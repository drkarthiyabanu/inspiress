<?php

//header("Content-type: application/json; charset=utf-8");
//date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
error_reporting(0);
//include_once '../mail/mail.php';

# Create connection
$jsonString = file_get_contents("php://input");

$phpObject = json_decode($jsonString);
if (isset($_POST["key"])) {
    $key = $_POST["key"];
} elseif (isset($phpObject->key)) {
    $key = $phpObject->key;
} 
else {
    $key = null;
}

// echo($key);
// exit();
// $key = isset($_POST["key"]) ? $_POST["key"] : null;
$conn = connect();

session_start(); 

$DateTime = date('Y-m-d H:i:s');
$created = isset($DateTime) ? $DateTime : null;
$createdby = isset($DateTime) ? $DateTime : null;
$modified = isset($DateTime) ? $DateTime : null;
$modifiedby = isset($DateTime) ? $DateTime : null;
//$invoice_id = $phpObject->invoice_id;
//$customer_id = $phpObject->customer_id;

switch ($key) {

                            case "course_add":
                                $course_id=$_POST["course_id"];
                                $param1 =" ";
                                $param2 =" ";
                                $param3 =" ";
                                $param4 =" ";
                                $pin = isset($_POST["pin"]) ? "1" : "0";
                                // $pin = $_POST["pin"]!=NULL ? "1":"0";
                                $str = $_POST["link"];

                                if (base64_decode($str, true) !== false){
                                    $link = $_POST["link"];
                                } else {
                                    //echo("False");
                                    $link = base64_encode($_POST["link"]);

                                }

                                // $image_path = isset(($_FILES['image']['name']) ? "1" : "0";

                                if(!($_FILES['image']['name'])){
                                    // echo($_POST["image_path"]);

                                    // $image1=$_POST["image_path"].rsplit('/', 1)[1]
                                    // echo($image1);
                                    // exit();
                                    // $del_image='../../img/courses/'.$image1;  
                                    $image_path = $_POST["image_path"];
                                } else{ 
                                    if(isset($_POST["image_path"])){
                                    // $image1=$_POST["image_path"].rsplit('/', 1)[1];
                                    $url=$_POST["image_path"];
                                    $image = substr(strrchr($url, '/'), 1);
                                    // echo($str);
                                    // exit();
                                    $del_image='../../../img/courses/'.$image;   
                                    // echo($del_image);
                                    unlink($del_image);
                                    }

                                $image= $_FILES['image']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                $target = "../../../img/courses/".$unique_image;
                               // echo($target);
                                
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                  $image_path="../../../img/courses/".$unique_image;
                                  //echo "<script>console.log('Image uploaded successfully $path' );</script>";
                                }else{
                                  //echo "<script>console.log('Error' );</script>";
                                  $value = array(
                                    "value" => '2',
                                    "course_id" => $course_id,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                exit();

                                }
                            }

                            $delete_flag=0;
                                $query = "REPLACE INTO inspire_courselist( course_id,title,description,duration,sdate,edate,stime,etime,image,price,link,status,pin,delete_flag,param1,param2,param3,param4) VALUES (:course_id, :title,:description,:duration,:sdate,:edate,:stime,:etime,:image,:price,:link,:status,:pin,:delete_flag,:param1,:param2,:param3,:param4)";
                                    $result = $conn->prepare($query);
                                
                                    $result->bindParam(":course_id", $course_id, PDO::PARAM_INT);
                                    $result->bindParam(":title", $_POST["coursename"], PDO::PARAM_STR);
                                    $result->bindParam(":description", $_POST["description"], PDO::PARAM_STR);           
                                    $result->bindParam(":duration", $_POST["duration"], PDO::PARAM_STR);           
                                    $result->bindParam(":sdate", $_POST["sdate"], PDO::PARAM_STR);                      
                                    $result->bindParam(":edate", $_POST["edate"], PDO::PARAM_STR);
                                    $result->bindParam(":stime", $_POST["stime"], PDO::PARAM_STR);
                                    $result->bindParam(":etime", $_POST["etime"], PDO::PARAM_STR);
                                    $result->bindParam(":image", $image_path, PDO::PARAM_STR);
                                    $result->bindParam(":price", $_POST["price"], PDO::PARAM_STR);
                                    $result->bindParam(":link", $link, PDO::PARAM_STR);
                                    $result->bindParam(":status",$_POST["status"], PDO::PARAM_STR);
                                    $result->bindParam(":pin", $pin, PDO::PARAM_INT);
                                    $result->bindParam(":delete_flag", $delete_flag, PDO::PARAM_INT);
                                    $result->bindParam(":param1",$param1, PDO::PARAM_STR);
                                    $result->bindParam(":param2",$param2, PDO::PARAM_STR);
                                    $result->bindParam(":param3",$param3, PDO::PARAM_STR);
                                    $result->bindParam(":param4",$param4, PDO::PARAM_STR);
                                if (!$result->execute()) {         
                                    print_r($result->errorInfo());
                                    
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );        
                                    response(json($value, 'Insert Success', '201', 1), '201');

                                }
                                break;
		
                            case "member_add":

							if (isset($_FILES["csv_file"]) && $_FILES["csv_file"]["error"] === UPLOAD_ERR_OK) {
								$tmpName = $_FILES["csv_file"]["tmp_name"];

								// Open CSV
								if (($handle = fopen($tmpName, "r")) !== FALSE) {
									// Skip the header row if necessary
									fgetcsv($handle);

									$dflag = 0;
									//$inspire_id = "INS" . time() . rand(10, 99);


									$query = "INSERT INTO inspire_reg (name, cource_id, institution, designation, rollno, mobile, email, type, inspire_id, intern_position, source, whatsapp, delete_flag) VALUES (:name, :cource_id, :institution, :designation, :rollno, :mobile, :email, :type, :inspire_id, :intern_position, :source, :whatsapp, :delete_flag)";

									$stmt = $conn->prepare($query);

									while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
										$inspire_id = "EDZ".date("YmdHis");
										// Assuming CSV columns: name, cource_id, institution, mobile, email, type, inspire_id, intern_certificate
										$stmt->bindParam(":name", $data[0], PDO::PARAM_STR);
										$stmt->bindParam(":cource_id", $data[1], PDO::PARAM_STR);
										$stmt->bindParam(":institution", $data[2], PDO::PARAM_STR);
										$stmt->bindParam(":designation", $data[3], PDO::PARAM_STR);
										$stmt->bindParam(":rollno", $data[4], PDO::PARAM_STR);
										$stmt->bindParam(":mobile", $data[5], PDO::PARAM_STR);
										$stmt->bindParam(":email", $data[6], PDO::PARAM_STR);
										$stmt->bindParam(":type", $data[7], PDO::PARAM_STR);
										$stmt->bindParam(":inspire_id", $inspire_id, PDO::PARAM_STR);
										$stmt->bindParam(":intern_position", $data[8], PDO::PARAM_STR);
										$stmt->bindParam(":source", $data[9], PDO::PARAM_STR);
										$stmt->bindParam(":whatsapp", $data[10], PDO::PARAM_STR);
										$stmt->bindParam(":delete_flag", $dflag, PDO::PARAM_INT);

										if (!$stmt->execute()) {
											response(json(array("value" => '0'), 'Insert Error', '500', 0), '500');
											exit;
										}
										
										if (strtolower($data[7]) == 'internship') {

											$curl = curl_init();
											curl_setopt_array($curl, array(
											  CURLOPT_URL => 'https://wikichennai.com/inspire/intern_certi.php?id='.$inspire_id,
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

											$curl = curl_init();
											curl_setopt_array($curl, array(
											  CURLOPT_URL => 'https://edinztech.com/inspire/admin/api/post.php',
											  CURLOPT_RETURNTRANSFER => true,
											  CURLOPT_ENCODING => '',
											  CURLOPT_MAXREDIRS => 10,
											  CURLOPT_TIMEOUT => 0,
											  CURLOPT_FOLLOWLOCATION => true,
											  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
											  CURLOPT_CUSTOMREQUEST => 'POST',
											  CURLOPT_POSTFIELDS => array('id' => $inspire_id,'key' =>'update_intern_certificate'),
											));

											$response = curl_exec($curl);
											curl_close($curl);
										
										}
										else{

											$curl = curl_init();
											curl_setopt_array($curl, array(
											  CURLOPT_URL => 'https://wikichennai.com/inspire/intern_reg.php?id='.$inspire_id,
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
											
										}
									}

									fclose($handle);

									response(json(array("value" => '1'), 'Insert Success', '201', 1), '201');

								} else {
									response(json(array("value" => '2'), 'File Open Failed', '400', 0), '400');
								}

							} else {
								response(json(array("value" => '2'), 'File Upload Failed', '400', 0), '400');
							}

							break;


                            case "update_intern_certificate":

                                if (isset($_POST["id"])) {
                                    $id = $_POST["id"];
                                } elseif (isset($phpObject->id)) {
                                    $id = $phpObject->id;
                                } 
                                else {
                                    $id = null;
                                }
                        
                                $query = "update inspire_reg set intern_certificate='1' where inspire_id='".$id."'";
                         
                                $result_reg = $conn->prepare($query);
                        
                                if (!$result_reg->execute()) {         
                                    print_r($result_reg->errorInfo());
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;


                            case "course_delete":

                                    if (isset($_POST["course_id"])) {
                                        $course_id = $_POST["course_id"];
                                    } elseif (isset($phpObject->course_id)) {
                                        $course_id = $phpObject->course_id;
                                    } 
                                    else {
                                        $course_id = null;
                                    }
                            
                                    $query = "update inspire_courselist set delete_flag=1 where course_id='".$course_id."'";
                             
                                    $result_reg = $conn->prepare($query);
                                    //$result_reg->bindParam(":invoice_id",$invoice_id , PDO::PARAM_STR);
                                    //$result_reg->bindParam(":delete_flag", 1, PDO::PARAM_INT);
                            
                                    if (!$result_reg->execute()) {         
                                        print_r($result_reg->errorInfo());
                                    } else {
                                        $value = array(
                                            "value" => '1',
                                        );            
                                    }
                                    response(json($value, 'Update Success', '201', 1), '201');
                            break;


                            case "gallery_delete":

                                if (isset($_POST["id"])) {
                                    $id = $_POST["id"];
                                } elseif (isset($phpObject->id)) {
                                    $id = $phpObject->id;
                                } 
                                else {
                                    $id = null;
                                }
                        
                                $query = "update gallery set iflag=1 where id='".$id."'";
                         
                                $result_reg = $conn->prepare($query);
                                //$result_reg->bindParam(":invoice_id",$invoice_id , PDO::PARAM_STR);
                                //$result_reg->bindParam(":delete_flag", 1, PDO::PARAM_INT);
                        
                                if (!$result_reg->execute()) {         
                                    print_r($result_reg->errorInfo());
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;
                            

                            case "certificate_add":
                                // echo($key);
                                // exit();
                                $course_id=$_POST["course_id"];
                                // if(!$course_id){

                                if(!($_FILES['image']['name'])){
                                    $image_path = $_POST["image_path"];
                                } else{ 
                                $image= $_FILES['image']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                // $unique_image = $course_id.'.'.$file_ext;
                                $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                $target = "../../../certificate/".$unique_image;
                                //    echo($_FILES['image']['tmp_name']);
                                //    echo($target);
                                //    exit();
                                
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                //   $image_path="https://inspiress.in/certificate/".$unique_image;
                                $image_path=$unique_image;
                                //   echo "<script>console.log('Image uploaded successfully $image_path' );</script>";
                                }else{
                                  //echo "<script>console.log('Error' );</script>";
                                  $value = array(
                                    "value" => '2',
                                    "course_id" => $course_id,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                // exit();

                                }
                            }
                                // exit();
                                $flag=0;
                                $query = "INSERT INTO certificates (certificateid,courseid,coursename,cpath,startdate,enddate,duration,flag,certificatetype) VALUES (:certificateid, :courseid, :coursename,:cpath, :startdate, :enddate, :duration, :flag,:certificatetype)";
                                    $result = $conn->prepare($query);
                                
                                    $result->bindParam(":certificateid", $_POST["cid"], PDO::PARAM_STR);
                                    $result->bindParam(":courseid", $_POST["course_id"], PDO::PARAM_STR);
                                    $result->bindParam(":coursename", $_POST["cname"], PDO::PARAM_STR);           
                                    $result->bindParam(":cpath", $image_path, PDO::PARAM_STR);           
                                    $result->bindParam(":startdate", $_POST["sdate"], PDO::PARAM_STR);                      
                                    $result->bindParam(":enddate", $_POST["edate"], PDO::PARAM_STR);
                                    $result->bindParam(":duration", $_POST["duration"], PDO::PARAM_STR);
                                    $result->bindParam(":flag", $flag, PDO::PARAM_INT);
                                    $result->bindParam(":certificatetype", $_POST["certificatetype"], PDO::PARAM_STR);
                                if (!$result->execute()) {         
                                    print_r($result->errorInfo());
                                    
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );        
                                    response(json($value, 'Insert Success', '201', 1), '201');

                                }
                            // }
                                break;

                                case "gallery_add":
                                    // echo($key);
                                    // exit();
                                    // $course_id=$_POST["course_id"];
                                    // if(!$course_id){

                                        $image_path ='';
                                        $vlink ='';
                                        $type = $_POST["type"];
    
                                    if(!($_FILES['image']['name'])){
                                        $vlink = $_POST["vlink"];
                                    } else{ 
                                    $image= $_FILES['image']['name'];
                                    $div = explode('.', $image);
                                    $file_ext = strtolower(end($div));
                                    // $unique_image = $course_id.'.'.$file_ext;
                                    $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                    $target = "../../../img/gallery/".$unique_image;
                                    //    echo($_FILES['image']['tmp_name']);
                                    //    echo($target);
                                    //    exit();
                                    
                                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                    //   $image_path="https://inspiress.in/certificate/".$unique_image;
                                    $image_path=$unique_image;
                                    //   echo "<script>console.log('Image uploaded successfully $image_path' );</script>";
                                    }else{
                                      //echo "<script>console.log('Error' );</script>";
                                      $value = array(
                                        "value" => '2',
                                        // "course_id" => $course_id,
                                    );        
                                    response(json($value, 'Image Upload Failed', '201', 1), '201');
                                    // exit();
    
                                    }
                                }
                                    // exit();
                                    $iflag=0;
                                    $ipin=0;
                                    $query = "INSERT INTO gallery (ititle, ipath, vlink, type, iflag, ipin) VALUES (:ititle, :ipath, :vlink, :type, :iflag, :ipin)";
                                        $result = $conn->prepare($query);
                                    
                                        $result->bindParam(":ititle", $_POST["ititle"], PDO::PARAM_STR);
                                        $result->bindParam(":ipin", $ipin, PDO::PARAM_INT);
                                        $result->bindParam(":iflag", $iflag, PDO::PARAM_INT);           
                                        $result->bindParam(":type", $type, PDO::PARAM_INT);           
                                        $result->bindParam(":ipath", $image_path, PDO::PARAM_STR);
                                        $result->bindParam(":vlink", $vlink, PDO::PARAM_STR);

                                    if (!$result->execute()) {         
                                        print_r($result->errorInfo());
                                        
                                    } else {
                                        $value = array(
                                            "value" => '1',
                                        );        
                                        response(json($value, 'Insert Success', '201', 1), '201');
    
                                    }
                                // }
                                    break;
                                case "inspireid_add":
                                    $inspireid=$_POST["inspireid"];
                                    $start=$_POST["start"];
                                    $end=$_POST["end"];
                                    $flags=0;

                                    for($i=$start;$i<=$end;$i++) {
                                    $inspireid1=0;
                                    // echo($i);
                                    if($i<10){
                                        // echo('inside 10');
                                        $temp='00';
                                    $inspireid1=$inspireid.$temp.$i;
                                    }
                                    else if($i>=10 && $i<100){
                                        $temp='0';
                                        $inspireid1=$inspireid.$temp.$i;  
                                    }
                                    else{
                                        // echo('Hi');
                                        $inspireid1=$inspireid.$i;
                                    }
                                    // echo($inspireid1);
                                    // exit();
                                    $flag='0';
                                    $query = "INSERT INTO inspireid (inspireid,courseid,flag) VALUES (:inspireid, :courseid, :flag)";
                                    $result = $conn->prepare($query);
                                    $result->bindParam(":inspireid", $inspireid1, PDO::PARAM_STR);
                                    $result->bindParam(":courseid", $_POST["cid"], PDO::PARAM_STR);
                                    $result->bindParam(":flag", $flag, PDO::PARAM_STR); 
                                    $result->execute();
                                    $flags++;
                                    }
                                    if($flags>0)
                                    {
                                        $value = array(
                                            "value" => '1',
                                        );        
                                        response(json($value, 'Insert Success', '201', 1), '201');
    
                                    }
                                    break;

                                case "certificate_delete":

                                    if (isset($_POST["id"])) {
                                        $id = $_POST["id"];
                                    } elseif (isset($phpObject->id)) {
                                        $id = $phpObject->id;
                                    } 
                                    else {
                                        $id = null;
                                    }
                                    //echo($id);
                
                            
                                    $query = "update certificates set flag = 1 where id='".$id."'";
                             
                                    $result_reg = $conn->prepare($query);
                                    if (!$result_reg->execute()) {         
                                        print_r($result_reg->errorInfo());
                                    } else {
                                        $value = array(
                                            "value" => '1',
                                        );            
                                    }
                                    response(json($value, 'Update Success', '201', 1), '201');
                            break;

                            case "quiz_certificate_delete":

                                if (isset($_POST["id"])) {
                                    $id = $_POST["id"];
                                } elseif (isset($phpObject->id)) {
                                    $id = $phpObject->id;
                                } 
                                else {
                                    $id = null;
                                }
                                //echo($id);
                                
                            $selectQuery="select cpath from quiz_certificates where id='".$id."'";
                            $stmt = $conn->prepare($selectQuery);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $del_image='../../../quiz_certificate/'.$result[0]['cpath'];
                            unlink($del_image);
            
                        
                                $query = "update quiz_certificates set flag = 1 where id='".$id."'";
                         
                                $result_reg = $conn->prepare($query);
                                if (!$result_reg->execute()) {         
                                    print_r($result_reg->errorInfo());
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;

                            case "certificate_update":

                                $id = $_POST["cnum"];
                                $cid = $_POST["cid"];
                                $course_id = $_POST["course_id"];
                                $sdate = $_POST["sdate"];
                                $edate = $_POST["edate"];
                                $duration = $_POST["duration"];
                                $flag = 0;
                                $certificatetype = $_POST["certificatetype"];
                                $image1 = $_POST["cpath"];
                                $cname = $_POST["cname"];
                                // echo($image1);
                                $image= $_FILES['image']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                // $unique_image = $course_id.'.'.$file_ext;
                                $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                $target = "../../../certificate/".$unique_image;
                                if (!empty($_FILES['image']['name'])) 
                                {
                                    // $image1=$image.rsplit('/', 1)[1]
                                    // echo($image1);
                                    // exit();
                                    $del_image='../../../certificate/'.$image1;   
                                    // echo($del_image);
                                    unlink($del_image);
                                    // exit();
                                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                        $image_path=$unique_image;
                                        //echo "<script>console.log('Image uploaded successfully $path' );</script>";
                                      }
                                    // $image_filename = move_uploaded_file($_FILES['image']['tmp_name'], $target)
                                }
                                else{
                                    $image_path = $image1;
                                }
                                //exit;
                                $query = "update certificates set certificateid = '".$cid."', courseid = '".$course_id."', coursename = '".$cname."',startdate = '".$sdate."',enddate = '".$edate."',duration = '".$duration."', cpath = '".$image_path."', certificatetype = '".$certificatetype."' where id='".$id."'";
                                $result_reg = $conn->prepare($query);
                        
                                if (!$result_reg->execute()) {         
                                    print_r($result_reg->errorInfo());
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;
                        
                        case "add_feedback":
                            $inspireid = $_POST["inspireid"];
							$name= $_POST['name'];
							$instution= $_POST['instution'];
							$email= $_POST['email'];
							$mobile= $_POST['mobile'];
							$place= $_POST['place'];
							$state= $_POST['state'];
							$comment= $_POST['comment'];

                            $selectQuery1="SELECT * from inspireid where inspireid='$inspireid'";
                            $stmt1 = $conn->prepare($selectQuery1);
                            $stmt1->execute();
                            $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                            $number_of_rows1 = $stmt1->rowCount();
							if($number_of_rows1 == 0){
								$selectQuery2="SELECT * from inspire_reg where inspire_id='$inspireid'";
								$stmt2 = $conn->prepare($selectQuery2);
								$stmt2->execute();
								$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
								$number_of_rows2 = $stmt2->rowCount();
								if($result2[0]['cource_certificate']==1){
									// 203 - Certificate Already Downloaded
									response(json($number_of_rows2, '203', '203', 1), '201');
									break;
								}
								$courseid = $result2[0]['cource_id'];
								$sql ="SELECT * FROM certificates WHERE courseid='$courseid'";
								$sql8 ="update inspire_reg SET cource_certificate=1 where inspire_id='".$inspireid."'";
							}
							else{
								$number_of_rows2 = 1;
								if($result1[0]['flag']==1){
									// 203 - Certificate Already Downloaded
									response(json($number_of_rows1, '203', '203', 1), '201');
									break;
									}
								$courseid = $result1[0]['courseid'];
								$sql ="SELECT * FROM certificates WHERE courseid='$courseid'";
								$sql8 ="update inspireid SET flag=1 where inspireid='".$inspireid."'";
							}
							if($number_of_rows2 == 0){
								// 202 - Invalid Inspire ID
								response(json($number_of_rows2, '202', '202', 1), '201');
								break;
							}
		
                            $stmt3 = $conn->prepare($sql);
                            $stmt3->execute();
                            $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
							$certificateid= $result3[0]['certificateid'];
							$coursename= $result3[0]['coursename'];
							$startdate= $result3[0]['startdate'];
							$enddate= $result3[0]['enddate'];
							$duration= $result3[0]['duration'];
							$cpath= $result3[0]['cpath'];
		
                            $stmt4 = $conn->prepare("SELECT * FROM feedback where cpath='$cpath'");
                            $stmt4->execute();
                            $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
							$number_of_rows4 = $stmt4->rowCount();
							$sno = $number_of_rows4+1;
		
							$name = urlencode($name);
							$instution = urlencode($instution);
							$email = urlencode($email);
		
							$sql5="INSERT INTO feedback (inspireid, sno, certificateid, name, institution, email, mobile, coursename, courseid,cpath, startdate, enddate, duration, flag, place, state, comment)  VALUES ('$inspireid', '$sno','$certificateid','$name','$instution','$email','$mobile','$coursename','$courseid','$cpath','$startdate','$enddate','$duration',0,'$place','$state','$comment')";
							$stmt5 = $conn->prepare($sql5);
							$stmt5->execute();
		                            
							$stmt6 = $conn->prepare("SELECT * FROM feedback where inspireid='$inspireid'order by createdate desc");
                            $stmt6->execute();
                            $result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
							$id = $result6[0]['id'];
		
							$curl = curl_init();
							curl_setopt_array($curl, array(
							  CURLOPT_URL => 'https://wikichennai.com/inspire/mail.php?id='.$id,
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
									
							$stmt7 = $conn->prepare("update feedback SET flag=1 where inspireid='".$inspireid."'");
                            $stmt7->execute();
                            $result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
									
							$stmt8 = $conn->prepare($sql8);
                            $stmt8->execute();
                            $result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
		
                            response(json($id, 'Success', '201', 1), '201');
                            break;
                        
                        case "update_feedback":
                            $inspireid = $_POST['inspireid'];
							$name= $_POST['name'];
							$instution= $_POST['instution'];
							$email= $_POST['email'];
							$mobile= $_POST['mobile'];
		
							$sql ="SELECT * from feedback where inspireid='$inspireid'";
                            $stmt1 = $conn->prepare($sql);
                            $stmt1->execute();
                            $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
							$count = $stmt1->rowCount();
							$courseid= $result1[0]['courseid'];
		
							if (strpos($inspireid, 'EDZ') !== false) {
								$sql2 = "SELECT * FROM certificates WHERE courseid='$courseid'";
							} else {
								$sql2 = "SELECT * FROM certificates WHERE courseid='$courseid'";
							};
                            $stmt2 = $conn->prepare($sql2);
                            $stmt2->execute();
                            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
							$number_of_rows2 = $stmt2->rowCount();
							$cpath= $result2[0]['cpath'];
		
							if($count>0){
								$sql3 = "UPDATE inspireid SET flag=0 WHERE inspireid='$inspireid'";
								$stmt3 = $conn->prepare($sql3);
								$stmt3->execute();
								$sql4 = "UPDATE feedback SET flag=0 WHERE inspireid='$inspireid'";
								$stmt4 = $conn->prepare($sql4);
								$stmt4->execute();
							}
							if($count==0)
							{
								// 202 - Fill the feedback first
								response(json($inspireid, 'Success', '202', 1), '201');
                            	break;
							}
		
							$name = urlencode($name);
							$instution = urlencode($instution);
							$email = urlencode($email);
		
							$sql5="UPDATE feedback SET name='$name',institution='$instution',email='$email', mobile='$mobile', cpath='$cpath' WHERE inspireid='$inspireid'";
							$stmt5 = $conn->prepare($sql5);
							$stmt5->execute();
		                            
							$stmt6 = $conn->prepare("SELECT * FROM feedback where inspireid='$inspireid'order by createdate desc");
                            $stmt6->execute();
                            $result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
							$id = $result6[0]['id'];
		
							$curl = curl_init();
							curl_setopt_array($curl, array(
							  CURLOPT_URL => 'https://wikichennai.com/inspire/mail.php?id='.$id,
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
									
							$stmt7 = $conn->prepare("update feedback SET flag=1 where inspireid='".$inspireid."'");
                            $stmt7->execute();
                            $result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
		
							if (strpos($inspireid, 'EDZ') !== false) {
								$sql8 = "UPDATE inspire_reg SET cource_certificate = 1 WHERE inspire_id = '" . $inspireid . "'";
							} else {
								$sql8 = "UPDATE inspireid SET flag = 1 WHERE inspireid = '" . $inspireid . "'";
							}
									
							$stmt8 = $conn->prepare($sql8);
                            $stmt8->execute();
                            $result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
		
                            response(json($sql2, 'Success', '201', 1), '201');
                            break;
                        
                        case "quiz_truncate":

                            $selectQuery="select image from(select question_img as image from inspire_quiz union select answer1_img as image from inspire_quiz union select answer2_img as image from inspire_quiz union select answer3_img as image from inspire_quiz union select answer4_img as image from inspire_quiz ) tt where image is not null";

                            // $baseQuery = "SELECT * FROM earn_users";
                            // $selectQuery = $baseQuery . " where email='" . $email . "'";
                            #DB Fetching#
                            $stmt = $conn->prepare($selectQuery);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $number_of_rows = $stmt->rowCount();
                            // $number_of_rows = $stmt->fetchColumn(); 
                            // echo($number_of_rows);
                            for($i=0;$i<$number_of_rows;$i++)
                            {
                                // echo($result[$i]['image']);
                                $del_image='../quiz_img/'.$result[$i]['image'];
                                // echo($del_image);
                                unlink($del_image);
                            }

                            // echo($result[0]['image']);
                            // exit();

                            
                            $query = "TRUNCATE TABLE inspire_quiz";
                            $result = $conn->prepare($query);
                            if (!$result->execute()) {         
                                print_r($result->errorInfo());
                            } else {
                                $value = array(
                                    "value" => '1',
                                );            
                            }
                            response(json($value, 'Delete Success', '201', 1), '201');
                            break;

                        case "quiz_add":

                            $q_flag=$_POST["q_flag"];
                            $answer1_flag=$_POST["a1_flag"];
                            $answer2_flag=$_POST["a2_flag"];
                            $answer3_flag=$_POST["a3_flag"];
                            $answer4_flag=$_POST["a4_flag"];
                            
                            if($q_flag==1)
                            { 
                                // echo($q_flag);
                                $image= $_FILES['image0']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image0 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image0;
                                if (move_uploaded_file($_FILES['image0']['tmp_name'], $target)) {
                                $question_img=$unique_image0;
                                $question = '';
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "q_flag" => $q_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }

                            }
                            else{
                                $question = $_POST["editor1"];
                                $question_img='';
                            }

                            if($answer1_flag==1)
                            { 
                                // echo($q_flag);
                                $image= $_FILES['image1']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image1 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image1;
                                if (move_uploaded_file($_FILES['image1']['tmp_name'], $target)) {
                                $answer1_img=$unique_image1;
                                $answer1 = '';
                                // echo($answer1_img);
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer1_flag" => $answer1_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }

                            }
                            else{
                                $answer1 = $_POST["editor2"];
                                $answer1_img='';

                            }

                            if($answer2_flag==1)
                            { 
                                // echo($q_flag);
                                $image= $_FILES['image2']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image2 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image2;
                                if (move_uploaded_file($_FILES['image2']['tmp_name'], $target)) {
                                $answer2_img=$unique_image2;
                                $answer2 = '';
                                // echo($answer2_img);

                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer2_flag" => $answer2_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }

                            }
                            else{
                                $answer2 = $_POST["editor3"];
                                $answer2_img='';

                            }

                            if($answer3_flag==1)
                            { 
                                // echo($q_flag);
                                $image= $_FILES['image3']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image3 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image3;
                                if (move_uploaded_file($_FILES['image3']['tmp_name'], $target)) {
                                $answer3_img=$unique_image3;
                                $answer3 = '';
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer3_flag" => $answer3_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }

                            }
                            else{
                                $answer3 = $_POST["editor4"];
                                $answer3_img='';

                            }

                            if($answer4_flag==1)
                            { 
                                // echo($q_flag);
                                $image= $_FILES['image4']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image4 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image4;
                                if (move_uploaded_file($_FILES['image4']['tmp_name'], $target)) {
                                $answer4_img=$unique_image4;
                                $answer4 = '';

                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer4_flag" => $answer4_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }

                            }
                            else{
                                $answer4 = $_POST["editor5"];
                                $answer4_img='';

                            }
                            $param2='0';
                            $param3='';
                            $param4='';

                            $query = "INSERT INTO inspire_quiz (qid,qno,question,question_img,q_flag,answer1,answer1_img,answer1_flag,answer2,answer2_img,answer2_flag,answer3,answer3_img,answer3_flag,answer4,answer4_img,answer4_flag,param1,param2,param3,param4) VALUES (:qid,:qno,:question,:question_img,:q_flag,:answer1,:answer1_img,:answer1_flag,:answer2,:answer2_img,:answer2_flag,:answer3,:answer3_img,:answer3_flag,:answer4,:answer4_img,:answer4_flag,:param1,:param2,:param3,:param4)";
                            
                                $result = $conn->prepare($query);
                                
                            
                                $result->bindParam(":qid", $_POST["qid"], PDO::PARAM_STR);
                                $result->bindParam(":qno", $_POST["qno"], PDO::PARAM_INT);
                                $result->bindParam(":question", $question, PDO::PARAM_STR);
                                $result->bindParam(":question_img", $question_img, PDO::PARAM_STR);           
                                $result->bindParam(":q_flag", $q_flag, PDO::PARAM_STR);
                                $result->bindParam(":answer1", $answer1, PDO::PARAM_STR);
                                $result->bindParam(":answer1_img", $answer1_img, PDO::PARAM_STR);
                                $result->bindParam(":answer1_flag", $answer1_flag, PDO::PARAM_STR);
                                $result->bindParam(":answer2", $answer2, PDO::PARAM_STR);
                                $result->bindParam(":answer2_img", $answer2_img, PDO::PARAM_STR);
                                $result->bindParam(":answer2_flag", $answer2_flag, PDO::PARAM_STR);
                                $result->bindParam(":answer3", $answer3, PDO::PARAM_STR);
                                $result->bindParam(":answer3_img", $answer3_img, PDO::PARAM_STR);
                                $result->bindParam(":answer3_flag", $answer3_flag, PDO::PARAM_STR);
                                $result->bindParam(":answer4", $answer4, PDO::PARAM_STR);
                                $result->bindParam(":answer4_img", $answer4_img, PDO::PARAM_STR);
                                $result->bindParam(":answer4_flag", $answer4_flag, PDO::PARAM_STR);
                                $result->bindParam(":param1", $_POST["ans"], PDO::PARAM_STR);
                                $result->bindParam(":param2", $param2, PDO::PARAM_STR);
                                $result->bindParam(":param3", $param3, PDO::PARAM_STR);
                                $result->bindParam(":param4", $param4, PDO::PARAM_STR);

                            if (!$result->execute()) {         
                                print_r($result->errorInfo());
                                
                            } else {
                                $value = array(
                                    "value" => '1',
                                );        
                                response(json($value, 'Insert Success', '201', 1), '201');

                            }
                            break;
                            case "quiz_delete":

                                if (isset($_POST["sno"])) {
                                    $sno = $_POST["sno"];
                                } elseif (isset($phpObject->sno)) {
                                    $sno = $phpObject->sno;
                                } 
                                else {
                                    $sno = null;
                                }
                        
                                $query = "update inspire_quiz set param2=1 where sno='".$sno."'";
                         
                                $result_reg = $conn->prepare($query);
                                //$result_reg->bindParam(":invoice_id",$invoice_id , PDO::PARAM_STR);
                                //$result_reg->bindParam(":delete_flag", 1, PDO::PARAM_INT);
                        
                                if (!$result_reg->execute()) {         
                                    print_r($result_reg->errorInfo());
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;
                        case "quiz_update":

                            $qno=$_POST["qno"];
                            $sno=$_POST["sno"];
                            $param1=$_POST["ans"];
                            $q_flag=$_POST["q_flag"];
                            $answer1_flag=$_POST["a1_flag"];
                            $answer2_flag=$_POST["a2_flag"];
                            $answer3_flag=$_POST["a3_flag"];
                            $answer4_flag=$_POST["a4_flag"];
                            $question_img1=$_POST["image0_1"];
                            $answer1_img1=$_POST["image1_1"];
                            $answer2_img1=$_POST["image2_1"];
                            $answer3_img1=$_POST["image3_1"];
                            $answer4_img1=$_POST["image4_1"];
                            
                            if($q_flag==1)
                            { 
                                if(!$_FILES['image0']['name']){
                                    $question_img=$question_img1;
                                    $question = '';
                                }
                                else{
                                $del_image='../quiz_img/'.$question_img1;
                                unlink($del_image);
                                $image= $_FILES['image0']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image0 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image0;
                                if (move_uploaded_file($_FILES['image0']['tmp_name'], $target)) {
                                $question_img=$unique_image0;
                                $question = '';
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "q_flag" => $q_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }
                            }
                            }
                            else{
                                $question = $_POST["editor1"];
                                $del_image='../quiz_img/'.$question_img1;
                                unlink($del_image);
                                $question_img='';
                            }

                            if($answer1_flag==1)
                            { 
                                if(!$_FILES['image1']['name']){
                                    $answer1_img=$answer1_img1;
                                    $answer1 = '';
                                }
                                else{
                                $del_image='../quiz_img/'.$answer1_img1;
                                unlink($del_image);
                                // echo($q_flag);
                                $image= $_FILES['image1']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image1 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image1;
                                if (move_uploaded_file($_FILES['image1']['tmp_name'], $target)) {
                                $answer1_img=$unique_image1;
                                $answer1 = '';
                                // echo($answer1_img);
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer1_flag" => $answer1_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }
                            }
                            }
                            else{
                                $answer1 = $_POST["editor2"];
                                $answer1_img='';
                                $del_image='../quiz_img/'.$answer1_img1;
                                unlink($del_image);

                            }

                            // echo($question_img);
                            // echo($question);

                            // echo($answer1_img);
                            // echo($answer1);
                            // exit();
                            
                            if($answer2_flag==1)
                            {  
                                if(!$_FILES['image2']['name']){
                                    $answer2_img=$answer2_img1;
                                    $answer2 = '';
                                }
                                else{
                                // echo($q_flag);
                                $image= $_FILES['image2']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image2 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image2;
                                if (move_uploaded_file($_FILES['image2']['tmp_name'], $target)) {
                                $answer2_img=$unique_image2;
                                $answer2 = '';
                                // echo($answer2_img);

                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer2_flag" => $answer2_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }
                            }
                            }
                            else{
                                $answer2 = $_POST["editor3"];
                                $answer2_img='';
                                $del_image='../quiz_img/'.$answer2_img1;
                                unlink($del_image);

                            }

                            if($answer3_flag==1)
                            { 
                                if(!$_FILES['image3']['name']){
                                    $answer3_img=$answer3_img1;
                                    $answer3 = '';
                                }
                                else{
                                // echo($q_flag);
                                $image= $_FILES['image3']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image3 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image3;
                                if (move_uploaded_file($_FILES['image3']['tmp_name'], $target)) {
                                $answer3_img=$unique_image3;
                                $answer3 = '';
                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer3_flag" => $answer3_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }
                            }
                            }
                            else{
                                $answer3 = $_POST["editor4"];
                                $answer3_img='';
                                $del_image='../quiz_img/'.$answer3_img1;
                                unlink($del_image);

                            }

                            if($answer4_flag==1)
                            { 
                                if(!$_FILES['image4']['name']){
                                    $answer4_img=$answer4_img1;
                                    $answer4 = '';
                                }
                                else{
                                // echo($q_flag);
                                $image= $_FILES['image4']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                $unique_image4 = substr(md5(mt_rand()), 0, 5).'.'.$file_ext;
                                $target = "../quiz_img/".$unique_image4;
                                if (move_uploaded_file($_FILES['image4']['tmp_name'], $target)) {
                                $answer4_img=$unique_image4;
                                $answer4 = '';

                                }else{
                                  $value = array(
                                    "value" => '2',
                                    "answer4_flag" => $answer4_flag,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                }
                            }
                            }
                            else{
                                $answer4 = $_POST["editor5"];
                                $answer4_img='';
                                $del_image='../quiz_img/'.$answer4_img1;
                                unlink($del_image);

                            }

                            $query = "update inspire_quiz set qno='".$qno."',question='".$question."',question_img='".$question_img."',q_flag='".$q_flag."',answer1='".$answer1."',answer1_img='".$answer1_img."',answer1_flag='".$answer1_flag."',answer2='".$answer2."',answer2_img='".$answer2_img."',answer2_flag='".$answer2_flag."',answer3='".$answer3."',answer3_img='".$answer3_img."',answer3_flag='".$answer3_flag."',answer4='".$answer4."',answer4_img='".$answer4_img."',answer4_flag='".$answer4_flag."',param1='".$param1."' where sno='".$sno."'";
                             
                                    $result_reg = $conn->prepare($query);
                                    //$result_reg->bindParam(":invoice_id",$invoice_id , PDO::PARAM_STR);
                                    //$result_reg->bindParam(":delete_flag", 1, PDO::PARAM_INT);
                            
                                    if (!$result_reg->execute()) {         
                                        print_r($result_reg->errorInfo());
                                    } else {
                                        $value = array(
                                            "value" => '1',
                                        );            
                                    }
                                    response(json($value, 'Update Success', '201', 1), '201');
                            break;

                            case "quiz_certificate_add":

                                $qid=$_POST["qid"];
                                // if(!$course_id){

                                if(!($_FILES['image']['name'])){
                                    $image_path = $_POST["image_path"];
                                } else{ 
                                $image= $_FILES['image']['name'];
                                $div = explode('.', $image);
                                $file_ext = strtolower(end($div));
                                // $unique_image = $course_id.'.'.$file_ext;
                                $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                $target = "../../../quiz_certificate/".$unique_image;
                            //    echo($target);
                                
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                //   $image_path="https://inspiress.in/certificate/".$unique_image;
                                $image_path=$unique_image;
                                //   echo "<script>console.log('Image uploaded successfully $image_path' );</script>";
                                }else{
                                  //echo "<script>console.log('Error' );</script>";
                                  $value = array(
                                    "value" => '2',
                                    "quiz_id" => $qid,
                                );        
                                response(json($value, 'Image Upload Failed', '201', 1), '201');
                                // exit();

                                }
                            }
                            $flag=0;
                                // exit();
                                $query = "INSERT INTO quiz_certificates (certificateid,quizid,quizname,cpath,flag,certificatetype) VALUES (:certificateid, :quizid, :quizname,:cpath, :flag,:certificatetype)";
                                    $result = $conn->prepare($query);
                                
                                    $result->bindParam(":certificateid", $_POST["cid"], PDO::PARAM_STR);
                                    $result->bindParam(":quizid", $_POST["qid"], PDO::PARAM_STR);
                                    $result->bindParam(":quizname", $_POST["qname"], PDO::PARAM_STR);           
                                    $result->bindParam(":cpath", $image_path, PDO::PARAM_STR);
                                    $result->bindParam(":flag", $flag, PDO::PARAM_INT);
                                    $result->bindParam(":certificatetype", $_POST["certificatetype"], PDO::PARAM_STR);
                                    // $result->bindParam(":createdate", $created, PDO::PARAM_STR);
                                if (!$result->execute()) {         
                                    print_r($result->errorInfo());
                                    
                                } else {
                                    $value = array(
                                        "value" => '1',
                                    );        
                                    response(json($value, 'Insert Success', '201', 1), '201');

                                }
                            // }
                                break;
                                case "quiz_certificate_update":

                                    $id = $_POST["qnum"];
                                    $cid = $_POST["cid"];
                                    $quiz_id = $_POST["quiz_id"];
                                    $flag = 0;
                                    $certificatetype = $_POST["certificatetype"];
                                    $image1 = $_POST["cpath"];
                                    $qname = $_POST["qname"];
                                    // echo($image1);
                                    $image= $_FILES['image']['name'];
                                    $div = explode('.', $image);
                                    $file_ext = strtolower(end($div));
                                    // $unique_image = $course_id.'.'.$file_ext;
                                    $unique_image = substr(md5(time()), 0, 5).'.'.$file_ext;
                                    $target = "../../../quiz_certificate/".$unique_image;
                                    if (!empty($_FILES['image']['name'])) 
                                    {
                                        // $image1=$image.rsplit('/', 1)[1]
                                        // echo($image1);
                                        // exit();
                                        $del_image='../../../quiz_certificate/'.$image1;   
                                        // echo($del_image);
                                        unlink($del_image);
                                        // exit();
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                            $image_path=$unique_image;
                                            //echo "<script>console.log('Image uploaded successfully $path' );</script>";
                                          }
                                        // $image_filename = move_uploaded_file($_FILES['image']['tmp_name'], $target)
                                    }
                                    else{
                                        $image_path = $image1;
                                    }
                                    //exit;
                                // $query = "INSERT INTO quiz_certificates (certificateid,quizid,quizname,cpath,flag,certificatetype) VALUES (:certificateid, :quizid, :quizname,:cpath, :flag,:certificatetype)";

                                    $query = "update quiz_certificates set certificateid = '".$cid."', quizname = '".$qname."', flag = '".$flag."', cpath = '".$image_path."', certificatetype = '".$certificatetype."' where id='".$id."'";
                                    $result_reg = $conn->prepare($query);
                            
                                    if (!$result_reg->execute()) {         
                                        print_r($result_reg->errorInfo());
                                    } else {
                                        $value = array(
                                            "value" => '1',
                                        );            
                                    }
                                    response(json($value, 'Update Success', '201', 1), '201');
                            break;
                            case "update_flag":

                                if (isset($_POST["inspireid"])) {
                                    $inspireid = $_POST["inspireid"];
                                } elseif (isset($phpObject->inspireid)) {
                                    $inspireid = $phpObject->inspireid;
                                } 
                                else {
                                    $inspireid = null;
                                }

                                // echo($id);
                                // exit();
                        
                                $query = "update feedback SET flag=1 where inspireid='".$inspireid."'";
                         
                                $result_reg = $conn->prepare($query);
                                //$result_reg->bindParam(":invoice_id",$invoice_id , PDO::PARAM_STR);
                                //$result_reg->bindParam(":delete_flag", 1, PDO::PARAM_INT);
                                // echo($query);
                                // exit();
                        
                                if (!$result_reg->execute()) {    

                                    print_r($result_reg->errorInfo());
                                } else {
                                    $query = "update inspireid SET flag=1 where inspireid='".$inspireid."'";
                         
                                    $result_reg = $conn->prepare($query);
                                    $result_reg->execute();

                                    $value = array(
                                        "value" => '1',
                                    );            
                                }
                                response(json($value, 'Update Success', '201', 1), '201');
                        break;

        default:
            http_response_code(400);
            echo "Bad Request";
        break;
}
