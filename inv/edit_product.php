<?php
  $page_title = 'Edit product';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product =find_by_id('products', (int)$_GET['id']);
 
$all_categories = find_all('categories');
$all_units = find_all('units');

$all_photo = find_all('media');
if (!$product) {
    $session->msg("d", "Missing product id.");
    redirect('product.php');
}
?>
<?php
 if (isset($_POST['product'])) {
     $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' ,'add-units','product-wieght',
             'manf-company','manf-country');
     validate_fields($req_fields);

     if (empty($errors)) {
         $p_name  = remove_junk($db->escape($_POST['product-title']));
         $p_cat   = (int)$_POST['product-categorie'];
         $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
         $p_buy   = remove_junk($db->escape($_POST['buying-price']));
         $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
         $p_date  = remove_junk($db->escape($_POST['prod-date']));
         $p_exp_date  = remove_junk($db->escape($_POST['exp-date']));
         $p_unit  = remove_junk($db->escape($_POST['add-units']));
         $p_wie  = remove_junk($db->escape($_POST['product-wieght']));
         $p_m_co = remove_junk($db->escape($_POST['manf-company']));
         $p_m_cu = remove_junk($db->escape($_POST['manf-country']));
          
          
          
       
         if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
             $media_id = '0';
         } else {
             $media_id = remove_junk($db->escape($_POST['product-photo']));
         }
         $query   = "UPDATE products SET name='{$p_name}', quantity ='{$p_qty}',buy_price ='{$p_buy}', sale_price ='{$p_sale}',categorie_id='{$p_cat}',media_id='{$media_id}',unit_id='{$p_unit}',product_wieght='{$p_wie}',manf_company='{$p_m_co}',manf_country='{$p_m_cu}'";
         $query  .=" WHERE id ='{$product['id']}'";
         $result = $db->query($query);
         if ($result && $db->affected_rows() === 1) {
             $session->msg('s', "Product updated ");
             redirect('product.php', false);
         } else {
             $session->msg('d', ' Sorry failed to updated!');
             redirect('edit_product.php?id='.$product['id'], false);
         }
     } else {
         $session->msg("d", $errors);
         redirect('edit_product.php?id='.$product['id'], false);
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
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Product</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-7">
          <form method="post"
            action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title"
                  value="<?php echo remove_junk($product['name']);?>">
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" name="product-categorie">
                    <option value=""> Select a categorie</option>
                    <?php  foreach ($all_categories as $cat): ?>
                    <option
                      value="<?php echo (int)$cat['id']; ?>"
                      <?php if ($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?>
                      >
                      <?php echo remove_junk($cat['name']); ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="product-photo">
                    <option value=""> No image</option>
                    <?php  foreach ($all_photo as $photo): ?>
                    <option
                      value="<?php echo (int)$photo['id'];?>"
                      <?php if ($product['media_id'] === $photo['id']): echo "selected"; endif; ?>
                      >
                      <?php echo $photo['file_name'] ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="product-quantity"
                        value="<?php echo remove_junk($product['quantity']); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Buying price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="buying-price"
                        value="<?php echo remove_junk($product['buy_price']);?>">
                      <span class="input-group-addon">.00</span>
                    </div>

                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Selling price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price"
                        value="<?php echo remove_junk($product['sale_price']);?>">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group" style="margin-left:14px;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group" id="d">
                      <span class="input-group-addon">
                      </span>
                      <input type="text" class="datepicker form-control" name="prod-date" placeholder="prod date">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group" id="d">
                      <span class="input-group-addon">

                      </span>
                      <input type="text" class="datepicker form-control" name="exp-date" placeholder="exp date">

                    </div>
                  </div>
				   <div class="col-md-4">
                  <select class="form-control" name="add-units">
                    <option value=""> Select unit</option>
                    <?php  foreach ($all_units as $u): ?>
                    <option
                      value="<?php echo (int)$u['unit_id']; ?>"
                      <?php if ($product['unit_id'] === $u['unit_id']): echo "selected"; endif; ?>
                      >
                      <?php echo remove_junk($u['name']); ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
				  
                  <div class="col-md-3">
                    <div class="input-group">

                      <input type="checkbox" id="check" name="checkbox" />

                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group" style="margin-left:15px;">
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
                      <input type="text" class="form-control" name="manf-country" placeholder="manf-country">

                    </div>
                  </div>
                </div>


              </div>
            </div>
            <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('../layouts/footer.php');
