<?php
  $page_title = 'All Group';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('../layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading clearfix">
          <strong>
		  
		  
            <span class="glyphicon glyphicon-th"></span>
            <span>The Dtelies</span>
            <br><br>
            <a href="add_product.php" class="btn btn-primary">Add New</a>
          </strong>
		  
		  <br><br>
		  
		  <nav class="navbar navbar-default">
  <div class="container-fluid">
 
    </div>
    <ul class="nav navbar-nav">
      <li class="active"> <a href="../app/Categorie_data.php">Directory of items</a></li>
      <li class="active" ><a href="the_details_cat.php">The Details</a></li>
      <li><a href="#">Inventory</a></li>
      <li><a href="#">Costs and prices</a></li>
	   <li><a href="#">Suppliers</a></li>
	   <li><a href="#">Statistical reports</a></li>
	   
    </ul>
	
        </div>
		
		
		<div class="panel-body">
		  
<form>
  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  
  <input type="checkbox" name="vehicle1" value="Bike"> I have a bike<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a carb<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
   <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
    <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
	 <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
	  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
	   <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
	    <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
		 <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
		  <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
		   <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
		    <input type="checkbox" name="vehicle2" value="Car"> I have a car<br>
</form>
		  
		  
		  </div>
</div>
</div>











        </div>
        
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
