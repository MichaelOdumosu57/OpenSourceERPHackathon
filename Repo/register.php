<?php
include ('navbar.php');
$error = NULL;

// Register form is submitted
if(isset($_POST['submit'])) {
  // Get form data after submission
  $name = $_POST['company_name'];
  $email = $_POST['email'];
  $password = $_POST['psw'];
  $password_repeat = $_POST['psw-repeat'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $postal = $_POST['postal'];

  // Query to check if the email is already in use
  $query_email = "SELECT email FROM manufacturer WHERE email = '$email'";
  $results = mysqli_query($connection, $query_email);
  $row = mysqli_fetch_assoc($results);
  $email_check = $row['email'];

  // Validate Email
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "<p>Please enter a valid E-Mail.</p>";
  }
  // Check if Email already exists
  elseif($email == $email_check) {
    $error.= "The Email you entered is already in use.";
  // Validate Password
  } elseif($password != $password_repeat) {
    $error.= "Your passwords do not match.";
  // Check if password is at least 6 characters in length
  } elseif(strlen($password) < 5) {
    $error.= "Your password needs to be at least 6 characters in length.";
  // Insert into database
  } else {
    // Sanitize form data
    $email = pg_escape_string($email);
    $password = pg_escape_string($password);
    $password_repeat = pg_escape_string($password_repeat);
    // https://secure.php.net/manual/en/function.password-hash.php
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert form data
    $query = "INSERT INTO manufacturer (name, email, password, address,city,state,postal) VALUES ('$name','$email','$password','$address','$city','$state','$postal')";
    $insert = mysqli_query($connection, $query);

    if($insert) {
      echo '<div class="alert alert-success alert-dismissible fade in">
             <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>You have successfully created an account.</strong>
           </div>';
     echo '<script>';
     echo 'window.location.href="login.php"';
     echo '</script>';
    }
  }

}

?>

<style>
* {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 16px;

}

/* Full-width input fields */
input {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: #F79C1D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity:1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}

@media (min-width: 800px) {
  .container {
    width:650px;
  }
}
</style>
  <?php
    // If there is an error message
    if($error != NULL) {
      echo '<div class="alert alert-danger alert-dismissible">
                  <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$error.'</strong>
                </div>';
    }
  ?>
  <form method="POST" action="">
    <div class="container">
      <h1>Register</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <label for="company_name"><b>Company Name</b></label>
      <input type="text" placeholder="Enter Company Name" name="company_name" id="company_name" required autofocus>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Address" name="address" id="address" required>

      <label for="city"><b>City</b></label>
      <input type="text" placeholder="City" name="city" id="city" required>

      <label for="state"><b>State</b></label>
      <input type="text" placeholder="State" name="state" id="state" required>

      <label for="postal"><b>Zipcode</b></label>
      <input type="text" placeholder="Zipcode" name="postal" id="postal" required>


      <hr>

      <button type="submit" id="form-submit" name="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
      <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    </div>
  </form>

  <script>
    // Trigger form submit on enter key
    window.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
       event.preventDefault();
       document.getElementById("form-submit").click();
      }
    });
  </script>
