<?php
  $page_title = 'All Product';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
  $all_categories = find_all('categorie')
  
?>
 <?php
    $search_result ="";


if(isset($_GET['valueToSearch']))
{
  $valueToSearch=$_GET['valueToSearch'];
  $products = join_product_table_with_filter($valueToSearch);
     
    
}
 
// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "matrix", "", "");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
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
		
		<div class="pull-right"  >
		
		 <form method="GET" action="product.php" autocomplete="off" id="">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="valueToSearch"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
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
					
					 <a href="more_datiles.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="more_datiles" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-pushpin"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
			  <tr>
	
            </tbody>
         
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>

  