<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

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

//your products with their price.
$food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;
if(isset($_COOKIE['totalAmount'])) {
    $totalValue = $_COOKIE['totalAmount'];
};
$total = 0;
$showMessage = true;
$showErrorEmail = false;
$showErrorStreet = false;
$showErrorStreetNumber = false;
$showErrorCity = false;
$showErrorZipCode = false;
$showErrorCheckboxes = false;
$quickDelivery = false;

// $cookieName = 'totalAmount';
// $totalValue += $total;
// setcookie($cookieName, $totalValue, time() + (86400 * 30), "/"); 

if (!empty($_POST['email'])){
    $_SESSION['email'] = $_POST['email'];
};
if (!empty($_POST['email'])){
    $_SESSION['street'] = $_POST['street'];
};
if (!empty($_POST['email'])){
    $_SESSION['streetnumber'] = $_POST['streetnumber'];
};
if (!empty($_POST['email'])){
    $_SESSION['city'] = $_POST['city'];
};
if (!empty($_POST['email'])){
    $_SESSION['zipcode'] = $_POST['zipcode'];
};


if (isset($_POST['email']) && $_POST['email'] == '') {
    $showMessage = false;
    $showErrorEmail = true;
};

if (isset($_POST['street']) && $_POST['street'] == '' ) {
    $showMessage = false;
    $showErrorStreet = true;
};

if (isset($_POST['streetnumber']) && $_POST['streetnumber'] == '' || isset($_POST['zipcode']) && !is_numeric($_POST['streetnumber']) ) {
    $showMessage = false;
    $showErrorStreetNumber = true;
};

if (isset($_POST['city']) && $_POST['city'] == '') {
    $showMessage = false;
    $showErrorCity = true;
};

if (isset($_POST['zipcode']) && $_POST['zipcode'] == '' || isset($_POST['zipcode']) && !is_numeric($_POST['zipcode'])) {
    $showMessage = false;
    $showErrorZipCode = true;
};


if (isset($_GET['food']) && $_GET['food'] != 1) {
    $products = $drinks;
} else {
    $products = $food;
};

if(isset($_POST['products'])){
    $total = 0;
    foreach(array_keys($_POST['products']) as $key) {
        $total += $products[$key]['price'];
    };
    if(isset($_POST['express_delivery'])) {
        $total += $_POST['express_delivery'];
        $quickDelivery = true;
    };
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($showMessage) {
        $totalValue = $total + $totalValue; 
        setcookie("totalAmount", strVal($totalValue), time()+30*24*60*60);
    };
};

} else {
    $showErrorCheckboxes = true;
    $showMessage = false;
};


    

require 'form-view.php';

