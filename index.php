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


    if(empty($_POST['email'])) {
        echo 'An email is required <br />';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = 'Email must be a valid email address';
            echo $emailErr;
        }
    }

    // check street
    if(empty($_POST['street'])) {
        echo 'Street name is required<br />';
    } else {
        $street = $_POST['street'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $street)){
            $streetErr = 'Street name must be letters and spaces only';
            echo $streetErr;
        }
    }

    // check number
    if(empty($_POST['streetnumber'])) {
        echo 'Street number is required <br />';
    } else {
        $streetnumber = $_POST['streetnumber'];
        if(!preg_match('/^[0-9]+$/', $streetnumber)){
            $streetnumberErr = 'Street number  must be numbers only';
            echo $streetnumberErr;
        }
    }

    // check number
    if(empty($_POST['city'])) {
        echo 'City name is required <br />';
    } else {
        $city = $_POST['city'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $city)){
            $cityErr = 'City name must be letters and spaces only';
            echo $cityErr;
        };
    }

    // check number
    if(empty($_POST['zipcode'])) {
        echo 'Zipcode is required <br />';
    } else {
        $zipcode = $_POST['zipcode'];
        if(!preg_match('/^[0-9]+$/', $zipcode)){
            $zipcodeErr = 'Zipcode must be numbers only';
            echo $zipcodeErr;
        }
    }

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

require 'form-view.php';