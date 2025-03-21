<?php

/** ---------------------------------------------------------------------------------------------------
 * Email Cron
 * Send emails that are stored in the email queue (database)
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *      - the scheduler is set to run this every minuted
 *      - the schedler itself is evoked by the signle cronjob set in cpanel (which runs every minute)
 * @package    Grow CRM
 * @author     NextLoop
 *-----------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs\Landlord;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailCron {

    public function __invoke() {

        //[MT] - run config settings for landlord
        runtimeLandlordCronConfig();

        //[MT] - landlord only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current()) {
                return;
            }
        }

        /**
         * Send emails
         *   These emails are being sent every minute. You can set a higher or lower sending limit.
         */
        $limit = 20;
        if ($emails = \App\Models\Landlord\EmailQueue::On('landlord')->Where('emailqueue_type', 'general')->where('emailqueue_status', 'new')->take($limit)->get()) {

            //mark all emails in the batch as processing - to avoid batch duplicates/collisions
            foreach ($emails as $email) {
                $email->update([
                    'emailqueue_status' => 'processing',
                    'emailqueue_started_at' => now(),
                ]);
            }

            //now process
            foreach ($emails as $email) {

                //send the email (only to a valid email address)
                if ($email->emailqueue_to != '') {
                    Mail::to($email->emailqueue_to)->send(new \App\Mail\Landlord\SendQueued($email));
                    //log email
                    $log = new \App\Models\Landlord\EmailLog();
                    $log->setConnection('landlord');
                    $log->emaillog_email = $email->emailqueue_to;
                    $log->emaillog_subject = $email->emailqueue_subject;
                    $log->emaillog_body = $email->emailqueue_message;
                    $log->save();

                }
                //delete email from the queue
                \App\Models\EmailQueue::On('landlord')->Where('emailqueue_id', $email->emailqueue_id)->delete();
            }
        }

        //reset last cron run data
        \App\Models\Settings::On('landlord')->Where('settings_id', 'default')
            ->update([
                'settings_cronjob_has_run' => 'yes',
                'settings_cronjob_last_run' => now(),
            ]);

    }
}