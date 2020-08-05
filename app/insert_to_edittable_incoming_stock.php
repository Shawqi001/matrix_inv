<?php
if(isset($_POST["item_name"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=matrix", "root", "");
 $order_id = uniqid();
 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {  
  $query = "INSERT INTO products 
  (id, name, item_quantity, unit_id) 
  VALUES (:id, : name, :item_quantity, :unit_id)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':id'   => $id,
    ':name'  => $_POST["name"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':unit_id'  => $_POST["unit_id"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>


