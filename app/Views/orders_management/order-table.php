<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label class="form-label" for="formclientinput">Select Category</label>
                    <select class="select2 form-select" id="filter_campaign">
                        <option value="0">Choose Category...</option>
                        <?php foreach ($campaigns as $row) { ?>
                            <option value="<?= $row['id'] ?>">
                                <?= $row['campaign_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="formvendorinput">Select Vendor</label>
                    <select class="select3 form-select" id="filter_vendor">
                        <option value="0">Choose Vendor...</option>
                        <?php foreach ($vendors as $row) { ?>
                            <option value="<?= $row['id'] ?>">
                                <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-2 d-flex align-items-end">
                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light filter-clear" style="display:none;">Clear Filter</button>
                </div>

            </div>
            <br>
            <div class="lead-summary">
                <button class="btn btn-default btn-with-tooltip" id="slideDown">
                    <i class="fa fa-align-left"></i>
                </button>

                <div class="lead-content" id="order-report">
                    <div class="row ">
                        <div class="col-md-3 order-report-card"><b> Total Orders :  </b></div>
                        <div class="col-md-3 order-report-card"><b> Active Orders :  </b></div>
                        <div class="col-md-3 order-report-card"><b> Complete Orders :  </b></div>
                        <div class="col-md-3 order-report-card"><b> Blocked Orders :  </b></div>

                    </div>
                </div>
            </div>

            <br>

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Agent Name</th>
                        <th>Options </th>
                        <th>Leads Requested</th>
                        <th>Remaining Leads</th>
                        <th>Vendor </th>
                        <th>Notes & Area</th>
                        <th>Status</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>
</div>