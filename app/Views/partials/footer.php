
<!-- Varying Modal Content example -->
<div class="modal fade" id="referralModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="referralModalLabel">Client Referral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form action="<?php echo base_url("add-referral");?>" method="post" class="custom-validation" id="clientReferralForm">
                <div class="mb-3">
                    <label for="client-name" class="col-form-label">Client Full Name:</label>
                    <input type="text" class="form-control" name="client-name" id="client-name" required >
                </div>
                <div class="mb-3">
                    <label for="client-email" class="col-form-label">Client Email:</label>
                    <input type="email" class="form-control" name="client-email" id="client-email" required >
                </div>
            
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
        </div>
</div>



<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <?=date('Y') ?> © TTMG.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>