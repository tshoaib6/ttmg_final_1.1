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
            
            <form action="<?php echo base_url("editTemplate/").$template['id'];?>" method="post" class="custom-validation" id="emailtemplateform" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                
                <div class="col-sm-12 mb-3">
                    <label class="form-label" for="formrow-subject-input">Subject *</label>
                    <input type="text" name="subject" class="form-control rform" required="" id="subject" value="<?php echo $template['subject']; ?>">
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label" for="formrow-message-input">Message *</label>
                    <textarea class="form-control" name="message" id="classic-editor"><?php echo $template['message']; ?></textarea>
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

                <?= $this->include('./partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('./partials/right-sidebar') ?>

        <?= $this->include('./partials/vendor-scripts') ?>

        <script src="<?=base_url('assets/libs/parsleyjs/parsley.min.js'); ?>"></script>
       <!-- ckeditor -->
        <script src="<?=base_url('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js'); ?>"></script>
        <script>
             $(function () {
                    $('.custom-validation').parsley();
                });

        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script> 
    
        <!-- App js -->
        <?= $this->include('partials/top-alerts') ?>
        <script src="<?=base_url('assets/js/app.js'); ?>"></script>


        
   

    </body>
</html>
