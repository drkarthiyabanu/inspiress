<?php include_once '../includes/header.inc.php'?>
<?php include_once '../includes/menus.inc.php'?>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<!-- Content Starts From Here -->
<?php
include_once '../config/database.php';
// $pdo = connect();

// $sth = $pdo->query("SELECT receiptno FROM invoice order by receiptno desc limit 1");
// $receiptno = $sth + 1;

$member_id = $_GET["member_id"];

// $sth = $pdo->query("Select max(receiptno) from invoice_ssg");
// $receiptno = $sth + 1;
$conn = connect();
    #DB Fetching#
    $query = "select * from inspire_reg where id='" . $member_id . "' ";
    $stmt = $conn->prepare($query);
    //echo $query;
    $stmt->execute();
    $row = $stmt->fetch();
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
                            <a href="../course/members">Member</a></li>
                            <li class="breadcrumb-item">Edit Member</li>
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
                
              <div class="col-lg-2">
                            <div class="form-floating mb-1">
                            <input type="text" class="form-control" name="sno1" id="sno1" value="<?php echo $member_id; ?>" disabled>
                                <input type="text" class="form-control" name="sno" id="sno" value="<?php echo $member_id; ?>" Hidden>
                                <label for="course_id">S.No:</label>
                               
                            </div>
                          </div>
                        <div class="col-lg-10">
                              <div class="form-floating mb-1">
                              <input value="<?php echo $row['name'];?>" type="text" class="form-control" name="name" id="name" >
                                
                                  <label for="name">Name:</label>
                                
                              </div>
                            </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-1">
                            <input type="text" class="form-control" name="course_id" id="course_id" value="<?php echo $row['cource_id'];?>" required>

                                <label for="course_id">Course Id:</label>
                               
                            </div>
                          </div>

                          <div class="col-lg-8">
                              <div class="form-floating mb-1">
                              <input value="<?php echo $row['institution'];?>" type="text" class="form-control" name="institution" id="institution" >
                                
                                  <label for="institution">Institution:</label>
                                
                              </div>
                        </div>



                            <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="<?php echo $row['mobile'];?>" type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" >
                                
                                  <label for="mobile">Mobile:</label>
                                
                              </div>
                              </div>



                            <div class="col-lg-3">
                              <div class="form-floating mb-1">
                              <input value="<?php echo $row['email'];?>" type="text" class="form-control" name="email" id="email" placeholder="email" >
                                
                                  <label for="email">email:</label>
                                
                              </div>
                              </div>


                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="certificate_update" hidden></span>
                            <input type="text" id="cpath" placeholder="" name="cpath" value="<?php echo $row['cpath']; ?>" hidden></span>

                            <div class="col-12">
                            <input data-loading-text="Saving Invoice..." type="submit" id="submit" name="submit" value="Update" class="btn btn-primary theme-btn invoice-save-btm px-5">  
                              
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
$('#certificate_form').submit(function(event) {
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
                alert("Certificate Updated Successfully !");
                window.location.href=siteUrl + 'admin/course/certificate_list'
            }  
            else if (response.result.value == 2) {
                alert("Image Upload Failed... Retry Again!");
            } 
            else{
                alert("Contact Admin - Certificate Not Updated !");
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
  var siteUrl = "<?php echo getSiteLink(); ?>";
      var cidapiUrl = siteUrl + "admin/api/get.php?method=get_cid";
    $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        url: cidapiUrl,
        dataType: "JSON",
        success: function(response) { 
            var jsonData = response;
            cid_json = jsonData;
        }
    });
    
  </script>

<script>

function CheckCID() {
        course_id = document.getElementById("course_id").value;
        // alert(course_id);
        flag = 0
        if (course_id == '') {
            $('#course_id').val('');
        }

        for (var i = 0; i < cid_json.length; i++) {
            if (cid_json[i]['courseid'] == course_id) {
                flag = 1;
                break;
            }
        }
        if (flag == 1) {

            $('#course_id').val('');
            // $('#btnsubmit').prop('disabled', true);
            alert('Course ID aleadry exists!');
        } else {
            // $('#btnsubmit').prop('disabled', false);
        }
    }
    </script>
