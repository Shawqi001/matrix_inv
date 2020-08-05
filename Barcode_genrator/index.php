<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Barcode Generator Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../libs/css/bootstrap.min.css">
  <script src="../libs/js/jquery.min.js"></script>
  <script src="../libs/js/bootstrap.min.js"></script>
</head>
<body style="  background-color:#c9e7f4 ;">

<div class="container">
  <div style="margin: 10%;">
  	<h2 class="text-center">Matrix BARCODE Printing</h2>
  	<form class="form-horizontal" method="post" action="barcode.php" target="_blank">
  	<div class="form-group">
      <label class="control-label col-sm-2" for="product">Product Name:</label>
      <div class="col-sm-10">
        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="product_id">Product ID:</label>
      <div class="col-sm-10">
        <input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="rate">Price</label>
      <div class="col-sm-10">          
        <input autocomplete="OFF" type="text" class="form-control" id="rate"  name="rate" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="print_qty">Barcode Quantity</label>
      <div class="col-sm-10">          
        <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty"  name="print_qty" required="">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Print</button>
      
        <button onclick="goBack()" class="btn btn-default">Back To Home</button >

<script>
function goBack() {
  window.history.back();
}
</script>
      
    </div>
  </form>
  </div>
</div>

</body>
</html>
