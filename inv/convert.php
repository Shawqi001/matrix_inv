<?php
  $page_title = 'All stock_convert';
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$stock_convert= find_all_stock();
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
          <span>All convert</span>
        </strong>
        <div class="pull-right">
          <a href="stock_convert.php" class="btn btn-primary">Add Convert</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Product name </th>
              <th class="text-center" style="width: 15%;"> Quantity</th>
              <th class="text-center" style="width: 15%;"> Total </th>
              <th class="text-center" style="width: 15%;"> Date </th>
              <th class="text-center" style="width: 100px;"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stock_convert as $stock):?>
            <tr>
              <td class="text-center"><?php echo count_id();?>
              </td>
              <td><?php echo remove_junk($stock['name']); ?>
              </td>
              <td class="text-center"><?php echo (int)$stock['qty']; ?>
              </td>
              <td class="text-center"><?php echo remove_junk($stock['price']); ?>
              </td>
              <td class="text-center"><?php echo $stock['date']; ?>
              </td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_sale.php?id=<?php echo (int)$stock['id'];?>"
                    class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_sale.php?id=<?php echo (int)$stock['id'];?>"
                    class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash"></span>
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
<?php include_once('../layouts/footer.php');
