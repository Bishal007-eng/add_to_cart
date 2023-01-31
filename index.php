<?php

include 'config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel='stylesheet' href='style.css' />


  <style>


    

  </style>


</head>


<body>


  <?php

    require 'navbar.php';

  ?>

  <!-- Product display  -->

  <div class="container">
    <div> <h2> Shopping Cart</h2></div>
    <div class="row">
      
     
      <?php
        $query = "SELECT * FROM product ORDER BY id ASC ";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) > 0) 
        {

          while ($row = mysqli_fetch_array($result)) 
          {

            ?>
            <div class="col-md-3 mb-3">

              <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">

                <div class="product">

                  <img src="<?php echo $row["image"]; ?>" class="img-responsive" style="margin-top: 15px; height: 150px;">
                  <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                  <h5 class="text-danger"><?php echo $row["price"]; ?></h5>
                  <input type="text" name="quantity" class="form-control" value="1">
                  <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                  <input type="submit" name="add" style="margin-top: 15px;" class="btn btn-success" value="Add to Cart">

                </div>

              </form>

            </div>
            <?php
          }
        }
      ?>

      <div style="clear: both"></div>

      <h2 class="title2" style="margin-top: 15px; text-align: center;">Shopping Cart Details</h2>
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th width="30%">Product Name</th>
            <th width="10%">Quantity</th>
            <th width="13%">Price Details</th>
            <th width="10%">Total Price</th>
            <th width="17%">Remove Item</th>
          </tr>

          <?php
            if(!empty($_SESSION["cart"]))
            {
              $total = 0;
                foreach ($_SESSION["cart"] as $key => $value) 
                {
                  ?>
                  <tr>
                    <td><?php echo $value["item_name"]; ?></td>
                    <td><?php echo $value["item_quantity"]; ?></td>
                    <td>$ <?php echo $value["product_price"]; ?></td>
                    <td>$<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                    <td>
                      <a href="index.php?action=delete&id=<?php echo $value["product_id"]; ?>">
                        <span class="text-danger">Remove Item</span>
                      </a>
                    </td>

                  </tr>
                  <?php
                    $total = $total + ($value["item_quantity"] * $value["product_price"]);
                }
              ?>
              <tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">$ <?php echo number_format($total, 2); ?></th>
                <td></td>
              </tr>
              <?php
            }
          ?>
        </table>
      </div>
    </div>

  </div>

</body>
</html>