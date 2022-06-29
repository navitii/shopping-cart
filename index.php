<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel='stylesheet' href='<?php $actual_link;?>/shopping-cart/css/styles.css' />
</head>

<body>
<?php 
    
    include 'config.php';
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 

    if (isset($_POST['id']) && isset($_POST['ratedIndex'])) {

      $uID = $conn->real_escape_string($_POST['id']);
      $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);

      $sql = "UPDATE product SET rating='$ratedIndex' WHERE id=$uID";
      $query = $conn->query($sql);
    
      
    }


    
?>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i>&nbsp;&nbsp;Basic Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php"><i class="fas fa-store"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->
  

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			$stmt = $conn->prepare('SELECT * FROM product');
  			$stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()):   
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $actual_link.'/shopping-cart/'.$row['product_image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
              <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
              <h5 class="card-text text-center text-danger"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?>/-</h5>
            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <div class='rating-stars text-center'>
                  <ul id='stars'>
                    <li class='star' title='Poor' data-value='1' id='<?php echo $row['id'];  ?>'>
                      <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Fair' data-value='2' id='<?php  echo $row['id'];  ?>'>
                      <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Good' data-value='3' id='<?php echo $row['id'];  ?>' >
                      <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='Excellent' data-value='4' id='<?php echo $row['id'];  ?>'>
                      <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='WOW' data-value='5' id='<?php echo $row['id'];  ?>'>
                      <i class='fa fa-star fa-fw'></i>
                    </li>
                  </ul>
                </div>
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->
  <script src='<?php $actual_link;?>/shopping-cart/js/jquery-3.5.1.min.js'></script>
  <script src='<?php $actual_link;?>/shopping-cart/js/main.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>

</html>