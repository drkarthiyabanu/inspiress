<?php include_once 'post/connect.php';?>
<?php

$sql ="SELECT * FROM inspire_courselist WHERE delete_flag=0 order by pin desc, course_id desc";
$result=$conn->query($sql);
$number_of_results = mysqli_num_rows($result);

echo($number_of_results);
?>