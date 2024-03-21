<div class="col-lg-12">
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-primary mr-2" onclick="showAddFilter(); return 0;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter"></i></span></button>
                    <button class="btn btn-sm btn-danger" onclick="resetFilter(); return 0;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter-off"></i></span></button>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Select Date Range</label>
                    <div class="input-daterange input-group" id="datepicker6" data-date-format="mm-dd-yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                        <input type="text" class="form-control date_filter" name="start_date" id="start_date" placeholder="Start Date" />
                        <input type="text" class="form-control date_filter" name="end_date" placeholder="End Date" id="end_date" />
                    </div>
                </div>
            </div>

            <div class="row  " id="assign-container" style="display:none !important;">
                <form id="lead_assign_form" action="<?= base_url() ?>assign-leads/" method="POST">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-campaign-input">Order<span class="required"> * </span></label>
                        <select class="form-control select2" name="order_id" required style="width: 100%;">
                            <?php foreach ($order as $o) { ?>
                                <option value="<?php echo $o['pkorderid'] ?>">
                                    <?php echo $o['agent'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input id="lead_id" type="hidden" value="" name="leadId">
                    </div>
                    <div class="col-md-3 mt-4">
                        <button id="assign-btn" type="button" class="btn btn-primary mb-3">Assign
                        </button>
                    </div>
                </form>

            </div>

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Check </th>
                        <th>Agent Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>State</th>
                        <th>Phone Number</th>
                        <th>Action </th>
                        <th>Check </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
</div>