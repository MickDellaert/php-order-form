<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions

session_start();

if (isset($_POST["email"])) {
    $_SESSION['email'] = $_POST["email"];
    $userEmail = $_SESSION['email'];
}


function whatIsHappening()
{
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

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

if (isset($_GET['food']) && $_GET['food'] === '0') {

    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

// setting variables to empty when first accessing the page
$email = $street = $streetnumber = $city = $zipcode = '';
$errors = array('emailErr' => '', 'streetErr' => '', 'streetnumberErr' => '', 'cityErr' => '', 'zipcodeErr' => '', 'orderErr' => '');
$totalValue = 0;
$orderMessage = '';
$orderItemName = '';
$price = '';

// validation of form input: checks only run after submit has been clicked
if (isset($_POST['submit'])) {

    // check email
    if (empty($_POST['email'])) {
        $errors['emailErr'] = 'Email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['emailErr'] = 'Email must be a valid email address';
        } else {
            $_SESSION['email'] = $email;
        }
    }

    // check street
    if (empty($_POST['street'])) {
        $errors['streetErr'] = 'Street name is required';
    } else {
        $street = $_POST['street'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $street)) {
            $errors['streetErr'] = 'Street name must be letters and spaces only';
        } else {
            $_SESSION['street'] = $street;
        }
    }

    // check streetnumber
    if (empty($_POST['streetnumber'])) {
        $errors['streetnumberErr'] = 'Street number is required';
    } else {
        $streetnumber = $_POST['streetnumber'];
        if (!is_numeric($streetnumber)) {
            $errors['streetnumberErr'] = 'Street number must be numbers only';
        } else {
            $_SESSION['streetnumber'] = $streetnumber;
        }
    }

    // check city
    if (empty($_POST['city'])) {
        $errors['cityErr'] = 'City name is required <br />';
    } else {
        $city = $_POST['city'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $city)) {
            $errors['cityErr'] = 'City name must be letters and spaces only';
        } else {
            $_SESSION['city'] = $city;
        }
    }

    // check zipcode
    if (empty($_POST['zipcode'])) {
        $errors['zipcodeErr'] = 'Zipcode is required <br />';
    } else {
        $zipcode = $_POST['zipcode'];
        if (!is_numeric($zipcode)) {
            $errors['zipcodeErr'] = 'Zipcode must be numbers only';
        } else {
            $_SESSION['zipcode'] = $zipcode;
        }
    }
}

    // calculating the total of the order and displaying error message when order is empty

        if (isset($_POST['products'])) {
            foreach (($_POST['products']) as $key => $value) {
                echo $value;
                $price = $products[$key]['price'];
                $totalValue += $price;
                $orderValue = $totalValue;

                $orderItemName = $products[$key]['name'];
                $_SESSION['name'] = $orderItemName;
                echo $_SESSION['name'];
            }
            if (isset($_POST['express_delivery'])) {
                $orderValue += 5;
                $totalValue += 5;
            }
            if (!isset($_COOKIE["totalValue"])){
                setcookie("totalValue", "$totalValue", 0, "/");
            }


        } else {
            $errors['orderErr'] = 'Please make your choice';
        }

        // display message when form is successfully submitted
        if (isset($_POST['submit'])) {

            if (!array_filter($errors)) {
                $orderMessage = 'Thank you for your order';
            }
        }


$totalValue += $_COOKIE['totalValue'];
setcookie("totalValue", "$totalValue" );


function getDeliveryTime (){
    $currentTime = date("h:i");
    if(isset($_POST["express_delivery"])) {
        $expressDelivery= date("H:i" ,strtotime('+45 minutes',strtotime($currentTime)));
        return "Your order will be delivered at " . $expressDelivery . "</br>";
    } else {
        $normalDelivery= date("H:i" ,strtotime('+2 hours',strtotime($currentTime)));
        return "Your order will be delivered at " . $normalDelivery . "</br>";
    }
}


// whatIsHappening();

require 'form-view.php';
require 'confirmation.php';