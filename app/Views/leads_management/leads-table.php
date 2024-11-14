<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            
             <div class="button"></div>
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Check </th>
                        <th> Lead Date </th>
                        <th>Agent Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>State</th>
                        <th>Phone Number</th>
                        <th>Vendor</th> 
                        <th>Client</th> 
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
