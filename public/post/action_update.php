<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include_once 'connect.php';?>
<?php
//console.log('hi');
echo nl2br ("Loading please wait...\n \nDon't Reload or Close the window!");
$inspireid = $_POST['inspireid'];
$name= $_POST['name'];
$instution= $_POST['instution'];
$email= $_POST['email'];
$mobile= $_POST['mobile'];
$cpath = $rows['cpath'];

// $coursename= $_POST['coursename'];
// $startdate= $_POST['startdate'];
// $enddate= $_POST['enddate'];
// $duration= $_POST['duration'];
// $place= $_POST['place'];
// $state= $_POST['state'];
// $comment= $_POST['comment'];
// $courseid= $_POST['courseid'];
// $certificateid= $_POST['certificateid'];

// $sql="SELECT * from inspireid where inspireid='$inspireid'";
// $res=mysqli_query($conn,$sql);
// $flag1=0;
// while($row=mysqli_fetch_array($res))
// {
// 	//echo($row["inspireid"]);
// 	if($row["inspireid"]==$inspireid)
// 	{
// 		$flag1=1;
// 		//echo($row["inspireid"]);
// 		if($row["flag"]==1)
// 		{
// 			echo "<script>alert('Candidate have already filled the form!');window.location.href='../feedback.php';</script>";
// 			return;
// 		}
// 		if($row["flag"]==0)
// 		{
// 			continue;
// 		}
// 	}
// }

// if($flag1==0)
// {
// 	echo "<script>alert('Inspire ID not exists');window.location.href='../feedback.php';</script>";

// }
$sql="SELECT * from feedback where inspireid='$inspireid'";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

$result1=$conn->query($sql);

$row=mysqli_fetch_array($result1); 
$courseid = $row['courseid'];



$sql ="SELECT * FROM certificates where courseid='$courseid'";

// echo($sql);

$result=$conn->query($sql);

$row=mysqli_fetch_array($result); 
$cpath = $row['cpath'];

if($count>0){
	$sql = "UPDATE inspireid SET flag=0 WHERE inspireid='$inspireid'";
	$conn->query($sql);
	$sql = "UPDATE feedback SET flag=0 WHERE inspireid='$inspireid'";
	$conn->query($sql);
}
if($count==0)
{
	echo "<script>alert('Please fill the feedback form first!');window.location.href='../feedback.php';</script>";
		return;
}

// $sql ="SELECT * FROM feedback where courseid='$courseid'";
// $result=$conn->query($sql);
// $sno = mysqli_num_rows( $result )+1;


$name = urlencode($name);
$instution = urlencode($instution);
$email = urlencode( $email);

//echo "<script>alert($name);</script>";

#$sql="INSERT INTO feedback (inspireid, sno, certificateid, name, institution, email, mobile, coursename, courseid, startdate, enddate, duration, flag, place, state, comment) 
#VALUES ('$inspireid', '$sno','$certificateid','$name','$instution','$email','$mobile','$coursename','$courseid','$startdate','$enddate','$duration',0,'$place','$state','$comment')";

$sql =" UPDATE feedback SET name='$name',institution='$instution',email='$email', mobile='$mobile', cpath='$cpath' WHERE inspireid='$inspireid'";
// echo($sql);
// exit();
if ($conn->query($sql) === TRUE) {

//   echo "<script>window.location.href='../mail.php?id=$inspireid';</script>";
$sql ="SELECT * FROM feedback where inspireid='$inspireid'";
$result=$conn->query($sql);

$row=mysqli_fetch_array($result); 
$id = $row['id'];
// $command = escapeshellcmd("python ../certi.py $id");
// // echo($command);

// $output = shell_exec($command);

//  $sql = "UPDATE feedback SET flag=1 WHERE inspireid='$inspireid'";
//  if ($conn->query($sql) === TRUE)
// {	$sql = "UPDATE inspireid SET flag=1 WHERE inspireid='$inspireid'";
//   $conn->query($sql);
// echo "<script>alert('Thank you for your positive feedback and your certificate is sent to the given mailid!');window.location.href='../index.html';</script>";
// }
  
//exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  
}

?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <title>
        Inspire Solution
    </title>
 
    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
 
        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
 
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
 
<body>
    <div id="loader" class="center"></div>
         

</body>
 
</html>

<script>
        document.onreadystatechange = function () {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>

<script>
	var id=<?php echo $id ?>;
	var inspireid='<?php echo $inspireid ?>';

			$.ajax({
            url: "https://ythiz.com/api_other/ins_certi/mail.php?id="+id, // Replace with the actual URL of the PHP file on another domain
            method: "GET",
            dataType: "json", // Change the data type according to your expected response
            success: function (data) {
				var key='update_flag';
				var formData = new FormData();
				formData.append("key", key);
				formData.append("id", id);
				formData.append("inspireid", inspireid);

				var apiUrlPost = "https://edinztech.com/inspire/admin/api/post";
				$.ajax({
					type: 'POST',
					url: apiUrlPost,
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {
						alert('Thank you for your positive feedback and your certificate is sent to the given mailid!');
							window.location.href= 'https://edinztech.com';
						},
					
					error: function(response) {
						console.log(response);
					}
				})
            }
        });
	</script>