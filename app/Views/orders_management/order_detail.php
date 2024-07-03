<?= $this->include('partials/main') ?>

<head>

    <?php echo $title_meta ?>


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

                                <div class="row col-md-9">

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
                                <div class="col-md-3">
                                    <div class=" text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" id="invoice_modal">Generate Invoice</button>
                                    </div>
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
        <?= $this->include('invoice/invoice_modal') ?>
        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/jszip/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.6/xlsx.full.min.js"></script>


<script type="text/javascript">

     function deleteLead(id) {
        if (confirm('Are you sure you want to delete this lead?')) {
            $.ajax({
                url: '<?= site_url('delete-lead/') ?>' + id,
                type: 'GET',
                success: function(response) {
                    if (JSON.parse(response).success) {
                        toastr.success('Lead Delete', 'Lead Deleted Successfully')

                        // Reload the datatable
                        $('#table').DataTable().ajax.reload();
                    } else {
                        console.log(JSON.parse(response).success);
                        // toastr.error('Lead Delete', 'Error')
                    }
                },
                error: function() {
                    alert('Error deleting lead');
                }
            });
        }
    }
    
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        columnDefs: [{
            target: 0,
            visible: false,
            searchable: false
        }, ],
        order: [],
        ajax: {
            url: "<?php echo site_url('leads-datatable') ?>/" + <?php echo $order['pkorderid'] ?>,
            data: function(d) {
                d.lead_status = "";
                d.state = "";
                d.client = "";

            }

        },
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
            console.log(aData[0]);
        },

    });

    $(function() {

        $("#invoice_modal").click(function() {
            $("#invoiceModal").modal('show');
        });
    });
</script>

<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js') ?>"></script>

</body>

</html>