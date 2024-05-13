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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php echo form_open('create-campaign', array('class' => 'needs-validation', 'novalidate' => 'novalidate')) ?>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="campaign_name">Campaign Name</label>
                                    <input type="text" class="form-control" id="campaign_name" name="campaign_name"
                                        placeholder="Enter Campaign Name" <?php if(isset($camp)){ ?> value="<?php echo $camp['campaign_name']?>"  <?php }?> required>
                                        <?php if(isset($camp)){?>
                                    <input type="hidden" name="id" value="<?php echo $camp['id'] ?>" >
                                    <?php }?>
                              
                                    </div>

                                <hr>
                                <h5 class="mb-0"> Campaign Columns </h5>
                                <hr>
                                <div class="repeater-fields">
                                
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id="default_value"
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id="default_value"
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id="subject"
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id=""
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id="default_value"
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input readonly type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input readonly type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <input readonly type="text" name="col_type[]" id="default_value"
                                                    class="form-control col_type"  value="text" readonly />
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input readonly type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input readonly  type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>
                                 
                                </div>
                                <input type="button" id="add-btn" class="btn btn-success mt-3 mt-lg-0"
                                        value="Add" />





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
<script src="<?php echo base_url('assets/libs/jquery.repeater/jquery.repeater.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-repeater.int.js')?>"></script>
<!-- Alerts Live Demo js -->

<script src="<?php echo base_url('assets/js/pages/alerts.init.js')?>"></script>
<script src="<?php echo base_url('assets/libs/toastr/toastr.js')?>"></script>


<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

<?php require('assets/js/campaign/campaign-js.php'); ?>

</body>

</html>