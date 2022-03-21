<div class="container">
  <h3> User Carts</h3>
  <p> Dashboard.</p>
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <?php

              // set API Endpoint and API key
              $endpoint = 'latest';
              $access_key = '691de305e7fa8787584d251b22982d07';
      
              // Initialize CURL:
              $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '');
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
              // Store the data:
              $json = curl_exec($ch);
              curl_close($ch);
      
              // Decode JSON response:
              $exchangeRates = json_decode($json, true);
      
              // Access the exchange rate values, e.g. GBP:
      
      
      foreach ($carts as $cart) {  ?>

        <div class="col">
          <div class="card">
            <div class="card-body">
              <?php //print_r($exchangeRates); 
              ?>
            </div>
            <div class="card-body bg-light text-center">
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2"> Username:

                  <?php

                  $this->db->where('id', $cart->user_id);
                  $query = $this->db->get('user');
                  $rs = $query->result();

                  if ($rs) {
                    echo $rs[0]->name;
                  } ?>
                </h6>
                <h6 class="font-weight-semibold mb-2"> <?php echo $cart->title; ?>

                  <?php
                  $this->db->where('status', 1);
                  $this->db->where('id', $cart->product_id);
                  $query = $this->db->get('products');
                  $rs = $query->result();

                  if ($rs) {
                    echo "(Active)";
                  } else {
                    echo "( Inactive )";
                  } ?>
                </h6>
              </div>
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Quantity: <?php echo $cart->qty; ?> </h6>
              </div>
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Price per Item: <?php echo $cart->price; ?> </h6>
              </div>
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Exchange Rate USD: <?php echo $exchangeRates['rates']['USD']; ?> </h6>
              </div>
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">Exchange Rate RON: <?php echo $exchangeRates['rates']['RON']; ?> </h6>
              </div>


              <?php if ($rs) {  ?>
                <h3 class="mb-0 font-weight-semibold">$<?php echo $cart->price; ?> X <?php echo $cart->qty; ?>(QTY)= $<?php echo $cart->price * $cart->qty; ?></h3>
              <?php } else {
                echo "( Product is Inactive )";
              }  ?>



            </div>
          </div>
        </div>
      <?php      }  ?>
    </div>
  </div>

</div>




</body>

</html>