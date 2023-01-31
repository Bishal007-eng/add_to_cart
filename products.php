<?php

include 'config.php';

?>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel='stylesheet' href='style.css' />
<?php

  require 'navbar.php';

?>

<div class="container">
    <div> <h2>Products</h2></div>
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

              <form method="post" action="products.php?action=add&id=<?php echo $row["id"]; ?>">

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