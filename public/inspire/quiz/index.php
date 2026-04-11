<?php include_once '../post/connect.php';
$sql ="SELECT * FROM quiz_certificates WHERE flag=0 order by createdate desc limit 1";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);
// echo($sql);
$quizid = $rows["quizid"];
?>
<!DOCTYPE html>
<?php
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
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <title>INSPIRE_QUIZ</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	  
	<!-- Style-->  
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/cus.css">
	<link rel="stylesheet" href="assets/icons/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="assets/css/color_theme.css">
	
	<script src="http://code.jquery.com/jquery-1.5.js"></script>
	<script>
      function countChar(val) {
        var len = val.value.length;
        if (len > 75) {
          val.value = val.value.substring(0, 75);
        } else {
          $('#charNum').text(75 - len); 
        }
      };
	  function countChar1(val) {
        var len = val.value.length;
        if (len > 75) {
          val.value = val.value.substring(0, 75);
        } else {
          $('#charNum1').text(75 - len); 
        }
      };
    </script>
 

</head>
<body class="hold-transition light-skin sidebar-mini theme-primary">
	
	
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
					  <form onSubmit="javascript: alert('1) E-certificates will be generated for those who secure 40% and above.\n2) You can attempt this quiz only once.\n3) Wish you all the best.'); " action="quiz_main.php" method="POST" >
					<div class="box-header with-border">
					  <h4 class="box-title" style="text-align: center;">Inspire organized &quot; <?php echo($rows["quizname"])?> Assessment &quot;</h4><br>
					  <!--<h4 class="box-title" style="text-align: center;">Inspire organized assessment on &quot; English Made Easy Final Quiz &quot;</h4><br>-->
					  <p class="al">1) The questions are structured to evaluate your technical Skills.<br></p>
					  <!--<p class="al">-> The questions are structured to evaluate your English Language Skills.<br></p>-->

					  <p class="al">2) For any queries please contact: 8667493679/9360505768  | Mail: training@inspiress.in.<br></p>
					  <p class="al">3) Visit our website www.inspiress.in to know more about us.<br></p>
					  <p class="al">4) Attempt with full Concentration &amp; Enthusiasm.<br></p>
					  <p class="al">5) Below entered details will be taken for the certificate generation so carefully enter the details.<br></p>

					</div>

					<div class="box-body">
						<!--<div class="form-group">
							<label>First Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Frst name input field" name="fname1" required >
                        </div>-->
						<div class="form-group">
							<label>Enter your Name & Designation  (If individual just type your name alone)<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Ex: Dr. Karthiya Banu, Business Head" name="fname1" onkeypress="return blockSpecialChar(event)" onkeyup="countChar(this)" maxlength="75" required >
							<p style="text-align:right; font-size:10px;">You have left with <span id="charNum"> 75 </span> characters out of 75 characters</p>
						</div>

						

						<div class="form-group">
							<label>Enter Your Institution/Organization Name (If individual just  leave it blank)</label>
							<input type="text" class="form-control" placeholder="Ex: INSPIRE SOFTECH SOLUTIONS" name="inst" onkeypress="return blockSpecialChar(event)" onkeyup="countChar1(this)" maxlength="75" >
							<p style="text-align:right; font-size:10px;">You have left with <span id="charNum1"> 75 </span> characters out of 75 characters</p>
                        </div>

						<div class="form-group">
							<label>Email Id<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Mail ID input field" name="mailid" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" required >
						</div>

						<div class="form-group">
							<label>Whatsapp Number<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Whatsapp input field" pattern="[6-9]{1}[0-9]{9}" title="Please enter a valid 10-digit mobile number starting with 9, 8, 7, or 6." oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" name="whatsapp" required >
						</div>

						<div class="form-group">
							<label>City/District<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Place/District input field" onkeypress="return blockSpecialChar(event)" name="place" required >
						</div>

						<div class="form-group">
							<label>State<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="State input field" onkeypress="return blockSpecialChar(event)" name="state" required >
						</div>

						<div class="form-group">
							<label>Country<span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Country input field" onkeypress="return blockSpecialChar(event)" name="country" required >
						</div>

						<input type="text" class="form-control" placeholder="Country input field" name="quizid" value="<?php echo($rows["quizid"]) ?>" hidden >
						<input type="text" class="form-control" placeholder="Country input field" name="quizname" value="<?php echo($rows["quizname"]) ?>" hidden >
						                          
						<div class="box-footer text-right">
						<button type="submit" value="Submit" class="waves-effect waves-light btn btn-primary mb-5" style="border-radius: 3px;">Start Test</button>
						</div>
						
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
  <!-- /.content-wrapper -->
  <!-- <footer>
  
  <div class="container footerBot">
        <div class="row d-flex align-items-center"> 
            <p class="col-lg-12 order-lg-1 text-center ">&copy; 2020 by <a href="https://wikichennai.com/">wikichennai</a></p>                     
        </div>
	</div>
</footer> -->

	
</body>

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
</html>
<script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 63 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }

		
  </script>