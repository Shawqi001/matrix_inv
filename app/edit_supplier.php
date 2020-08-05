<?php
  $page_title = 'Edit suppliers';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  	$all_supliers =find_all('supplier')
?>
<?php
  //Display all suplliers
  
  $suppliers = find_sup_by_id('suppliers',(int)$_GET['id']);
  if(!$suppliers){
    $session->msg("d","Missing suplierid.");
    redirect('add_supplier.php');
  }
  
?>

<?php
if(isset($_POST['edit_sup'])){
	
  $req_field = array('supplier-name','account-name','account-number','supplier-number');
   validate_fields($req_field);
    if(empty($errors)){
   $sup_name = remove_junk($db->escape ($_POST['supplier-name']));
   $ac_name = remove_junk($db->escape($_POST['account-name']));
   $ac_num = remove_junk($db->escape($_POST['account-number']));
   $sup_num=remove_junk($db->escape($_POST['supplier-number']));
 
        $sql = "UPDATE suppliers SET sup_name='{$sup_name}',account_name='{$ac_name}',account_number='{$ac_num}',supplier_number='{$sup_num}'";		
       $sql .= " WHERE sup_id={$suppliers['sup_id']}";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated supplier");
       redirect('add_supplier.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('edit_supplier.php?id='.$suppliers['sup_id'],false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('edit_supplier.php?id='.$suppliers['sup_id'],false);
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
           <span>Editing <?php echo remove_junk(ucfirst($suppliers['sup_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_supplier.php?id=<?php echo (int)$suppliers['sup_id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="supplier-name" value="<?php echo remove_junk(ucfirst($suppliers['sup_name']));?>">
			   
           </div>
		   <div class="col-md-6">
			<div class="form-group">
			
			<input type="text" class="form-control" name="account-number"  value="<?php echo remove_junk($suppliers['account_number']);?>" >
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="form-group">
			`	
			<input type="text" class="form-control" name="account-name"  value="<?php echo remove_junk($suppliers['account_name']);?>" >
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
			
			<input type="text" class="form-control" name="supplier-number"  value="<?php echo remove_junk($suppliers['supplier_number']);?>" >
			</div>
			</div>
           <button type="submit" name="edit_sup" class="btn btn-primary">Update suppliers</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('../layouts/footer.php'); ?>
