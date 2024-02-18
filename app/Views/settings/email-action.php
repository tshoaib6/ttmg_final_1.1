<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>
        <?= $this->include('./partials/head-css') ?>
       
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
            <form action="<?php echo base_url("email-action");?>" method="post"  id="settingsform" accept-charset="utf-8" enctype="multipart/form-data">

            <div class="row">
            
            <div class="col-md-4">
                <h3 class="font-size-20 mb-3">Admin</h3>
                <hr style="color:#000;">
                <div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            Add/Update/Delete Campaigns  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch1" switch="none" name="admincampaign" value="1" <?php if ($cs_data['admincampaign']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch1" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                           Add/Update/Delete Leads 
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch2" switch="none" name="adminleads"  value="1" <?php if ($cs_data['adminleads']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch2" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            Accept/Reject Leads (Client) 
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch3" switch="none" name="adminaccept" value="1" <?php if ($cs_data['adminaccept']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch3" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            New Client Add  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch4" switch="none" name="adminnewclient" value="1" <?php if ($cs_data['adminnewclient']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch4" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>

                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            New Order Add  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch10" switch="none" name="neworderadmin" value="1" <?php if ($cs_data['neworderadmin']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch10" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>

                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            Order Complete  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch13" switch="none" name="ordercompleteadmin" value="1" <?php if ($cs_data['ordercompleteadmin']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch13" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="font-size-20 mb-3">Vendor</h3>
                <hr style="color:#000;">
                <div>
                    
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                           Add/Update/Delete Leads 
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch5" switch="none" name="vendorleads" value="1" <?php if ($cs_data['vendorleads']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch5" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            New Client Add  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch6" switch="none" name="vendornewclient" value="1" <?php if ($cs_data['vendornewclient']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch6" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            New Order Add  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch12" switch="none" name="newordervendor" value="1" <?php if ($cs_data['newordervendor']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch12" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            Order Complete  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch14" switch="none" name="ordercompletevendor" value="1" <?php if ($cs_data['ordercompletevendor']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch14" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="font-size-20 mb-3">Client</h3>
                <hr style="color:#000;">
                <div>
                    
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                           Add/Update/Replace Leads 
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch7" switch="none" name="clientleads" value="1" <?php if ($cs_data['clientleads']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch7" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>

                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            New Order Add  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch11" switch="none" name="neworderclient" value="1" <?php if ($cs_data['neworderclient']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch11" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    <div class="inner mb-3 row">
                        <div class="col-md-10 col-8">
                            Order Complete  
                        </div>    
                        <div class="col-md-2 col-4">
                        <input type="checkbox" id="switch15" switch="none" name="ordercompleteclient" value="1" <?php if ($cs_data['ordercompleteclient']=="1") {
                        echo "checked";
                    } ?> />
                        <label for="switch15" data-on-label="On" data-off-label="Off"> </label> 
                        </div>
                    </div>
                    
                </div>

            </div>
            
            </div>
                 <div class="d-flex flex-wrap gap-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md" id="registeruserbtn">
                        Save
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


                <?= $this->include('./partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('./partials/right-sidebar') ?>

        <?= $this->include('./partials/vendor-scripts') ?>

        
        <!-- App js -->
         <?= $this->include('partials/top-alerts') ?>
        <script src="assets/js/app.js"></script>
        <script>
           $(function () {
                
            });
        </script>

   

    </body>
</html>
