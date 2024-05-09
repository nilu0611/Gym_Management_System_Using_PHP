<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Registration Form</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/2.jpg'); /* Your image path here */
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the image */
            background-attachment: fixed; /* Fix the background image */
            margin: 0;
            padding: 0;
            color: #fff; /* Making the text color white for contrast */
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #000; /* Changed to black */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Adjusting box shadow for dark background */
            /* Adjusting background opacity if needed */
            background: rgba(0, 0, 0, 0.8);
            color: #fff; /* Making the text color white for contrast */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff; /* Making the label text color white for contrast */
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333; /* Dark input backgrounds */
            color: #fff; /* Light text color for readability */
        }

        input[type="submit"] {
            background-color: orangered;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: orangered;
        }
        .button {
            background-color: orangered; /* Primary color */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block; /* Block level for full width */
            width: 100%; /* Match the width of the input fields */
            margin-top: 10px; /* Space from preceding elements */
        }

        .button:hover {
            background-color: orangered; /* Darker shade on hover */
        }

    </style>
</head>
<body>
    
    <div class="container">
    <h2>Welcome to Gym-Become Member with ease</h2><br>
        <form class="form-group" action="useradd.php" method="post" onsubmit="return validateForm()">
            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname" required><br>

            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required><br>

           <br>
           <p>Note:Please visit the gym for a personal trainer.</p>
           <input type="submit" value="Register" class="button">

           <button type="button" class="button" onclick="location.href='login.php';">Existing User</button>
           <button type="button" class="button" onclick="location.href='home.html';">Home</button>


        </form>
    </div>

    <script>
        function validateForm() {
            var fname = document.getElementById("fname").value;
            var lname = document.getElementById("lname").value;
            var email = document.getElementById("email").value;
            var contact = document.getElementById("contact").value;

            // Simple validation example (you can add more complex validation as needed)
            if (fname == "" || lname == "" || email == "" || contact == "") {
                alert("All fields are required");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
