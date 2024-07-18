<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Lead Detail</h5>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#lead_detail" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">Lead Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#notes" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#remainder" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">Remainder</span>
                </a>
            </li>

        </ul>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Tab panes -->
    <div class="tab-content p-3 text-muted">
        <div class="tab-pane active" id="lead_detail" role="tabpanel">
            <div class="offcanvas-body" id="lead-detail">

            </div>
        </div>
        <div class="tab-pane" id="notes" role="tabpanel">
            <div class="container">
                <form id="notes-form">
                    <div class="form-group">
                        <textarea class="form-control status-box" rows="3" placeholder="Enter your notes here..."></textarea>
                    </div>

                    <input type="hidden" value name="l_id">
                </form>
                <div class="button-group pull-right">
                    <p class="counter">250</p>
                    <a href="#" id="post-btn" class="btn btn-primary mt-3">Post</a>
                </div>
                <ul class="posts  mt-3">
                </ul>
            </div>
        </div>
        <div class="tab-pane" id="remainder" role="tabpanel">

            <div class="container">
                <form id="remainder-form">
                    <div class="col-sm-12 mb-3">
                        <label class="form-label" for="formrow-remainder-input">Title<span class="required"> *
                            </span></label>
                        <input type="text" name="remainder_title" class="form-control rform" required id="remainder" value="<?php echo set_value('remainder'); ?>">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control discription-box" rows="3" placeholder="Description..."></textarea>
                    </div>

                    <input type="hidden" value name="l_id">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-orderdate-input">Date / Time</label>
                        <input type="text" class="form-control" name="orderdate" id="datepicker-datetime">
                    </div>
                </form>
                <div class="button-group pull-right">
                    <a href="#" id="remainder-btn" class="btn btn-primary mt-3">Post</a>
                </div>
                <ul class="remainder  mt-3">
                </ul>
            </div>
        </div>
    </div>

</div>