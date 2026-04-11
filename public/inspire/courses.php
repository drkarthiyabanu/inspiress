<?php include_once 'post/connect.php';?>
<?php

$sql ="SELECT * FROM inspire_courselist WHERE delete_flag=0 order by pin desc, course_id desc";
$result=$conn->query($sql);
$number_of_results = mysqli_num_rows($result);

while($rows1=mysqli_fetch_array($result))
{
  $sdate11= str_replace('/', '-', $rows1['sdate']);
  $sdate1 = date('d-M-Y',strtotime(str_replace('/', '-', $rows1['sdate']))); 
  $edate1 = date('d-M-Y',strtotime(str_replace('/', '-', $rows1['edate']))); 
  $status1 = $rows1['status'];
  $current_date1 = date("d-m-Y");
  $date_diff1 = date_diff(date_create($current_date1),date_create($sdate11));
  $date_diff1 = $date_diff1->format('%R%a');
  
  if($date_diff1<0)
  {
    $id1 = $rows1['course_id'];
    $sql1 ="UPDATE inspire_courselist SET param1='1' WHERE course_id ='$id1'";
    $result1=$conn->query($sql1);
  }
}

$sql ="SELECT * FROM inspire_courselist WHERE delete_flag=0 order by param1 asc, pin desc, course_id desc";
$result=$conn->query($sql);
//echo($sql);

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <style type="text/css">
    .img-padding {
        padding: 10px 10px 0px 10px !important;
      }
    .card-title{
        text-align: center !important;
        margin-bottom:1.25rem !important;
        font-size: 15px !important;
    }
    .card-title a{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        --chakra-line-clamp: 2;
        min-height: 36px;
        margin-top: 5px;
        margin-bottom: 5px;
        font-size: 15px;
        /* font-weight: 600;   */
    }
    .css-1pdh09u {
    display: inline-flex;
    vertical-align: top;
    -webkit-box-align: center;
    align-items: center;
    max-width: 100%;
    font-weight: var(--chakra-fontWeights-normal);
    line-height: 1.2;
    outline: transparent solid 2px;
    outline-offset: 2px;
    min-height: 1.25rem;
    min-width: 1.25rem;
    font-size: var(--chakra-fontSizes-xs);
    padding-inline-start: var(--chakra-space-2);
    padding-inline-end: var(--chakra-space-2);
    border-radius: 3px;
    background: rgb(255, 217, 140);
    color: var(--chakra-colors-gray-800);
    margin-bottom: 15px !important;
    }
    .card-text-info{
        font-size: 10px !important;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .card-text{
        font-size: 12px !important;
        margin-bottom: 5px !important;
    }
    .btn-know{
        background: #ffa500;
        margin-top: 15px;
        height: 30px;
        font-size: 14px;
        margin-top: 0px !important;
        color:white;
    }
    /* common */
    .ribbon {
    width: 110px;
    height: 110px;
    overflow: hidden;
    position: absolute;
    }
    .ribbon::before,
    .ribbon::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #2980b9;
    }
    .ribbon.Closing::before,
    .ribbon.Closing::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #e5b116;
    }
    .ribbon.Expired::before,
    .ribbon.Expired::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #b6444f;
    }
    .ribbon.Registration-Closed::before,
    .ribbon.Registration-Closed::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #b6444f;
    }
    .ribbon span {
    position: absolute;
    display: block;
    width: 225px;
    padding: 5px 0;
    background-color: #3498db;
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
    color: #fff;
    font: 700 18px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0,0,0,.2);
    text-transform: uppercase;
    text-align: center;
    font-size: 80%;
    }
    .ribbon.Expired span{
        background: #dc3545;
        
    }
    .ribbon.Registration-Closed span{
        background: #dc3545;
        font-size: 9px;
    }
    .ribbon.Closing span{
        background: #ffc107;
        /* color: #212529; */
    }
    /* top right*/
    .ribbon-top-right {
    top: -10px;
    right: -10px;
    }
    .ribbon-top-right::before,
    .ribbon-top-right::after {
    border-top-color: transparent;
    border-right-color: transparent;
    }
    .ribbon-top-right::before {
    top: 0;
    left: 0;
    }
    .ribbon-top-right::after {
    bottom: 0;
    right: 0;
    }
    .ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg);
    }
    /* top left*/
    .ribbon-top-left {
    top: -10px;
    left: -10px;
    }
    .ribbon-top-left::before,
    .ribbon-top-left::after {
    border-top-color: transparent;
    border-left-color: transparent;
    }
    .ribbon-top-left::before {
    top: 0;
    right: 0;
    }
    .ribbon-top-left::after {
    bottom: 0;
    left: 0;
    }
    .ribbon-top-left span {
    right: -50px;
    top: 35px;
    transform: rotate(-45deg);
    }
    </style>
    
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
					<li class="nav-item activeMenu">
                    <a class="nav-link" href="courses" >Our Courses</a>
                	</li>
                    <li class="nav-item ">
                    <a class="nav-link" href="gallery" >Gallery</a>
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
                    <li class="nav-item dropdown"><a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">Certificate </a>
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a class="dropdown-item" href="feedback">Feedback Form </a> <a class="dropdown-item" href="verify.html" target="blank">Certificate Verification </a></div>
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
                    Our
                </span>
                <span class="orange">
                    Programs
                </span>
                </h1>
         </div>
     </Section>
         <!-- Enquiry form -->
        <Section style="margin-top: 20px;">
         <div class="container">
            <div class="row">
            <?php
              while($rows=mysqli_fetch_array($result))
              {
                //$sdate = str_replace('/', '-', $rows['sdate']);
                //echo($rows['sdate']);
                $sdate1= str_replace('/', '-', $rows['sdate']);
               //echo($sdate1);
                $sdate = date('d-M-Y',strtotime(str_replace('/', '-', $rows['sdate']))); 
                $edate = date('d-M-Y',strtotime(str_replace('/', '-', $rows['edate']))); 
                $status = $rows['status'];
                $current_date = date("d-m-Y");
                $date_diff = date_diff(date_create($current_date),date_create($sdate1));
                $date_diff = $date_diff->format('%R%a');
                if($date_diff<0)
                {
                  $status = "Registration-Closed";
                }
                else if($date_diff<=2 and $date_diff>0)
                {
                  $status = "Limited Seats";
                }
                //echo($date_diff);
            ?> 
                <!-- 1 -->
              <div class="col-md-3 mb-3">
                <div class="card border-0 shadow course-card" style="border-radius: 10px;" >
                    <div class="ribbon ribbon-top-left <?php echo ($status);?>">
                      <span class="<?php echo ($status);?>"><?php echo ($status);?></span>
                    </div>
                  <img class="card-img-top img-padding" src="img/icon/card.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="#" class="blue"><?php echo $rows['title'];?></a>
                    </h5>
                    <span class="css-1pdh09u">
                        <span class="card-text-info">&nbsp;&nbsp;E-Certificate will be provided.&nbsp;&nbsp;</span>
                    </span>
                    <p class="card-text"><i class="bi bi-hourglass-split"></i>&nbsp;&nbsp; Course Duration: <?php echo $rows['duration']?></p>
                    <p class="card-text"><i class="bi bi-calendar-check"></i>&nbsp;&nbsp; Start: <?php echo ($sdate)?></p>
                    <p class="card-text"><i class="bi bi-calendar-x"></i>&nbsp;&nbsp; End: <?php echo $edate ?></p>
                    <p class="card-text" style="text-align: right;">Course Fee:&nbsp;<i class="bi bi-currency-rupee"></i><?php echo $rows['price']?></p>
                    <hr>
                    <a href="https://inspiress.in/courses_main?course_id=<?php echo $rows['course_id']?>&status=<?php echo $status?>" class="btn btn-orange w-100 btn-know">CLICK HERE TO REGISTER</a>
                  </div> 
                </div>
              </div>
              <!-- 1 -->
              <?php
                }
                $conn->close();
              ?>
              
            </div>
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>

                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
                </nav> -->
          </div>
        </Section>





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
                        

<p style="border-top:1px solid; padding-top: 3%;">10th Floor, CITIUS A Block, Phase 1, <br />
	Olympia Tech Park Plot No.1, SIDCO Industrial Estate, Guindy,Chennai-32</p>
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
            <div class="whatsapp "><a href="https://api.whatsapp.com/send?phone=8667493679&text=Hello" target="_blank"><img alt="" src="img/whatsapp-icon.png" /> </a></div>

    
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