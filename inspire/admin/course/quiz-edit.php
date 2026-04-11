<?php include_once '../includes/header.inc.php' ?>
<?php include_once '../includes/menus.inc.php' ?>
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> -->
<script type="text/javascript" src="../assets/js/ck_editor_custom_init.js"></script>
<!-- Content Starts From Here -->
<?php
include_once '../config/database.php';
// $pdo = connect();

// $sth = $pdo->query("SELECT receiptno FROM invoice order by receiptno desc limit 1");
// $receiptno = $sth + 1;

$conn = connect();
$sno = $_GET["sno"];
// $sno = "1";
$query = "select * from inspire_quiz where sno='" . $sno . "' ";
$stmt = $conn->prepare($query);
// echo $query;
$stmt->execute();
$row = $stmt->fetch();

// print_r($row);
 
$question = preg_replace('/\s+/', ' ', trim($row['question']));
// echo $string;

?>
<style>
    input[type="radio"] {
        margin: 0 2px 0 15px !important;
    }

    input[type="checkbox"] {
        margin: 0 0px 0 20px !important;
    }

    input[type="file"] {
        padding-top: 17px !important;
        padding-left: 30px !important;
    }

    .enter_btn {
        margin-top: 10px;
        background: #ffa500;
        border-radius: 6px;
        color: white;
        border: transparent;
        font-size: 14px;
    }

    .btn_br {
        width: 8% !important;
        height: auto !important;
        font-size: 1rem !important;
        margin-top: 10px !important;
        border-radius: 20 !important;
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
                                    <a href="../dashboard">Home </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="../course/quiz">Quiz</a>
                                </li>
                                <li class="breadcrumb-item">New Quiz</li>
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
                <form class="row g-3 needs-validation" name="uploadImages" method="post" id="quiz_form" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body row">

                            <div class="col-lg-12">

                            <div class="col-lg-12">
                                    <div class="form-floating mb-1">
                                    <!-- <select class="form-control" id="qid" name="qid" placeholder="Quiz ID"  value="<?php echo $row['qid']; ?>" disabled></select> -->
                                <input type="text" class="form-control" name="qid" id="qid"  value="<?php echo $row['qid'];?>" disabled>
                                    <label for="qid">Quiz Id:</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-1">
                                        <!-- <input type="number" class="form-control" name="qno" id="qno" value="<?php echo $row['qno']; ?>" disabled> -->
                                        <input type="number" class="form-control" name="qno" id="qno" value="<?php echo $row['qno']; ?>">
                                        <label for="qno">Q.No:</label>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label style="margin-bottom:10px;"><b>Question</b></label>
                                    <div class="col-lg-12">
                                    <input type="radio" id="text" name="q_opt" value="0">
                                    <label for="text">Text</label>
                                    <input type="radio" id="img" name="q_opt" value="1">
                                    <label for="img">Image</label>
                                    </div>
                                </div>
                                <br>
                            <div class="col-lg-12">
                                    <div class="form-floating mb-1" id="q_img" >
                                        <input type="file" name="image[0]" class="form-control" id="image[0]" accept="image/*" >
                                        <!-- <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['question_img']; ?>" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a>   -->
                                        <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['question_img']; ?>" target="blank" class="btn btn-primary w-10 mb-0 ml-2" style="white-space: pre-wrap;float:right; font-size: 12px; background:#ffa500; border-color:#ffa500;margin-top:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="q_text">
                                        <textarea id="editor1" name="editor1" contenteditable="true" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body row">

                            <div class="col-lg-12">
                                <label style="margin-bottom:10px;"><b>Answer 1</b></label>
                                <br>
                                    <div class="col-lg-12">
                                    <input type="radio" id="a1_text_op" name="a1_opt" value="0">
                                    <label for="a1_text_op">Text</label>
                                    <input type="radio" id="a1_img_op" name="a1_opt" value="1">
                                    <label for="a1_img_op">Image</label>
                                    </div>
                                <br>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-1" id="a1_img">
                                        <input type="file" name="image[1]" class="form-control" id="image1" name="image1" accept="image/*">
                                        <!-- <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer1_img']; ?>" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                        <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer1_img']; ?>" target="blank" class="btn btn-primary w-10 mb-0 ml-2" style="white-space: pre-wrap;float:right; font-size: 12px; background:#ffa500; border-color:#ffa500;margin-top:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="a1_text">
                                        <textarea id="editor2" name="editor2" contenteditable="true" rows="4"></textarea>
                                    </div>
                                </div>
                                <br>
                                <label style="margin-bottom:10px;"><b>Answer 2</b></label>
                                <br>
                                    <div class="col-lg-12">
                                    <input type="radio" id="a2_text_op" name="a2_opt" value="0">
                                    <label for="a2_text_op">Text</label>
                                    <input type="radio" id="a2_img_op" name="a2_opt" value="1">
                                    <label for="a2_img_op">Image</label>
                                    </div>
                                <br>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-1" id="a2_img">
                                        <input type="file" name="image[]" class="form-control" id="image2" name="image2" accept="image/*">
                                        <!-- <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer2_img']; ?>" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                        <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer2_img']; ?>" target="blank" class="btn btn-primary w-10 mb-0 ml-2" style="white-space: pre-wrap;float:right; font-size: 12px; background:#ffa500; border-color:#ffa500;margin-top:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="a2_text">
                                        <textarea id="editor3" name="editor3" contenteditable="true" rows="4"></textarea>
                                    </div>
                                </div>
                                <br>
                                <label style="margin-bottom:10px;"><b>Answer 3</b></label>
                                <br>
                                <div class="col-lg-12">
                                <input type="radio" id="a3_text_op" name="a3_opt" value="0">
                                <label for="a3_text_op">Text</label>
                                <input type="radio" id="a3_img_op" name="a3_opt" value="1">
                                <label for="a3_img_op">Image</label>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-1" id="a3_img">
                                        <input type="file" name="image[]" class="form-control" id="image3" name="image3" accept="image/*">
                                        <!-- <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer3_img']; ?>" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                        <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer3_img']; ?>" target="blank" class="btn btn-primary w-10 mb-0 ml-2" style="white-space: pre-wrap;float:right; font-size: 12px; background:#ffa500; border-color:#ffa500;margin-top:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="a3_text">
                                        <textarea id="editor4" name="editor4" contenteditable="true" rows="4"></textarea>
                                    </div>
                                </div>
                                <br>
                                <label style="margin-bottom:10px;"><b>Answer 4</b></label>
                                <br>
                                <div class="col-lg-12">
                                <input type="radio" id="a4_text_op" name="a4_opt" value="0">
                                <label for="a4_text_op">Text</label>
                                <input type="radio" id="a4_img_op" name="a4_opt" value="1">
                                <label for="a4_img_op">Image</label>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-1" id="a4_img">
                                        <input type="file" name="image[]" class="form-control" id="image4" name="image4" accept="image/*">
                                        <!-- <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer4_img']; ?>" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                        <a href="https://inspiress.in/admin/quiz_img/<?php echo $row['answer4_img']; ?>" target="blank" class="btn btn-primary w-10 mb-0 ml-2" style="white-space: pre-wrap;float:right; font-size: 12px; background:#ffa500; border-color:#ffa500;margin-top:10px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="a4_text">
                                        <textarea id="editor5" name="editor5" contenteditable="true" rows="4"></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="col-lg-12">
                                <div class="form-floating mb-1">
                                <input  type="number" class="form-control" name="ans" id="ans" placeholder="Final Answer" value="<?php echo $row['param1']; ?>" required>
                                    
                                    <label for="ans">Final Answer:</label>
                                    
                                </div>
                                </div>
                                <br>
                                <span style="display:none">
                                <input type="text" id="image0_1" placeholder="" name="image0_1" value="<?php echo $row['question_img']; ?>" hidden></span>
                                <input type="text" id="image1_1" placeholder="" name="image1_1" value="<?php echo $row['answer1_img']; ?>" hidden></span>
                                <input type="text" id="image2_1" placeholder="" name="image2_1" value="<?php echo $row['answer2_img']; ?>" hidden></span>
                                <input type="text" id="image3_1" placeholder="" name="image3_1" value="<?php echo $row['answer3_img']; ?>" hidden></span>
                                <input type="text" id="image4_1" placeholder="" name="image4_1" value="<?php echo $row['answer4_img']; ?>" hidden></span>
                                <input type="text" id="sno" placeholder="" name="sno" value="<?php echo $row['sno']; ?>" hidden></span>
                                    <input type="text" id="key" placeholder="" name="key" value="quiz_update" hidden></span>


                                <div class="col-12">
                                    <input data-loading-text="Saving Invoice..." type="submit" id="submit" name="submit" value="Update" class="btn btn-primary theme-btn invoice-save-btm px-5">

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

