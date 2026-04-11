<?php

//header("Content-type: application/json; charset=utf-8");
//date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../inspire/admin/config/database.php';
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
                      case "ins_quiz":

                                    if (isset($_POST["id"])) {
                                        $id = $_POST["id"];
                                    } elseif (isset($phpObject->id)) {
                                        $id = $phpObject->id;
                                    } 
                                    else {
                                        $id = null;
                                    }
                                    if (isset($_POST["count"])) {
                                        $count = $_POST["count"];
                                    } elseif (isset($phpObject->count)) {
                                        $count = $phpObject->count;
                                    } 
                                    else {
                                        $count = null;
                                    }
                                    if (isset($_POST["qid"])) {
                                        $qid = $_POST["qid"];
                                    } elseif (isset($phpObject->qid)) {
                                        $qid = $phpObject->qid;
                                    } 
                                    else {
                                        $qid = null;
                                    }
                                    $mark=0;
                                    $selectQuery="select * from inspire_quiz where qid='$qid'";
                                    $stmt = $conn->prepare($selectQuery);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $number_of_rows = $stmt->rowCount();
                                    $j=1;
                                    for($i=0;$i<$count;$i++){

                                        if(intval($_POST["q$j"]) == intval($result[$i]['param1']))
                                        {
                                            $mark=$mark+1;
                                        }
                                        $j=$j+1;
                                    }
                                    
                                    $mark = round(($mark/$count)*100);
                                    $query = "update quiz_record set mark ='".$mark."'  where id='".$id."'";
                                    // echo($query);
                                    // exit();
                             
                                    $result_reg = $conn->prepare($query);
                                    if (!$result_reg->execute()) {         
                                        print_r($result_reg->errorInfo());
                                    } else {
                                        if($mark>=40){
                                            // func1(); 
                                        // echo '<script type="text/javascript"> mail(); </script>'; 
                                        // function GetEbookTopics()
                                        //     {
                                                $curl = curl_init();

                                            curl_setopt_array($curl, array(
                                            CURLOPT_URL => "https://ythiz.com/api_other/ins_certi/quiz_mail.php?id=".$id,
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

                                            $value = array(
                                            "value" => '1',
                                        );   
                                        } else {
                                            $value = array(
                                                "value" => '2',
                                            ); 
                                        }         
                                    }
                                    response(json($value, 'Quiz Success', '201', 1), '201');
                            break;
        default:
            http_response_code(400);
            echo "Bad Request";
        break;
}
?>