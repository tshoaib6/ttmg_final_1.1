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
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Line with Data Labels</h4>

                                        <div id="line_chart_datalabel" data-colors='["--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>                              
                                    </div>
                                </div><!--end card-->
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Dashed Line</h4>
                                        
                                        <div id="line_chart_dashed" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]' class="apex-charts" dir="ltr"></div>        
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Spline Area</h4>

                                        <div id="spline_area" data-colors='["--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>                      
                                    </div>
                                </div><!--end card-->
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Column Chart</h4>
                                        
                                        <div id="column_chart" data-colors='["--bs-warning", "--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>                                      
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Column with Data Labels</h4>
                                        
                                        <div id="column_chart_datalabel" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Bar Chart</h4>
                                        
                                        <div id="bar_chart" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>  
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Line, Column & Area Chart</h4>
                                        
                                        <div id="mixed_chart" data-colors='["--bs-success", "--bs-light", "--bs-warning"]' class="apex-charts" dir="ltr"></div> 
                                    </div>
                                </div><!--end card-->
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Radial Chart</h4>
                                        
                                        <div id="radial_chart" data-colors='["--bs-primary", "--bs-success", "--bs-info" ,"--bs-warning"]' class="apex-charts" dir="ltr"></div>  
                                    </div>
                                </div><!--end card-->
                                
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Pie Chart</h4>
                                        
                                        <div id="pie_chart" data-colors='["--bs-success", "--bs-primary", "--bs-warning" ,"--bs-info", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Donut Chart</h4>
                                        
                                        <div id="donut_chart" data-colors='["--bs-success", "--bs-primary", "--bs-warning" ,"--bs-info", "--bs-danger"]' class="apex-charts"  dir="ltr"></div>
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

        <!-- apexcharts init -->
        <script src="assets/js/pages/apexcharts.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>
