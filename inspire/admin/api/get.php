<?php
###########################################################################
#
# NAME:  API
#
# COMMENT:  Get Value and Perform the operation
#
# VERSION HISTORY:
#
###########################################################################

date_default_timezone_set('Asia/Kolkata');
include_once '../config/database.php';
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
# Create connection

$method = $_GET['method'];
// echo($method);
// exit();

#Function to Fetch data from DB#
function dbFetch($fetchQuery)
{
    $conn = connect();
    #DB Fetching#
    $stmt = $conn->prepare($fetchQuery);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultarray = [];

    foreach ($result as $row) {
        $resultarray[] = $row;
    }
    echo json_encode(utf8ize($resultarray));
    #return $resultarray;
}

function dbFetchName($fetchQuery)
{
    $conn = connect();
    #DB Fetching#
    $stmt = $conn->prepare($fetchQuery);
    $stmt->execute();
    $result=$stmt->fetchColumn();
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $resultarray = [];

    // foreach ($result as $row) {
    //     $resultarray[] = $row;
    // }
    // echo json_encode(utf8ize($resultarray));
    echo $result;
}


function utf8ize($d)
{
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string($d)) {
        return utf8_encode($d);
    }
    return $d;
}

switch ($method) {


        case "course_list":
            $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
            $baseQuery = "select * from inspire_courselist";
            if ($course_id == null) 
                        $selectQuery = $baseQuery . " where delete_flag !=1 or delete_flag is null order by course_id desc";                        
                 else 
                        $selectQuery = $baseQuery . " where delete_flag !=1 or delete_flag is null and course_id='" . $course_id . "' ";                                        
                dbFetch($selectQuery);                
            break;


        case "member_list":
              // echo($method);
            $member_id = isset($_GET['$member_id']) ? $_GET['$member_id'] : null;
            $baseQuery = "select * from inspire_reg";
            if ($member_id == null) 
                        $selectQuery = $baseQuery . " where delete_flag !=1 or delete_flag is null order by id desc";                        
                 else 
                        $selectQuery = $baseQuery . " where delete_flag !=1 or delete_flag is null and id='" . $member_id . "' ";                                      
                dbFetch($selectQuery);                
            break;

            case "quiz_list":
                // echo($method);
                $sno = isset($_GET['sno']) ? $_GET['sno'] : null;
                $baseQuery = "select * from inspire_quiz";
                if ($sno == null) 
                            $selectQuery = $baseQuery. " where param2=0 ";                        
                     else 
                            $selectQuery = $baseQuery . " where param2=0 and sno='" . $sno . "' ";         
                            // echo                               
                    dbFetch($selectQuery);                
                break;

            case "feedback_list":
                $selectQuery = "select * from feedback order by id desc";                                        
                    dbFetch($selectQuery);                
            break;
            
            case "quiz_clist":
                $selectQuery = "select * from quiz_record order by id desc";                                        
                    dbFetch($selectQuery);                
            break;

            case "certificate_list":
                $selectQuery = "select * from certificates where flag = 0 order by id desc";                                        
                    dbFetch($selectQuery);                
            break;

            case "gallery_list":
                $selectQuery = "select * from gallery where iflag = 0 order by id desc";                                        
                    dbFetch($selectQuery);                
            break;

            case "quiz_certificate_list":
                $selectQuery = "select * from quiz_certificates where flag = 0 order by id desc";    
                // echo($selectQuery);                                    
                    dbFetch($selectQuery);                
            break;

            case "inspireid_list":
                $selectQuery = "select * from inspireid order by id desc";                                        
                    dbFetch($selectQuery);                
            break;

                // case "update_flag":
                //     $selectQuery = "select * from inspireid order by id desc";                                        
                //         dbFetch($selectQuery);                
                // break;

            case "test":
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $baseQuery = "select * from inspireid";
                if ($id == null) 
                    $selectQuery = $baseQuery;                        
                else 
                    $selectQuery = $baseQuery . " where id='" . $id . "' ";                                        
                    dbFetch($selectQuery);                
                break;

            case "verify":
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $baseQuery = "SELECT * FROM feedback";
                $selectQuery = $baseQuery . " where id='" . $id . "' or inspireid='" . $id . "' ";                                        			//echo($selectQuery);
                    dbFetch($selectQuery);                
                break;  
                    
            case "get_cid":
                // $id = isset($_GET['id']) ? $_GET['id'] : null;
                $baseQuery = "SELECT * FROM certificates";
                // $selectQuery = $baseQuery . " where id='" . $id . "' ";                                        
                    dbFetch($baseQuery);                
                break; 

            case "get_qid":
                    // $id = isset($_GET['id']) ? $_GET['id'] : null;
                    $baseQuery = "SELECT * FROM quiz_certificates where flag='0' order by createdate desc limit 1";
                    // $selectQuery = $baseQuery . " where id='" . $id . "' ";       
                    // echo($baseQuery);                                 
                        dbFetch($baseQuery);                
                    break; 

            case "get_info":
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $baseQuery = "SELECT * FROM feedback";
                $selectQuery = $baseQuery . " where id='" . $id . "' ";
                // echo($selectQuery);                                        
                    dbFetch($selectQuery);                
                break;   

            case "get_intern_info":
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $baseQuery = "SELECT r.*,c.course_id,c.title, c.duration,c.sdate,c.edate,c.stime,c.etime, c.image FROM `inspire_reg` r join inspire_courselist c on r.cource_id= c.course_id";
                $selectQuery = $baseQuery . " where r.inspire_id='" . $id . "' ";
                //echo($selectQuery);                                        
                    dbFetch($selectQuery);                
                break;    
                
                case "get_quizinfo":
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    $baseQuery = "SELECT * FROM quiz_record";
                    $selectQuery = $baseQuery . " where id='" . $id . "' ";
                    // echo($selectQuery);                                        
                        dbFetch($selectQuery);                
                    break;    

               //End                     
    default:
        http_response_code(400);
        echo "Bad Request";
        break;
}
