<?php
  $page_title = 'Add Sale';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>

?>
<?php include_once('../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>اوامر الشراء</span>
       </strong>
	   
      </div>
	  <div class="panel-body">
	  <div class= "row"  >
         <div class="col-md-3">
	  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="رقم الامر  ">
               </div>
              </div>
              
			  </div>
			  
			   <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder=" رقم طلب الشراء"    maxlength="10">
               </div>
              </div>
			  
			  
			   <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="رقم المورد "  maxlength="10">
               </div>
			   
              </div>
			  
			  
			  
                
            </div>
			 <div class="form-group">
			 <div class= "row"  >
			   <div class="col-md-3">
			<select class="form-control" name="Store number">
                      <option value="">رقم المخزن</option>
                    <?php  foreach ($all_inventory as $inv): ?>
                      <option value="<?php echo (int)$inv['inv_id'] ?>">
                        <?php echo $inv['inv_id'] ?></option>
                    <?php endforeach; ?>
                    </select>
					 
			   </div>
			   
			   
			   <div class="col-md-3">
			 <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="مركز التكلفة">
               </div>
			   </div>
			   
			  <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="datepicker form-control" name="product-title" placeholder="تاريخ طلب الشراء "  maxlength="10">
               </div>
			   
              </div>
              </div>
 			 
			 
			 
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
	   <th  style="width:15%;">price</th>
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
   html +=  '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
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
</div>	
 </div>
<?php include"../layouts/footer.php"; ?>