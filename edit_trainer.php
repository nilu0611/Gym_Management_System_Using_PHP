<!DOCTYPE html>
<html>
<head>
    <title>Edit Trainer Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: black;
            color: white;
            padding: 14px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Trainer Details</h2>
    <?php
    include("func.php");

    if(isset($_GET['trainerId'])) {
        $trainerId = $_GET['trainerId'];

        // Fetch trainer details from the database
        $query = "SELECT * FROM Trainer WHERE Trainer_id = $trainerId";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $fname = $row['Name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $address = $row['address'];

            // Display the form to edit trainer details
            echo "<form action='update_trainer.php' method='post'>
                      <input type='hidden' name='trainerId' value='$trainerId'>
                      <label for='fname'>Name:</label>
                      <input type='text' name='fname' id='fname' value='$fname' required>
                      <label for='phone'>Phone:</label>
<input type='text' name='phone' id='phone' value='$phone' pattern='[0-9]+' title='Please enter numeric values only' required>

                      <label for='email'>Email:</label>
                      <input type='text' name='email' id='email' value='$email' required>
                      <label for='address'>Address:</label>
                      <input type='text' name='address' id='address' value='$address' required>
                      <input type='submit' name='update_trainer' value='Update'>
                  </form>";
        } else {
            echo "Trainer not found.";
        }
    } else {
        echo "TrainerId parameter is missing.";
    }
    ?>
</div>

</body>
</html>
