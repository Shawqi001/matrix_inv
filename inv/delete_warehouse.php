<?php
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $inventory = find_inv_by_id('inventory',(int)$_GET['id']);
  if(!$inventory){
    $session->msg("d","inventory id.");
    redirect('Warehouse_Details.php');
  }
?>
<?php
  $delete_id = delete_inv_by_id('inventory',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","inventory deleted.");
      redirect('Warehouse_Details.php');
  } else {
      $session->msg("d","inventory deletion failed.");
      redirect('Warehouse_Details.php');
  }
?>
