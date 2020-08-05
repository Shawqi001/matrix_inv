ew <?php
  $page_title = 'All inventory';
  require_once('../includes/load.php');

  // Checkin What level user has permission to view this page
  page_require_level(2);
  
  $inventory = find_all('inventory')
?>
<?php
 if(isset($_POST['inve_name'])){
   $req_field = array('inventory-name','inventory-location','inventory-telephone');
   validate_fields($req_field);
   $inv_name = remove_junk($db->escape ($_POST['inventory-name']));
   $inv_location = remove_junk($db->escape($_POST['inventory-location']));
   $inv_tel = remove_junk($db->escape($_POST['inventory-telephone']));
 
   if(empty($errors)){
      $sql  = "INSERT INTO `inventory`( `inv_name`, `inv_location`,`inv_tel`)"; 
	       $sql.= " VALUES('{$inv_name}','{$inv_location}','{$inv_tel}')";
	     
      if($db->query($sql)){
        $session->msg("s",  "Successfully Added inventory");
        redirect('Warehouse_Details.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('Warehouse_Details.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('Warehouse_Details.php',false);
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
            <span>Add Warehouse</span>
         </strong>
        </div>
		
        <div class="panel-body">
		<div class="row">
		<div class="col-md-6">
          <form method="post" action="Warehouse_Details.php">
            <div class="form-group">
			 <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                <input type="text" class="form-control" name="inventory-name" placeholder="inventory Name"   Style="width:50%;">
            </div>
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
                    <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th-large"></i>
                      </span>
			<input type="text" class="form-control" name="inventory-location" placeholder="inventory location"  Style="width:50%;" >
			</div>
			</div>
			</div>
			
			
			<div class="col-md-6">
			<div class="form-group">
			
                    <div class="input-group">
			 <span class="input-group-addon">
                       <i class="glyphicon glyphicon-earphone"></i>
                      </span>
			
			<input type="text" class="form-control" name="inventory-telephone" placeholder="inventory Phone"  Style="width:50%;" onkeypress="return isNumberKey(event)"  maxlength="9"    >
			</div>
			</div>
			</div>
			</div>
			
			
            <button  type="submit" name="inve_name" class="btn btn-primary">Add inventory</button>
        </form>
        </div>
		
      </div>
    </div>
    <div class="col-md-10">
    <div class="panel panel-default">
      
        <div class="panel-heading clearfix">
         <div class="pull-left">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Warehouse_Details</span>
       </strong>
      </div>
	  
	  </div>
       <div class="panel-body">
	 
          <table class="table table-bordered"  >
            <thead>
              <tr>
			  
                <th class="text-center" >#</th>
                
                <th class="text-center" >inventory name </th>
                <th class="text-center" > inventory location</th>
                <th class="text-center"  > inventory phone  </th>
               
                
                <th class="text-center" > Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($inventory as $inv):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($inv['inv_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inv['inv_location']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inv['inv_tel']); ?></td>
				   <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_warehouse.php?id=<?php echo (int)$inv['inv_id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_warehouse.php?id=<?php echo (int)$inv['inv_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
           </div>
      </div>
    </div>
	</div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
