<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>
        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

        <?= $this->include('./partials/head-css') ?>

    </head>

    <?= $this->include('./partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('./partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?=  $page_title ?>
                      
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Add Email Template<i class="uil-plus ms-2"></i></button>
                    </div> -->
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>User Type</th>
                            <th>Event</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
        
        </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">User Detail</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    <div class="offcanvas-body" id="userDetails">
      
    </div>
    </div>

                <?= $this->include('./partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('./partials/right-sidebar') ?>

        <?= $this->include('./partials/vendor-scripts') ?>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        </script>
    <script type="text/javascript">
 
    $(document).ready(function() {

       
        var table = $('#table').DataTable({ 
            processing: true,
            serverSide: true,
            columnDefs: [
                {
                    target: 0,
                    visible: false,
                    searchable: false
                },
            ],
           /* dom: 'Blfrtip',
            buttons: [
                      'csv', 'excel', 'print','colvis',
                    ],*/
            order: [], //init datatable not ordering
            ajax: "<?php echo base_url('ajax-emailtemplates-datatable')?>",
            "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                $(nRow).attr('id', aData[0]);
            }

            
        });
        var offcanvasright = document.getElementById('offcanvasRight')
        table.on('click','tr:not(:first)',function(e){

             if($(e.target).is($(this).find('td:last')) || $(e.target).is($(this).find('i')))
             {
                return;
             }
             var uid = $(this).attr('id');
             $.ajax({
              url: '<?= base_url() ?>/getuserid/'+uid,
              type: 'get',
              success: function(data)
              {
                $("#userDetails").html(data);
              }
          });
             var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasright);
              bsOffcanvas2.show();
        });

    });
    </script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>


   

    </body>
</html>
