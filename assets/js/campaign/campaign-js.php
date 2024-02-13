<script>
    $(document).ready(function () {
        console.log("Test Campain JS")

        var columns = [
            { col_name: 'Agent Name', col_slug: 'agent_name', col_type: 'text', col_default: 'DefaultAgent' },
            { col_name: 'First Name', col_slug: 'first_name', col_type: 'text', col_default: 'DefaultFirst' },
            { col_name: 'Last Name', col_slug: 'last_name', col_type: 'text', col_default: 'DefaultLast' },
            { col_name: 'Phone Number', col_slug: 'phone_number', col_type: 'text', col_default: 'DefaultPhone' },
            { col_name: 'Date', col_slug: 'date', col_type: 'date', col_default: 'DefaultDate' },
            { col_name: 'State', col_slug: 'state', col_type: 'text', col_default: 'DefaulState' }

        ];

        // Iterate over each data-repeater-item
        $('.fields-row').each(function (index) {
            // Get the current row
            var $row = $(this);
            var columnData = columns[index];
            $row.find('.col_name').val(columnData.col_name);
            $row.find('.col_slug').val(columnData.col_slug);
            $row.find('.col_type').val(columnData.col_type);
            $row.find('.defaultField input').val(columnData.col_default);
        });

        $("#add-btn").click(function () {
            $(".repeater-fields").append(`<div  class="row fields-row">
                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="name"> Column Name:</label>
                                                <input  type="text" id="name" name="col_name[]"
                                                    class="form-control col_name" placeholder="Enter column name"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-3">
                                                <label class="form-label" for="col_slug">Column Slug</label>
                                                <input  type="text" name="col_slug[]" id="col_slug"
                                                    class="form-control col_slug" placeholder="Enter Column Slug"
                                                    required />
                                            </div>

                                            <div class="mb-3 col-lg-2">
                                                <label class="form-label" for="subject">Column Type</label>

                                                <select name="col_type[]" class="form-select col_type" required
                                                    aria-label="Floating label select example">
                                                    <option value="text">Text</option>
                                                    <option value="number">Number</option>
                                                    <option value="date">Date</option>
                                                    <option value="dropdown">Dropdown</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 col-lg-2 defaultField">
                                                <label class="form-label" for="default_value">Default Value</label>
                                                <input  type="text" name="col_default[]" id="default_value"
                                                    class="form-control" placeholder="Enter default value" />
                                            </div>

                                            <div class="col-lg-2 align-self-center">
                                                <div class="d-grid">
                                                    <input  readonly type="button" class="btn btn-primary delete"
                                                        value="Delete" />
                                                </div>
                                            </div>
                                        </div>`);
            console.log("Addded");
        });

        $(".delete").click(function () {
        $(this).closest('.fields-row').remove();
        });



        <?php if (isset($camp)) { ?>
            console.log("Fired Up")
            camp_data = <?= json_encode($camp); ?>;
            console.log("Camp Data", camp_data);

            var campaignColumnsData = JSON.parse(camp_data.campaign_columns);
            template = $('[data-repeater-item]').first();
            $('[data-repeater-item]').remove();
            // Iterate through the data and populate the fields
            $.each(campaignColumnsData, function (index, item) {
                var newItem = template.clone(); // Clone the first repeater item

                // Populate the cloned item with data
                newItem.find('.col_name').val(item.col_name);
                newItem.find('.col_slug').val(item.col_slug);
                newItem.find('.col_type').val(item.col_type);
                newItem.find('.col_default').val(item.col_default);

                // Append the cloned item to the repeater list
                $('[data-repeater-list="group-a"]').append(newItem);
            });
        <?php } ?>



        $(document).on('change', '.form-select.col_type', function () {
            var selectedType = $(this).val();
            var defaultField = $(this).closest('.row').find('.defaultField');
            if (selectedType === 'dropdown') {
                defaultField.html(
                    '<label class="form-label" for="options">Options</label>' +
                    '<input type="text" name="col_options" class="form-control" placeholder="Option 1 | Option 2 | Option 3" required/>' +
                    '<small class="form-text text-muted">Add option with |</small>'
                );
            } else {
                defaultField.html(
                    '<label class="form-label" for="default_value">Default Value</label>' +
                    '<input type="text" name="col_default" class="form-control" placeholder="Enter default value" />'
                );
            }
        });

        $(document).on('change', '.form-control.col_name', function () {
            var columnName = $(this).val();
            console.log("Shoaib", columnName)
            var slug = columnName.toLowerCase().replace(/ /g, '_');
            var row = $(this).closest('.row');
            row.find('.col_slug').val(slug);
        });

    }
    );

    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


    <?php if (session()->has('success')): ?>
        toastr.success("<?php echo session('success'); ?>");
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        toastr.success("<?php echo session('error'); ?>");
    <?php endif; ?>

</script>