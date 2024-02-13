<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>
        
        <?= $this->include('./partials/head-css') ?>
        <style>
            .message-list li{
                height: 65px;
                padding-left: 10px;
                padding-top: 6px;
            }
        </style>
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
                    <ul class="message-list" data-page = '<?=$page ?>'>
                        <?php if(isset($all_notifications)){ 
                            foreach ($all_notifications as $row) {
                            ?>
                        <li class="<?php if(!$row['isread']){ echo 'unread'; } ?>">
                            <div class="col-mail col-mail-1">
                                <div class="ml-3">
                                <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-sm">
                                </div>
                                <a href="<?=$row['link'] ?>" class="title"><?=$row['from_full_name'] ?>


                                </a>
                            </div>
                                <div class="col-mail col-mail-2">
                                <a href="<?=$row['link'] ?>" class="subject" target="_blank">
                                    <?php 
                                     if($row['isread'])
                                     {
                                        echo '<span class="bg-success badge me-2">read</span>';
                                       
                                     }else{
                                         echo '<span class="bg-warning badge me-2">unread</span>';
                                     }
                                       echo $row['description'];
                                     ?>
                                </a>
                            <div class="date"><?=time_ago($row['created_at']) ?></div>
                            </div>
                        </li>
                    <?php }} ?>
        </ul>
        <button type="button" class="btn btn-primary btn-lg waves-effect loadmore mb-1">Load More</button>
        
    </div> <!-- card -->  


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

       

        </script>
    <script type="text/javascript">
 
    $(document).ready(function() {
        
       $(".loadmore").on('click',function(){

        var page2 = $('.message-list').attr('data-page');
        var total_pages = <?=$total_pages ?>;
        console.log(page2);
        if(page2 <= total_pages)
        {
            
             $.ajax({
              url: '<?= base_url() ?>notifications/',
              type: 'post',
              data: {page:page2},
              success: function(data)
              {
                 var dd = JSON.parse(data);
                $("ul.message-list").append(dd['html']);
                console.log(dd['page']);
                $('.message-list').attr('data-page',dd['page']);
              }
          }); 
        }
       
       });
        
    });
    </script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>


   

    </body>
</html>
