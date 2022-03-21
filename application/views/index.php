<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <div class="container">
    <div classs="row">
      <div class="" style=" margin-top:20px;">Products</div>
      <div class="col-md-12" style="text-align:right; margin-top:20px;"><a href="<?php echo base_url() ?>Products/add" class="btn btn-secondary">Add Product</a></div>

      <table class="table  table-bordered" style="margin-top:20px;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($products as $prod) { ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $prod->title; ?></td>
              <td><?php echo $prod->description; ?></td>
              <td><img src="<?php echo base_url() ?>assets/images/<?php echo $prod->image; ?>" style="height:100px; width:100px;"></td>
              <td> <a id="btn_<?= $prod->id ?>" class="<?php if ($prod->status == 1) echo "badge bg-success";
                                                      else echo "badge bg-danger"; ?>" onclick="changeStatus(<?php echo $prod->id; ?>,<?php echo $prod->status; ?>)"><?php if ($prod->status == 1) echo "Active";
                                                                                                                                                                                                                          else echo "Deactive"; ?></a></td>
              <td><a href="<?php echo base_url() ?>Products/edit/<?php echo $prod->id; ?>"><i class="bi bi-pencil-fill"></i></a>/<a href="<?php echo base_url() ?>Products/delete/<?php echo $prod->id; ?>" onclick="return confirm('Are you sure to delete ?');" style="cursor:pointer"><i class="bi bi-trash"></i></a></td>
            </tr>
          <?php $i++;
          } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    function changeStatus(id, st) {
      $.ajax({
        url: "<?php echo base_url('Products/changeStatusproduct') ?>",
        type: "post",
        data: {
          "sid": id,
          "status": st
        },
        success: function(response) {

          bt = "#btn_" + id;
          console.log(response);
          if (response == 1) {
            console.log("yes");
            $(bt).removeClass("badge bg-danger");
            $(bt).addClass("badge bg-success");
            $(bt).attr("onclick", "changeStatus(" + id + ",1)");
            $(bt).html("Active");
          } else {
            console.log("no");
            $(bt).removeClass("badge bg-success");
            $(bt).addClass("badge bg-danger");
            $(bt).attr("onclick", "changeStatus(" + id + ",0)");
            $(bt).html("Deactive");


          }

        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Error',
            body: "Something went wrong",
            autohide: true,
            delay: 3000
          });
        }
      });

    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>