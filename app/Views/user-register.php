<?= $this->include('partials/main') ?>

    <head>
        
        <?= $title_meta ?>

        <?= $this->include('partials/head-css') ?>
        <!-- plugin css -->
        <link href="<?=base_url('assets/libs/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.css');?>" rel="stylesheet" type="text/css">
        
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

                        <?= $page_title?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

        
 
    
        <form action="<?php echo base_url("create");?>" method="post" class="custom-validation" id="registeruserform" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">First Name *</label>
                <input type="text" name="firstname" class="form-control rform" required="" id="fname" value="<?php echo set_value('firstname'); ?>">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Last Name *</label>
                <input type="text" name="lastname" class="form-control rform" required="" id="lname" value="<?php echo set_value('lastname'); ?>">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Email</label>
                <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" required="" id="email">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Password</label>
                 <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" id="password" required="">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-phone-input">Phone</label>
                <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control" id="phone">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-address-input">Address</label>
                 <input type="text" name="address" value="<?php echo set_value('address'); ?>" class="form-control"  id="address">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Website</label>
                 <input type="text" name="website" value="<?php echo set_value('website'); ?>" class="form-control"  id="website">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Coverage Area</label>
                 <input type="text" name="coverage" value="<?php echo set_value('coverage'); ?>" class="form-control"  id="coverage">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Linkedin Profile</label>
                 <input type="text" name="linkedin" value="<?php echo set_value('linkedin'); ?>" class="form-control"  id="linkedin">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Display Picture</label>
                <input type="file" class="form-control" name="agentpicture">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formroleinput">Role</label>
                <select class="form-control form-select" id="role" name="role" required="" onchange="changerole(this)">
                        <option value="1">Admin</option>
                        <option value="2">Vendor</option>
                        <option value="3">Client</option>
                </select>
            </div>
            
            <div class="col-* mb-3" id="client_settings"  style="display:none;">
                <label class="form-label" for="formroleinput">Select Vendor *</label>
                <select class="select2 form-control select2-multiple" multiple="multiple" data-parsley-min="1" id="vendor" name="vendor[]" required="" >
                        <option value="0">Select Vendor</option>
                        <?php foreach ($vendors as $value) {?>
                          <option value="<?=$value['id']?>"><?=$value['firstname'].' '.$value['lastname']?></option>
                        <?php } ?>
                </select>
            </div>

 
            <div class="row" id="vendor_settings" style="display:none;">
                <h4 class="mb-3 mt-3">Mail Setting</h4>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">SMTP Email / Username *</label>
                        <input type="text" name="smtpemail" class="form-control"  placeholder="abc@example.com" required="" id="smtpemail">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">SMTP Password *</label>
                        <input type="text" name="smtppassword" class="form-control"  placeholder="Password" required="" id="smtppassword">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">SMTP Incoming Server *</label>
                        <input type="text" name="smtpincomingserver" class="form-control"  placeholder="abc.example.com" required="" id="smtpincomingserver">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">SMTP Outgoing Server *</label>
                        <input type="text" name="smtpoutgoingserver" class="form-control"  placeholder="abc.example.com" required="" id="smtpoutgoingserver">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">SMTP Port *</label>
                        <input type="text" name="smtpport" class="form-control"  placeholder="i.e 465" required="" id="smtpport">
                    </div>
                <h4 class="mb-3 mt-3">Branch Details</h4>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Branch Name *</label>
                        <input type="text" name="branchname" class="form-control" required="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Slug *</label>
                        <input type="text" name="branchslug" class="form-control" required="">
                    </div> 
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Country *</label>
                        <input type="text" name="branchcountry" class="form-control" required="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Address *</label>
                        <input type="text" name="branchaddress" class="form-control" required="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Header Color</label>
                        <input type="text" name="brancheader" class="form-control spectrum with-add-on colorpicker-showalpha">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">NavBar Background Color</label>
                        <input type="text" name="branchnavbar" class="form-control spectrum with-add-on colorpicker-showalpha">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Nav Text Color</label>
                        <input type="text" name="branchnavtext" class="form-control spectrum with-add-on colorpicker-showalpha">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Nav Text Hover</label>
                        <input type="text" name="branchnavhover" class="form-control spectrum with-add-on colorpicker-showalpha">
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label class="form-label" for="formrow-email-input">Branch Logo</label>
                        <input type="file" class="form-control" name="branchlogo">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Logo Height</label>
                        <input type="text" name="branchlogoheight" class="form-control ">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-email-input">Logo width</label>
                        <input type="text" name="branchlogowidth" class="form-control ">
                    </div>
                     
                   
            </div>
        </div>
        <div class="d-flex flex-wrap gap-3">
            <button type="submit" class="btn btn-primary waves-effect waves-light w-md" id="registeruserbtn">
                Submit
            </button>
        </div>
    </form>
        
                                    </div>
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
        <?= $this->include('partials/vendor-scripts') ?>
        <!-- plugins -->
        <script src="<?=base_url('assets/libs/select2/js/select2.min.js');?>"></script>
        <script src="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.js'); ?>"></script>
        <!-- parsleyjs -->
        <script src="<?=base_url('assets/libs/parsleyjs/parsley.min.js'); ?>"></script>

    <script>
       $(function () {

        $(".select2").select2({width: '100%'});

        $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress],select[name=vendor]'
            });
        
        
    });
       function changerole(e)
        {
          var d = $(e);
          var str = d.val();

          if (str=="2") 
          {
            $("#client_settings").hide();
            $("#vendor_settings").show();
            $(".colorpicker-showalpha").spectrum({
            showAlpha: true
            });
            $('.custom-validation').parsley().reset();
            $('.custom-validation').parsley({excluded:'select[name=vendor]'});
            //$('.custom-validation').parsley();
          }
          else if(str=="3")
          {
            $("#client_settings").show();
            $("#vendor_settings").hide();
            $('.custom-validation').parsley().reset();
            $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress]'
            });

          }
          else
          {
            $("#client_settings").hide();
            $("#vendor_settings").hide();
            $('.custom-validation').parsley().reset();
           $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress],select[name=vendor]'
            });
          }
        }
    </script>

        
        <!-- App js -->
        <script src="assets/js/app.js"></script>


    </body>
</html>
