<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

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

                      
                                <?php echo form_open('create-order', array('class' => 'needs-validation', 'novalidate' => 'novalidate')) ?>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-agent-input">Agent <span
                                                class="required"> * </span></label>
                                        <input type="text" name="agent" class="form-control rform" required id="agent"
                                            value="<?php set_value('agent'); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Campaign Type <span
                                                class="required"> * </span></label>
                                        <select class="form-control select2" name="categoryname" style="width: 100%;"
                                            required>
                                            <?php foreach ($campaigns as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['campaign_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Assigned to Vendor<span
                                                class="required"> * </span></label>
                                        <select class="form-control select2" name="fkvendorstaffid" required
                                            style="width: 100%;">
                                            <?php foreach ($vendors as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Assigned to Client<span
                                                class="required"> * </span></label>
                                        <select class="form-control select2"  name="fkclientid" style="width: 100%;">
                                        <option value=0 selected> Select Client </option>

                                        <?php foreach ($clients as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">State<span
                                                class="required"> * </span></label>
                                        <select class="form-control select2" name="state" style="width: 100%;">
                                            <option value="AK">AK</option>
                                            <option value="AL">AL</option>
                                            <option value="AR">AR</option>
                                            <option value="AZ">AZ</option>
                                            <option value="CA">CA</option>
                                            <option value="CO">CO</option>
                                            <option value="CT">CT</option>
                                            <option value="DC">DC</option>
                                            <option value="DE">DE</option>
                                            <option value="FL">FL</option>
                                            <option value="GA">GA</option>
                                            <option value="HI">HI</option>
                                            <option value="IA">IA</option>
                                            <option value="ID">ID</option>
                                            <option value="IL">IL</option>
                                            <option value="IN">IN</option>
                                            <option value="KS">KS</option>
                                            <option value="KY">KY</option>
                                            <option value="LA">LA</option>
                                            <option value="MA">MA</option>
                                            <option value="MD">MD</option>
                                            <option value="ME">ME</option>
                                            <option value="MI">MI</option>
                                            <option value="MN">MN</option>
                                            <option value="MO">MO</option>
                                            <option value="MS">MS</option>
                                            <option value="MT">MT</option>
                                            <option value="NC">NC</option>
                                            <option value="ND">ND</option>
                                            <option value="NE">NE</option>
                                            <option value="NH">NH</option>
                                            <option value="NJ">NJ</option>
                                            <option value="NM">NM</option>
                                            <option value="NM">NV</option>


                                        </select>
                                    </div>

                                  
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Priority Level<span
                                                class="required"> * </span></label>
                                        <select class="form-control select2" name="prioritylevel" required
                                            style="width: 100%;">

                                            <option>Gold Agent</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                            <option>On Hold</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-ageranges-input">Age Ranges <span
                                                class="required"> * </span></label>
                                        <input type="text" name="ageranges" class="form-control rform" required
                                            id="ageranges" value="<?php echo set_value('ageranges'); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-ageranges-input">Lead Requested </label>
                                        <input type="number" name="lead_requested" class="form-control rform"
                                            required="" id="lead_requested"
                                            value="<?php echo set_value('lead_requested'); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-fblink-input">FB link </label>
                                        <input type="text" name="fblink" class="form-control rform"
                                            id="fblink" value="<?php echo set_value('fblink'); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-notes-input">Notes & Area to Use for
                                            Order</label>
                                            <textarea name="notes" class="form-control rform" required id="notes"><?php echo set_value('notes'); ?></textarea>

                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-orderdate-input">Date / Time</label>
                                        <input type="text" class="form-control" name="orderdate"
                                            id="datepicker-datetime">

                                    </div>




                                </div>



                            </div>

                            <div class="card-footer text-muted d-flex justify-content-end">
                                <button class="btn btn-danger" type="submit" value="Submit"> Submit </button>
                            </div>
                            <?php echo form_close('') ?>
                        </div>
                    </div>
                </div>


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

<!-- form repeater js -->
<script src="<?php echo base_url('assets/libs/jquery.repeater/jquery.repeater.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-repeater.int.js') ?>"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>


<!-- Alerts Live Demo js -->

<script src="<?php echo base_url('assets/js/pages/alerts.init.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/jquery.repeater/jquery.repeater.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/toastr/toastr.js') ?>"></script>


<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js') ?>"></script>

<?php require('assets/js/order/order-js.php'); ?>

</body>

</html>