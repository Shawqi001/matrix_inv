<?php
  $page_title = 'Add shelfs';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $Shelfs = find_all('Shelfs');
  $blocks = find_all('blocks');
 
?>
<?php
 if(isset($_POST['add_shelf'])){
   $req_fields = array('shelf_name','shelf_number','block_name','block_number');
   validate_fields($req_fields);
  
     $s_name = remove_junk($db->escape($_POST['shelf_name']));
     $s_num  = remove_junk($db->escape($_POST['shelf_number']));
	   $b_name  = remove_junk($db->escape($_POST['block_name']));
	     $b_number  = remove_junk($db->escape($_POST['block_number']));
	 
	 
      if(empty($errors)){
     
   $sql  = "INSERT INTO `shelfs`(`shelf_name`,`shelf_number` ,`block_name` ,`block_number`)"; 
	  $sql.= " VALUES('{$s_name}','{$s_num}','{$b_name}','{$b_number }')";
     
	 
     if($db->query($sql)){
       $session->msg('s',"shelf added ");
       redirect('shelves_details.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('shelves_detailst.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('shelves_details.php',false);
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
            <span>Add New Shelf And Blocks</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-4">
          <form method="post" action="shelves_details.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
				   
                  </span>
				  
				  
                  <input type="text" class="form-control" name="shelf_name" placeholder="new shelf">
				 
               </div>
			    </div>
			   <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				  
			    <input type="text" class="form-control" name="shelf_number" placeholder="number shelf">
              </div>
			 
			 
             
                  </div>
				  
				  
				  <div class="row">
  <div class="col-md-4">
				  <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				 
			    <input type="text" class="form-control" name="block_name" placeholder="block name">
              </div>
                 </div>
				 
				 
				 <div class="col-md-4"  style="margin-top:10px;">
				  <div class="input-group">
			   <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
				 
			    <input type="text" class="form-control" name="block_number" placeholder="block number">
              </div>
                 </div>
				 </div>
<!-- add morre details -->

<!-- /add morre details -->
              
               </div>
              </div>
              <button type="submit" name="add_shelf" class="btn btn-danger">Add Shelf</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('../layouts/footer.php'); ?>