<?php include_once '../includes/footer.inc.php' ?>

<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    
    // console.log(q);
                    for (name in CKEDITOR.instances) {
                        CKEDITOR.instances[name].destroy(true);
                    }
                    CKEDITOR.replace('editor1');
                    var editorElement = CKEDITOR.document.getById('editor1');
                    editorElement.setHtml('<?php echo (preg_replace('/\s+/', ' ', trim($row['question'])));?>');
                    CKEDITOR.replace('editor2');
                    var editorElement1 = CKEDITOR.document.getById('editor2');
                    editorElement1.setHtml('<?php echo (preg_replace('/\s+/', ' ', trim($row['answer1'])));?>');
                    CKEDITOR.replace('editor3');
                    var editorElement1 = CKEDITOR.document.getById('editor3');
                    editorElement1.setHtml('<?php echo (preg_replace('/\s+/', ' ', trim($row['answer2'])));?>');
                    CKEDITOR.replace('editor4');
                    var editorElement1 = CKEDITOR.document.getById('editor4');
                    editorElement1.setHtml('<?php echo (preg_replace('/\s+/', ' ', trim($row['answer3'])));?>');
                    CKEDITOR.replace('editor5');
                    var editorElement1 = CKEDITOR.document.getById('editor5');
                    editorElement1.setHtml('<?php echo (preg_replace('/\s+/', ' ', trim($row['answer4'])));?>');
                    
    </script>

