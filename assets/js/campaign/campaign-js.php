<script>
   $(document).ready(function() {
    console.log("Test Campaign JS");

    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().slice(0, 10);

    const columns = [
        { col_name: 'Agent Name', col_slug: 'agent_name', col_type: 'text', col_default: '' },
        { col_name: 'First Name', col_slug: 'first_name', col_type: 'text', col_default: '' },
        { col_name: 'Last Name', col_slug: 'last_name', col_type: 'text', col_default: '' },
        { col_name: 'Phone Number', col_slug: 'phone_number', col_type: 'text', col_default: '' },
        { col_name: 'Date', col_slug: 'date', col_type: 'date', col_default: formattedDate },
        { col_name: 'State', col_slug: 'state', col_type: 'text', col_default: '' }
    ];

    $('.fields-row').each(function(index) {
        var $row = $(this);
        var columnData = columns[index];
        $row.find('.col_name').val(columnData.col_name);
        $row.find('.col_slug').val(columnData.col_slug);
        $row.find('.col_type').val(columnData.col_type);
        $row.find('.defaultField').val(columnData.col_default);
    });

    $("#add-btn").click(function() {
        $(".repeater-fields").append(`
            <div class="row fields-row">
                <div class="mb-3 col-lg-3">
                    <label class="form-label" for="name">Column Name:</label>
                    <input type="text" id="name" name="col_name[]" class="form-control col_name" placeholder="Enter column name" required />
                </div>
                <div class="mb-3 col-lg-3">
                    <label class="form-label" for="col_slug">Column Slug</label>
                    <input type="text" name="col_slug[]" id="col_slug" class="form-control col_slug" placeholder="Enter Column Slug" required />
                </div>
                <div class="mb-3 col-lg-2">
                    <label class="form-label" for="subject">Column Type</label>
                    <select name="col_type[]" class="form-select col_type" required aria-label="Floating label select example">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="date">Date</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-2 defaultFiledDiv">
                    <label class="form-label" for="default_value">Default Value</label>
                    <input type="text" name="col_default[]" class="form-control defaultField" placeholder="Enter default value" />
                </div>
                <div class="col-lg-2 align-self-center">
                    <div class="d-grid">
                        <input readonly type="button" class="btn btn-primary delete" value="Delete" />
                    </div>
                </div>
            </div>
        `);
    });

    $(document).on("click", ".delete", function() {
        $(this).closest('.fields-row').remove();
    });

    <?php if (isset($camp)) { ?>
        var camp_data = <?= json_encode($camp); ?>;
        var campaignColumnsData = JSON.parse(camp_data.campaign_columns);
        var template = $('.fields-row').first();
        $('.fields-row').remove();
        $.each(campaignColumnsData, function(index, item) {
            var newItem = template.clone();
            newItem.find('.col_name').val(item.col_name);
            newItem.find('.col_slug').val(item.col_slug);
            newItem.find('.col_type').val(item.col_type);
            newItem.find('.col_default').val(item.col_default);

            // Remove readonly attribute for editable fields
            newItem.find('input').prop('readonly', false);

            // Append the cloned item to the repeater list
            $('.repeater-fields').append(newItem);
        });
    <?php } ?>

    $(document).on('change', '.form-select.col_type', function() {
        console.log("I am changed");
        var selectedType = $(this).val();
        console.log(selectedType);
        var defaultField = $(this).closest('.row').find('.defaultFiledDiv');
        console.log("Yes", defaultField.val());

        if (selectedType === 'dropdown') {
            defaultField.html(`
                <label class="form-label" for="options">Options</label>
                <input type="text" name="col_default[]" class="form-control" placeholder="Option 1 | Option 2 | Option 3" required/>
                <small class="form-text text-muted">Add option with |</small>
            `);
        } else if (selectedType === 'date') {
            $(this).closest('.row').find('.defaultField').val(formattedDate);
        } else {
            defaultField.html(`
                <label class="form-label" for="default_value">Default Value</label>
                <input type="text" name="col_default[]" class="form-control" placeholder="Enter default value" />
            `);
        }
    });

    $(document).on('change', '.form-control.col_name', function() {
        var columnName = $(this).val();
        console.log("Shoaib", columnName);
        var slug = columnName.toLowerCase().replace(/ /g, '_');
        var row = $(this).closest('.row');
        row.find('.col_slug').val(slug);
    });

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    <?php if (session()->has('success')) : ?>
        toastr.success("<?php echo session('success'); ?>");
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
        toastr.success("<?php echo session('error'); ?>");
    <?php endif; ?>
});

</script>