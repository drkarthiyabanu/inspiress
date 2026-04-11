<?php include_once 'config/connect.php';?>
<?php
if (isset($_GET['course_id'])) {
    $course_id = preg_replace('#[^0-9]#i', '', $_GET['course_id']);
    $status = $_GET['status'];
  }
$sql ="SELECT * FROM inspire_courselist WHERE course_id=$course_id";
$result=$conn->query($sql);
$number_of_results = mysqli_num_rows($result);
$rows=mysqli_fetch_array($result);
$button_default = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
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
			  <li><a  href="https://edinztech.com/courses">Internships</a></li>
            <li class="current"><?php echo $rows['title']; ?></li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">

              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>

              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="<?php echo str_replace('../../', 'inspire/', $rows['image']); ?>" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
              <h2><?php echo $rows['title']; ?></h2>
              <h3 style=" font-size: 17px; font-weight: bold; margin-bottom: 20px; ">Description:</h3>
              <p><?php echo $rows['description']; ?></p>
            </div>
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <ul>
                <li><strong><i class="bi bi-calendar" aria-hidden="true"></i>&nbsp;Date</strong>: <?php echo $rows['sdate']; ?> to <?php echo $rows['edate']; ?></li>
                <li><strong><i class="bi bi-alarm"></i>&nbsp;Timing</strong>: <?php echo $rows['stime']; ?> to <?php echo $rows['etime']; ?></li>
                <li><strong><i class="bi bi-hourglass-split"></i> &nbsp;Duration</strong>: <?php echo $rows['duration']; ?></li>
                <li><strong><i class="bi bi-cash"></i>&nbsp;Course Fee</strong>: ₹<?php echo $rows['price']; ?></li>
              </ul>
				<div style="text-align: right;margin-bottom: -20px !important;">
                <?php if ($status!="Expired") {
                    echo base64_decode($rows['link']);
                 }
                 else{
                    echo ("Please contact the admin for enrollment !");
                 }
                 ?>
				</div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

  </main>
  <?php include_once 'includes/footer.php'; ?>