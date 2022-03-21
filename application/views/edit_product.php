<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div style="margin-bottom:20px;">Edit Product</div>
                <?php
                foreach ($product as $prod) {
                ?>
                    <?php echo form_error(); ?>
                    <form class="row g-3 bordered" action="<?php echo base_url() ?>index.php/Products/edit_prod" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Title</label>
                            <input type="text" class="form-control <?php if (@form_error('title')) {
                                                                        echo "error";
                                                                    } ?>" name="title" id="inputEmail4" value="<?php echo $prod->title; ?>">
                            <?php echo form_error('title'); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Description</label>
                            <textarea class="form-control <?php if (@form_error('description')) {
                                                                echo "error";
                                                            } ?>" name="description" id="inputCity" value="<?php echo $prod->description; ?>"><?php echo $prod->description; ?></textarea> <?php echo form_error('description'); ?>
                        </div>
                        <div class="col-md-12">
                            <label for="inputImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control <?php if (@form_error('file')) {
                                                                        echo "error";
                                                                    } ?>" name="file" id="inputImage" onchange="loadFile(event)">
                            <!-- <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                            <?php echo form_error('file'); ?>
                        </div>

                        <div class="image-area mt-4"><img id="output" src="<?php echo base_url() ?>assets/images/<?php echo $prod->image; ?>" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" style="height:100px; width:100px;"></div>
                        <input type="hidden" name="imagedata" value="<?php echo $prod->image; ?>">
                        <input type="hidden" name="id" value="<?php echo $prod->id; ?>">

            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="edit_btn">submit</button>
            </div>
            </form>
        <?php } ?>
        </div>
    </div>
    </div>

    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>