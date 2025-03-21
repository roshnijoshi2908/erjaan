<!--rows-->
<?php $__currentLoopData = $timesheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <!--full_name-->
    <td>
        <a href="<?php echo e(url('/project/'.$timesheet->project_id )); ?>"><?php echo e(str_limit_reports($timesheet->project_title ?? '---', 50)); ?></a>
    </td>

    <!--sum_not_invoiced-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($timesheet->sum_not_invoiced)); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($timesheet->sum_not_invoiced)); ?>

    </td>


    <!--sum_invoiced-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($timesheet->sum_invoiced)); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($timesheet->sum_invoiced)); ?>

    </td>

    <!--sum_hours-->
    <td>
        <?php echo e(runtimeSecondsWholeHours($timesheet->sum_hours)); ?>:<?php echo e(runtimeSecondsWholeMinutesZero($timesheet->sum_hours)); ?>

    </td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/pages/reports/timesheets/project/ajax.blade.php ENDPATH**/ ?>