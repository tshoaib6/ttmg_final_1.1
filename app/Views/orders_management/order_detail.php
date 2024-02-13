<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>


    </style>

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

                <?php echo $page_title ?>

                <div class="row">
                    <?= $this->include('partials/add-alert') ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <h6>Agent Name</h6>
                                    <p>
                                        <?php echo $order['agent'] ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <h6>Vendor</h6>
                                    <p>
                                        <?php $vendor = get_vendors($order['fkvendorstaffid']);
                                        echo $vendor[0]['firstname'] . " " . $vendor[0]['lastname'] ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <h6>Leads Requested</h6>
                                    <p>
                                        <?php echo $order['lead_requested'] ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <h6>Remaining Leads</h6>
                                    <p>
                                        <?php echo $order['remainingLeads'] ?>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <h6>Replacement Leads</h6>
                                    <p>
                                        <?php echo "0" ?>
                                    </p>
                                </div>

                            </div>
                            <hr>
                            <h5> Leads </h5>
                            <?= $this->include('leads_management/leads-table') ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/jszip/jszip.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.6/xlsx.full.min.js"></script>


<script type="text/javascript">
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
                order: [],
                ajax:  {
                    url: "<?php echo site_url('leads-datatable') ?>/" + <?php echo $order['pkorderid'] ?>,
                    
    },
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                console.log(aData[0]);
            },
               
        });
</script>

<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>

</html>