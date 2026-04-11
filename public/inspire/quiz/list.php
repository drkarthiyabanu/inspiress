<!DOCTYPE html>
<?php include_once 'connect.php';?>
<?php
$sql ="SELECT * FROM quiz_record ";
$result=$conn->query($sql);
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

    <title>QUIZ_List</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	  
	<!-- Style-->  
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/cus.css">
	<link rel="stylesheet" href="assets/icons/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="assets/css/color_theme.css">

  
	


</head>
<body class="hold-transition light-skin sidebar-mini theme-primary">
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
	
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
                <section class="content">

<div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-body">
          <div class="table-responsive">
              <table id="empTable" class="table table-hover no-wrap product-order" data-page-size="10">
                  <thead>
                      <tr>
                           <th>ID</th>
                           <th>NAME</th>
                           <th>MAIL ID</th>
                           <th>MARK</th>
                           <th class="noExport"> </th>
                           <th class="noExport">CERTIFICATE</th>
                           <th>WHATSAPP</th>
                           <th>EDUCATION</th>
                           <th>INSTITUTION</th>
                           <th>STATE</th>

                           
                      </tr>
                  </thead>
                          <?php
while($rows=mysqli_fetch_array($result))
{
?> 
                
                  <tbody>
                      <tr>
                          <td><?php echo $rows['id'];?></td>
                          <td><?php $fname1 = str_replace(' ', '_', $rows['fname']); echo $fname1 ?></td>
                          <td><?php echo $rows['mailid']?></td>
                          <td><?php echo $rows['mark']?></td>
                          <td class="noExport"><a href="certificate?id=<?php echo $rows['id']; ?>"><i class="ti-download"></i></a></td> 
                          <td class="noExport"><?php echo $rows['down']?></td>
                          <td><?php echo $rows['whatsapp']?></td>
                          <td><?php echo $rows['category']?></td>
                          <td><?php echo $rows['institution']?></td>
                          <td><?php echo $rows['state']?></td>
                      </tr>

                  </tbody>	
                  <?php
}
$conn->close();
?>
  
              </table>
          </div>
        </div>
      </div>
    </div>		  
</div>


<div class="text-right">
  <button  id="export"  class="waves-effect waves-light btn btn-primary mb-5" style="border-radius: 3px;"> Export</button>
  <a  href="truncate"  class="waves-effect waves-light btn btn-primary mb-5" style="border-radius: 3px;"> Turncate</a>
          </div>

</section>
<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <footer>
  
  <div class="container footerBot">
        <div class="row d-flex align-items-center"> 
            <p class="col-lg-12 order-lg-1 text-center ">&copy; 2020 by <a href="https://wikichennai.com/">wikichennai</a></p>                     
        </div>
	</div>
</footer>

<script>
$(document).ready(function() {
    $('#export').on('click', function(e){
        $("#empTable").table2excel({
            exclude: ".noExport",
            name: "Data",
            filename: "Workbook",
        });
    });        
});
</script>
	
</body>



<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
</html>
