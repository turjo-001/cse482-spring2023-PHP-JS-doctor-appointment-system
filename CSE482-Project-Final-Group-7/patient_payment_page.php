<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login_page.php");
  die();
}

$user = $_SESSION['user'];

if ($user['type'] !== 'patient') {
  header("Location: login_page.php");
  die();
}

$user = $user['data'];
$patientID = $_SESSION['patientID'];
$selectedDoctorID = $_SESSION['selectedDoctorID'];
$selectedDate = $_SESSION['selectedDate'];
$selectedTime = $_SESSION['selectedTime'];
?>


<!DOCTYPE html>
<html>

<head>
  <title>Checkout Page</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>

</head>

<body>
  <h1>Checkout Page</h1>
  <div class="container">
    <form method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" placeholder="Enter your address" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" placeholder="Enter your city" required>

      <div id="paypal-button-container" name="click-paypal-button"></div>
    </form>
  </div>

  <?php
  ?>

  <script src="https://www.paypal.com/sdk/js?client-id=AeHgU-J-kyx7fhhy6pntC_wiN61tHPIN9m8HVB95uhLUR5RgROYwWZ20celzThHJfPHqLRl7RxaR8UL4&currency=USD"></script>

  <script>
    paypal.Buttons({
      onClick() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('address').value;
        var city = document.getElementById('city').value;
        if (name.length == 0 || email.length == 0 || address.length == 0 || city.length == 0) {
          alert("Please fill all the fields");
          return false;
        }


      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '50'
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          var name = document.getElementById('name').value;
          var email = document.getElementById('email').value;
          var address = document.getElementById('address').value;
          var city = document.getElementById('city').value;
          var transid = details.id;

          alert("Payment Completed");
          window.location.href="book-after-payment.php";
        });
      }
    }).render('#paypal-button-container');
  </script>

</body>

</html>