<script>
    if(<?php echo $row['q_flag']?>==1){
        jQuery("#img").attr('checked', true);
    $("#q_text").attr("disabled",true);
    $("#q_text").attr("hidden",true);
    $("#q_img").attr("disabled",false);
    $("#q_img").attr("hidden",false);
    }
    else{
    jQuery("#text").attr('checked', true);
    $("#q_img").attr("disabled",true);
    $("#q_img").attr("hidden",true);
    $("#q_text").attr("hidden",false);
    $("#q_text").attr("disabled",false);
    }

    $('input[type=radio][name=q_opt]').change(function() {
        if(document.getElementById('text').checked == true) {   
        //  alert("Summer radio button is selected");   
    $("#q_img").attr("disabled",true);
    $("#q_img").attr("hidden",true);
    $("#q_text").attr("hidden",false);
    $("#q_text").attr("disabled",false);

} else {  
    $("#q_text").attr("disabled",true);
    $("#q_text").attr("hidden",true);
    $("#q_img").attr("disabled",false);
    $("#q_img").attr("hidden",false);
}  
});
</script>

<script>
    if(<?php echo $row['answer1_flag']?>==1){
        jQuery("#a1_img_op").attr('checked', true);
        $("#a1_text").attr("disabled",true);
    $("#a1_text").attr("hidden",true);
    $("#a1_img").attr("disabled",false);
    $("#a1_img").attr("hidden",false);
    }
    else{
    jQuery("#a1_text_op").attr('checked', true);
    $("#a1_img").attr("disabled",true);
    $("#a1_img").attr("hidden",true);
    $("#a1_text").attr("hidden",false);
    $("#a1_text").attr("disabled",false);
    }
    $('input[type=radio][name=a1_opt]').change(function() {
        if(document.getElementById('a1_text_op').checked == true) {   
        //  alert("Summer radio button is selected");   
    $("#a1_img").attr("disabled",true);
    $("#a1_img").attr("hidden",true);
    $("#a1_text").attr("hidden",false);
    $("#a1_text").attr("disabled",false);

} else {  
    $("#a1_text").attr("disabled",true);
    $("#a1_text").attr("hidden",true);
    $("#a1_img").attr("disabled",false);
    $("#a1_img").attr("hidden",false);
}  
});
</script>

