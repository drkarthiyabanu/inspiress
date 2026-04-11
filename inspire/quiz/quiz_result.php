<!DOCTYPE html>
<?php include_once 'connect.php';?>
<?php
$id = $_GET['id'];
$sql ="SELECT * FROM quiz_record WHERE id='$id'";
// echo($sql);
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);
// $res=mysqli_query($conn,$sql);
// $row = mysqli_fetch_assoc($res);	
// $cpath= $rows['cpath'];
// echo($cpath);
// $certificateid= $row['certificateid'];

?>
<html lang="en">

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/browser/logo.ico">

    <title>INSPIRE_QUIZ</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	  
	<!-- Style-->  
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/cus.css">
	<link rel="stylesheet" href="assets/icons/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="assets/css/color_theme.css">
	

  <!--script type='text/javascript'-->
<!-- 
(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  

    else
      localStorage.removeItem( 'firstLoad' );
  }
})();
-->
<!--/script-->
<script language ="javascript" >
  var marks="<?php echo $rows['mark']; ?>"
  var mail= "<?php echo $rows['mailid']; ?>"
  var fname = "<?php echo $rows['name']; ?>"
  function f1() {
    if(marks>40)
     // document.getElementById("showtime").innerHTML = "Congratulation " +fname +" " +lname+" ! \n<br>E-certificate has been successfully sent to your mail id - "+mail;
      document.getElementById("showtime").innerHTML = "Congratulation " +fname+ " ! \n<br>E-certificate has been successfully sent to your mail id - "+mail;

  else
  document.getElementById("showtime").innerHTML = "You have scored less the minimum criteria. <br>Better luck next time !";
  }
    </script>


</head>
<!-- body class="hold-transition light-skin sidebar-mini theme-primary" onload="window.location.reload()">-->
	<body class="hold-transition light-skin sidebar-mini theme-primary" onload="f1()">
	
<div class="wrapper">

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper leff">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="display: flex; justify-content: center;">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
                    <div class="logo-lg">
					<a href="index"class="cl1" ><img src="images/logo.png"   class="logo-img" alt="logo"></a>
                        <!--<span class="dark-logo"><img src="../images/logo-light-text.png" alt="logo"></span>-->
                    </div>
					<!--<h3 class="page-title">General Form Elements</h3>-->
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content" style="margin-top:20px">
			<div class="row">
				<div class="col-12">
				  <div class="box">
					  <form>
					<div class="box-header with-border">
          <h4 class="box-title" style="text-align: center; font-size: initial;">Thank you for connecting us. For any queries reach us: 8667493679 / 9840773715.<br> <br>Visit our website <a href="www.inspiress.in">www.inspiress.in</a></h4><br>
					  <h4 class="box-title" style="text-align: center;">YOUR SCORE :  <?php echo $rows['mark']; ?>%</h4>
					</div>              
          <div class="box-header with-border">
					  <div id="showtime" style="text-align: center; font-weight: bold;" ></div>
					</div>       		
				
				</form>
			</div>
			  <!-- /.box -->

		  </div>
		  <!-- /.row -->

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper 
  <footer>
  
  <div class="container footerBot">
        <div class="row d-flex align-items-center"> 
            <p class="col-lg-12 order-lg-1 text-center ">&copy; 2020 by <a href="https://wikichennai.com/">wikichennai</a></p>                     
        </div>
	</div>
</footer>-->
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>

<!--===============================================================================================-->

</body>

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
</html>
