<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }
        .form-container {
            background: #000; /* Set form background to black */
            color: #fff; /* Set text color to white for contrast */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #777; /* Lighten the border color for visibility on black */
            background: #333; /* Darken input fields for contrast */
            color: #fff; /* Set input text color to white */
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #5cb85c;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }

        /* To change the placeholder color to a lighter shade for better readability */
        ::placeholder {
            color: #bbb;
            opacity: 1; /* Firefox */
        }
        
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #bbb;
        }
        
        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #bbb;
        }
    </style>
     <script>
    function handlePaymentTypeChange(paymentType) {
        var qrCodeDiv = document.getElementById('qrCode');
        var cashInstructionsDiv = document.getElementById('cashInstructions');
        var submitButton = document.getElementById('submitPaymentButton');

        if (paymentType === 'UPI') {
            qrCodeDiv.style.display = 'block';
            cashInstructionsDiv.style.display = 'none';
            submitButton.style.display = 'none'; // Hide submit button for QR payments
        } else {
            qrCodeDiv.style.display = 'none';
            cashInstructionsDiv.style.display = 'block';
            submitButton.style.display = 'inline-block'; // Show submit button for Cash payments
        }
    }

    // Ensure that the payment type handling is triggered when the page loads if UPI is the default selection
    window.onload = function() {
        handlePaymentTypeChange(document.getElementById('payment_type').value);
    };
    </script>
</head>
<body>
<div class="form-container">
        <h2>Payment Details</h2>
        <form action="process_payment.php" method="post">
            <label for="payment_id">Payment ID:</label>
            <input type="text" id="payment_id" name="payment_id" required value="<?php echo bin2hex(random_bytes(8)); // Generates a random payment_id ?>">

            <label for="amount">Amount(per month):</label>
            <select id="amount" name="amount" required>
                <option value="800">800</option>
                <option value="1000">1000</option>
                <option value="1500">1500</option>
            </select>

            <label for="customer_id">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" required value="<?php echo isset($_GET['member_id']) ? htmlspecialchars($_GET['member_id']) : ''; ?>" readonly >

            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="payment_type">Payment Type:</label>
        <select id="payment_type" name="payment_type" onchange="handlePaymentTypeChange(this.value)">
            <option value="UPI">UPI (QR)</option>
            <option value="cash">Cash</option>
        </select>

        <div id="qrCode" style="display: none; text-align: center;">
            <p>Scan the QR code to make a payment:</p>
            <img src="upi.png" alt="QR Code" /> <!-- Replace with the actual path to your QR code image -->
        </div>

        <div id="cashInstructions" style="display: none;">
            <p>Please visit the gym reception to make a cash payment.</p>
        </div>

            <input type="submit" value="Submit Payment">
        </form>
    </div>
</body>
</html>
