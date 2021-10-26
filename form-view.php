<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <?php        
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
    ?>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                } ?>" />
                <?php if (isset($_POST['email']) && $_POST['email'] == '') {
                    $showMessage = false;
                ?>  <label class='error' for="email">Please fill in an email.</label>

                <?php } ?>

            </div>
            <div></div>
        </div>
    
        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php if(isset($_SESSION['street'])) {
                    echo $_SESSION['street'];
                } ?>" >
                <?php if (isset($_POST['street']) && $_POST['street'] == '' ) {
                    $showMessage = false;
                ?>  <label class='error' for="street">Please fill in a street.</label>

                <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php if(isset($_SESSION['streetnumber'])) {
                    echo $_SESSION['streetnumber'];
                } ?>" >
                <?php if (isset($_POST['streetnumber']) && $_POST['streetnumber'] == '' || isset($_POST['zipcode']) && !is_numeric($_POST['streetnumber']) ) {
                    $showMessage = false;
                ?>  <label class='error' for="streetnumber">Please fill in a streetnumber.</label>

                <?php } ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_SESSION['city'])) {
                    echo $_SESSION['city']; 
                } ?>" >
                <?php if (isset($_POST['city']) && $_POST['city'] == '') {
                    $showMessage = false;
                ?>  <label class='error' for="city">Please fill in a city.</label>
                <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php if(isset($_SESSION['zipcode'])) {
                        $showMessage = false;
                    echo $_SESSION['zipcode'];
                } ?>" >
                 <?php if (isset($_POST['zipcode']) && $_POST['zipcode'] == '' || isset($_POST['zipcode']) && !is_numeric($_POST['zipcode'])) {
                     $showMessage = false;
                ?>  <label class='error' for="zipcode">Please fill in a zipcode(numbers).</label>
                <?php } ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            
            <?php 
            foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" name='submit' class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }

    .error {
        color: red;
    }
</style>
</body>
</html>