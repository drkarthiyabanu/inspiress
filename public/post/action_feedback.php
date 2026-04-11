<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php include_once 'connect.php';?>

<?php

echo nl2br ("Loading please wait...\n \nDon't Reload or Close the window!");

$inspireid = $_POST['inspireid'];
$name= $_POST['name'];
$instution= $_POST['instution'];
$email= $_POST['email'];
$mobile= $_POST['mobile'];
$place= $_POST['place'];
$state= $_POST['state'];
$comment= $_POST['comment'];
// echo('$name');
// echo($name);
// exit();




$sql="SELECT * from inspireid where inspireid='$inspireid'";
$res=mysqli_query($conn,$sql);
// echo($row["flag"]);
// echo($sql);
// echo('Flag1');
//print_r($res);

$flag1=0;
//exit;
while($row=mysqli_fetch_array($res))
{
	print_r($row);
	echo($row["inspireid"]);
	exit;
	if($row["inspireid"]==$inspireid)
	//if($row["inspireid"]==$inspireid)
	{
		
		$flag1=1;
		if($row["flag"]==1)
		{
			echo "<script>alert('Candidate have already filled the form!');window.location.href='../feedback.php';</script>";
			return;
		}
		if($row["flag"]==0)
		{
			continue;
		}
	}
}

if($flag1==0)
{
	// console.log("flag1=0");
	exit();
}

$sql ="SELECT courseid FROM inspireid WHERE inspireid='$inspireid'";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);
$courseid= $rows['courseid'];

$sql ="SELECT * FROM certificates WHERE courseid='$courseid'";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);

$certificateid= $rows['certificateid'];
$coursename= $rows['coursename'];
$startdate= $rows['startdate'];
$enddate= $rows['enddate'];
$duration= $rows['duration'];
$cpath = $rows['cpath'];



$sql ="SELECT * FROM feedback where courseid='$courseid'";
$result=$conn->query($sql);
$sno = mysqli_num_rows( $result )+1;


// $name = str_replace("'", '"', $name);
// $instution = str_replace("'", '"', $instution);
// $email = str_replace("'", '"', $email);

$name = urlencode($name);
$instution = urlencode($instution);
$email = urlencode( $email);


$sql="INSERT INTO feedback (inspireid, sno, certificateid, name, institution, email, mobile, coursename, courseid,cpath, startdate, enddate, duration, flag, place, state, comment) 
VALUES ('$inspireid', '$sno','$certificateid','$name','$instution','$email','$mobile','$coursename','$courseid','$cpath','$startdate','$enddate','$duration',0,'$place','$state','$comment')";

if ($conn->query($sql) === TRUE) {

//   echo "<script>window.location.href='../mail.php?id=$inspireid';</script>";
  
$sql ="SELECT * FROM feedback where inspireid='$inspireid'";
$result=$conn->query($sql);

$row=mysqli_fetch_array($result); 
$id = $row['id'];
// $command = escapeshellcmd("python ../certi.py $id");
// $output = shell_exec($command);


// echo($command);
// echo($id);
// echo($rows['cpath']);
// exit();

//  $sql = "UPDATE feedback SET flag=0 WHERE inspireid='$inspireid'";
//  if ($conn->query($sql) === TRUE)
// {	
// 	$sql = "UPDATE inspireid SET flag=0 WHERE inspireid='$inspireid'";
//   $conn->query($sql);
// // echo "<script>alert('Thank you for your positive feedback and your certificate is sent to the given mailid!');window.location.href='../index.html';</script>";
// }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  
}

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <title>
        Insipre Solution
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
            url: "https://ythiz.com/api_other/ins_certi/mail.php?id="+id,
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
						console.log(response);
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

</body>
 
 </html>