<script>
        if(<?php echo $row['answer2_flag']?>==1){
        jQuery("#a2_img_op").attr('checked', true);
        $("#a2_text").attr("disabled",true);
    $("#a2_text").attr("hidden",true);
    $("#a2_img").attr("disabled",false);
    $("#a2_img").attr("hidden",false);
    }
    else{
        jQuery("#a2_text_op").attr('checked', true);
    $("#a2_img").attr("disabled",true);
    $("#a2_img").attr("hidden",true);
    $("#a2_text").attr("hidden",false);
    $("#a2_text").attr("disabled",false);
    }

    $('input[type=radio][name=a2_opt]').change(function() {
        if(document.getElementById('a2_text_op').checked == true) {   
        //  alert("Summer radio button is selected");   
    $("#a2_img").attr("disabled",true);
    $("#a2_img").attr("hidden",true);
    $("#a2_text").attr("hidden",false);
    $("#a2_text").attr("disabled",false);

} else {  
    $("#a2_text").attr("disabled",true);
    $("#a2_text").attr("hidden",true);
    $("#a2_img").attr("disabled",false);
    $("#a2_img").attr("hidden",false);
}  
});
</script>

<script>
    if(<?php echo $row['answer3_flag']?>==1){
    jQuery("#a3_img_op").attr('checked', true);
    $("#a3_text").attr("disabled",true);
    $("#a3_text").attr("hidden",true);
    $("#a3_img").attr("disabled",false);
    $("#a3_img").attr("hidden",false);
    }
    else{
        jQuery("#a3_text_op").attr('checked', true);
    $("#a3_img").attr("disabled",true);
    $("#a3_img").attr("hidden",true);
    $("#a3_text").attr("hidden",false);
    $("#a3_text").attr("disabled",false);
    }

    $('input[type=radio][name=a3_opt]').change(function() {
        if(document.getElementById('a3_text_op').checked == true) {   
        //  alert("Summer radio button is selected");   
    $("#a3_img").attr("disabled",true);
    $("#a3_img").attr("hidden",true);
    $("#a3_text").attr("hidden",false);
    $("#a3_text").attr("disabled",false);

} else {  
    $("#a3_text").attr("disabled",true);
    $("#a3_text").attr("hidden",true);
    $("#a3_img").attr("disabled",false);
    $("#a3_img").attr("hidden",false);
}  
});
</script>

<script>
    if(<?php echo $row['answer4_flag']?>==1){
    jQuery("#a4_img_op").attr('checked', true);
    $("#a4_text").attr("disabled",true);
    $("#a4_text").attr("hidden",true);
    $("#a4_img").attr("disabled",false);
    $("#a4_img").attr("hidden",false);
    }
    else{
        jQuery("#a4_text_op").attr('checked', true);
    $("#a4_img").attr("disabled",true);
    $("#a4_img").attr("hidden",true);
    $("#a4_text").attr("hidden",false);
    $("#a4_text").attr("disabled",false);
    }

    $('input[type=radio][name=a4_opt]').change(function() {
        if(document.getElementById('a4_text_op').checked == true) {   
        //  alert("Summer radio button is selected");   
    $("#a4_img").attr("disabled",true);
    $("#a4_img").attr("hidden",true);
    $("#a4_text").attr("hidden",false);
    $("#a4_text").attr("disabled",false);

} else {  
    $("#a4_text").attr("disabled",true);
    $("#a4_text").attr("hidden",true);
    $("#a4_img").attr("disabled",false);
    $("#a4_img").attr("hidden",false);
}  
});
</script>

