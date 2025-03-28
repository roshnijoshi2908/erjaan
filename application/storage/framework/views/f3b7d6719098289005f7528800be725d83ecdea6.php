<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="js-trigger-nav-team">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="main-scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" id="main-sidenav">
            <ul id="sidebarnav" data-modular-id="main_menu_team">



                <!--home-->
                <?php if(auth()->user()->role->role_homepage == 'dashboard'): ?>
                <li data-modular-id="main_menu_team_home"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_home'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.home'))); ?>">
                    <a class="waves-effect waves-dark" href="/home" aria-expanded="false" target="_self">
                        <i class="ti-home"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.dashboard'))); ?>

                        </span>
                    </a>
                </li>
                <!--home-->
                <?php endif; ?>
                
                 <!--home-->
                <?php if(auth()->user()->role->role_dashboard != 0): ?>
                <li data-modular-id="main_menu_team_homes"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_homes'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.home1'))); ?>">
                    <a class="waves-effect waves-dark" href="/dashboard" aria-expanded="false" target="_self">
                        <i class="ti-home"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.dashboard1'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--home-->
                

                <!--users[done]-->
                <?php if(runtimeGroupMenuVibility([config('visibility.modules.clients'),
                config('visibility.modules.users')])): ?>
                <li data-modular-id="main_menu_team_clients"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_customers'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-people"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.customers'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(config('visibility.modules.clients')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_customers'] ?? ''); ?>" id="submenu_clients">
                            <a href="/clients"
                                class="<?php echo e($page['submenu_customers'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.clients'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.users')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_contacts'] ?? ''); ?>" id="submenu_contacts">
                            <a href="/users"
                                class="<?php echo e($page['submenu_contacts'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.client_users'))); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <!--customers-->

                <!--projects[done]-->
                <?php if(config('visibility.modules.projects')): ?>
                <li data-modular-id="main_menu_team_projects"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_projects'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-folder"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.projects'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(config('system.settings_projects_categories_main_menu') == 'yes'): ?>
                        <?php $__currentLoopData = config('projects_categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="sidenav-submenu" id="submenu_projects">
                            <a href="<?php echo e(_url('/projects?filter_category='.$category->category_id)); ?>"
                                class="<?php echo e($page['submenu_projects_category_'.$category->category_id] ?? ''); ?>"><?php echo e($category->category_name); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_projects'] ?? ''); ?>" id="submenu_projects">
                            <a href="<?php echo e(_url('/projects')); ?>"
                                class="<?php echo e($page['submenu_projects'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.projects'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_templates'] ?? ''); ?>"
                            id="submenu_project_templates">
                            <a href="<?php echo e(_url('/templates/projects')); ?>"
                                class="<?php echo e($page['submenu_templates'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.templates'))); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <!--projects-->

                <!--Suppliers[done]-->
                 <?php if(config('visibility.modules.supplier')): ?>
                <li data-modular-id="main_menu_team_suppliers"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_suppliers'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-folder"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.supplier'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu <?php echo e($page['submenu_suppliers_category'] ?? ''); ?>" id="submenu_suppliers_category">
                            <a href="<?php echo e(_url('/supplier/category')); ?>"
                                class="<?php echo e($page['submenu_suppliers_category'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.suppliers_categories'))); ?></a>
                        </li>
                        <?php if(config('visibility.modules.supplier_category')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_supplier'] ?? ''); ?>"
                            id="submenu_suppliers">
                            <a href="<?php echo e(_url('/supplier')); ?>"
                                class="<?php echo e($page['submenu_supplier'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.supplier'))); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <!--Suppliers-->
                
                <!--procurement-->
                <?php if(config('visibility.modules.purchases') || config('visibility.modules.purchase_gm_approval') || config('visibility.modules.purchase_accountant')): ?>
                <li data-modular-id="main_menu_team_procurement"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_procurement'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <!--<i class="ti-folder"></i>-->
                        <!--<span class="hide-menu"><?php echo e(cleanLang(__('lang.procurement'))); ?>-->
                        <!--</span>-->
                        <i class="ti-folder"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.procurement'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                       <?php if(config('visibility.modules.purchases')): ?>
                         <li class="sidenav-submenu <?php echo e($page['submenu_purchases'] ?? ''); ?>"
                            id="submenu_purchase">
                            <a href="<?php echo e(_url('/purchase')); ?>"
                                class="<?php echo e($page['submenu_purchases'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.purchases'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.purchase_gm_approval')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_gm_approvals'] ?? ''); ?>" id="submenu_gm_approvals">
                            <a href="<?php echo e(_url('/gm-approvals')); ?>"
                                class="<?php echo e($page['submenu_gm_approvals'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.gm_approvals'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.purchase_accountant')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_accountant'] ?? ''); ?>"
                            id="submenu_accountant">
                            <a href="<?php echo e(_url('/accountant')); ?>"
                                class="<?php echo e($page['submenu_accountant'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.accountant'))); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <!--procurement-->
                
               
                <!--general-expense-->
                <?php if(config('visibility.modules.generalexpence') || 
                    config('visibility.modules.generalexpence_gm_approval') || 
                    config('visibility.modules.generalexpence_accountant') || 
                    config('visibility.modules.generalexpence_category')): ?>
                    
                    <li data-modular-id="main_menu_general_expence" class="sidenav-menu-item <?php echo e($page['mainmenu_general_expence'] ?? ''); ?>">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-folder"></i>
                            <span class="hide-menu"><?php echo e(cleanLang(__('lang.general_expence'))); ?></span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <?php if(config('visibility.modules.generalexpence_category')): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_generalexpences_category'] ?? ''); ?>" id="submenu_generalexpences_category">
                                    <a href="<?php echo e(_url('/general-expense/category')); ?>" class="<?php echo e($page['submenu_generalexpences_category'] ?? ''); ?>">
                                        <?php echo e(cleanLang(__('lang.category'))); ?>

                                    </a>
                                </li>
                                <li class="sidenav-submenu <?php echo e($page['submenu_generalexpences_subcategory'] ?? ''); ?>" id="submenu_generalexpences_subcategory">
                                    <a href="<?php echo e(_url('/general-expense/subcategory')); ?>" class="<?php echo e($page['submenu_generalexpences_subcategory'] ?? ''); ?>">
                                        <?php echo e(cleanLang(__('lang.subcategory'))); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                
                            <?php if(config('visibility.modules.generalexpence')): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_generalexpences'] ?? ''); ?>" id="submenu_genralexpence">
                                    <a href="<?php echo e(_url('/general-expense')); ?>" class="<?php echo e($page['submenu_generalexpences'] ?? ''); ?>">
                                        <?php echo e(cleanLang(__('lang.general_expence_request'))); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                
                            <?php if(config('visibility.modules.generalexpence_gm_approval')): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_gm_approvals'] ?? ''); ?>" id="submenu_generalexpences_gm_approvals">
                                    <a href="<?php echo e(_url('/general-expense/gm-approvals')); ?>" class="<?php echo e($page['submenu_gm_approvals'] ?? ''); ?>">
                                        <?php echo e(cleanLang(__('lang.gm_approvals'))); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                
                            <?php if(config('visibility.modules.generalexpence_accountant')): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_accountant'] ?? ''); ?>" id="submenu_generalexpences_accountant">
                                    <a href="<?php echo e(_url('/general-expense/accountant')); ?>" class="<?php echo e($page['submenu_accountant'] ?? ''); ?>">
                                        <?php echo e(cleanLang(__('lang.accountant'))); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!--general-expense-->

                <!--tasks[done]-->
                <?php if(config('visibility.modules.tasks')): ?>
                <li data-modular-id="main_menu_team_tasks"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_tasks'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.tasks'))); ?>">
                    <a class="waves-effect waves-dark" href="/tasks" aria-expanded="false" target="_self">
                        <i class="ti-menu-alt"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.tasks'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--tasks-->

                <!--leads[done]-->
                <?php if(config('visibility.modules.leads')): ?>
                <li data-modular-id="main_menu_team_leads"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_leads'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.leads'))); ?>">
                    <a class="waves-effect waves-dark" href="/leads" aria-expanded="false" target="_self">
                        <i class="sl-icon-call-in"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.leads'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--leads-->

                <!--sales-->
                <?php if(runtimeGroupMenuVibility([config('visibility.modules.invoices'),
                config('visibility.modules.payments'), config('visibility.modules.estimates'),
                config('visibility.modules.products'), config('visibility.modules.expenses'),
                config('visibility.modules.proposals')])): ?>
                <li data-modular-id="main_menu_team_billing"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_sales'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-wallet"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.sales'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(config('visibility.modules.invoices')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_invoices'] ?? ''); ?>" id="submenu_invoices">
                            <a href="/invoices"
                                class=" <?php echo e($page['submenu_invoices'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.invoices'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.payments')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_payments'] ?? ''); ?>" id="submenu_payments">
                            <a href="/payments"
                                class=" <?php echo e($page['submenu_payments'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.payments'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.estimates')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_estimates'] ?? ''); ?>" id="submenu_estimates">
                            <a href="/estimates"
                                class=" <?php echo e($page['submenu_estimates'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.estimates'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.subscriptions')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_subscriptions'] ?? ''); ?>"
                            id="submenu_subscriptions">
                            <a href="/subscriptions"
                                class=" <?php echo e($page['submenu_subscriptions'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.subscriptions'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.products')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_products'] ?? ''); ?>" id="submenu_products">
                            <a href="/products"
                                class=" <?php echo e($page['submenu_products'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.products'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.expenses')): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_expenses'] ?? ''); ?>" id="submenu_expenses">
                            <a href="/expenses"
                                class=" <?php echo e($page['submenu_expenses'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.expenses'))); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <!--billing-->


                <!--proposals [multiple]-->
                <?php if(config('visibility.modules.proposals') && auth()->user()->role->role_templates_proposals > 0): ?>
                <!--multipl menu-->
                <li data-modular-id="main_menu_team_proposals"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_proposals'] ?? ''); ?>">
                    <!--multiple menu-->
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-bookmark-alt"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.proposals'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu <?php echo e($page['submenu_proposals'] ?? ''); ?>" id="submenu_proposals">
                            <a href="<?php echo e(_url('/proposals')); ?>"
                                class="<?php echo e($page['submenu_proposals'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.proposals'))); ?></a>
                        </li>
                        <li class="sidenav-submenu <?php echo e($page['submenu_proposal_templates'] ?? ''); ?>"
                            id="submenu_proposal_templates">
                            <a href="<?php echo e(_url('/templates/proposals')); ?>"
                                class="<?php echo e($page['submenu_templates'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.templates'))); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <!--proposals-->

                <!--proposals [single]-->
                <?php if(config('visibility.modules.proposals') && auth()->user()->role->role_templates_proposals == 0): ?>
                <li data-modular-id="main_menu_team_proposals"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_proposals'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.proposals'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/proposals" aria-expanded="false" target="_self">
                        <i class="ti-bookmark-alt"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.proposals'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>


                <!--contracts [multiple]-->
                <?php if(config('visibility.modules.contracts') && auth()->user()->role->role_templates_contracts > 0): ?>
                <!--multipl menu-->
                <li data-modular-id="main_menu_team_contracts"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_contracts'] ?? ''); ?>">
                    <!--multiple menu-->
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-write"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.contracts'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu <?php echo e($page['submenu_contracts'] ?? ''); ?>" id="submenu_contracts">
                            <a href="<?php echo e(_url('/contracts')); ?>"
                                class="<?php echo e($page['submenu_contracts'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.contracts'))); ?></a>
                        </li>
                        <li class="sidenav-submenu <?php echo e($page['submenu_contract_templates'] ?? ''); ?>"
                            id="submenu_contract_templates">
                            <a href="<?php echo e(_url('/templates/contracts')); ?>"
                                class="<?php echo e($page['submenu_templates'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.templates'))); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <!--contracts-->

                <!--contracts [single]-->
                <?php if(config('visibility.modules.contracts') && auth()->user()->role->role_templates_contracts == 0): ?>
                <li data-modular-id="main_menu_team_contracts"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_contracts'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.contracts'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/contracts" aria-expanded="false" target="_self">
                        <i class="ti-write"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.contracts'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>


                <!--affiliates-->
                <?php if(auth()->user()->is_admin && config('settings.custom_modules.cs_affiliate')): ?>
                <li class="sidenav-menu-item <?php echo e($page['mainmenu_cs_affiliates'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-badge"></i>
                        <span class="hide-menu"><?php echo app('translator')->get('lang.affiliates'); ?>
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li class="sidenav-submenu <?php echo e($page['submenu_templates'] ?? ''); ?>"
                            id="submenu_cs_affiliate_users">
                            <a href="<?php echo e(_url('/cs/affiliates/users')); ?>"
                                class="<?php echo e($page['submenu_cs_affiliate_users'] ?? ''); ?>"><?php echo app('translator')->get('lang.users'); ?></a>
                        </li>
                        <li class="sidenav-submenu <?php echo e($page['submenu_templates'] ?? ''); ?>"
                            id="submenu_cs_affiliate_projects">
                            <a href="<?php echo e(_url('/cs/affiliates/projects')); ?>"
                                class="<?php echo e($page['submenu_cs_affiliate_projects'] ?? ''); ?>"><?php echo app('translator')->get('lang.projects'); ?></a>
                        </li>
                        <li class="sidenav-submenu <?php echo e($page['submenu_templates'] ?? ''); ?>"
                            id="submenu_cs_affiliate_earnings">
                            <a href="<?php echo e(_url('/cs/affiliates/earnings')); ?>"
                                class="<?php echo e($page['submenu_cs_affiliate_earnings'] ?? ''); ?>"><?php echo app('translator')->get('lang.earnings'); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <!--affiliates-->


                <!--messaging-->
                <?php if(config('visibility.modules.messages')): ?>
                <li data-modular-id="main_menu_team_messages"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_messages'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.messages'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/messages" aria-expanded="false" target="_self">
                        <i class="sl-icon-bubbles"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.messages'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>

                <!--[MODULES] - dynamic menu-->
                <?php echo config('module_menus.main_menu_team'); ?>


                <!--spaces-->
                <?php if(config('visibility.modules.spaces')): ?>
                <li data-modular-id="main_menu_team_spaces hidden"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_spaces'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-layers"></i>
                        <span class="hide-menu"><?php echo app('translator')->get('lang.spaces'); ?>
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(config('system.settings2_spaces_user_space_status') == 'enabled'): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_spaces_my'] ?? ''); ?>" id="submenu_spaces_my">
                            <a href="<?php echo e(_url('/spaces/'.auth()->user()->space_uniqueid)); ?>"
                                class="<?php echo e($page['submenu_spaces_my'] ?? ''); ?>">
                                <?php echo e(config('system.settings2_spaces_user_space_menu_name')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('system.settings2_spaces_team_space_status') == 'enabled'): ?>
                        <li class="sidenav-submenu <?php echo e($page['submenu_spaces_team'] ?? ''); ?>" id="submenu_spaces_team">
                            <a href="<?php echo e(_url('/spaces/'.config('system.settings2_spaces_team_space_id'))); ?>"
                                class="<?php echo e($page['submenu_spaces_team'] ?? ''); ?>">
                                <?php echo e(config('system.settings2_spaces_team_space_menu_name')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <!--spaces-->


                <!--tickets-->
                <?php if(config('visibility.modules.tickets')): ?>
                <li class="sidenav-menu-item <?php echo e($page['mainmenu_tickets'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.tickets'))); ?>">
                    <a class="waves-effect waves-dark" href="/tickets" aria-expanded="false" target="_self">
                        <i class="ti-comments"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.support'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--tickets-->


                <!--knowledgebase-->
                <?php if(config('visibility.modules.knowledgebase')): ?>
                <li data-modular-id="main_menu_team_knowledgebase"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_kb'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.knowledgebase'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/knowledgebase" aria-expanded="false"
                        target="_self">
                        <i class="sl-icon-docs"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.knowledgebase'))); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--knowledgebase-->


                <!--knowledgebase-->
                <?php if(config('visibility.modules.reports')): ?>
                <li data-modular-id="main_menu_reports"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_reports'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.reports'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/reports" aria-expanded="false"
                        target="_self">
                        <i class="sl-icon-chart"></i>
                        <span class="hide-menu"><?php echo app('translator')->get('lang.reports'); ?>
                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <!--knowledgebase-->

                <!--other-->
                <?php if(auth()->user()->is_team): ?>
                <li data-modular-id="main_menu_team_team"
                    class="sidenav-menu-item <?php echo e($page['mainmenu_settings'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-panel"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.other'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="position-top collapse">
                        <?php if(config('visibility.modules.team')): ?>
                        <li class="sidenav-submenu mainmenu_team <?php echo e($page['submenu_team'] ?? ''); ?>" id="submenu_team">
                            <a href="/team"
                                class="<?php echo e($page['submenu_team'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.team_members'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(config('visibility.modules.timesheets')): ?>
                        <li class="sidenav-submenu mainmenu_timesheets <?php echo e($page['submenu_timesheets'] ?? ''); ?>"
                            id="submenu_timesheets">
                            <a href="/timesheets"
                                class="<?php echo e($page['submenu_timesheets'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.time_sheets'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->is_admin): ?>
                        <li class="sidenav-submenu mainmenu_settings <?php echo e($page['submenu_settings'] ?? ''); ?>"
                            id="submenu_settings">
                            <a href="/settings"
                                class="<?php echo e($page['submenu_settings'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.settings'))); ?></a>
                        </li>
                        <?php endif; ?>
                        <li class="sidenav-submenu mainmenu_bank <?php echo e($page['submenu_bank'] ?? ''); ?>"
                            id="submenu_banks">
                            <a href="/bank"
                                class="<?php echo e($page['submenu_bank'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.bank'))); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside><?php /**PATH /home2/lhxwbjte/erjaan.com/application/resources/views/nav/leftmenu-team.blade.php ENDPATH**/ ?>