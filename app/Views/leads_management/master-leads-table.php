<div class="col-lg-12">
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-primary mr-2" onclick="showAddFilter(); return 0;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter"></i></span></button>
                    <button class="btn btn-sm btn-danger" onclick="resetFilter(); return 0;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter-off"></i></span></button>
                </div>
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
                        <th> Check </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
</div>