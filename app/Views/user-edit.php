<?= $this->include('partials/main') ?>

<head>
    
    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <!-- plugin css -->
    <link href="<?=base_url('assets/libs/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.css'); ?>" rel="stylesheet" type="text/css">
    
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

        <form action="<?= base_url("editUser/").$duser[0]['id'];?>" method="post" class="custom-validation" id="registeruserform" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">First Name *</label>
                <input type="text" name="firstname" class="form-control rform" required="" id="fname" value="<?= $duser[0]['firstname']?>">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Last Name *</label>
                <input type="text" name="lastname" class="form-control rform" required="" id="lname" value="<?= $duser[0]['lastname']?>">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Email *</label>
                <input type="email" name="email" class="form-control" required="" id="email" value="<?= $duser[0]['email']?>" Readonly>
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Password *</label>
                 <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" id="password" required="" value="<?= $duser[0]['password']?>">
            </div>
            
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-phone-input">Phone</label>
                <input type="text" name="phone" value="<?= $duser[0]['phone']?>" class="form-control" id="phone">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-address-input">Address</label>
                 <input type="text" name="address" value="<?= $duser[0]['address']?>" class="form-control" id="address">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Website</label>
                 <input type="text" name="website" value="<?= $duser[0]['website']?>" class="form-control" id="website">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Coverage Area</label>
                 <input type="text" name="coverage" value="<?= $duser[0]['coverage']?>" class="form-control" id="coverage">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-website-input">Linkedin Profile</label>
                 <input type="text" name="linkedin" value="<?= $duser[0]['linkedin']?>" class="form-control" id="linkedin">
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formroleinput">Role</label>
                <select class="form-control form-select" id="role" name="role" required="" onchange="changerole(this)">
                    <option value="1">Admin</option>
                    <option value="2">Vendor</option>
                    <option value="3">Client</option>
                </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label class="form-label" for="formrow-email-input">Display Picture</label>
                <input type="file" class="form-control" name="agentpicture"><br>
                <?php if ($duser[0]['useruimage']): ?>
                    <img class="rounded" src="<?= base_url('uploads/users/'.$duser[0]['useruimage']) ?>" height="50">
                <?php endif; ?>
            </div>

            <div class="col-sm-12 mb-3" id="client_settings" style="display:none;">
                <label class="form-label" for="formroleinput">Select Vendor *</label>
                <select class="select2 form-control select2-multiple" multiple="multiple" data-parsley-min="1" id="vendor" name="vendor[]" required="">
                    <option value="0">Select Vendor</option>
                    <?php 
                        $v_vendors = explode(", ", $duser[0]['vendor']);
                    ?>
                    <?php foreach ($vendors as $value): ?>
                        <option value="<?= $value['id'] ?>" <?php if (in_array($value['id'], $v_vendors)) echo 'selected'; ?>>
                            <?= $value['firstname'].' '.$value['lastname'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row" id="vendor_settings" style="display:none;">
                <h4 class="mb-3 mt-3">Select Referrer</h4>
                <?php 
                    $s_vendors = explode(", ", $duser[0]['referred_to']);
                ?>
                <div class="col-* mb-3">
                    <label class="form-label" for="sub-vendor">Select Sub-Vendor</label>
                    <select class="select2 form-control select2-multiple" multiple="multiple" data-parsley-min="1" id="sub-vendor" name="subvendor[]">
                        <option value="0">Select Sub-Vendor</option>
                        <?php foreach ($vendors as $value): ?>
                            <option value="<?= $value['id'] ?>" <?php if (in_array($value['id'], $s_vendors)) echo 'selected'; ?>>
                                <?= $value['firstname'].' '.$value['lastname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h4 class="mb-3 mt-3">Mail Setting</h4>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">SMTP Email / Username</label>
                    <input type="text" name="smtpemail" class="form-control" placeholder="abc@example.com" required="" id="smtpemail" value="<?= $duser[0]['smtpemail'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">SMTP Password</label>
                    <input type="text" name="smtppassword" class="form-control" placeholder="Password" required="" id="smtppassword" value="<?= $duser[0]['smtppassword'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">SMTP Incoming Server</label>
                    <input type="text" name="smtpincomingserver" class="form-control" placeholder="abc.example.com" required="" id="smtpincomingserver" value="<?= $duser[0]['smtpincomingserver'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">SMTP Outgoing Server</label>
                    <input type="text" name="smtpoutgoingserver" class="form-control" placeholder="abc.example.com" required="" id="smtpoutgoingserver" value="<?= $duser[0]['smtpoutgoingserver'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">SMTP Port</label>
                    <input type="text" name="smtpport" class="form-control" placeholder="i.e 465" required="" id="smtpport" value="<?= $duser[0]['smtpport'] ?>">
                </div>

                <h4 class="mb-3 mt-3">Branch Details</h4>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Branch Name</label>
                    <input type="text" name="branchname" class="form-control" required="" value="<?= $duser[0]['branchname'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Slug</label>
                    <input type="text" name="branchslug" class="form-control" required="" value="<?= $duser[0]['branchslug'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Country</label>
                    <input type="text" name="branchcountry" class="form-control" required="" value="<?= $duser[0]['branchcountry'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Address</label>
                    <input type="text" name="branchaddress" class="form-control" required="" value="<?= $duser[0]['branchaddress'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Header Color</label>
                    <input type="text" name="brancheader" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?= $duser[0]['brancheader'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">NavBar Background Color</label>
                    <input type="text" name="branchnavbar" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?= $duser[0]['branchnavbar'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Nav Text Color</label>
                    <input type="text" name="branchnavtext" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?= $duser[0]['branchnavtext'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Nav Text Hover</label>
                    <input type="text" name="branchnavhover" class="form-control spectrum with-add-on colorpicker-showalpha" value="<?= $duser[0]['branchnavhover'] ?>">
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label" for="formrow-email-input">Branch Logo</label>
                    <input type="file" class="form-control" name="branchlogo"><br>
                    <?php if ($duser[0]['branchlogo']): ?>
                        <img class="rounded" src="<?= base_url('uploads/users/'.$duser[0]['branchlogo']) ?>" height="50">
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Logo Height</label>
                    <input type="text" name="branchlogoheight" class="form-control" value="<?= $duser[0]['branchlogoheight'] ?>">
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="form-label" for="formrow-email-input">Logo width</label>
                    <input type="text" name="branchlogowidth" class="form-control" value="<?= $duser[0]['branchlogowidth'] ?>">
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

        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>
        <!-- plugins -->
        <script src="<?=base_url('assets/libs/select2/js/select2.min.js');?>"></script>
        <script src="<?=base_url('assets/libs/spectrum-colorpicker2/spectrum.min.js'); ?>"></script>
        <!-- parsleyjs -->
        <script src="<?=base_url('assets/libs/parsleyjs/parsley.min.js'); ?>"></script>

    <script>
       $(function () {

        <?php if($duser[0]['userrole'] == '1'){ ?>
         var role = $('#role>option:eq(0)').attr('selected',true);
         changerole(role);
         $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress],select#vendor'
            });
        <?php }elseif($duser[0]['userrole'] == '2'){ ?>
         var role =$('#role>option:eq(1)').attr('selected',true); 
         changerole(role); 
         $(".select2").select2({width: '100%'});
         $('.custom-validation').parsley({excluded:'select#vendor'});    
        <?php }elseif($duser[0]['userrole'] == '3'){ ?>
         var role =$('#role>option:eq(2)').attr('selected',true);
         changerole(role);
         $(".select2").select2({width: '100%'});
         $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress]'
            });
        <?php } ?>   
    });

    function changerole(e)
    {
        var d = $(e);
        var str = d.val();

        if (str == "2") 
        {
            $("#client_settings").hide();
            $("#vendor_settings").show();
            $(".colorpicker-showalpha").spectrum({
                showAlpha: true
            });
            $('.custom-validation').parsley({excluded:'select#vendor'});
        }
        else if (str == "3")
        {
            $("#client_settings").show();
            $("#vendor_settings").hide();
            $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress]'
            });
        }
        else
        {
            $("#client_settings").hide();
            $("#vendor_settings").hide();
            $('.custom-validation').parsley({
                excluded:'#smtpemail,#smtppassword,#smtpincomingserver,#smtpoutgoingserver,#smtpport,input[name=branchname],input[name=branchslug],input[name=branchcountry],input[name=branchaddress],select#vendor'
            });
        }
    }
    </script>
    <!-- App js -->
    <?= $this->include('partials/top-alerts') ?>
    <script src="<?=base_url('assets/js/app.js'); ?>"></script>

</body>
</html>
