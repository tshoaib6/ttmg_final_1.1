<script>
    $(document).ready(function () {
        
        <?php if(isset($order)){?>
            order=<?php echo json_encode($order) ;?>; 
            console.log(order);
            $('input[name="agent"]').val(order.agent);
            // $('input[name="categoryname"]').val(order.agent);
            // $('input[name="fkvendorstaffid"]').val(order.agent);
            // $('input[name="fkclientid"]').val(order.agent);
            // $('input[name="state"]').val(order.agent);
            // $('input[name="prioritylevel"]').val(order.agent);
            // $('input[name="ageranges"]').val(order.agent);
            // $('input[name="lead_requested"]').val(order.agent);
            // $('input[name="fblink"]').val(order.agent);
            // $('input[name="notes"]').val(order.agent);
            // $('input[name="orderdate"]').val(order.agent);



            <?php  } ?>
        console.log("Test Order JS")

        

        $(".select2").select2();
        flatpickr('#datepicker-datetime', {
            enableTime: true,
            dateFormat: "m-d-Y H:i",
            defaultDate: new Date()
        });

    });

    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
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

</script>