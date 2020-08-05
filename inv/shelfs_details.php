<?php
  $page_title = 'Add shelfs';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);

$shelfs= find_all('shelf')
 
?>
<?php
 if(isset($_POST['add_shelf'])){
   $req_fields = array('shelf_name','shelf_number');
   validate_fields($req_fields);
  
     $s_name = remove_junk($db->escape($_POST['shelf_name']));
     $s_num  = remove_junk($db->escape($_POST['shelf_number']));
	  
	 
      if(empty($errors)){
     
	 $sql  = "INSERT INTO `shelfs`( `shelf_name`, `shelf_number`,`id_block`)"; 
	       $sql.= " VALUES('{$s_name}','{$s_num}','1')";
	      
     if($db->query($sql)){
       $session->msg('s',"shelf added ");
       redirect('shelfs_details.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('shelfs_details.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('shelfs_details.php',false);
   }

 }

?>

<?php   
 if(isset($_POST['add_block'])){
   $req_fields = array('block_name','block_number');
   validate_fields($req_fields);
  
     $b_name = remove_junk($db->escape($_POST['block_name']));
     $b_num  = remove_junk($db->escape($_POST['block_number']));
	 
	 
	 if(empty($errors)){
     
   $sql  = "INSERT INTO `blocks`(`block_name`,`block_number` )"; 
	  $sql.= " VALUES('{$b_name}','{$b_num}')";
     
	 
     if($db->query($sql)){
       $session->msg('s',"blocks added ");
       redirect('shelfs_details.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('shelfs_details.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('shelfs_details.php',false);
   }

 }



?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Shelf </span>
         </strong>
        </div>
		
        <div class="panel-body">
         <div class="col-md-4">
          <form method="post" action="shelfs_details.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
				   
                  </span>
				  
				  
                  <input type="text" class="form-control" name="shelf_name" placeholder="new shelf"  >
				 
               </div>
			    </div>
				                  </div>
								  
					 <div class="col-md-4">			  
			   <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				  
			    <input type="text" class="form-control" name="shelf_number" placeholder="number shelf">
              </div>
			 </div>
			 
             

				  
				  
<!-- add morre details -->

<!-- /add morre details -->
              
               </div>

              <button type="submit" name="add_shelf" class="btn btn-danger">Add Shelf</button>
          </form>
         </div>
		            </div>
        </div>
		
		
		
		
		
		
		<div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
	   <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Blocks</span>
         </strong>
        </div>
     
	  
	  
	   <div class="panel-body">
				  <div class="row">
  <div class="col-md-4">
  <form method="post" action="shelfs_details.php" class="clearfix">
				  <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				 
			    <input type="text" class="form-control" name="block_name" placeholder="block name"  >
              </div>
                 </div>
				 
				 
				 <div class="col-md-4"  >
				  <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				 
			    <input type="text" class="form-control" name="block_number" placeholder="block number">
              </div>
                 </div>
				 </div>
    </div>
 
  <button type="submit" name="add_block" class="btn btn-danger">Add blocks</button>
   </div>
  </form>
  
  </div>
  </div>

<?php include_once('../layouts/footer.php'); ?>
