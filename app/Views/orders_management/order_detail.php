<?= $this->include('partials/main') ?>

<head>

    <?php echo $title_meta ?>

    <link rel="stylesheet" href="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/datatable-css') ?>
    <?= $this->include('partials/head-css') ?>

    <style>
        .offcanvas.offcanvas-end {
            width: 600px;
        }

        .offcanvas-body {
            max-height: calc(100vh - 150px);
            /* Adjust based on your header height */
            overflow-y: auto;
        }

        .counter {
            display: inline;
            margin-top: 0;
            margin-bottom: 0;
            margin-right: 10px;
        }

        .posts {
            clear: both;
            list-style: none;
            padding-left: 0;
            width: 100%;
            text-align: left;
        }

        .posts li {
            background-color: #fff;
            border: 1.5px solid #d8d8d8;
            border-radius: 10px;
            padding-top: 10px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 10px;
            margin-bottom: 10px;
            word-wrap: break-word;
            min-height: 42px;
        }
    </style>




</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>
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
                                <!-- <div class="col-md-3">
                                    <div class=" text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" id="invoice_modal">Generate Invoice</button>
                                    </div>
                                </div> -->


                            </div>
                            <hr>
                            <h5> Leads </h5>
                            <?= $this->include('leads_management/leads-table') ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('leads_management/reject_lead_modal') ?>
        <?= $this->include('leads_management/lead_detail_canva') ?>
        <?= $this->include('invoice/invoice_modal') ?>
        <?= $this->include('partials/footer') ?>
    </div>
</div>
<?= $this->include('partials/right-sidebar') ?>
<?= $this->include('partials/vendor-scripts') ?>
<?= $this->include('partials/datatable-scripts') ?>

<script src="<?=base_url('assets/libs/flatpickr/flatpickr.min.js')?>"></script>
<script src="<?=base_url('assets/libs/select2/js/select2.min.js')?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.6/xlsx.full.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {

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

        $("#invoice_modal").click(function() {
            $("#invoiceModal").modal('show');
        });

       

        $('input[name=amount]').keyup(function(event) {
            var total = <?php echo $order['lead_requested']; ?>;
            var newTotal = event.target.value * total;
            $("input[name=total]").val(newTotal);
        });

    });
</script>
<script src="<?php echo base_url('assets/js/app.js') ?>"></script>
<?php require('assets/js/lead/lead-table-js.php'); ?>
</body>

</html>