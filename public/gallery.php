<?php include_once 'config/connect.php'; ?>

<?php
$sql = "SELECT * FROM gallery WHERE iflag = 0 order by created desc";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'includes/header.php'; ?>
</head>
<body>

<main class="main">

  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
    <div class="container position-relative">
      <h1>Gallery</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="https://edinztech.com/">Home</a></li>
          <li>Gallery</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End Page Title -->

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">
    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

          <?php
          if ($result && mysqli_num_rows($result) > 0):
            while ($rows = mysqli_fetch_assoc($result)):
           
              $imgPath = htmlspecialchars('img/gallery/' . $rows['ipath']);
              $title = htmlspecialchars($rows['ititle']);
              $created = htmlspecialchars($rows['created']);
          ?>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <div class="portfolio-content h-100">
              <img src="<?= $imgPath ?>" class="img-fluid" alt="Gallery Image">
              <div class="portfolio-info">
                <h4><?= $title ?></h4>
                <p>Date: <?= $created ?></p>
                <a href="<?= $imgPath ?>" title="<?= $title ?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
              </div>
            </div>
          </div>

          <?php
            endwhile;
          else:
            echo "<p>No images found in the gallery.</p>";
          endif;
          $conn->close();
          ?>

        </div><!-- End Portfolio Container -->
      </div>

    </div>
  </section>
  <!-- /Portfolio Section -->

</main>

<?php include_once 'includes/footer.php'; ?>
</body>
</html>
