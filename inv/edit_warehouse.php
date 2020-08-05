<?php
  $page_title = 'Edit inventory';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>

<?php
  //Display all catgories.
  if(isset($_GET['id'])){
  $inventory = find_inv_by_id('inventory',(int)$_GET['id']);
  if(!$inventory){
    $session->msg("d","Missing inventory id.");
    redirect('Warehouse_Details.php');
  }
}
?>

<?php
if(isset($_POST['edit_inv'])){
  $inv_id=$_POST['id'];

  $req_field = array('inventory-name','inventory-location','inventory-telephone');
  validate_fields($req_field);
  if(empty($errors)){
  $inv_name = remove_junk($db->escape($_POST['inventory-name']));
  $inv_location = remove_junk($db->escape($_POST['inventory-location']));
  $inv_tel = remove_junk($db->escape($_POST['inventory-telephone']));
  
        $sql = "UPDATE inventory SET ";
		 $sql.=" inv_name ='{$inv_name}',inv_location='{$inv_location}', inv_tel='{$inv_tel}'";
       $sql .= " WHERE inv_id ='$inv_id'";
	   
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated inventory");
       redirect('Warehouse_Details.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('edit_warehouse.php? id='.$inventory['inv_id'],false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('edit_warehouse.php? id='.$inventory['inv_id'],false);
  }
}
?>
<?php include_once('../layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($inventory['inv_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_warehouse.php">
           <div class="form-group">
           
           <input type="hidden" name="id" value="<?php echo (int)$inventory['inv_id'];?>">
               <input type="text" class="form-control" name="inventory-name" value="<?php echo remove_junk(ucfirst($inventory['inv_name']));?>">
			   
           </div>
		   <div class="col-md-6">
			<div class="form-group">
			
			<input type="text" class="form-control" name="inventory-location"  value="<?php echo remove_junk($inventory['inv_location']);?>" >
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="form-group">
			
			<input type="text" class="form-control" name="inventory-telephone"  value="<?php echo remove_junk($inventory['inv_tel']);?>" >
			</div>
			</div>
           <button type="submit" name="edit_inv" class="btn btn-primary">Update inventory</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('../layouts/footer.php'); ?>
