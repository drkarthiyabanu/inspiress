
<?php include_once '../includes/header.inc.php'?>
<?php include_once '../includes/menus.inc.php'?>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- Content Starts From Here -->
<?php
//ini_set('display_errors', '1'); error_reporting(E_ALL);
include_once '../config/database.php';
// $pdo = connect();

// $sth = $pdo->query("SELECT receiptno FROM invoice order by receiptno desc limit 1");
// $receiptno = $sth + 1;

$conn = connect();
    #DB Fetching#
    $stmt = $conn->prepare("SELECT course_id FROM inspire_courselist order by course_id desc limit 1");
    $stmt->execute();
    $course_id = $stmt->fetchColumn()+1;

?>
<style>
    input[type="radio"]{
  margin: 0 2px 0 15px !important;
}
input[type="checkbox"]{
  margin: 0 0px 0 20px !important;
}
input[type="file"]{
  padding-top: 17px !important;
  padding-left: 30px !important;
}
.enter_btn{
    margin-top: 10px;
    background: #ffa500;
    border-radius: 6px;
    color: white;
    border: transparent;
    font-size: 14px;
}
.btn_br{
    width:8% !important;
    height:auto !important;
    font-size:1rem !important;
    margin-top: 10px !important;
    border-radius: 20 !important;
}
</style>
<main id="main" class="main">

    <!-- Content Header Starts -->
    <div class="pagetitle d-flex flex-md-row flex-column">

    
        <div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center">
                    <div class="icons-sec">
                            <span class="iconify menu-icon" data-icon="clarity:grid-view-line"></span>
                    </div>
                    <div class="d-flex flex-column">
                        <h1 class="pb-0">Inspire</h1>
                        <nav>
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                             <a href="../dashboard">Home </a> </li>
                            <li class="breadcrumb-item">
                            <a href="../course/members">Member</a></li>
                            <li class="breadcrumb-item">New Members Upload</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                
               
            </div>
            
           
        </div>
        
    </div>
    <!-- Content Header Ends -->
    
    <section class="section bootstrap-iso">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body row">
            
              <div class="col-lg-12">
              <form class="row g-3 needs-validation" method="post" id="member_form" enctype="multipart/form-data">
				  <p>Upload only CSV file. Click here to <a href="https://edinztech.com/inspire/admin/assets/template.csv"> Download Template </a></p>

                            <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required >
                                
                              </div>
                            </div>


                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="member_add" hidden></span>

                            <div class="col-12">
                            <input data-loading-text="Saving Invoice..." type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary theme-btn invoice-save-btm px-5">  
                              
                            </div>
                           
                        </form>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

</main>

  <!-- Content End Here -->

  <?php include_once '../includes/footer.inc.php'?>

<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script>
      $('#sdate').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

</script>
<script>
      $('#edate').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

</script>

<script>
var siteUrl = "<?php echo getSiteLink(); ?>";
var apiUrlPost = siteUrl + "admin/api/post";

//console.log("asdin");
$('#member_form').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting via the browser
    $("#submit").attr("disabled", true);
     //console.log(this);
    $.ajax({
        type: 'POST',
        url: apiUrlPost,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.result.value == 1) {
                alert("Members Added Successfully !");
                window.location.href=siteUrl + 'admin/course/members'
            }  
            else if (response.result.value == 2) {
                alert("Image Upload Failed... Retry Again!");
            } 
            else{
                alert("Contact Admin - Course Not Created !");
            }
        },
        error: function(response) {
            console.log(response);
        }
    }).done(function(data) {
        // Optionally alert the user of success here...
    }).fail(function(data) {
        // Optionally alert the user of an error here...
    });
});

</script>
