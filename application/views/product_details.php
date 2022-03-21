<div class="container">
  <h3>Product Details</h3>
  <p> Dashboard.</p>
  <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
      <?php $product = $product[0];  ?>

      <form method="post" action="<?php echo base_url(); ?>cart/validation" class="mx-1 mx-md-4">

        <div class="col-md-12 mt-2">
          <div class="card">
            <div class="card-body">
              <div class="card-img-actions"> <img src="<?php echo base_url() ?>assets/images/<?php echo $product->image; ?>" class="card-img img-fluid" width="96" height="350" alt=""> </div>
            </div>
            <div class="card-body bg-light text-center">
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2"> <a href="#" class="text-default mb-2" data-abc="true"><?php echo $product->title ?></a> </h6>
              </div>
              <p>$<?php echo $product->description; ?></p>

              <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>" />
              <input type="hidden" name="product_id" value="<?php echo $product->id; ?>" />
              <input type="hidden" name="title" value="<?php echo $product->title; ?>" />

              <div class="form-outline flex-fill mb-0">
                <input type="number" name="qty" value="1" id="form3Example1c" class="form-control" />
                <label class="form-label" for="form3Example1c">Quantiry</label>
                <span class="text-danger"> <?php echo form_error('qty'); ?> </span>
              </div>

              <div class="form-outline flex-fill mb-0">
                <input type="number" name="price" value="0" id="form3Example1c" class="form-control" />
                <label class="form-label" for="form3Example1c">price per item</label>
                <span class="text-danger"> <?php echo form_error('price'); ?> </span>
              </div>

     

              <input type="submit" class="btn btn-primary" name="add" value="Add to cart" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>


</body>

</html>