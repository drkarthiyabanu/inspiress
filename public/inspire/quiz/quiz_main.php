
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include_once 'connect.php';?>
<?php 
$fname1= $_POST['fname1'];
$fname= preg_replace('/\s+/', '_', $fname1);

$mailid= $_POST['mailid'];


$mailid= $_POST['mailid'];
if (!filter_var($mailid, FILTER_VALIDATE_EMAIL)) {
	echo "<script>alert('Invalid email format');window.location.href='index.php';</script>";
	return;
  }

$whatsapp= $_POST['whatsapp'];
	if(!preg_match('/^\d{10}$/',$whatsapp)) {
	echo "<script>alert('Invalid mobile number');window.location.href='index.php';</script>";
	return;
  }  

  //$edu= $_POST['edu'];
//   $inst= $_POST['inst'];
  //$lname1= $_POST['lname1'];
  //$lname= preg_replace('/\s+/', '_', $lname1);
//   if($inst==NULL)
//   {
// 	  $inst='nil';
//   }
//   else
//   {
// 	$inst= preg_replace('/\s+/', '_', $inst);
//   }
$inst= $_POST['inst'];
//$lname1= $_POST['lname1'];
//$lname= preg_replace('/\s+/', '_', $lname1);
if($inst==NULL)
{
	$inst='nil';
}
else
{
  $inst= preg_replace('/\s+/', '_', $inst);
}

$qid= $_POST['quizid'];
// echo($qid);
  $state= $_POST['state'];
  $place= $_POST['place'];
  $country= $_POST['country'];
  $quizname = $_POST['quizname'];

$sql="SELECT * from quiz_record where (mailid='$mailid');";
$res=mysqli_query($conn,$sql);

if (mysqli_num_rows($res) > 0) {
	$row = mysqli_fetch_assoc($res);
	{
		if($mailid==$row['mailid'])
		{

			$sql ="SELECT * FROM quiz_certificates WHERE quizid='$qid'";
			// echo($sql);
			$res=mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($res);	
			$cpath= $row['cpath'];
			$certificateid= $row['certificateid'];
		
			$sql ="SELECT * FROM quiz_record where (qid='$qid');";
			// echo($sql);
			$result=$conn->query($sql);
			$rows=mysqli_fetch_array($result);
			$cid = mysqli_num_rows( $result )+1;
			echo "<script>alert('You have already attempted the quiz');window.location.href='index.php';</script>";
			return;
		}
	}
}
else{
	$sql ="SELECT * FROM quiz_certificates WHERE quizid='$qid'";
	// echo($sql);
	$res=mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);	
	$cpath= $row['cpath'];
	$certificateid= $row['certificateid'];
	$quizname= $row['quizname'];

	$sql ="SELECT * FROM quiz_record where (qid='$qid');";
	// echo($sql);
	$result=$conn->query($sql);
	$rows=mysqli_fetch_array($result);
	$cid = mysqli_num_rows( $result )+1;
	// $cid = $rows["id"]+1; 

//$sql="INSERT INTO record (fname,lname,mailid,mark,whatsapp,down,place,category,institution,state,country) VALUES ('$fname','$lname','$mailid','0','$whatsapp','no','0','$edu','$inst','$state','0')";
$sql="INSERT INTO quiz_record (cid,name,institution,mailid,mark,whatsapp,city,state,country,qid,cpath,certificateid,quizname) VALUES ('$cid','$fname','$inst','$mailid','0','$whatsapp','$place','$state','$country','$qid','$cpath','$certificateid','$quizname')";

if ($conn->query($sql) === TRUE) {
  			} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    			}
			}
$sql ="SELECT * FROM quiz_record where (mailid='$mailid');";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);
$id = $rows["id"]; 


// session_start();
// $_SESSION['id']= $id;
// $_SESSION['qid']= $qid;

// $qid= $_POST['quizid'];

$sql ="SELECT * FROM inspire_quiz WHERE param2=0 and qid='$qid' order by qno asc";
$result=$conn->query($sql);
// $rows=mysqli_fetch_array($result);
// echo($sql);


?>
<html lang="en">

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/browser/logo.ico">

    <title>Quiz</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	  
	<!-- Style-->  
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/cus.css">
	<link rel="stylesheet" href="assets/icons/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="assets/css/color_theme.css">


<script language ="javascript" >
        var tim;
        var min = 45;
        var sec = 00;
        var f = new Date();
        function f1() {
            f2();
             
          
        }
        function f2() {
            if (parseInt(sec) > 0) {
                sec = parseInt(sec) - 1;
                document.getElementById("showtime").innerHTML = "Time Left   "+min+" Minutes : " + sec+" Seconds";
                tim = setTimeout("f2()", 1000);
            }
            else {
                if (parseInt(sec) == 0) {
					min = parseInt(min) - 1;
                    if (parseInt(min) == 0) {
                        alert('Time Over');
						document.getElementById("myButtonId").click();
                    }
				   else {
                        sec = 60;
                        document.getElementById("showtime").innerHTML = "Time Left   "+min+" Minutes : " + sec+" Seconds";
                        tim = setTimeout("f2()", 1000);
                    }
                }
               
            }
        }
    </script>
	
	


</head>
<body class="hold-transition light-skin sidebar-mini theme-primary" onload="f1()">
	
	
<div class="wrapper">

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper leff">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header" style="display: flex; justify-content: center;">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
                    <div class="logo-lg">
                        <a href="#"class="cl1" ><img src="images/logo.png"   class="logo-img" alt="logo"></a>
                        <!--<span class="dark-logo"><img src="../images/logo-light-text.png" alt="logo"></span>-->
                    </div>
					<!--<h3 class="page-title">General Form Elements</h3>-->
				</div>
				
			</div>
		</div>	  

