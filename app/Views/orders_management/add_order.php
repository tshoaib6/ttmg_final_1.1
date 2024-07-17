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

                                <?php echo form_open($form_action, array('class' => 'needs-validation', 'novalidate' => 'novalidate')) ?>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-agent-input">Agent <span class="required"> * </span></label>
                                        <input type="text" name="agent" class="form-control rform" required id="agent" value="<?= set_value('agent', isset($order['agent']) ? $order['agent'] : ''); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Campaign Type <span class="required"> * </span></label>
                                        <select class="form-control select2" name="categoryname" style="width: 100%;" required>
                                            <?php foreach ($campaigns as $c) { ?>
                                                <option value="<?= $c['id'] ?>" <?= isset($order['categoryname']) && $order['categoryname'] == $c['id'] ? 'selected' : ''; ?>>
                                                    <?= $c['campaign_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Assigned to Vendor<span class="required"> * </span></label>
                                        <select class="form-control select2" name="fkvendorstaffid" required style="width: 100%;">
                                            <?php foreach ($vendors as $c) { ?>
                                                <option value="<?= $c['id'] ?>" <?= isset($order['fkvendorstaffid']) && $order['fkvendorstaffid'] == $c['id'] ? 'selected' : ''; ?>>
                                                    <?= $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Assigned to Client<span class="required"> * </span></label>
                                        <select class="form-control select2" name="fkclientid" style="width: 100%;">
                                            <option value="0" <?= isset($order['fkclientid']) && $order['fkclientid'] == 0 ? 'selected' : ''; ?>> Select Client </option>
                                            <?php foreach ($clients as $c) { ?>
                                                <option value="<?= $c['id'] ?>" <?= isset($order['fkclientid']) && $order['fkclientid'] == $c['id'] ? 'selected' : ''; ?>>
                                                    <?= $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">State<span class="required"> * </span></label>
                                        <select class="form-control select2" name="state" style="width: 100%;">
                                            <?php foreach ($states as $state) { ?>
                                                <option value="<?= $state ?>" <?= isset($order['state']) && $order['state'] == $state ? 'selected' : ''; ?>><?= $state ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Priority Level<span class="required"> * </span></label>
                                        <select class="form-control select2" name="prioritylevel" required style="width: 100%;">
                                            <option value="Gold Agent" <?= isset($order['prioritylevel']) && $order['prioritylevel'] == 'Gold Agent' ? 'selected' : ''; ?>>Gold Agent</option>
                                            <option value="High" <?= isset($order['prioritylevel']) && $order['prioritylevel'] == 'High' ? 'selected' : ''; ?>>High</option>
                                            <option value="Medium" <?= isset($order['prioritylevel']) && $order['prioritylevel'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                                            <option value="Low" <?= isset($order['prioritylevel']) && $order['prioritylevel'] == 'Low' ? 'selected' : ''; ?>>Low</option>
                                            <option value="On Hold" <?= isset($order['prioritylevel']) && $order['prioritylevel'] == 'On Hold' ? 'selected' : ''; ?>>On Hold</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-ageranges-input">Age Ranges <span class="required"> * </span></label>
                                        <input type="text" name="ageranges" class="form-control rform" required id="ageranges" value="<?= set_value('ageranges', isset($order['ageranges']) ? $order['ageranges'] : ''); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-ageranges-input">Lead Requested </label>
                                        <input type="number" name="lead_requested" class="form-control rform" required id="lead_requested" value="<?= set_value('lead_requested', isset($order['lead_requested']) ? $order['lead_requested'] : ''); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-fblink-input">FB link </label>
                                        <input type="text" name="fblink" class="form-control rform" id="fblink" value="<?= set_value('fblink', isset($order['fblink']) ? $order['fblink'] : ''); ?>">
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-notes-input">Notes & Area to Use for Order</label>
                                        <textarea name="notes" class="form-control rform" required id="notes"><?= set_value('notes', isset($order['notes']) ? $order['notes'] : ''); ?></textarea>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="formrow-orderdate-input">Date / Time</label>
                                        <input type="text" class="form-control" name="orderdate" id="datepicker-datetime" value="<?= set_value('orderdate', isset($order['orderdate']) ? $order['orderdate'] : ''); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-muted d-flex justify-content-end">
                                <button class="btn btn-danger" type="submit" value="Submit">Submit</button>
                            </div>
                            <?php echo form_close('') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('partials/footer') ?>
    </div>
</div>

<?= $this->include('partials/right-sidebar') ?>
<?= $this->include('partials/vendor-scripts') ?>

<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
<script src="assets/js/pages/form-repeater.int.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/js/pages/alerts.init.js"></script>
<script src="assets/libs/toastr/toastr.js"></script>
<script src="assets/js/app.js"></script>
<?php require('assets/js/order/order-js.php'); ?>
</body>
</html>
