<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <label class="form-label" for="formclientinput">Select Client</label>
                    <select class="select2 form-select" id="filter_client">
                        <option value="0">Choose Client...</option>
                        <?php foreach ($clients as $row) { ?>
                            <option value="<?= $row['id'] ?>">
                                <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-2">
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

                <div class="col-sm-3">
                    <label class="form-label">Select Date Range</label>
                    <div class="input-daterange input-group" id="datepicker6" data-date-format="mm-dd-yyyy"
                        data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                        <input type="text" class="form-control date_filter" name="start_date" id="start_date"
                            placeholder="Start Date" />
                        <input type="text" class="form-control date_filter" name="end_date" placeholder="End Date"
                            id="end_date" />
                    </div>
                </div>

                <div class="col-sm-2 d-flex align-items-end">
                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light filter-clear"
                        style="display:none;">Clear Filter</button>
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