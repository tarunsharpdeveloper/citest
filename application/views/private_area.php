<?php if($this->session->userdata('usertype')==1){?>
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
            <p>Total: <?php echo $total_user; ?></p> 
            <p>Active/Verified: <?php echo $total_verified; ?></p> 
            <p>Inactive/Unverified: <?php echo $total_unverified; ?></p> 
            <p>User Has Active Products: <?php echo $total_hasproduct; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Products</h4>
            <p>Total: <?php echo $total_product; ?></p> 
            <p>Active: <?php echo $total_active_product; ?></p> 
            <p>Inactive: <?php echo $total_product-$total_active_product; ?></p> 
            <p>Not Attached: <?php echo $notattached; ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Attached Products Amount</h4>
            <p>Amount of All Active Attached Products: <?php echo $activeProductsTotalAmount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Summarized Amount By Users</h4>
            <?php foreach($userwiseProductsTotalAmount as $user){ ?>
              <p><?php echo $user['username']; ?>: <?php echo $user['amount']; ?></p> 
           <?php  } ?>
           
          </div>
        </div>
      </div>

    </div>
    <div class="well">
        <h4>Exchange Rates</h4>
        <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Exchange Rate USD: <?php echo $exchangeRates['rates']['USD']; ?> </h6>
              </div>
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Exchange Rate RON: <?php echo $exchangeRates['rates']['RON']; ?> </h6>
              </div>
      </div>
  </div>
</div>


</div>

 <?php }else{ ?>

    <div class="container">
  <h3>Welcome User</h3>
  <p>User Dashboard.</p>
</div>

 <?php } ?> 



</body>
</html>
