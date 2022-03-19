<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">CI Test</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>products">Products</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>cart">Cart</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Welcome : <?php echo $this->session->userdata('username'); ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo base_url(); ?>private_area/logout ">Logout</a>

      </div>
    </li>
  </ul>
</nav>
<br>
 <?php if($this->session->userdata('usertype')==1){ ?>
    <div class="container">
    <div class="container-fluid">
  <div class="row content">
    
    <div class="col-sm-12">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Administrator</p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Users</h4>
            <p>1 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Pages</h4>
            <p>100 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Sessions</h4>
            <p>10 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Bounce</h4>
            <p>30%</p> 
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


</div>

 <?php }else{ ?>

    <div class="container">
  <h3>Product Details</h3>
  <p> Dashboard.</p>
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        <?php  $product=$product[0];  ?> 

        <form method="post" action="<?php echo base_url(); ?>cart/validation" class="mx-1 mx-md-4">

        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-img-actions"> <img src="<?php echo $product->image; ?>" class="card-img img-fluid" width="96" height="350" alt=""> </div>
                </div>
                <div class="card-body bg-light text-center">
                    <div class="mb-2">
                        <h6 class="font-weight-semibold mb-2"> <a href="#" class="text-default mb-2" data-abc="true"><?php echo $product->title ?></a> </h6> 
                    </div>
                    <h3 class="mb-0 font-weight-semibold">$<?php echo $product->price; ?></h3>
                    <div> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> </div>
                    <div class="form-outline flex-fill mb-0">
    <input type="number" name="qty" value="1" id="form3Example1c" class="form-control" />

    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>"  />

    <input type="hidden" name="product_id" value="<?php echo $product->price; ?>" />

    <input type="hidden" name="title" value="<?php echo $product->title; ?>" />

    <input type="hidden" name="price" value="<?php echo $product->price; ?>" />
    <label class="form-label"  for="form3Example1c">Quantiry</label>
  <span class="text-danger">  <?php echo form_error('user_name'); ?> </span>
  </div>
                    <input type="submit" class="btn bg-cart" name="add" value="Add to cart" />
                </div>
            </div>
        </div>
 </form>
    </div>
</div>
 
</div>

 <?php } ?> 



</body>
</html>
