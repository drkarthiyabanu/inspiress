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
    $stmt = $conn->prepare("SELECT id FROM quiz_certificates order by id desc limit 1");
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
                            <a href="../course/quiz_certificate_list">Quiz Certificate</a></li>
                            <li class="breadcrumb-item">New Quiz Certificate</li>
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
              <form class="row g-3 needs-validation" method="post" id="certificate_form" enctype="multipart/form-data">
                        <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="cid" id="cid" placeholder="Certificate ID" required>
                                
                                  <label for="cid">Quiz Certificate ID:</label>
                                
                              </div>
                            </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="qid" id="qid" onchange="CheckQID(this)" value="" required>
                                <label for="qid">Quiz Id:</label>
                               
                            </div>
                          </div>

                          <div class="col-lg-8">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="qname" id="qname" required>
                                
                                  <label for="qname">Quiz Name:</label>
                                
                              </div>
                        </div>

                        <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input type="file" class="form-control" id="image" name="image" accept="image/*" required >
                                
                              </div>
                            </div>

                        <!-- <div class="col-lg-6">
                              <div class="form-floating mb-1">
                              <input value="" type="text" class="form-control" name="sdate" id="sdate" data-date-format="dd/mm/yyyy" required>
                                
                                  <label for="sdate">Start Date (DD/MM/YYYY):</label>
                                
                              </div>
                            </div> -->

                        <!-- <div class="col-lg-6">
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
                              </div>-->
                           
                              <div class="col-lg-12">
                              <div class="form-floating mb-1">
                              <input type="text" class="form-control" name="certificatetype1" id="certificatetype1" placeholder="Certificate Type" value="landscape" disabled>
                              <input type="text" class="form-control" name="certificatetype" id="certificatetype" placeholder="Certificate Type" value="landscape" hidden>
                                  <label for="certificatetype">Certificate Type:</label>
                                
                              </div>
                              </div>

                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="quiz_certificate_add" hidden></span>

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
      var qidapiUrl = siteUrl + "admin/api/get.php?method=get_qid";
    $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        url: qidapiUrl,
        dataType: "JSON",
        success: function(response) { 
            var jsonData = response;
            qid_json = jsonData;
        }
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
     var id = document.getElementById("qid").value;
    $.ajax({
        type: 'POST',
        url: apiUrlPost,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.result.value == 1) {
                $.ajax({
            url: "https://ythiz.com/api_other/ins_certi/quiz_id.php?id="+id, // Replace with the actual URL of the PHP file on another domain
            method: "GET",
            dataType: "json", // Change the data type according to your expected response
            success: function (data) {
                alert("Certificate Added Successfully !");

                window.location.href=siteUrl + 'admin/course/quiz_certificate_list'
                }  
            });
            }
            else if (response.result.value == 2) {
                alert("Image Upload Failed... Retry Again!");
            } 
            else{
                alert("Contact Admin - Certificate Not Created !");
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

function CheckQID() {
        qid = document.getElementById("qid").value;
        // alert(course_id);
        flag = 0
        if (qid == '') {
            $('#qid').val('');
        }

        for (var i = 0; i < qid_json.length; i++) {
            if (qid_json[i]['quizid'] == qid) {
                flag = 1;
                break;
            }
        }
        if (flag == 1) {

            $('#qid').val('');
            // $('#btnsubmit').prop('disabled', true);
            alert('Quiz ID aleadry exists!');
        } else {
            // $('#btnsubmit').prop('disabled', false);
        }
    }
    </script>
