<?= $this->include('partials/main') ?>

    <head>

        <?= $title_meta ?>

        <?= $this->include('partials/head-css') ?>

    </head>

    <?= $this->include('partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?= $page_title ?>

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo count($orders) ?> </span></h4>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        <?php if(!is_vendor()){?>
                             <div class="<?php if(is_vendor()) {?> col-xl-4 <?php } else { ?> col-xl-3 <?php } ?> col-md-6 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo count($vendors) ?></span></h4>
                                            <p class="text-muted mb-0">Vendors</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
<?php  } ?>
                            <div class="<?php if(is_vendor()) {?> col-xl-4 <?php } else { ?> col-xl-3 <?php  } ?> col-md-6 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="clients-chart" data-colors='["--bs-warning"]'> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo count($clients) ?></span></h4>
                                            <p class="text-muted mb-0">Clients</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->


                            <div class="<?php if(is_vendor()) {?> col-xl-4 <?php } else { ?> col-xl-3 <?php } ?> col-md-6 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $lead_count ?></span></h4>
                                            <p class="text-muted mb-0">Total Leads</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fw-semibold">Sort By</span> <span class="text-muted"><i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                    <a class="dropdown-item" href="#" onclick="dashboard_lead('monthly')">Monthly</a>
                                                    <a class="dropdown-item" href="#" onclick="dashboard_lead('yearly')">Yearly</a>
                                                    <a class="dropdown-item" href="#" onclick="dashboard_lead('weekly')">Weekly</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Leads Analytics</h4>

                                        <div class="mt-1">
                                            <ul class="list-inline main-chart mb-0">
    
                                                <li class="list-inline-item chart-border-left me-0">
                                                    <h3><span data-plugin="counterup" id="dashboard-total-leads">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Leads</span>
                                                    </h3>
                                                </li>
                                               <!--  <li class="list-inline-item chart-border-left me-0">
                                                    <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                                                </li> -->
                                            </ul>
                                        </div>

                                        <div class="mt-3">
                                            <div id="sales-analytics-chart" data-colors='["--bs-primary", "#dfe2e6", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                                            
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <div class="float-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" id="dropdownMenuButton3"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Recent<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>

                                               <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                                    <a class="dropdown-item" href="#">Recent</a>
                                                    <a class="dropdown-item" href="#">By Users</a>
                                                </div> 
                                            </div>
                                        </div> -->

                                        <h4 class="card-title mb-4">Recent Activity</h4>

                                        <ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 400px;">
                                            <?php foreach($activities as $activity){ ?>
                                            <li class="feed-item">
                                                <div class="feed-item-list">
                                                    <p class="text-muted mb-1 font-size-13"><?=time_ago($activity['created_at']) ?></p>
                                                    <p class="mb-0"><?=$activity['description'] ?> <span class="text-primary"><?=ucwords($activity['full_name']) ?></span></p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                            

                                        </ol>

                                    </div>
                                </div>
                            </div>
                           
                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" id="dropdownMenuButton3"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Filter<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>

                                               <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                                    <a class="dropdown-item" href="#">Today</a>
                                                    <a class="dropdown-item" href="#">Yesterday</a>
                                                </div> 
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Leads Delivered</h4>
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Active Order</th>
                                                        <th>Vendor Name</th>
                                                        <th>Date</th>
                                                        <th>Total Leads</th>
                                                        <th>Remaining Leads</th>
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php foreach($orders as $o){ ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $o['pkorderid'] ?></td>
                                                        <td><?php $vendor_detail=get_vendors($o['fkvendorstaffid']); echo $vendor_detail[0]['firstname']." ".$vendor_detail[0]['lastname'] ?></td>
                                                        <td><?php echo $o['orderdate'] ?> </td>
                                                        <td><?php echo $o['lead_requested'] ?></td>
                                                        <td><?php echo  $o['remainingLeads']?></td>
                                                    </tr>
                                                    
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <?= $this->include('partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('partials/right-sidebar') ?>

		<?= $this->include('partials/vendor-scripts') ?>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <?php require('assets/js/pages/dashboard.init-js.php'); ?>


        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>