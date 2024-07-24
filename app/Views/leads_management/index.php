<?= $this->include('partials/main') ?>
<head>
    <?php echo $title_meta ?>
    <!-- datepicker css -->
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

<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?php echo $page_title ?>
                <div class="row">
                    <?= $this->include('partials/add-alert') ?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex">
                                    <?php if (is_admin()) { ?>
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label" for="formrow-campaign-input">Client<span class="required"> </span></label>
                                            <select class="form-control select2" name="fkclientid" style="width: 100%;">
                                                <?php foreach ($client as $c) { ?>
                                                    <option value="<?php echo $c['id'] ?>">
                                                        <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label" for="formrow-campaign-input">Vendors<span class="required"> </span></label>
                                            <select class="form-control select2" name="fkclientid" style="width: 100%;">
                                                <?php foreach ($client as $c) { ?>
                                                    <option value="<?php echo $c['id'] ?>">
                                                        <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                </div>
                                <button id="filter-btn" class="btn btn-primary mb-3">Filter</button>
                            <?php } ?>

                            <div class="row  " id="assign-container" style="display:none !important;">
                                <form id="lead_assign_form" action="<?= base_url() ?>assign-leads/" method="POST">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Order<span class="required"> * </span></label>
                                        <select class="form-control select2" name="order_id" required style="width: 100%;">
                                            <?php foreach ($order as $o) { ?>
                                                <option value="<?php echo $o['pkorderid'] ?>">
                                                    <?php echo $o['agent'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <input id="lead_id" type="hidden" value="" name="leadId">
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button id="assign-btn" type="button" class="btn btn-primary mb-3">Assign
                                        </button>
                                    </div>
                                </form>

                            </div>


                            </div>
                        </div>
                    </div>

                    <?= $this->include('leads_management/leads-table') ?>
                </div>
            </div> 
        </div>

        <?= $this->include('leads_management/reject_lead_modal') ?>
        <?= $this->include('leads_management/lead_detail_canva') ?>
        <?= $this->include('partials/footer') ?>
    </div>
   
</div>


<?= $this->include('partials/right-sidebar') ?>
<?= $this->include('partials/vendor-scripts') ?>
<?= $this->include('partials/datatable-scripts') ?>


<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>



</script>
<script type="text/javascript">
    $(document).ready(function() {
        var radioValue = "";
        var checkedIds = [];



        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [{
                    target: 0,
                    visible: false,
                    searchable: false
                },

            ],

            order: [],
            ajax: {
                url: "<?php echo site_url('leads-datatable') ?>/" + 0,
                data: function(d) {
                    d.lead_status = radioValue;
                    d.state = $("#state").val();
                    d.client = $('select[name="fkclientid"]').val();

                }
            },
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },

        });

        $('select[name=fkclientid]').change(function() {

        });

    });
</script>

<script src="assets/js/app.js"></script>
<?php require('assets/js/lead/lead-table-js.php'); ?>



</body>

</html>