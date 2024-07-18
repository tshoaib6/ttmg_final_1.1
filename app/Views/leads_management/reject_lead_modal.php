<div class="modal fade bs-example-modal-center" id="rejectLeadModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="reject_lead_form">
                            <div class="col-sm-12 mb-3">
                                <label class="form-label" for="formrow-reason-input">Reason <span class="required"> *
                                    </span></label>
                                <textarea name="reason" class="form-control rform" required id="reason">
                            </textarea>
                            </div>
                            <input type="hidden" name="l_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="rejectLeadSubmit()" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>
        </div>