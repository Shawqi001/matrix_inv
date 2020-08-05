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
          </strong>
          <div class="pull-right">
            <a href="add_supplier.php" class="btn btn-primary">Add supplier</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
               
           <th>name </th>
                <th class="text-center" style="width: 15%;"> account name</th>
                <th class="text-center" style="width: 15%;"> account number </th>
                <th class="text-center" style="width: 15%;">supplier number  </th>
				<th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
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
               <td class="text-center">
                  <div class="btn-group">
                     <a href="../app/edit_supplier.php?id=<?php echo (int)$supplier['sup_id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <!--a href="../app/delete_supplier.php?id=<?php echo (int)$supplier['sup_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span-->
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('../layouts/footer.php'); ?>
