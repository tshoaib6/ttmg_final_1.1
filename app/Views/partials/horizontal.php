<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->

            <?php
            $company_logo_settings = json_decode(get_option('companysettings'), 1);
            $company_logo = base_url('uploads/') . $company_logo_settings['companylogo'];
            $company_name = $company_logo_settings['companyname'];
            if (session()->has('branch_set')) {
                $company_logo = base_url('uploads/users/') . session()->branch_branchlogo;
            }


            ?>
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= $company_logo ?>" alt="" height="60">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= $company_logo ?>" alt="" height="60">
                    </span>
                </a>

                <a href="/home" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= $company_logo ?>" alt="" height="60">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= $company_logo ?>" alt="" height="60">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <!-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="<?= lang('Files.Search') ?>...">
                    <span class="uil-search"></span>
                </div>
            </form> -->
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?= lang('Files.Search') ?> ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            $session = \Config\Services::session();
            ?>





            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="uil-bell"></i>
                    <span class="badge bg-danger rounded-pill" id="notifytotalcount">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16">
                                    <?= lang('Files.Notifications') ?>
                                </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" onClick="notification_read_unread_all()" class="small">
                                    <?= lang('Files.Mark all as read') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 100%;" id="top-notification-list">

                        <!--  <a href="javascript:void(0);" class="text-dark notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1"></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> </p>
                                    </div>
                                </div>
                            </div>
                        </a>  -->

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center"
                                href="<?= base_url('all-notifications') ?>">
                                <i class="uil-arrow-circle-right me-1"></i>
                                <?= lang('Files.View More') ?>..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="<?php echo base_url('uploads/users/') . $session->get('login_useruimage'); ?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">
                        <?= $session->get('login_firstname'); ?>
                    </span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?= base_url('profile') ?>"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">
                            <?= lang('Files.View Profile') ?>
                        </span></a>

                    <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle"><?= lang('Files.My Wallet') ?></span></a>
                    <a class="dropdown-item d-block" href="javascript:void(0)"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle"><?= lang('Files.Settings') ?></span> <span class="badge bg-success-subtle text-success rounded-pill mt-1 ms-2">03</span></a>
                    <a class="dropdown-item" href="auth-lock-screen"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle"><?= lang('Files.Lock screen') ?></span></a> -->

                    <a class="dropdown-item" href="<?= base_url('logout') ?>"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">
                            <?= lang('Files.Sign out') ?>
                        </span></a>
                </div>
            </div>

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div> -->

        </div>
    </div>
    <div class="container-fluid">
        <div class="topnav">

            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">
                                <i class="uil-home-alt me-2"></i>
                                <?= lang('Files.Dashboard') ?>
                            </a>
                        </li>

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                <i class="uil-flask me-2"></i><?= lang('Files.UI Elements') ?> <div class="arrow-down"></div>
                            </a>

                            <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                aria-labelledby="topnav-uielement">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-alerts" class="dropdown-item"><?= lang('Files.Alerts') ?></a>
                                            <a href="ui-buttons" class="dropdown-item"><?= lang('Files.Buttons') ?></a>
                                            <a href="ui-cards" class="dropdown-item"><?= lang('Files.Cards') ?></a>
                                            <a href="ui-carousel" class="dropdown-item"><?= lang('Files.Carousel') ?></a>
                                            <a href="ui-dropdowns" class="dropdown-item"><?= lang('Files.Dropdowns') ?></a>
                                            <a href="ui-grid" class="dropdown-item"><?= lang('Files.Grid') ?></a>
                                            <a href="ui-images" class="dropdown-item"><?= lang('Files.Images') ?></a>
                                            <a href="ui-lightbox" class="dropdown-item"><?= lang('Files.Lightbox') ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>                                            
                                            <a href="ui-modals" class="dropdown-item"><?= lang('Files.Modals') ?></a>
                                            <a href="ui-offcanvas" class="dropdown-item"><?= lang('Files.Offcanvas') ?></a>
                                            <a href="ui-rangeslider" class="dropdown-item"><?= lang('Files.Range Slider') ?></a>
                                            <a href="ui-session-timeout" class="dropdown-item"><?= lang('Files.Session Timeout') ?></a>
                                            <a href="ui-progressbars" class="dropdown-item"><?= lang('Files.Progress Bars') ?></a>
                                            <a href="ui-placeholders" class="dropdown-item"><?= lang('Files.Placeholders') ?></a>
                                            <a href="ui-sweet-alert" class="dropdown-item"><?= lang('Files.Sweet-Alert') ?></a>
                                            <a href="ui-tabs-accordions" class="dropdown-item"><?= lang('Files.Tabs & Accordions') ?></a>                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>                                            
                                            <a href="ui-typography" class="dropdown-item"><?= lang('Files.Typography') ?></a>
                                            <a href="ui-toasts" class="dropdown-item"><?= lang('Files.Toasts') ?></a>
                                            <a href="ui-video" class="dropdown-item"><?= lang('Files.Video') ?></a>
                                            <a href="ui-general" class="dropdown-item"><?= lang('Files.General') ?></a>
                                            <a href="ui-colors" class="dropdown-item"><?= lang('Files.Colors') ?></a>
                                            <a href="ui-rating" class="dropdown-item"><?= lang('Files.Rating') ?></a>
                                            <a href="ui-notifications" class="dropdown-item"><?= lang('Files.Notifications') ?></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li> -->

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i class="uil-apps me-2"></i><?= lang('Files.Apps') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="calendar" class="dropdown-item"><?= lang('Files.Calendar') ?></a>
                                <a href="chat" class="dropdown-item"><?= lang('Files.Chat') ?></a>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                        role="button">
                                        <?= lang('Files.Email') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-email">
                                        <a href="email-inbox" class="dropdown-item"><?= lang('Files.Inbox') ?></a>
                                        <a href="email-read" class="dropdown-item"><?= lang('Files.Read Email') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                        role="button">
                                        <?= lang('Files.Ecommerce') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                        <a href="ecommerce-products" class="dropdown-item"><?= lang('Files.Products') ?></a>
                                        <a href="ecommerce-product-detail" class="dropdown-item"><?= lang('Files.Product Detail') ?></a>
                                        <a href="ecommerce-orders" class="dropdown-item"><?= lang('Files.Orders') ?></a>
                                        <a href="ecommerce-customers" class="dropdown-item"><?= lang('Files.Customers') ?></a>
                                        <a href="ecommerce-cart" class="dropdown-item"><?= lang('Files.Cart') ?></a>
                                        <a href="ecommerce-checkout" class="dropdown-item"><?= lang('Files.Checkout') ?></a>
                                        <a href="ecommerce-shops" class="dropdown-item"><?= lang('Files.Shops') ?></a>
                                        <a href="ecommerce-add-product" class="dropdown-item"><?= lang('Files.Add Product') ?></a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                        role="button">
                                        <?= lang('Files.Invoices') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                        <a href="invoices-list" class="dropdown-item"><?= lang('Files.Invoice List') ?></a>
                                        <a href="invoices-detail" class="dropdown-item"><?= lang('Files.Invoice Detail') ?></a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                        role="button">
                                        <?= lang('Files.Contacts') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                        <a href="contacts-grid" class="dropdown-item"><?= lang('Files.User Grid') ?></a>
                                        <a href="contacts-list" class="dropdown-item"><?= lang('Files.User List') ?></a>
                                        <a href="contacts-profile" class="dropdown-item"><?= lang('Files.Profile') ?></a>
                                    </div>
                                </div>
                            </div> -->
                        </li>

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                               >
                                <i class="uil-layers me-2"></i><?= lang('Files.Components') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                        role="button">
                                        <?= lang('Files.Forms') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-form">
                                        <a href="form-elements" class="dropdown-item"><?= lang('Files.Basic Elements') ?></a>
                                        <a href="form-validation" class="dropdown-item"><?= lang('Files.Validation') ?></a>
                                        <a href="form-advanced" class="dropdown-item"><?= lang('Files.Advanced Plugins') ?></a>
                                        <a href="form-editors" class="dropdown-item"><?= lang('Files.Editors') ?></a>
                                        <a href="form-uploads" class="dropdown-item"><?= lang('Files.File Upload') ?></a>
                                        <a href="form-xeditable" class="dropdown-item"><?= lang('Files.Xeditable') ?></a>
                                        <a href="form-repeater" class="dropdown-item"><?= lang('Files.Repeater') ?></a>
                                        <a href="form-wizard" class="dropdown-item"><?= lang('Files.Wizard') ?></a>
                                        <a href="form-mask" class="dropdown-item"><?= lang('Files.Mask') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                        role="button">
                                        <?= lang('Files.Tables') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-table">
                                        <a href="tables-basic" class="dropdown-item"><?= lang('Files.Bootstrap Basic') ?></a>
                                        <a href="tables-datatable" class="dropdown-item"><?= lang('Files.Datatables') ?></a>
                                        <a href="tables-responsive" class="dropdown-item"><?= lang('Files.Responsive') ?></a>
                                        <a href="tables-editable" class="dropdown-item"><?= lang('Files.Editable') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                        role="button">
                                        <?= lang('Files.Charts') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                        <a href="charts-apex" class="dropdown-item"><?= lang('Files.Apex') ?></a>
                                        <a href="charts-chartjs" class="dropdown-item"><?= lang('Files.Chartjs') ?></a>
                                        <a href="charts-flot" class="dropdown-item"><?= lang('Files.Flot') ?></a>
                                        <a href="charts-knob" class="dropdown-item"><?= lang('Files.Jquery Knob') ?></a>
                                        <a href="charts-sparkline" class="dropdown-item"><?= lang('Files.Sparkline') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                        role="button">
                                        <?= lang('Files.Icons') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                        <a href="icons-unicons" class="dropdown-item"><?= lang('Files.Unicons') ?></a>
                                        <a href="icons-boxicons" class="dropdown-item"><?= lang('Files.Boxicons') ?></a>
                                        <a href="icons-materialdesign" class="dropdown-item"><?= lang('Files.Material Design') ?></a>
                                        <a href="icons-dripicons" class="dropdown-item"><?= lang('Files.Dripicons') ?></a>
                                        <a href="icons-fontawesome" class="dropdown-item"><?= lang('Files.Font Awesome') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                        role="button">
                                        <?= lang('Files.Maps') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-map">
                                        <a href="maps-google" class="dropdown-item"><?= lang('Files.Google') ?></a>
                                        <a href="maps-vector" class="dropdown-item"><?= lang('Files.Vector') ?></a>
                                        <a href="maps-leaflet" class="dropdown-item"><?= lang('Files.Leaflet') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>
     -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                <i class="uil-copy me-2"></i><?= lang('Files.Extra Pages') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-more">
                                
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                        role="button">
                                        <?= lang('Files.Authentication') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                        <a href="auth-login" class="dropdown-item"><?= lang('Files.Login') ?></a>
                                        <a href="auth-register" class="dropdown-item"><?= lang('Files.Register') ?></a>
                                        <a href="auth-recoverpw" class="dropdown-item"><?= lang('Files.Recover Password') ?></a>
                                        <a href="auth-lock-screen" class="dropdown-item"><?= lang('Files.Lock Screen') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                        role="button">
                                        <?= lang('Files.Utility') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                        <a href="pages-starter" class="dropdown-item"><?= lang('Files.Starter Page') ?></a>
                                        <a href="pages-maintenance" class="dropdown-item"><?= lang('Files.Maintenance') ?></a>
                                        <a href="pages-comingsoon" class="dropdown-item"><?= lang('Files.Coming Soon') ?></a>
                                        <a href="pages-timeline" class="dropdown-item"><?= lang('Files.Timeline') ?></a>
                                        <a href="pages-faqs" class="dropdown-item"><?= lang('Files.FAQs') ?></a>
                                        <a href="pages-pricing" class="dropdown-item"><?= lang('Files.Pricing') ?></a>
                                        <a href="pages-404" class="dropdown-item"><?= lang('Files.Error') ?> 404</a>
                                        <a href="pages-500" class="dropdown-item"><?= lang('Files.Error') ?> 500</a>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                               >
                                <i class="uil-window-section me-2"></i><?= lang('Files.Layouts') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-verti"
                                        role="button">
                                        <?= lang('Files.Vertical') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-verti">
                                        <a href="layouts-dark-sidebar" class="dropdown-item"><?= lang('Files.Dark Sidebar') ?></a>
                                        <a href="layouts-compact-sidebar" class="dropdown-item"><?= lang('Files.Compact Sidebar') ?></a>
                                        <a href="layouts-icon-sidebar" class="dropdown-item"><?= lang('Files.Icon Sidebar') ?></a>
                                        <a href="layouts-boxed" class="dropdown-item"><?= lang('Files.Boxed Width') ?></a>
                                        <a href="layouts-preloader" class="dropdown-item"><?= lang('Files.Preloader') ?></a>
                                        <a href="layouts-colored-sidebar" class="dropdown-item"><?= lang('Files.Colored Sidebar') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-hori"
                                        role="button">
                                        <?= lang('Files.Horizontal') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-hori">
                                        <a href="layouts-horizontal" class="dropdown-item"><?= lang('Files.Horizontal') ?></a>
                                        <a href="layouts-hori-topbar-dark" class="dropdown-item"><?= lang('Files.Dark Topbar') ?></a>
                                        <a href="layouts-hori-boxed-width" class="dropdown-item"><?= lang('Files.Boxed Width') ?></a>
                                        <a href="layouts-hori-preloader" class="dropdown-item"><?= lang('Files.Preloader') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li> -->

                        <?php if (is_admin()) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-user me-2"></i>Users <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="<?= base_url('allUsers') ?>" class="dropdown-item">All Users</a>
                                    <a href="<?= base_url('register') ?>" class="dropdown-item">User Registration</a>

                                </div>
                            </li>
                        <?php } ?>

                        <?php if (count(has_subvendors()) > 0 && !is_admin()) { ?>
                            <li class="nav-item dropdown">
                                <button class="nav-link  arrow-none link-subvendor" href="#" id="topnav-pages link-subvendor" role="button">
                                    <i class="uil-user me-2"></i>Sub Vendors <div class=""></div>
                                </button>
                            </li>
                        <?php } ?>




                        <?php if (is_admin()) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-user me-2"></i>Campaigns <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="<?= base_url('campaign-index') ?>" class="dropdown-item">All Campaigns</a>
                                    <a href="<?= base_url('create-campaign') ?>" class="dropdown-item">Create Campaign</a>
                                </div>
                            </li>
                        <?php } ?>

                        <?php if (is_admin() || is_vendor()) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-user me-2"></i>Orders <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="<?= base_url('order-index') ?>" class="dropdown-item">All Orders</a>
                                    <?php $camp = get_categories();
                                    foreach ($camp as $c) { ?>
                                        <a href="<?= base_url('campaign-detail/' . $c['id']) ?>" class="dropdown-item">
                                            <?php echo $c['campaign_name'] ?>
                                        </a>

                                    <?php } ?>
                                    <a href="<?= base_url('create-order') ?>" class="dropdown-item">Create New Order</a>
                                </div>
                            </li>
                        <?php } ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i class="uil-user me-2"></i>Leads <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <?php if(is_admin()){ ?>
                            <a href="<?= base_url('master-lead-index') ?>" class="dropdown-item">Master Leads (Leads Center)</a>
                            <?php }?>
                            <a href="<?= base_url('lead-index') ?>" class="dropdown-item">Client Leads</a>
                                <a href="<?= base_url('add-lead') ?>" class="dropdown-item">Add Lead</a>
                            </div>
                        </li>

                        <?php if (is_admin() || is_vendor()) { ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-user-circle me-2"></i>Referrals <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#referralModal">Send Referral</a>
                                    <a href="<?= base_url('all-referral') ?>" class="dropdown-item">My Referrals</a>

                                </div>
                            </li>
                        <?php } ?>


                        <?php if (is_admin()) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-cog me-2"></i>Settings <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="<?= base_url('allEmail') ?>" class="dropdown-item">Email Template</a>
                                    <a href="<?= base_url('email-action') ?>" class="dropdown-item">Email Action</a>
                                    <a href="<?= base_url('all-notifications') ?>" class="dropdown-item">Notifications</a>
                                    <a href="<?= base_url('all-activities') ?>" class="dropdown-item">Activity Logs</a>
                                    <a href="<?= base_url('settings') ?>" class="dropdown-item">System Settings</a>

                                </div>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('support-request-center') ?>">
                                <i class="uil-megaphone me-2"></i> Support & Request
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightSv" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Sub Vendor Details</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="sv_details">

    </div>
</div>

<script>
   
   
</script>