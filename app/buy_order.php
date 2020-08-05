<?php
$page_title = 'Add buy_order';
require_once('../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
$all_inventory = find_all("inventory");
$connect = new PDO("mysql:host=localhost;dbname=matrix", "root", "");

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




?>

<?php
if (isset($_POST['add_order'])) {
  //  $req_fields = array('supplier_id','inventory_id');
  // validate_fields($req_fields);



  $sup_id = remove_junk($db->escape($_POST['supplier_id']));
  $inv_id = remove_junk($db->escape($_POST['inventory_id']));

  if (empty($errors)) {
    $sql  = "INSERT INTO `buy_orders`(  `suplier_id`, `inv_id`) ";
    $sql .= "VALUES('{$sup_id}','{$inv_id}')";
    if ($db->query($sql)) {
      $id = $db->insert_id();

      $f = (int) count($_POST['product_name']);
      for ($i = 0; $i < $f; $i++) {
        $pro = (int) ($_POST['product_name'][$i]);
        $qty = (int) ($_POST['Qty'][$i]);
        $sql1  = "INSERT INTO buy_oders_products (product_id, buy_order_id
                 ,quantity)";
        $sql1 .= " VALUES ('{$pro}','{$id}','{$qty}')";
        if ($db->query($sql1)) {
          $session->msg("s", "Successfully Added Incoming stock");
        }
      }
      $session->msg('s', "buy_order added ");

      redirect('buy_order.php', false);
    } else {
      $session->msg('d', ' Sorry failed to added!');
      redirect('buy_order.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('buy_order.php', false);
  }
}




?>




<!-----

$searchTerm = $_GET['name']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM suppliers WHERE suppliers  LIKE '%".$searchTerm."%' AND sup_id = '1' ORDER BY sup_id ASC"); 
 
// Generate array with skills data 
$suppliers = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['sup_id'] = $row['sup_id']; 
        $data['value'] = $row['supplier_number']; 
        array_push($suppliers, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($suppliers); 

php
$key=$_GET['supplier_number'];
    $array = array('supplier_number');
    $query="select * from suppliers where  supplier_number LIKE '%{$key}%'";
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['supplier_number'];
    }
    echo json_encode($array);
   

?>
---->


<form method="post">
  <?php include_once('../layouts/header.php'); ?>

  <div class="row">

    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>BUY ORDER</span>
          </strong>

        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <?php echo display_msg($msg); ?>
            </div>

          </div>

          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-th-large"></i>
              </span>
              <select class="form-control" name="supplier_id" id="">
                <option value="">Supplier</option>
                <?php echo fill_supplier_select_box($connect); ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <select class="form-control" name="inventory_id">
              <option value="">INV_NUM </option>
              <?php foreach ($all_inventory as $inv) : ?>
                <option value="<?php echo (int) $inv['inv_id'] ?>">
                  <?php echo $inv['inv_name'] ?>
                </option>
              <?php endforeach; ?>
            </select>

          </div>
        </div>
        <div class="form-group">
          <div class="row">











          </div>



        </div>


        <?php
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

        ?>


        <div class="row">
          <div class="col-md-4">
            <div class="container">

              <div class="table-repsonsive" style="width:69%;">
                <span id="error"></span>
                <table class="table table-bordered" id="item_table">
                  <tr>
                    <th style="width:45%;">product name</th>
                    <th style="width:45%;">Qty</th>
                    <th style="width:10%;">Totla</th>

                    <th> <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                  </tr>
                </table>
                <div align="center">
                  <input type="submit" name="add_order" class="btn btn-info" value="Insert" />
                </div>
              </div>
            </div>
          </div>
        </div>
</form>

</body>

</html>

<script>
  $(document).ready(function() {

    $(document).on('click', '.add', function() {
      var html = '';

      html += '<tr>';
      html +=
        '<td><select name="product_name[]" class="form-control name"><option value="">Select Product</option><?php echo fill_unit_select_box($connect); ?></select></td>';
      html +=
        '<td><input type="text" name="Qty[]" class="form-control name"/></td>';;
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
<?php include "../layouts/footer.php";
