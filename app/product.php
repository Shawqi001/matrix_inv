<?php
  $page_title = 'All Product';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
  $all_products = find_all('products');

 
  
?>

<?php
if(isset($_POST['submit_search'])){
	
	$searchq=$_POST['search'];
	$sql= "SELECT * FORM products WHERE  name LIKE '%name'";
	$sql=mysql_query($conn,$sql);
	
	if(mysql_num_rows($sql)< 1){
	   
	   echo "sorry  we dont found any result";
		
	}else{
		
		
		while($fetch=mysql_fetch_assoc($sql)){
			
			
			
			$id=$fetch['id'];
			$name=$fetch['name'];
			
			echo $id."-".$name."<br>";
			
		}
	}
}




?>

<?php include_once('../layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
		
		<div class="pull-right"   style="padding-right:10px;">
		<form action="../inv/product.php"  method="post">
		<input type=" text"   name="search"  placeholder="search"  dir="ltr">
		<Button  type="submit"   name="submit_search">search </Button>
		
		
		</form>
		</div>
         <div class="pull-left">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 9%;"> Categorie </th>
				
                <th class="text-center" style="width: 9%;"> Instock </th>
                <th class="text-center" style="width: 9%;"> Buying Price </th>
                <th class="text-center" style="width: 9%;"> Saleing Price </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
				
                <th class="text-center" style="width: 100px;"> Actions </th>
					
              </tr>
            </thead>
            <tbody>
			
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="<?php echo ROOT;?>/uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="<?php echo ROOT;?>/uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
			
                <td> <?php echo remove_junk($product['name']); ?></td>
				
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
				 
				
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
				 
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
			 
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
