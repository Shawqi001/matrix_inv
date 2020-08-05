<?php
  $page_title = 'All Product';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_products_table();
  $all_products= find_all('product')
  
  
   
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
		<form action="product.php"  method="post">
		<input type=" text"   name="search"  placeholder="search">
		<Button  type="submit"   name="submit_search">search </Button>
		
		
		</form>
		</div>
         
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 5px;">#</th>
     
				<th class="text-center"  style="width: 10%;" > Product Title</th>
                <th class="text-center"  style="width: 11%;" >Units</th>
                <th class="text-center" style="width: 10%;"> manf Company </th>
				
                <th class="text-center" style="width: 10%;"> manf country  </th>
                <th class="text-center" style="width: 12%;"> production date </th>
                <th class="text-center" style="width: 11%;"> Expration date </th>
              
				
                <th class="text-center" style="width: 10px;">product wieght	 </th>
					
              </tr>
            </thead>
            <tbody>
			
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
				
                <td>
                  <?php echo remove_junk($product['name']); ?>
                </td>
			
                <td class="text-center"> <?php echo remove_junk($product['unit_id']); ?>  </td>
				<td class="text-center"> <?php echo remove_junk($product['manf_company']); ?>  </td>
                <td class="text-center"> <?php echo remove_junk($product['manf_country']); ?></td>
                <td class="text-center"> <?php  echo remove_junk($product['date_prod']); ?></td>
                <td class="text-center"> <?php  echo remove_junk($product['date_exp']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['product_wieght']); ?></td>
				 
				
               
               
              </tr>
             <?php endforeach; ?>
			 
            </tbody>
          
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
