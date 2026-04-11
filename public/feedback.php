<?php include_once 'config/connect.php';?>

<?php
$sql ="SELECT * FROM certificates WHERE flag=1";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);

$sql = "SELECT inspireid FROM inspireid UNION SELECT inspire_id FROM inspire_reg";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

//create an array
$techarray = array();
while($row =mysqli_fetch_assoc($result)){
    $techarray[] = $row;
}

$techarray_json= json_encode($techarray);
?>


  <?php include_once 'includes/header.php'; ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

 <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    min-height: 100vh;
    background: white;
    justify-content: center;
    align-items: center;
  }

  .container {
    width: 100%;
    max-width: 1100px;
    padding: 1rem;
  }

  .content-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
  }

  .contact-info,
  .feedback-container {
    flex: 1 1 45%;
    min-width: 300px;
    background: #fff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  .feedback-container {
    background: rgba(255, 255, 255, 0.95);
    transform: translateY(20px);
    opacity: 0;
    animation: slideUp 0.5s ease forwards;
  }

  @keyframes slideUp {
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .info-block {
    margin-bottom: 2rem;
  }

  .icon-circle {
    width: 60px;
    height: 60px;
    border: 2px dotted #ff4a17;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 1rem;
  }

  .icon-circle i {
    font-size: 1.5rem;
    color: #3484be;
  }

  .info-block h3 {
    font-size: 1.2rem;
    color: #2c3e50;
    margin-bottom: 0.3rem;
  }

  .info-block p {
    color: #555;
    font-size: 1rem;
  }

  h2 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: 1.8rem;
  }

  .input-group {
    margin-bottom: 1.5rem;
    position: relative;
  }

  .input-group input,
  .input-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .input-group label {
    position: absolute;
    left: 12px;
    top: 12px;
    background: white;
    padding: 0 4px;
    color: #777;
    pointer-events: none;
    transition: all 0.3s ease;
  }



  .rating {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 1.5rem 0;
    flex-wrap: wrap;
  }

  .rating-item {
    font-size: 2rem;
    cursor: pointer;
    color: #ddd;
    transition: all 0.3s ease;
  }

  .rating-item.active {
    color: #ffd700;
  }

  .rating-item:hover {
    transform: scale(1.2);
  }

  button {
    width: 100%;
    padding: 12px;
    background: #ff4a17;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
  }

  button:hover {
    background: #ff4a17;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
  }

  .success-message {
    display: none;
    text-align: center;
    color: #3484be;
    margin-top: 1rem;
    font-weight: 500;
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
  }

  .error {
    animation: shake 0.5s ease;
    border-color: #ff6b6b !important;
  }

  /* RESPONSIVE FIXES */
  @media (max-width: 768px) {
    body {
      align-items: flex-start;
    }

    .content-wrapper {
      flex-direction: column;
      gap: 1.5rem;
    }

    .contact-info,
    .feedback-container {
      flex: 1 1 100%;
      padding: 1.5rem 1rem;
    }

    h2 {
      font-size: 1.5rem;
    }

    .input-group input,
    .input-group textarea {
      font-size: 0.95rem;
      padding: 10px;
    }

    .rating-item {
      font-size: 1.6rem;
    }
	 @media (max-width: 768px) {
  .contact-info {
    display: none;
  }
  }
</style>
<!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
    <div class="container position-relative">
      <h1>Feedback</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="https://edinztech.com/">Home</a></li>
          <li>Feedback</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- End Page Title -->

  <div class="container">
    <div class="content-wrapper" style="margin-top: 70px;">
      <!-- Contact Info -->
      <div class="contact-info">
        <div class="info-block" style="margin-top: 70px;">
          <div class="icon-circle">
             <i class="fas fa-map-marker-alt"></i>
          </div>
          <h3>Address</h3>
          <p>EDINZ TECH Private Limited
10th Floor, CITIUS A Block, Phase 1,Olympia Tech Park Plot No.1,
SIDCO Industrial Estate, Guindy, Tamil Nadu, Chennai- 600032</p>
        </div>
        <div class="info-block">
          <div class="icon-circle">
            <i class="fas fa-phone-alt"></i>
          </div>
          <h3>Call Us</h3>
          <p>Phone : +91 44 6145 9000 <br>Mobile : +91 9042930169</p>
        </div>
        <div class="info-block">
          <div class="icon-circle">
           <i class="fas fa-envelope"></i>
          </div>
          <h3>Email Us</h3>
          <p>info@edinztech.com</p>
        </div>
      </div>

      <!-- Feedback Form -->
      <div class="feedback-container">
        <h2>We Value Your Feedback!</h2>
        <!-- <form id="feedbackForm" method="post" action="post/action_feedback.php" onSubmit="if(!confirm('Please check the details again before submiting!')){return false;}"> -->
		  <form id="feedbackForm" method="post" >
			<p style="color: red;font-size:10px;margin-bottom: 2px;justify-self: left;">* Details given below will be taken for certificate generation!</p>
          <div class="input-group">		    
    <input type="text" id="inspireid" name="inspireid" placeholder="Enter Inspire ID" required onkeypress="return blockSpecialChar(event)" onchange="CheckIID(this)" />
    
  </div>
  <p style="color: red;font-size:10px;margin-bottom: 2px;justify-self: left;">* Below entered detail will be printed in the certificate!</p>

  <div class="input-group">
    <input type="text" id="name" name="name" placeholder="Enter Name" required onkeypress="return blockSpecialChar(event)" />
 
  </div>
  <p style="color: red;font-size:10px;margin-bottom: 2px;justify-self: left;">* Below entered detail will be printed in the certificate!</p>

  <div class="input-group">
    <input type="text" id="instution" name="instution" placeholder="Enter Organization or Institution Name" required onkeypress="return blockSpecialChar(event)"/>
    
  </div>

  <div class="input-group">
    <input type="email" id="email" name="email" placeholder="Enter Email" required onkeypress="return blockSpecialChar(event)" />
    
  </div>

  <div class="input-group">
    <input type="number" id="mobile" name="mobile" placeholder="Enter Mobile Number" required onkeypress="return blockSpecialChar(event)" pattern="[0-9]{10}" />

  </div>

  <div class="input-group">
    <input type="text" id="place" name="place" placeholder="Enter Place" required onkeypress="return blockSpecialChar(event)" />

  </div>

  <div class="input-group">
    <input type="text" id="state" name="state" placeholder="Enter State" required onkeypress="return blockSpecialChar(event)" />
 
  </div>

          <div class="input-group">
            <textarea id="comment" name="comment" onkeypress="return blockSpecialChar(event)" placeholder="Enter Your Feedback" rows="4" required></textarea>
          
          </div>

                            <span style="display:none">
                            <input type="text" id="key" placeholder="" name="key" value="add_feedback" hidden></span>
			  
          <button type="submit" id="submitbtn">Submit</button>
          <div class="success-message" id="successMsg">Thank you for your feedback!</div>
        </form>
      </div>
    </div>

  </div>

<?php include_once 'includes/footer.php'; ?>
	
	    <script>
      let inspireid = '<?php echo($techarray_json)?>';
      const obj = JSON.parse(inspireid);
      const len = obj.length;
    //   console.log(obj[1]['inspireid']);
    //   console.log(obj.length);
  </script>


<script>

	
var siteUrl = "https://edinztech.com/";
var apiUrlPost = siteUrl + "inspire/admin/api/post";

//console.log("asdin");
$('#feedbackForm').submit(function(event) {
	  const comment = document.getElementById("comment").value.trim();
  if (comment === "") {
    alert("Please enter valid feedback.");
    return false; // prevent form submission
  }
    if (!confirm("Please check the details again before submiting!")) {
        event.preventDefault();  // stop form submission
        return false;            // stop further code
    }
   event.preventDefault(); // Prevent the form from submitting via the browser
    $("#submitbtn").attr("disabled", true).text("Generating Certificate...");
    $.ajax({
        type: 'POST',
        url: apiUrlPost,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
			console.log(response);
            if (response.statusCode == 201) {
                alert("Certificate sent to your mail successfully!");
                //window.location.href='https://edinztech.com/feedback'
            } 
            if (response.statusCode == 202) {
                alert("Invalid inspire id!");
                //window.location.href='https://edinztech.com/feedback'
            } 
            if (response.statusCode == 203) {
                alert("Candidate have already filled the form!");
                //window.location.href='https://edinztech.com/feedback'
            } 
			$("#submitbtn").attr("disabled", false).text("Submit");
        },
        error: function(response) {
            console.log(response);
			$("#submitbtn").attr("disabled", false).text("Submit...");
        }
    }).done(function(data) {
        // Optionally alert the user of success here...
    }).fail(function(data) {
        // Optionally alert the user of an error here...
    });
});

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
            $( "#message" ).text('Invalid Inspire ID!');
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
        return ((k > 63 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57) || k == 46 || k == 44);
        }
  </script>
