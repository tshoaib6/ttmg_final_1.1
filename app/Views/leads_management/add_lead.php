<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">

    <style>
        .required {
            color: red;
        }
    </style>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label" for="formrow-campaign-input">Campaign Type <span
                                            class="required"> * </span></label>
                                    <select class="form-control select2" name="categoryname" style="width: 100%;" required>
                                        <option> Select </option>
                                        <?php if (isset($camp_name)) { ?>
                                            <option selected value="<?php echo $camp_name['id'] ?>">
                                                <?php echo $camp_name['campaign_name'] ?>
                                            </option>
                                        <?php } else { ?>
                                            <?php foreach ($campaigns as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['campaign_name'] ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>

                                    <div id="import-lead" class="btn btn-primary mt-3 mb-3" style="display:none;">
                                        Import Leads
                                    </div>
                                </div>
                                <div class="row" id="form-container">
                                    <!-- Your form fields for lead information -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>

            <div id="importLeadsModal" class="modal fade bs-bulklead-modal-center" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Bulk Lead</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload-lead" enctype="multipart/form-data" method="POST">
                                <label for="formFileLg" class="form-label">Upload File</label>
                                <input class="form-control form-control-lg mb-3" id="formFileLg" type="file" name="csvfile"
                                    required
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                <input type="hidden" id="order_id_field" name="order_id">
                                <input type="hidden" id="camp_id_field" name="camp_id">

                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Page-content -->

            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('partials/right-sidebar') ?>

    <?= $this->include('partials/vendor-scripts') ?>

    <!-- form repeater js -->
    <script src="<?php echo base_url('assets/libs/jquery.repeater/jquery.repeater.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/pages/form-repeater.int.js') ?>"></script>
    <script src="<?php echo base_url('assets/libs/select2/js/select2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.js') ?>"></script>

    <!-- Alerts Live Demo js -->
    <script src="<?php echo base_url('assets/js/pages/alerts.init.js') ?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery.repeater/jquery.repeater.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/libs/toastr/toastr.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url('assets/js/app.js') ?>"></script>

    <?php require('assets/js/lead/add-lead-js.php'); ?>

</body>

</html>
