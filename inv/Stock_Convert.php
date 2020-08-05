<?php
$page_title = 'All stock covert';
require_once('../includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$all_inventory = find_all('inventory');

if (isset($_POST['add_convert'])) {
    $req_fields = array('st_inv_id','to_inv_id','st_id', 'quantity');
    validate_fields($req_fields);
    if (empty($errors)) {
        $from_inv_id      = $db->escape((int) $_POST['st_inv_id']);
        $to_inv_id      = $db->escape((int) $_POST['to_inv_id']);
        $p_id      = $db->escape((int) $_POST['st_id']);
        $st_qty     = $db->escape((int) $_POST['quantity']);
        $st_date    = make_date();

        
        $sql  = "INSERT INTO stock_convert(";
        $sql .= " product_id,qty,date,from_inv_id,to_inv_id";
        $sql .= ") VALUES (";
        $sql .= "'{$p_id}','{$st_qty}','{$st_date}','{$from_inv_id}','{$to_inv_id}'";
        $sql .= ")";

        if ($db->query($sql)) {
            echo "sss";
            if (convert_to_inv($st_qty, $p_id, $from_inv_id, $to_inv_id)) {
                $session->msg('s', "Stock Convert added. ");
                redirect('Stock_Convert.php', false);
            }
        } else {
            $session->msg('d', ' Sorry failed to add!');
            redirect('Stock_Convert.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('Stock_Convert.php', false);
    }
}


?>

<!------	
 if(isset($_POST['add_convert'])){
   $req_field = array('selfs-name');
   validate_fields($req_field);
   $shelf_name = remove_junk($db->escape($_POST['shelfs-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO shelfs(shelf_name)";
      $sql .= " VALUES ('{$shelf_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Categorie");
        redirect('shelves_details.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('shelves_details.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('shelves_details.php',false);
   }
 }
------->
<?php include_once('../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-7">
    <?php echo display_msg($msg); ?>
    <form method="post" action="../app/ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Find It</button>
          </span>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Search for product name">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>

  </div>


</div>
<form method="post" action="Stock_Convert.php">

  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Stock Convert</span>
          </strong>
          <div class="pull-right">
            <a href="convert.php" class="btn btn-primary">manage Convert</a>
          </div>
        </div>
        <div class="panel-body">




          <div class="col-md-4">

            <select class="form-control" name="to_inv_id">
              <option value="">TO</option>
              <?php foreach ($all_inventory as $inv) : ?>
              <option
                value="<?php echo (int) $inv['inv_id'] ?>">
                <?php echo $inv['inv_name'] ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>

        <!-- add morre details -->

        <!-- /add morre details -->
        <div class="form-group">

          <div class="form-group">




          </div>

          <div class="row">
            <div class="col-md-6">
              <?php echo display_msg($msg); ?>

            </div>
          </div>
          <div class="row">

            <div class="col-md-12">

              <table class="table table-bordered">
                <thead>
                  <th> Item </th>
                  <th> Qty </th>
                  <th> Action</th>
                </thead>
                <tbody id="product_info"> </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
</form>


<?php include_once('../layouts/footer.php');
