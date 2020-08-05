	<?php
  $page_title = 'Add Product';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  
   $all_shelfs = find_all('shelfs');
   $all_units = find_all('units');
   ?>
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','buying-price','saleing-price' ,'add-units','product-wieght',
   'manf-company','manf-country','manf-country');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
	 $p_prod_date= remove_junk($db->escape($_POST['prod-date']));
	 $p_exp_date= remove_junk($db->escape($_POST['exp-date']));
	 $unit=remove_junk($db->escape($_POST['add-units']));
	 
	  $p_wi=remove_junk($db->escape($_POST['product-wieght']));
	   $p_manf=remove_junk($db->escape($_POST['manf-company']));
	    $p_mc=remove_junk($db->escape($_POST['manf-country']));
		
	
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date  = make_date();
     $query  = "INSERT INTO products(";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date ";
    if(!empty($_POST['has_expiration_date'])){
      $query .= ",date_prod ,date_exp";
    }

     $query.=",inv_id,unit_id ,product_wieght,manf_company,manf_country  ";
     $query .=") VALUES (";
     $query .=" '{$p_name}','{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', ";
     if(!empty($_POST['has_expiration_date'])){

     $query .="'{$date}', '{$p_prod_date}' ,";
     }
     $query .=" '{$p_exp_date}','1','{$unit}','{$p_wi}','{$p_manf}','{$p_mc}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
		<div class="row">
         <div class="col-md-4">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title"  >
               </div>
              </div>
              </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Product Photo</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
			
              
<!-- add morre details -->

<!-- /add morre details -->
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
			  
				 </div>
				 
				 <div class="form-group"  style="margin-left:14px;">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group"  id="d" >
                     <span class="input-group-addon">
                      </span>
                     <input type="text" class="datepicker form-control" name="prod-date"  placeholder="prod date" >
                  </div>
                 </div>
				  
				 <div class="col-md-4">
                   <div class="input-group"   id="d">
                     <span class="input-group-addon">
                      
                     </span>
                     <input type="text" class="datepicker form-control" name="exp-date" placeholder="exp date"   >

                  </div>
                 </div>
				 <div class="col-md-4"  >
         <select class="form-control" name="add-units">
                      <option value="">Select units</option>
                    <?php  foreach ($all_units as $u): ?>
                      <option value="<?php echo (int)$u['unit_id'] ?>">
                        <?php echo $u['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
           
				 <div class="col-md-3">
                   <div class="input-group">
                     
                      <input type="checkbox"   id="check"    name="has_expiration_date"/>

                  </div>
                 </div>
				 </div>
				 </div>
				  <div class="form-group"  style="margin-left:15px;">
				  <div class="row">
				  <div class="col-md-4">
		  <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="number" class="form-control" name="product-wieght" placeholder="product wieght">
				  <span class="input-group-addon">.00</span>
               </div>
         </div>
		 
		 
		 
		 <div class="col-md-4">
		  <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="manf-company" placeholder="manf-company">
				 
               </div>
         </div>
		
             <div class="col-md-4">
		      <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="manf-country" placeholder="manf-country" style="width:190px;">
				 
               </div>
         </div>		
		 </div>
				 
				 
				   </div>
				 <div class="form-group" style="margin-top:15px;    padding-left:15px;"> 
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="add-blocks'">
                      <option value="">Select shelfs </option>
                    <?php  foreach ($all_shelfs as $sh): ?>
                      <option value="<?php echo (int)$sh['id_shelf'] ?>">
                        <?php echo $sh['shelf_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
				
				
				 </div>
				
				 </div>
				
				 
				 </div>
              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
		 
        </div>
      </div>
    </div>
  </div>

<?php include_once('../layouts/footer.php'); ?>
