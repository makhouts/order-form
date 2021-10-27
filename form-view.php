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
<?php if($showMessage) { ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Thank you for your order!</h4>
  <p>We will deliver your order at: <strong><?php echo $_POST['street'] . ' ' . $_POST['streetnumber'] . ' ' . $_POST['city']; ?></strong></p>
  <p>Amount that should be paid upon delivery: <strong>€ <?php echo $total ?></strong></p>
  <hr>
  <p class="mb-0">Delivery time will be: <strong><?php echo $quickDelivery ? "45 minutes" : "2 hours"; ?></strong></p>
</div> <?php }; ?>
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
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                } ?>" />
                <?php echo $showErrorEmail ? "<label class='error' for='email'>Please fill in an email.</label>"  : null; ?>

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
                <?php echo $showErrorStreet ? "<label class='error' for='street'>Please fill in a street.</label>" : null; ?>

                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php if(isset($_SESSION['streetnumber'])) {
                    echo $_SESSION['streetnumber'];
                } ?>" >
                <?php echo $showErrorStreetNumber ? "<label class='error' for='streetnumber'>Please fill in a streetnumber.</label>" : null; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_SESSION['city'])) {
                    echo $_SESSION['city']; 
                } ?>" >
                <?php echo $showErrorCity ? "<label class='error' for='city'>Please fill in a city.</label>" : null; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php if(isset($_SESSION['zipcode'])) {
                        $showMessage = false;
                    echo $_SESSION['zipcode'];
                } ?>" >
                    <?php echo $showErrorZipCode ? "<label class='error' for='zipcode'>Please fill in a zipcode(numbers).</label>" : null; ?>
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
            
        <button type="submit" name='submit' class="btn btn-primary">Order!</button><br>
        <label class='error'><?php echo $showErrorCheckboxes ? 'Please select at least one food/drink!' : null ?></label>
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
    .alert-success {
        margin-top: 30px;
    }
</style>
</body>
</html>