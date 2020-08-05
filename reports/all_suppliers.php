<?php
  $page_title = 'All suppliers';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
   $suppliers = join_supplier_table();
	$all_supliers =find_all('supplier')
?>

<?php include_once('../layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All supplier</span>
            <button onclick="printDiv('prit_all_products')">Print List for all Suppliers</button>
          </strong>
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
        <div class="panel-body">
        <div id="prit_all_products">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
               
           <th>name </th>
                <th class="text-center" style="width: 15%;"> account name</th>
                <th class="text-center" style="width: 15%;"> account number </th>
                <th class="text-center" style="width: 15%;">supplier number  </th>
				<th class="text-center" style="width: 15%;"> Date </th>
             </tr>
            </thead>
           <tbody>
		  
             <?php foreach($suppliers as $supplier):?>
			  <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($supplier['sup_name']); ?></td>
               <td class="text-center"><?php echo remove_junk($supplier['account_name']); ?></td>
               <td class="text-center"><?php echo remove_junk($supplier['account_number']); ?></td>
			    <td class="text-center"><?php echo remove_junk($supplier['supplier_number']); ?></td>
               <td class="text-center"><?php echo read_date($supplier['date']); ?></td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
         </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once('../layouts/footer.php'); ?>
