<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) {
      redirect('index.php', false);
  }
?>

<?php
 // Auto suggetion
    $html = '';
   if (isset($_POST['product_name']) && strlen($_POST['product_name'])) {
       $products = find_product_by_title($_POST['product_name']);
       if ($products) {
           foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
           endforeach;
       } else {
           $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
           $html .= 'Not found';
           $html .= "</li>";
       }

       echo json_encode($html);
   }
 ?>
<?php
 // find all product
  if (isset($_POST['p_name']) && strlen($_POST['p_name'])) {
      $product_title = remove_junk($db->escape($_POST['p_name']));
      if ($results = find_all_product_info_by_title($product_title)) {
          foreach ($results as $result) {
              $html .= "<tr>";

              $html .= "<td id=\"st_name\">".$result['name']."</td>";
              $html .= "<input type=\"hidden\" name=\"st_id\" value=\"{$result['id']}\">";
              $html .= "<input type=\"hidden\" name=\"st_inv_id\" value=\"{$result['inv_id']}\">";
        
              $html .= "<td id=\"st_qty\">";
              $html .= "<input type=\"text\" class=\"form-control\" name=\"quantity\" value=\"1\">";
              $html  .= "</td>";
              $html  .= "<td>";
              $html  .= "<button type=\"submit\" name=\"add_convert\" class=\"btn btn-primary\">Add covert</button>";
              $html  .= "</td>";
              $html  .= "</tr>";
          }
      } else {
          $html ='<tr><td>product name not resgister in database</td></tr>';
      }

      echo json_encode($html);
  }
