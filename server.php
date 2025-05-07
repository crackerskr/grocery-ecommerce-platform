<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email    = "";
$errors = array();
$_SESSION['success'] = "";

// in your own pc
$databaseHost = 'localhost';
//database created
$databaseName = 'lmeo_db';
//superuser
$databaseUsername = 'root';
$databasePassword = '';

//connection handler,make the connection to the database server
//my sql vs mysqli , imporbed
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

// Check If form submitted, insert form data into announcement table.
if(isset($_POST['register_user'])) {
    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $repassword = mysqli_real_escape_string($mysqli, $_POST['repassword']);

    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($email)) { array_push($errors, "email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    if ($password != $repassword) {
        array_push($errors, "The two passwords do not match");
        // Checking if the passwords match
    }

    if (count($errors) == 0) {
    //Obtain data posted from the form
    //assign to the variable subject, from the text field subject in form
    $subject = $_POST['email'];
    $password = SHA1($_POST['password']);

    // include database connection file
    include_once("config.php"); 
            
    // Insert announcement data into table
    $query = "INSERT INTO `profile_info`(email,password) VALUES('$subject','$password')";
    $result = mysqli_query($mysqli, $query)or die(mysqli_error($mysqli));
    
    header('location: index.php');

    // Show password when announcement added
    echo "Account successfully created. Please go to sign in page to start your journey";
}
}

// User login
if (isset($_POST['login_user'])) {
     
    // Data sanitization to prevent SQL injection
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  
    // Error message if the input field is left blank
    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    // Checking for the errors
    if (count($errors) == 0) {
        // Password matching
        $password = SHA1($password);
        $sql="select * from profile_info where email='".$email."'AND password='".$password."' limit 1";
        $results = mysqli_query($mysqli, $sql);
        $a_email="lmeoGrocery@admin.my";
        $a_pw="lmeo123";
        if($email==$a_email && $password=$a_pw)
        {
            header('location: ../admin/index.php');
        }
  
        // $results = 1 means that one user with the
        // entered username exists
        if (mysqli_num_rows($results) == 1) {
             
            // Storing username in session variable
            $_SESSION['email'] = $email;
             
            // Welcome message
            $_SESSION['success'] = "You have logged in!";
            $_SESSION['loginsuccess'] = 1; 
            // Page on which the user is sent
            // to after logging in
            header('location: ../index.php');
        }
        else {
             
            // If the username and password doesn't match
            array_push($errors, "Username or password incorrect");
        }
    }
}





if(isset($_POST['add_address'])) {
    // Prevent sql injection
    $new_address = mysqli_real_escape_string($mysqli, $_POST['new_address']);
    $new_state = mysqli_real_escape_string($mysqli, $_POST['new_state']);
    $new_city = mysqli_real_escape_string($mysqli, $_POST['new_city']);
    $new_postcode = mysqli_real_escape_string($mysqli, $_POST['new_postcode']);
    $new_address_name = mysqli_real_escape_string($mysqli, $_POST['new_address_name']);
    $new_address_phone = mysqli_real_escape_string($mysqli, $_POST['new_address_phone']);

    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($new_address)) { array_push($errors, "Address is required"); }
    if (empty($new_state)) { array_push($errors, "State is required"); }
    if (empty($new_city)) { array_push($errors, "City is required"); }
    if (empty($new_postcode)) { array_push($errors, "PostCode is required"); }
    if (empty($new_address_name)) { array_push($errors, "Name is required"); }
    if (empty($new_address_phone)) { array_push($errors, "Phone is required"); }

    if (count($errors) == 0) {
    //Obtain data posted from the form
    //assign to the variable subject, from the text field subject in form
    $new_address = $_POST['new_address'];
    $new_state = $_POST['new_state'];
    $new_city = $_POST['new_city'];
    $new_postcode = $_POST['new_postcode'];
    $new_address_name = $_POST['new_address_name'];
    $new_address_phone = $_POST['new_address_phone'];

    // include database connection file
            
    // Insert announcement data into table
    $query = "INSERT INTO user_address(email,address,state,city,postcode,address_name,address_phone) 
              VALUES('$email','$new_address','$new_state','$new_city','$new_postcode','$new_address_name','$new_address_phone')";
    $result = mysqli_query($mysqli, $query)or die(mysqli_error($mysqli));
    header("Location: ../profile/index.php");

    }
}

$address_result_query = mysqli_query($mysqli, "SELECT * FROM user_address WHERE email='$email'");


?>

