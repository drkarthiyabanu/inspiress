<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<?php
$id = $_GET['id'];
// echo($id);

$id = trim($id,"http://");
$id = trim($id,"$");
$id = trim($id,"INS");
$id = trim($id,"$");

// echo($id);
// exit();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://edinztech.com/inspire/admin/api/get.php?id='.$id.'&method=verify',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
// $rows=$response;
// echo $rows;
$rows = json_decode($response,true);
// json_decode(GetEmpID($user_id),true);
// echo($rows[0]);
// $sql ="SELECT * FROM feedback WHERE id=$id";
// $result=$conn->query($sql);
// $rows=mysqli_fetch_array($result);
// echo($rows[0]["id"]);
// exit();



?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="Verify Your Email">
  <title>Verify Your Certificate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
   
</style>
</head>

<body class="blue" style="background-color: #3484be;">
      <div class="container">
        <div class="row align-items-center vh-100">
        <div class="col-md-6 col-sm-8 mx-auto">
        <div class="card rounded-3 shadow-sm">
          <div class="card-header py-3 bg-white text-center">
            <img src="./verified.gif" alt="Girl in a jacket" width="120px" height="120px">
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title text-center h2 font-weight-bold" style="font-size: 22px; padding-bottom: 10px;">Certificate Successfully Verified !</h1>
            <p class="text-muted fw-light h3 text-center mb-5" style=" margin-bottom: 25px !important;">Candidate Details</p>
            <div class="table-responsive mb-2">
      <table class="table text-left">
       
        <tbody>
          <tr>
            <th scope="row" class="text-start">ID</th>
            <td><?php echo $rows[0]["certificateid"] ?><?php echo $rows[0]["sno"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">Name</th>
            <td><?php echo $rows[0]["name"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">Course</th>
            <td><?php echo $rows[0]["coursename"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">Start Date</th>
            <td><?php echo $rows[0]["startdate"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">End Date</th>
            <td><?php echo $rows[0]["enddate"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">Duration</th>
            <td><?php echo $rows[0]["duration"] ?></td>
           
          </tr>
          <tr>
            <th scope="row" class="text-start">Issued By</th>
            <td>Inspiress.in</td>
           
          </tr>
        </tbody>

      </table>
    </div>
          
            <a class="w-100 btn btn-lg btn-success" href="index.php">Scan Again</a>
          
          </div>
        </div>
      </div>
        </div>
      </div>

</body>

</html>
