<?php
  $page_title = 'All Product';
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
		
		<div class="pull-right"   style="padding-right:10px;">
    </div>
    <script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>
         <div class="pull-left">
           <button onclick="printDiv('prit_all_products')">Print List for all products</button>
         </div>
        </div>

        <div class="panel-body">
        <div id="prit_all_products">
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
              </tr>
             <?php endforeach; ?>
			 
            </tbody>
          </tabel>
        </div>
                  
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
