 <?php /*
    if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible rounded-0">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible rounded-0">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
             </div>
<?php endif; */?>

<script>
    $(function(){
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": 300,
          "hideDuration": 1000,
          "timeOut": 5000,
          "extendedTimeOut": 1000,
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        <?php if(session()->getFlashdata('success')){ ?>

        toastr["success"]('<?= session()->getFlashdata('success') ?>');

        <?php } ?> 

        <?php if(session()->getFlashdata('error')){ 

            if(is_array(session()->getFlashdata('error')))
            {
                $ee = implode(",",session()->getFlashdata('error') ) ; 
            ?>
                 toastr["error"]('<?= $ee ?>');

         <?php }else{ ?>

                 toastr["error"]('<?= session()->getFlashdata('error') ?>');

        <?php } } ?> 
    });
</script>        

    
