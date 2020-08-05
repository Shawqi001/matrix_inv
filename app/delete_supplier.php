<?php
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
 $suppliers = find_sup_by_id('suppliers',(int)$_GET['id']);
  if(!$suppliers){
    $session->msg("d","Missing suplierid.");
    redirect('supplier.php');
  }
?>
<?php
  $delete_id = delete_sup_by_id('supplier',(int)$supplier['id']);
  if($delete_id){
      $session->msg("s","supplier deleted.");
      redirect('supllier.php');
  } else {
      $session->msg("d","supplier deletion failed.");
      redirect('supplier.php');
  }
?>
