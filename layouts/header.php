<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
	 
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Simple inventory System";?>
    </title>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="<?php echo ROOT;?>/libs/bootstrap/css/bootstrap.min.css"/>
	
  <!--  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />-->
    <link rel="stylesheet" href="<?php echo ROOT;?>/libs/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo ROOT;?>/libs/css/main.css" />
	<link rel="stylesheet" href="<?php echo ROOT;?>/libs/css/bootstrap.min2.css">
  <script src="<?php echo ROOT;?>/libs/js/jquery.min.js"></script>


	 
	

	<head>
<script type="application/javascript">

  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

	</script>
	
	<script>
	$(function () {
    $('div[id="d"]').hide();

    //show it when the checkbox is clicked
    $('#check').on('click', function () {
        if ($(this).prop('checked')) {
            $('div[id="d"]').fadeIn();
        } else {
            $('div[id="d"]').hide();
        }
    });
});
	</script>
	
  </head>
  <body>

  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left"><img src="../img/logo3.png" alt="Matrix-Inv" style="width:180px;height:60px;"></div>
      <div class="header-content">
      <div class="header-date pull-left">
        <strong><?php echo date("F j, Y, g:i a");?></strong>
      </div>

      <!--lang icon-->


      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="<?php echo ROOT;?>/uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Profile
                  </a>
              </li>
             <li>
                 <a href="../app/edit_account.php" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Settings
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Logout
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('user_menu.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
