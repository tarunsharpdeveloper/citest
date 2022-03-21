<div class="container">
  <h3>Welcome User</h3>
  <p>User Dashboard.</p>
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <?php foreach ($products as $product) {  ?>


        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-body">
              <div class="card-img-actions"> <img src="<?php echo base_url() ?>assets/images/<?php echo $product->image; ?>" class="card-img img-fluid" width="96" height="350" alt=""> </div>
            </div>
            <div class="card-body bg-light text-center">
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2"> <a href="<?php echo base_url(); ?>product/<?php echo $product->id; ?>" class="text-default mb-2" data-abc="true"><?php echo $product->title ?></a> </h6>
                <p><?php echo $product->description ?></p>
              </div>


            </div>
          </div>
        </div>
      <?php      }  ?>
    </div>
  </div>

</div>

</body>

</html>