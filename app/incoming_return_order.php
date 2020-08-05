
   
  <?php
  $page_title = 'All incoming return stock';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_inventory = find_all('inventory');
  $shelfs = find_all('shelfs')
?>
      	
	<?php
 if(isset($_POST['add_shelf'])){
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
?>	
<?php include_once('../layouts/header.php'); ?>
		<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Incoming Rturn Order</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-3">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                      
                     <div class="input-group">
                  
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="text" class="datepicker form-control" name="end-date" placeholder="Date	 ">
                </div>
				
				 </div>
			  
			  </div>
			  
			   <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder=" Account Number">
               </div>
              </div>
			  
			  
			   <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Account name ">
               </div>
              </div>
                
             </div>
			
<!-- add morre details -->

<!-- /add morre details -->
              <div class="form-group">
               <div class="row"  style="padding-left:28px;">
                 <div class="col-md-4">
                   
                      <select class="form-control" name="Store number">
                      <option value="">Store number</option>
                    <?php  foreach ($all_inventory as $inv): ?>
                      <option value="<?php echo (int)$inv['inv_id'] ?>">
                        <?php echo $inv['inv_id'] ?></option>
                    <?php endforeach; ?>
                    </select>
					 
                 
                 </div>
                 <div class="col-md-4">
                   
                     <select class="form-control" name="Store number">
                      <option value="">Supply number</option>
                    <?php  foreach ($all_inventory as $inv): ?>
                      <option value="<?php echo (int)$inv['inv_id'] ?>">
                        <?php echo $inv['inv_id'] ?></option>
                    <?php endforeach; ?>
                    </select>
					 
                     
                 
                 </div>
			
                 
				  
				  </div>
				  <div class="form-group">
				  <div class="row" style="padding-left:28px;  padding-top:28px; " >
				  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Supply number">
               </div>
              </div>
			  
			  
			  
			  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Cost of supply order">
               </div>
              </div>
			  
			  
			  			  
			  <div class="col-md-3" >
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Cost Center ">
               </div>
              </div>
			  
			  </div>
			  
			  
			  
			  
			                <div class="form-group">
			  <div class="row"   style="padding-left:28px;  padding-top:15px;">
			  <div class="col-md-3" >
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="textarea" class="form-control" name="product-title" placeholder="statment ">
				  
				  
               </div>
              </div>
			
             </div>
            </div>
				
          </form>
		  </div>
		  <?php
$connect = new PDO("mysql:host=localhost;dbname=matrix", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM products ORDER BY name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
 }
 return $output;
}

?>

  
  <div class="row">
  <div class="col-md-4">
  <div class="container">
  
   <form method="post" id="insert_form">
    <div class="table-repsonsive"  style="width:69%;">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th  style="width:15%;">catgories number</th>
       <th  style="width:15%;">catgories name</th>
	   <th  style="width:15%;"> Unit</th>
	   <th  style="width:15%;">amunt</th>
	   <th  style="width:15%;">price Unit</th>
	   	   <th  style="width:15%;">Totla</th>
	   
       <th> <button  type="button"  name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
  </div>
  </div>
  </div>
   </body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
   html += '<td><select name="name[]" class="form-control name"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
   html += '<td><select name="name[]" class="form-control name"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><select name="unit_id[]" class="form-control id"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
    html += '<td><select name="id[]" class="form-control id"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
   html += '<td><select name="id[]" class="form-control id"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
   html += '<td><select name="id[]" class="form-control id"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 
});
</script>
		  </div>
         </div>
       </div>
     
    
  

    <?php include_once('../layouts/footer.php'); ?>