<script>
    var siteUrl = "<?php echo getSiteLink(); ?>";
    var apiUrlPost = siteUrl + "admin/api/post";

    $('#quiz_form').submit(function(event) {
        event.preventDefault(); 
        
        var editorText1 = CKEDITOR.instances["editor1"].getData();
        var editorText2 = CKEDITOR.instances["editor2"].getData();
        var editorText3 = CKEDITOR.instances["editor3"].getData();
        var editorText4 = CKEDITOR.instances["editor4"].getData();
        var editorText5 = CKEDITOR.instances["editor5"].getData();

        var q_flag = $('input[name="q_opt"]:checked').val();
        var a1_flag = $('input[name="a1_opt"]:checked').val();
        var a2_flag = $('input[name="a2_opt"]:checked').val();
        var a3_flag = $('input[name="a3_opt"]:checked').val();
        var a4_flag = $('input[name="a4_opt"]:checked').val();

        var key = $('input[name="key"]').val();
        
        var qno = $('input[name="qno"]').val();
        
        var ans = $('input[name="ans"]').val();

        var sno = $('input[name="sno"]').val();


        var image0_1 = $('input[name="image0_1"]').val();
        var image1_1 = $('input[name="image1_1"]').val();
        var image2_1 = $('input[name="image2_1"]').val();
        var image3_1 = $('input[name="image3_1"]').val();
        var image4_1 = $('input[name="image4_1"]').val();


        // if (editorText1 === "") {
        //     if(!image[0]){
        //     alert('Content Required');
            
        //     return;
        //     }
        // }

        var formData = new FormData();

        formData.append("key", key);
        formData.append("qno", qno);
        formData.append("ans", ans);
        formData.append("sno", sno);

        formData.append("image0_1", image0_1);
        formData.append("image1_1", image1_1);
        formData.append("image2_1", image2_1);
        formData.append("image3_1", image3_1);
        formData.append("image4_1", image4_1);

        
        formData.append("q_flag", q_flag);
        formData.append("a1_flag", a1_flag);
        formData.append("a2_flag", a2_flag);
        formData.append("a3_flag", a3_flag);
        formData.append("a4_flag", a4_flag);

        $.each($("input[type=file]"), function(i, obj) {
            $.each(obj.files, function(j, file) {
                formData.append('image' + i , file);
            })
        });

        formData.append("editor1", editorText1);
        formData.append("editor2", editorText2);
        formData.append("editor3", editorText3);
        formData.append("editor4", editorText4);
        formData.append("editor5", editorText5);

        $("#submit").attr("disabled", true);

        $.ajax({
            type: 'POST',
            url: apiUrlPost,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.result.value == 1) {
                    alert("Question Added Successfully !");
                    window.location.href = siteUrl + 'admin/course/quiz'
                } else if (response.result.value == 2) {
                    alert("Image Upload Failed... Retry Again!");
                } else {
                    alert("Contact Admin - Course Not Created !");
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
    initSample();

    CKEDITOR.editorConfig = function(config) {
        CKEDITOR.config.allowedContent = true;
        config.toolbarCanCollapse = true;
    };
    var configShared = {
            startupOutlineBlocks: false,
            scayt_autoStartup: true,
            // etc.
        },
        config1 = CKEDITOR.tools.prototypedCopy(configShared),
        config2 = CKEDITOR.tools.prototypedCopy(configShared),
        config3 = CKEDITOR.tools.prototypedCopy(configShared),
        config4 = CKEDITOR.tools.prototypedCopy(configShared),
        config5 = CKEDITOR.tools.prototypedCopy(configShared);
    // config1.height = 100;
    // config2.height = 200;

    CKEDITOR.replace('editor1', config1);
    CKEDITOR.replace('editor2', config2);
    CKEDITOR.replace('editor3', config3);
    CKEDITOR.replace('editor4', config4);
    CKEDITOR.replace('editor5', config5);
</script>