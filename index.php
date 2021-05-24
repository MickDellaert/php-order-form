<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
// whatIsHappening();

// validation of form input

    // check email

    // $errors =  array('email'=>'', 'street'=>'','streetnumber'=>'', 'city'=>'', 'zipcode'=>'');
    // $_SESSION['errors'] = $errors;

    $errors = array('email' => '', 'street' => '');
    $_SESSION['error'] = $errors;
    $email = $street = $streetnumber = $city = $zipcode ='';
    $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr= '';

    if(isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $emailErr = 'Email is required';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = 'Email must be a valid email address';
            } else {
                $_SESSION['email'] = $email;
            }
        }

        // check street
        if (empty($_POST['street'])) {
            $streetErr = 'Street name is required';
        } else {
            $street = $_POST['street'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $street)) {
                $streetErr = 'Street name must be letters and spaces only';
            } else {
                $_SESSION['street'] = $street;
            }
        }

        // check streetnumber
        if (empty($_POST['streetnumber'])) {
            $streetnumberErr = 'Street number is required';
        } else {
            $streetnumber = $_POST['streetnumber'];
            if (!is_numeric($streetnumber)) {
                $streetnumberErr = 'Street number must be numbers only';
            } else {
                $_SESSION['streetnumber'] = $streetnumber;
            }
        }

        // check city
        if (empty($_POST['city'])) {
            $cityErr = 'City name is required <br />';
        } else {
            $city = $_POST['city'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $city)) {
                $cityErr = 'City name must be letters and spaces only';
            } else {
                $_SESSION['city'] = $city;
            }
        }

        // check zipcode
        if (empty($_POST['zipcode'])) {
            $zipcodeErr = 'Zipcode is required <br />';
        } else {
            $zipcode = $_POST['zipcode'];
            if (!is_numeric($zipcode)) {
                $zipcodeErr = 'Zipcode must be numbers only';
            } else {
                $_SESSION['zipcode'] = $zipcode;
            }
        }
    }

if(isset($_GET['food']) && $_GET['food'] === '0') {
//your products with their price.
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ]; }
else {

    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

$totalValue = 0;

require 'form-view.php';