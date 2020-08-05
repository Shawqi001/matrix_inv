 <?php
  $page_title = 'All supplier';
  require_once('../includes/load.php');

  // Checkin What level user has permission to view this page
  page_require_level(2);
  
  $suppliers = find_all('suppliers')
?>                                                   
<?php
 if(isset($_POST['add_sup'])){
   $req_field = array('supplier-name','account-name','account-number','supplier-number');
   validate_fields($req_field);
   $sup_name = remove_junk($db->escape ($_POST['supplier-name']));
   $ac_name = remove_junk($db->escape($_POST['account-name']));
   $ac_num = remove_junk($db->escape($_POST['account-number']));
   $sup_num=remove_junk($db->escape($_POST['supplier-number']));
 
   if(empty($errors)){
      $sql  = "INSERT INTO `suppliers`( `sup_name`, `account_name`,`account_number`,`supplier_number`)"; 
	       $sql.= " VALUES('{$sup_name}','{$ac_name}','{$ac_num}','{$sup_num}')";
	     
      if($db->query($sql)){
        $session->msg("s",  "0Successfully Added supplier");
        redirect('add_supplier.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('add_supplier.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_supplier.php',false);
   }
 }

 
?>
<?php include_once('../layouts/header.php'); ?>

  <div class="row"   >
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add suppliers</span>
         </strong>
		 <div class="pull-right">
            <a href="supplier.php" class="btn btn-primary">manage supplier</a>
          </div>
		
        </div>
		
        <div class="panel-body">
		<div class="row">
		<div class="col-md-6">
          <form method="post" action="add_supplier.php">
            <div class="form-group">
			 <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                <input type="text" class="form-control" name="supplier-name" placeholder="supplier name"   Style="width:50%;">
            </div>
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
                    <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
			<input type="text" class="form-control" name="account-number" placeholder="account number"  Style="width:50%;" >
			</div>
			</div>
			</div>
			
			 </div>
			 <div class="row">
			<div class="col-md-6">
			
			
                    <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-earphone"></i>
                      </span>
			
			<input type="text" class="form-control" name="account-name" placeholder="account name"  Style="width:50%;"    >
			</div>
			
			</div>
			<div class="col-md-3">
			<div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-earphone"></i>
                      </span>
			
		<input type="text" class="form-control" name="supplier-number" placeholder=" supplier number"  >
			</div>
			</div>
			
							  <button  type="submit" name="add_sup" class="btn btn-primary">Add supplier</button>
           
        </form>

       </div>

      </div>
	 
    </div>
   
	</div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
