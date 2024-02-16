<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>
        <?= $this->include('./partials/head-css') ?>
        <link href="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.css'); ?>" rel="stylesheet" type="text/css">
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
                   
 
    
        <form action="<?php echo base_url("settings");?>" method="post" class="custom-validation" id="settingsform" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">

                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Company Name *</label>
                    <input type="text" name="companyname" class="form-control rform" required="" id="companyname" value="<?php if(isset($cs_data['companyname'])){echo $cs_data['companyname']; }else{echo set_value('companyname');} ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Contact Details</label>
                    <input type="text" name="contactdetails" class="form-control rform"  id="contactdetails" value="<?php if(isset($cs_data['contactdetails'])){echo $cs_data['contactdetails']; }else{echo set_value('contactdetails');} ?>">
                </div>

                <div class="col-sm-12 mb-3">
                    <label class="form-label" for="formrow-email-input">About Company</label>
                    <textarea id="textarea" name="aboutcompany" class="form-control" rows="3" spellcheck="false"><?php if(isset($cs_data['aboutcompany'])){echo $cs_data['aboutcompany']; }else{echo set_value('aboutcompany'); }?></textarea>
                </div>

                <div class="col-sm-4 mb-3">
                    <label class="form-label" for="formrow-email-input">Company Logo</label>
                    <input type="file" class="form-control" name="companylogo">
                    <?php if(isset($cs_data['companylogo'])){
                        ?>
                        <img class="rounded" src="<?php echo 'uploads/'.$cs_data['companylogo'] ?>" height="50">
                    <?php
                     }else{
                        if(set_value('companylogo') != false){ ?>
                    <img class="rounded" src="<?php echo 'uploads/'.set_value('companylogo') ?>" height="50">
                <?php } 
                    } ?>
                </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label" for="formrow-email-input">Logo Height <small class="text-danger">maximum 60 px</small></label>
                        <input type="text" name="logoheight" value="<?php if(isset($cs_data['logoheight'])){echo $cs_data['logoheight']; }else{ echo set_value('logoheight');} ?>" class="form-control ">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label" for="formrow-email-input">Logo width <small class="text-danger">maximum 206 px</small></label>
                        <input type="text" name="logowidth" value="<?php if(isset($cs_data['logowidth'])){echo $cs_data['logowidth']; }else{ echo set_value('logowidth'); }?>" class="form-control ">
                    </div>

               <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Login Page Background</label>
                        <input type="text" name="login_bg" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?php if(isset($cs_data['login_bg'])){echo $cs_data['login_bg']; }else{echo "#5b8ce847";} ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Header Color</label>
                        <input type="text" name="headercolor" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?php if(isset($cs_data['headercolor'])){echo $cs_data['headercolor']; }else{echo "#5b73e8";} ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">NavBar Background Color</label>
                        <input type="text" name="navbar_bg" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?php if(isset($cs_data['navbar_bg'])){echo $cs_data['navbar_bg']; }else{echo "#ffffff";} ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Nav Text Color</label>
                        <input type="text" name="nav_txt" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?php if(isset($cs_data['nav_txt'])){echo $cs_data['nav_txt']; }else{echo "#7b8190";} ?>">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Nav Text Hover</label>
                        <input type="text" name="nav_txt_hover" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?php if(isset($cs_data['nav_txt_hover'])){echo $cs_data['nav_txt_hover']; }else{echo "#5b73e8";} ?>">
                    </div> 

                    <div class="d-flex flex-wrap gap-3">
            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" id="registeruserbtn">
                Submit
            </button>
        </div>



            </div>
        </form>
        
                </div>
                </div>
            </div>
        </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <?= $this->include('./partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('./partials/right-sidebar') ?>

        <?= $this->include('./partials/vendor-scripts') ?>

        <script src="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.js'); ?>"></script>
        <!-- App js -->
         <?= $this->include('partials/top-alerts') ?>
        <script src="assets/js/app.js"></script>
        <script>
           $(function () {
                $(".colorpicker-showalpha").spectrum({
                    showAlpha: true
                    });
            });
        </script>

   

    </body>
</html>
