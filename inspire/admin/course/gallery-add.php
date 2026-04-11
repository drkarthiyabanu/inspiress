<?php include_once '../includes/header.inc.php'?>
<?php include_once '../includes/menus.inc.php'?>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<!-- Content Starts From Here -->
<?php
include_once '../config/database.php';
// $pdo = connect();

// $sth = $pdo->query("SELECT receiptno FROM invoice order by receiptno desc limit 1");
// $receiptno = $sth + 1;

$conn = connect();
    #DB Fetching#
    $stmt = $conn->prepare("SELECT id FROM certificates order by id desc limit 1");
    $stmt->execute();
    $id = $stmt->fetchColumn()+1;

//     $stmt = $conn->prepare("SELECT courseid FROM certificates");
//    $result =  $stmt->execute();
//    echo('Hi12');
    // echo($result);
    // $id = $stmt->fetchColumn()+1;

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
                            <a href="../course/certificate_list">Gallery</a></li>
                            <li class="breadcrumb-item">New Gallery</li>
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
              <form class="row g-3 needs-validation" method="post" id="gallery_form" enctype="multipart/form-data">
                        <!-- <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="cid" id="cid" placeholder="Certificate ID" required>
                                
                                  <label for="cid">Certificate ID:</label>
                                
                              </div>
                            </div> -->

                        <!-- <div class="col-lg-4">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="course_id" id="course_id" onchange="CheckCID(this)" value="" required>
                                <label for="course_id">Course Id:</label>
                               
                            </div>
                          </div> -->

                          <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="ititle" id="ititle" required>
                                
                                  <label for="ititle">Title:</label>
                                
                              </div>
                        </div>

                        <div class="col-lg-12" id="img_form">
                              <div class="form-floating mb-1">
                              <input type="file" class="form-control" id="image" name="image" accept="image/*"  >
                                
                              </div>
                            </div>

                            <div class="col-lg-12" id="video_form" hidden>
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="vlink" id="vlink" >
                                
                                <label for="vlink">Video URL:</label>
                              </div>
                            </div>

                            <div class="col-lg-12">
                                <input type="radio" id="img" name="type" value="1" checked>
                                <label for="img">Image</label>
                                <input type="radio" id="video" name="type" value="0">
                                <label for="video">Video</label>
                            </div>
                        <!-- <div class="col-lg-6">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="sdate" id="sdate" data-date-format="dd/mm/yyyy" required>
                                
                                  <label for="sdate">Start Date (DD/MM/YYYY):</label>
                                
                              </div>
                            </div>

                        <div class="col-lg-6">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="edate" id="edate" data-date-format="dd/mm/yyyy" required >
                                
                                  <label for="edate">End Date (DD/MM/YYYY):</label>
                                
                              </div>
                            </div> -->

                            <!-- <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="duration" id="duration" placeholder="Duration" required>
                                
                                  <label for="month">Duration:</label>
                                
                              </div>
                              </div>
                           
                              <div class="col-lg-9">
                              <div class="form-floating mb-1">
                              <input type="text" class="form-control" name="certificatetype1" id="certificatetype1" placeholder="Certificate Type" value="landscape" disabled>
                              <input type="text" class="form-control" name="certificatetype" id="certificatetype" placeholder="Certificate Type" value="landscape" hidden>
                                  <label for="certificatetype">Certificate Type:</label>
                                
                              </div>
                              </div> -->

                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="gallery_add" hidden></span>

                            <div class="col-12">
                            <input data-loading-text="Saving Certificate..." type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary theme-btn invoice-save-btm px-5">  
                              
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
        $(document).ready(function () { 
            $('input[type=radio][name=type]').click(function () { 
                // alert("This is an alert message!"); 
                var type = $('input[name="type"]:checked').val();
                // alert(type);
                if(type ==1){
                    $("#img_form").attr("hidden", false);
                    $("#video_form").attr("hidden", true);
                    $("#vlink").attr("required", false);
                    $("#image").attr("required", true);
                }
                if(type ==0){
                    $("#img_form").attr("hidden", true);
                    $("#video_form").attr("hidden", false);
                    $("#vlink").attr("required", true);
                    $("#image").attr("required", false);
                }
            }); 
        }); 
    </script> 

<script>
var siteUrl = "<?php echo getSiteLink(); ?>";
var apiUrlPost = siteUrl + "admin/api/post";

//console.log("asdin");
$('#gallery_form').submit(function(event) {
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
                alert("Image Added Successfully !");
                window.location.href=siteUrl + 'admin/course/gallery_list'
            }  
            else if (response.result.value == 2) {
                alert("Image Upload Failed... Retry Again!");
            } 
            else{
                alert("Contact Admin - Image Not Created !");
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