<!-- Main content -->
<section class="content">
			<div class="row">
				<div class="col-12">
				  <div class="box">
					  <form  method="POST" id="ins_quiz" enctype="multipart/form-data">
					<div class="box-header with-border">
					  <h4 class="box-title" style="text-align: center;"><?php echo($quizname)?> - Final Assessment</h4>
					</div>
					<div class="box-header with-border">
					  <div id="showtime" style="text-align: center; font-weight: bold;" ><i class="ti-timer"></i></div>
					</div>
					<div class="box-body">
					<?php
					$i=1;
              while($rows=mysqli_fetch_array($result))
              {
				$j=1;
			  ?>
						<div class="form-group">
							<?php if($rows['q_flag']==0) 
							{ ?>
							<label><?php echo($rows['qno'])?>. <?php echo($rows['question'])?></label>
							<?php 
							} 
							else 
							{ ?>
							<label><?php echo($rows['qno'])?>. <img src="../admin/quiz_img/<?php echo($rows['question_img'])?>" style="width:100%"/><br></label>
							<?php
							} ?>

							<div class="demo-radio-button" >
								<?php if($rows['answer1_flag']==0) 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <?php echo($rows['answer1'])?></label><br>
								<?php 
								} 
								else 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <img src="../admin/quiz_img/<?php echo($rows['answer1_img'])?>" style="width:100%"/></label><br>
								<?php
								} $j=$j+1;?>
								
								<?php if($rows['answer2_flag']==0) 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <?php echo($rows['answer2'])?></label><br>
								<?php 
								} 
								else 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <img src="../admin/quiz_img/<?php echo($rows['answer2_img'])?>" style="width:100%"/></label><br>
								<?php
								} $j=$j+1;?>

								<?php if($rows['answer3_flag']==0) 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <?php echo($rows['answer3'])?></label><br>
								<?php 
								} 
								else 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <img src="../admin/quiz_img/<?php echo($rows['answer3_img'])?>" style="width:100%"/></label><br>
								<?php
								} $j=$j+1;?>

								<?php if($rows['answer4_flag']==0) 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <?php echo($rows['answer4'])?></label><br>
								<?php 
								} 
								else 
								{ ?>
								<input name="q<?php echo($i) ?>" type="radio" value="<?php echo($j) ?>" id="q<?php echo($i) ?>-<?php echo($j) ?>"    />
								<label for="q<?php echo($i) ?>-<?php echo($j) ?>"> <img src="../admin/quiz_img/<?php echo($rows['answer4_img'])?>" style="width:100%"/></label><br>
								<?php
								} ?>
							</div>
						</div>
					<div class="bod"></div>
				<?php 
				$i=$i+1;
				} 
				// $_SESSION['count']= $count;
				$conn->close();
				?>
					<div class="text-right">
					<p id="msg" style=" color: red; font-weight: bold; font-size: 15px; " hidden>Submitting your test! Please wait....</p>
						<!-- <button type="Submit" value="Submit" id="myButtonId" class="waves-effect waves-light btn btn-primary mb-5" style="border-radius: 3px;"><i class="ti-arrow-right"></i> Submit</button> -->
						<input id="key" name="key" value="ins_quiz" hidden>  
						<input id="count" name="count" value="<?php echo($i-1)?>" hidden>
						<input id="id" name="id" value="<?php echo($id)?>" hidden>
						<input id="qid" name="qid" value="<?php echo($qid)?>" hidden>

						<input data-loading-text="Submitting Test..." type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary theme-btn invoice-save-btm px-5">  
						
                    </div>
				</div>	
				</form>
			</div>
			  <!-- /.box -->

		  </div>
		  <!-- /.row -->

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper 
  <footer>
  
  <div class="container footerBot">
        <div class="row d-flex align-items-center"> 
		<p class="col-lg-12 order-lg-1 text-center ">&copy; 2022 by <a href="https://wikichennai.com/">wikichennai</a></p>                     
        </div>
	</div>
</footer>-->
	
</body>

<!-- Mirrored from www.multipurposethemes.com/admin/florence-admin-template/main/forms_general.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 17:51:03 GMT -->
</html>

<script>
var siteUrl = "https://inspiress.in/";
var apiUrlPost = siteUrl + "post/action_quiz.php";

//console.log("asdin");
$('#ins_quiz').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting via the browser

    $("#submit").attr("disabled", true);
	$("#msg").attr("hidden", false);
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
				window.location.href=siteUrl + 'quiz/quiz_result.php?id=<?php echo($id)?>';
                // // alert("Course Added Successfully !");
                // window.location.href=siteUrl + 'admin/course/course'
            }  
            else if (response.result.value == 2) {
				window.location.href=siteUrl + 'quiz/quiz_result.php?id=<?php echo($id)?>';
                // alert("Image Upload Failed... Retry Again!");
            } 
            else{
                window.location.href=siteUrl + 'quiz/quiz_result.php?id=<?php echo($id)?>';
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

document.querySelectorAll('p span').forEach(span => {
    span.replaceWith(...span.childNodes);
});

// Select all label elements containing <p> elements
document.querySelectorAll('label p').forEach(paragraph => {
    // Move the content of <p> into the label
    paragraph.parentElement.innerHTML = `${paragraph.parentElement.innerHTML.split('<p>')[0]} ${paragraph.innerHTML}`;
    paragraph.remove(); // Remove the original <p> element
});

</script>