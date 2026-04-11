
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
                            <a href="../course/course">Course</a></li>
                            <li class="breadcrumb-item">New Course</li>
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
              <form class="row g-3 needs-validation" method="post" id="course_form" enctype="multipart/form-data">
                        <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="coursename" id="coursename" placeholder="Course Name" required>
                                
                                  <label for="coursename">Course Name:</label>
                                
                              </div>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <textarea type="text" class="form-control" name="description" id="description" placeholder="Course Description" row="6" style="height: 100px;" required></textarea>
                              <input  id="btn_br" value="Enter" class="btn btn-primary theme-btn invoice-save-btm btn_br" style="font-size:1rem !important">  
                              <label for="description">Course Description:</label>
                                
                              </div>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input type="file" class="form-control" id="image" name="image" accept="image/*" required >
                                
                              </div>
                            </div>

                        <div class="col-lg-2">
                            <div class="form-floating mb-1">
                            <input type="number" class="form-control" name="courseid1" id="courseid1" value="<?php echo $course_id; ?>" disabled>
                                <input type="number" class="form-control" name="course_id" id="course_id" value="<?php echo $course_id; ?>" Hidden>
                                <label for="course_id">S.No:</label>
                               
                            </div>
                          </div>

                          <div class="col-lg-5">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="sdate" id="sdate" data-date-format="dd/mm/yyyy" required>
                                
                                  <label for="sdate">Start Date (DD/MM/YYYY):</label>
                                
                              </div>
                        </div>

                        <div class="col-lg-5">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="edate" id="edate" data-date-format="dd/mm/yyyy" required>
                                
                                  <label for="edate">End Date (DD/MM/YYYY):</label>
                                
                              </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="duration" id="duration" placeholder="Duration" required>
                                
                                  <label for="month">Duration:</label>
                                
                              </div>
                              </div>
                           
                              <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="stime" id="stime" placeholder="Start Time" required>
                                
                                  <label for="stime">Start Time:</label>
                                
                              </div>
                              </div>

                              <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="etime" id="etime" placeholder="End Time" required>
                                
                                  <label for="etime">End Time:</label>
                                
                              </div>
                              </div>

                            <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input  type="number" class="form-control" name="price" id="price" placeholder="Course Fee" required>
                                
                                  <label for="price">Course Fee:</label>
                                
                              </div>
                            </div>



                            <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="link" id="link" placeholder="Registration Link"required >
                                
                                  <label for="coursenamed">Registration Link:</label>
                                
                              </div>
                            </div>

                            <div class="col-lg-12">
                                <input type="checkbox" id="pin" name="pin" value="1">
                                <label for="pin">Pin</label>
                                <input type="radio" id="new" name="status" value="New" checked>
                                <label for="new">New</label>
                                <input type="radio" id="ltd" name="status" value="Limited">
                                <label for="ltd">Limited</label>
                                <input type="radio" id="exp" name="status" value="Expired">
                                <label for="exp">Expired</label>
                                <input type="radio" id="evt" name="status" value="Past Events">
                                <label for="evt">Past Events</label>
                                <input type="radio" id="up" name="status" value="Upcoming">
                                <label for="up">Upcoming</label>
                                <input type="radio" id="cur" name="status" value="Current">
                                <label for="cur">Current</label>
                            </div>

                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="course_add" hidden></span>

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
$('#course_form').submit(function(event) {
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
                alert("Course Added Successfully !");
                window.location.href=siteUrl + 'admin/course/course'
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


<script>
	
function sanitizeInput(input) {
    input.value = input.value.replace(/['"]/g, '');
}

document.querySelectorAll('input[type="text"]').forEach(function(input) {
    // Handle typing
    input.addEventListener('input', function () {
        sanitizeInput(this);
    });

    // Handle paste
    input.addEventListener('paste', function (e) {
        e.preventDefault();
        let pasted = (e.clipboardData || window.clipboardData).getData('text');
        this.value += pasted.replace(/['"]/g, '');
    });

    // Handle autofill (on focus or change)
    input.addEventListener('change', function () {
        sanitizeInput(this);
    });
});
	
const textarea = document.getElementById('description');

// ✅ Append text
//textarea.value += '<br>';

const btn = document.getElementById('btn_br');

// ✅ Append text on button click
btn.addEventListener('click', function handleClick() {
  textarea.value += '<br>';
});
</script>
