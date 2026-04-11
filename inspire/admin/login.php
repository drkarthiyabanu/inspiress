<?php

// session_set_cookie_params(36000 * 24 * 7);

session_start();
// header('X-Frame-Options: DENY');
if (isset($_POST['Submit'])) {
//exit;
    $logins = array('admin' => 'ins@adm');

    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    if (isset($logins[$Username]) && $logins[$Username] == $Password) {
        $_SESSION['UserData']['Username'] = $Username;   
        $_SESSION['Password'] = $Password;    
        
        header("location:course/dashboard");
        exit;
    } else {
//         $msg = "<div class='alert alert-danger alert-dismissible show mt-2' role='alert'><strong><span style='color:red;'>Invalid Login Details</span></strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//         <span aria-hidden='true'>&times;</span>
//     </button>
// </div>";
$msg = '<div id="liveToast" class="position-fixed top-0 end-0 m-3 toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true"><div class="d-flex"><div class="toast-body">Invalid Login Details!!!</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>';
//  $msg = "<strong><span style='color:red;'>Invalid Login Details</span></strong>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inspire Solutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="https://inspiress.in/img/logo.png">
  <!-- CSS Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Libraries -->

  <!-- main CSS Files -->
  <link href="assets/css/main.css" rel="stylesheet">
  <!-- main CSS Files -->
  
</head>
<body>

<!-- Content Starts From Here -->

<main class="login-bg">
    
    <section class="section-register min-vh-100 d-flex flex-column align-items-center justify-content-center bg-grad-login" style="background: url(assets/images/bg-login.jpg)">
        <div class="container-fluid">
        <div id="error" class=""></div>
            <div class="row justify-content-center min-vh-50">
                
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center bg-white rounded">
                    <!-- <div class="d-flex justify-content-center py-4">
                      
                           
                            <span class="h4 d-lg-block theme-text-color">Shopping</span>
                       
                    </div> -->

                    <div class="card mb-3 border-0">
                        <div class="card-body">

                        <div class="pt-4 pb-2 text-center">
                            <img src="https://inspiress.in/img/logo.png" alt="Inspire SolutionsS" class="text-center">
                            <h5 class="h3 card-title text-center pb-0 bold-font">Inspire Solutions</h5>
                            <p class="text-center small text-muted">Enter your username & password to login</p>
                        </div>

                        <form class="row g-3" action="" method="post" name="Login_Form" >
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="Username" id="Username" placeholder="Username" required="" autofocus="">
                                <label for="Username">Username</label>
                                <!-- <div class="invalid-feedback">Please enter your username.</div> -->
                            </div>
                            <div class="form-floating mb-1">
                                <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required="" autofocus="">
                                <label for="Password">Password</label>
                                <!-- <div class="invalid-feedback">Please enter your password!</div> -->
                            </div>
                            

            
                            <div class="col-12">
                                
                                <button class="btn btn-primary w-100 theme-btn" name="Submit" type="submit">Login</button>
                                <?php if (isset($msg)) {echo $msg;} ?>
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

  <?php include_once 'includes/footer.inc.php'?>
  
  <script>
    // $(function(){
    //     var $user = $("#floatingInputUsername"),
    //     $pass = $("#floatingPassword");  
    //     $( "#login" ).click(function() {
    //     //alert( "Handler for .click() called." );
    

    //     if (($user.val() == 'admin' && $pass.val() == 'admin')) {
    //         location.href='dashboard';
    //     } else{
    //         $("#error").append('<div id="liveToast" class="position-fixed top-0 end-0 m-3 toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true"><div class="d-flex"><div class="toast-body">User Name and password is wrong!!!</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>');
            
    //        // location.href='login';
    //     }
    // });    
    // });
    </script>