<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <!-- Download Button -->
            <button  id="download-csv" class="btn btn-primary mb-3">Download CSV</button>
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Check </th>
                        <th>Agent Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>State</th>
                        <th>Phone Number</th>
                        <th>Reason</th>
                        <th>Options</th>
                        <?php if(is_admin()){ ?>
                        <th>Action</th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
