<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions


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

    // calculating the total of the order and displaying error message when order is empty

        if (!empty($_POST['products'])) {
            echo "Your order:";
            foreach (($_POST['products']) as $key => $value) {
                $price = $products[$key]['price'];
                $totalValue += $price;
                $orderItemName = $products[$key]['name'];
                echo "<li>Item: $orderItemName - Price: €$price</li>";
            }
            if (isset($_POST['express_delivery'])) {
                $totalValue += 5;
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

}

require 'form-view.php';
require 'confirmation.php';