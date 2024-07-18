<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            width: 100%;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            max-width: 200px;
        }
        .invoice-details, .billing-details {
            margin-bottom: 20px;
        }
        .invoice-details p, .billing-details p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .subtotal, .total {
            text-align: right;
            margin-bottom: 20px;
        }
        .payment-instructions, .invoice-footer {
            text-align: left;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Multi-step Form Starts Here -->
                    <form id="invoiceForm">
                        <!-- Step 1: Invoice Details -->
                        <div id="step1" class="form-step">
                            <div class="mb-3">
                                <label for="invoiceLink" class="form-label">Invoice Link</label>
                                <input type="text" class="form-control" id="invoiceLink" name="invoiceLink" placeholder="Paste Invoice Link Here" required>
                            </div>
                            <div class="mb-3">
                                <label for="invoiceDate" class="form-label">Invoice Date</label>
                                <input type="date" class="form-control" id="invoiceDate" name="invoiceDate" required>
                            </div>
                            <label for="amount" class="form-label">Amount</label>
                            <div class="input-group mb-3" style="width: 35%;">
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                            </div>
                            <label for="total" class="form-label">Total</label>
                            <div class="input-group mb-3" style="width: 35%;">
                                <input type="number" class="form-control" id="total" name="total" placeholder="Total">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="nextStep">Next</button>
                        </div>
                        <!-- Step 2: Complete Invoice -->
                        <div id="step2" class="form-step" style="display:none;">
                            <div class="invoice-container">
                                <div class="invoice-header">
                                    <img src="<?php echo base_url('assets/logo.png')?>" alt="Logo">
                                    <h2>THE MARKETING AGENCY</h2>
                                </div>
                                <div class="invoice-details">
                                    <h3>INVOICE</h3>
                                    <p><strong>Invoice Number:</strong> <span id="displayInvoiceNumber">0628LB114</span></p>
                                    <p><strong>Invoice Date:</strong> <span id="displayInvoiceDate"></span></p>
                                    <p><strong>Due Date:</strong> July 1, 2024</p>
                                </div>
                                <div class="billing-details">
                                    <h3>BILL TO</h3>
                                    <p>LARRY BARNES</p>
                                    <p>larryb45@comcast.net</p>
                                    <p>303-304-5562</p>
                                </div>
                                <table class="invoice-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Telemarketing Leads Requested</td>
                                            <td>30</td>
                                            <td>10</td>
                                            <td>$<span id="displayAmount"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Additional Services (if any)</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="subtotal">
                                    <p><strong>Subtotal: $<span id="displayTotal"></span></strong></p>
                                </div>
                                <div class="payment-instructions">
                                    <p><strong>Payment Instructions:</strong></p>
                                    <p>Please make the payment by 1<sup>ST</sup> July through <a href="https://paypal.me/AreejAwan">paypal.me/AreejAwan</a>. If you have any questions about this invoice, please contact us at lookforleads1@gmail.com, contact@lookforleads.com</p>
                                </div>
                                <div class="invoice-footer">
                                    <p>Thank you for your business!</p>
                                    <p>Warm regards,</p>
                                    <p>Jason Jordan<br>Managing Director<br><a href="https://LookforLeads.com">https://LookforLeads.com</a><br>Contact Number: +1-346-419-9477</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" id="prevStep">Back</button>
                            <button type="submit" class="btn btn-primary" id="sendInvoice">Send Invoice</button>
                        </div>
                    </form>
                    <!-- Multi-step Form Ends Here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Change the following variable to your actual value from PHP
        var leadRequested = 30; // Replace this with your dynamic value

        document.getElementById('nextStep').addEventListener('click', function() {
            // Get values from step 1
            const invoiceLink = document.getElementById('invoiceLink').value;
            const invoiceDate = document.getElementById('invoiceDate').value;
            const amount = document.getElementById('amount').value;
            const total = document.getElementById('total').value;

            // Set values to display in step 2
            document.getElementById('displayInvoiceDate').innerText = invoiceDate;
            document.getElementById('displayAmount').innerText = amount;
            document.getElementById('displayTotal').innerText = total;

            // Switch steps
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
        });

        document.getElementById('prevStep').addEventListener('click', function() {
            // Switch steps
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
        });

        document.getElementById('invoiceForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('/invoice/sendInvoice', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error response
            });
        });

        // Update total based on amount input
        document.getElementById('amount').addEventListener('keyup', function(event) {
            const amount = event.target.value;
            const newTotal = amount * leadRequested;
            document.getElementById('total').value = newTotal;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
