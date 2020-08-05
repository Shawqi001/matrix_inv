<?php
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $products= find_by_id('product',(int)$_GET['id']);
  if(!$products){
    $session->msg("d","Missing Product id.");
    redirect('product.php');
  }
?>
<?php
  $delete_id=delete_by_id('product',(int)$products['id']);
  if($delete_id){
      $session->msg("s","Product deleted.");
      redirect('product.php');
  } else {
      $session->msg("d","Products deletion failed.");
      redirect('product.php');
  }
?>
