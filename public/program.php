
<?php include_once 'config/connect.php';?>
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
<!DOCTYPE html>
<html lang="en">
<head>
  
<style type="text/css">
    .img-padding {
        padding: 10px 10px 0px 10px !important;
      }
    .btn-orange{
		border: 1px solid #f3711e !important;
		font-size: 12px !important;
		font-weight: 500 !important;
		background-color: #f3711e !important;
		color: white !important;
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
        font-size: 16px;
        line-height: 25px;
        font-weight: 600; 
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
		font-weight: bold;
    }
    .card-text{
        font-size: 13px !important;
        margin-bottom: 5px !important;
		font-weight: 500;
		line-height: 20px;
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
  <?php include_once 'includes/header.php'; ?>
</head>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Internships</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="https://edinztech.com/">Home</a></li>
            <li class="current">Internships/Workshops</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

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
                  <img class="card-img-top img-padding" src="assets/img/card.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="https://edinztech.com/program_main?course_id=<?php echo $rows['course_id']?>&status=<?php echo $status?>" class="blue"><?php echo $rows['title'];?></a>
                    </h5>
                    <span class="css-1pdh09u">
                        <span class="card-text-info">&nbsp;&nbsp;E-Certificate will be provided.&nbsp;&nbsp;</span>
                    </span>
                    <p class="card-text"><i class="bi bi-hourglass-split"></i>&nbsp;&nbsp; Course Duration: <?php echo $rows['duration']?></p>
                    <p class="card-text"><i class="bi bi-calendar-check"></i>&nbsp;&nbsp; Start: <?php echo ($sdate)?></p>
                    <p class="card-text"><i class="bi bi-calendar-x"></i>&nbsp;&nbsp; End: <?php echo $edate ?></p>
                    <p class="card-text" style="text-align: right;">Course Fee:&nbsp;<i class="bi bi-currency-rupee"></i><?php echo $rows['price']?></p>
                    <hr>
                    <a href="https://edinztech.com/program_main?course_id=<?php echo $rows['course_id']?>&status=<?php echo $status?>" class="btn btn-orange w-100 btn-know">CLICK HERE TO REGISTER</a>
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

  </main>
  <?php include_once 'includes/footer.php'; ?>