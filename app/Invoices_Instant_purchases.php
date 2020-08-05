<?php
$page_title = 'Add purchase';
require_once('../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
$purchase = find_all('purchas');
?>
<?php
if (isset($_POST['add_purchase'])) {
  $sup_id = remove_junk($db->escape($_POST['supplier_id']));

  $f = (int) count($_POST['product_id']);
  for ($i = 0; $i < $f; $i++) {
    $p_id = (int) $_POST['product_id'][$i];
    $inv_id = (int) ($_POST['inv_id'][$i]);
    $qty = (int) ($_POST['Quantity'][$i]);



    $date = make_date();
    $sql  = "INSERT INTO purchase(`product_id`, `inv_id`, `supplier_id`, `data`)";

    $sql .= " VALUES('{$p_id}','{$inv_id}','{$sup_id}','{$date}')";

    $total_price = (float) (find_by_id("products", $p_id)["buy_price"]) * $qty;
    $sql = "UPDATE boxes set real_cash = real_cash - $total_price where id = 1";
    if ($db->query($sql)) {
      $sql1 = "UPDATE products SET quantity= quantity +'{$qty}' WHERE id = '{$p_id}'";
      $result1 = $db->query($sql1);
    } else {

      $session->msg("d", "Sorry Failed to insert.");
      redirect('invoices_instant_purchases.php', false);
    }
  }
  $session->msg("s", "Successfully Added  purchase");
  redirect('invoices_instant_purchases.php', false);
}

?>

<?php include_once('../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>

  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>فواتير مشتروات فورية</span>
        </strong>

      </div>
      <div class="panel-body">
      


        <div class="row">

          <div class="col-md-12">
            <form method="post" action="Invoices_Instant_purchases.php" class="clearfix">

              <div class="row">

                <?php
                $connect = new PDO("mysql:host=localhost;dbname=matrix", "root", "");
                function fill_unit_select_box($connect)
                {
                  $output = '';
                  $query = "SELECT * FROM products ORDER BY name ASC";
                  $statement = $connect->prepare($query);
                  $statement->execute();
                  $result = $statement->fetchAll();
                  foreach ($result as $row) {
                    $output .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                  }
                  return $output;
                }
                function fill_supplier_select_box($connect)
                {
                  $output = '';
                  $query = "SELECT * FROM suppliers ORDER BY sup_name ASC";
                  $statement = $connect->prepare($query);
                  $statement->execute();
                  $result = $statement->fetchAll();
                  foreach ($result as $row) {
                    $output .= '<option value="' . $row["sup_id"] . '">' . $row["sup_name"] . '</option>';
                  }
                  return $output;
                }
                function fill_inv_select_box($connect)
                {
                  $output = '';
                  $query = "SELECT * FROM inventory ORDER BY inv_name ASC";
                  $statement = $connect->prepare($query);
                  $statement->execute();
                  $result = $statement->fetchAll();
                  foreach ($result as $row) {
                    $output .= '<option value="' . $row["inv_id"] . '">' . $row["inv_name"] . '</option>';
                  }
                  return $output;
                }

                ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <label for="">Supplier</label>
                  <select name="supplier_id" class="form-control name">
                    <option value="">Select Supplier</option><?php echo fill_supplier_select_box($connect); ?>
                  </select>
                </div>
                <div class="col-md-3">
                <label for="">Payment Method</label>

                  <select class="form-control" name="payment_method">
                    <option value="" selected disabled>Select Payment Method</option>
                    <option value="0">cach</option>
                  </select>
                </div>
                <br>
                <br>
                <br>

                <br>

                <div class="row">
                  <div class="col-md-4">
                    <div class="container">

                      <div class="table-repsonsive" style="width:69%;">
                        <span id="error"></span>
                        <table class="table table-bordered" id="item_table">
                          <tr>
                            <th style="width:30%;">Product Name</th>
                            <th style="width:30%;">inventory name</th>
                            <th style="width:30%;"> Quantity</th>
                            <th style="width:30%;"> price</th>

                            <th> <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                          </tr>
                        </table>
                        <div align="center">
                          <input type="submit" name="add_purchase" class="btn btn-info" value="Insert" />
                        </div>
                      </div>
            </form>
          </div>
        </div>
        </body>

        </html>

        <script>
          $(document).ready(function() {

            $(document).on('click', '.add', function() {
              var html = '';
              html += '<tr>';
              html +=
                '<td><select name="product_id[]" class="form-control name"><option value="">Select Product</option><?php echo fill_unit_select_box($connect); ?></select></td>';
              html +=
                '<td><select name="inv_id[]" class="form-control name"><option value="">Select Inventory</option><?php echo fill_inv_select_box($connect); ?></select></td>';
              html +=
                '<td><input type="text" name="Quantity[]" class="form-control "></td>';
              html +=
                '<td><input type="text" name="price[]" class="form-control "></td>';
              html +=
                '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
              $('#item_table').append(html);
            });

            $(document).on('click', '.remove', function() {
              $(this).closest('tr').remove();
            });


          });
        </script>


      </div>
    </div>
  </div>
</div>
</div>
<?php include "../layouts/footer.php"; ?>