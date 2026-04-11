<?php
//include_once 'config/database.php';
ob_start();
session_start();


if(!isset($_SESSION['UserData']['Username'])|| $_SESSION['UserData']['Username']==null)
{
  header("location:https://edinztech.com/inspire/admin/login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin - Inspire Solutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="https://edinztech.com/assets/img/inspire.png">
  <!-- CSS Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link type="text/css" rel="stylesheet" href="https://edinztech.com/inspire/admin/assets/css/jsgrid/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://edinztech.com/inspire/admin/assets/css/jsgrid/jsgrid-theme.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <!-- CSS Libraries -->

  <!-- Custom CSS Files -->
  <link href="https://edinztech.com/inspire/admin/assets/css/style.css" rel="stylesheet">
  <link href="https://edinztech.com/inspire/admin/assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

  <!-- Custom CSS Files -->
  <style>
    #main.main .pagetitle{
      justify-content: space-between;
    }
    @media(max-width: 991px){
      body{
        overflow: initial;
      }
      #main .section{
        height: auto;
      }
      .jsgrid-table{
      table-layout: initial !important;
    }
    }
    
  </style>

</head>
<body>

<!-- Header Section Starts-->
<header id="header" class="header fixed-top d-flex align-items-center">

    <!-- Admin Logo Starts -->
    <div class="d-flex align-items-center justify-content-between">
      <span class="iconify toggle-sidebar-btn pr-3" data-icon="clarity:bars-line"></span>
        <div class="d-flex align-items-center ms-3">
          <!-- <img src="" alt=""> -->
          <svg xmlns="http://www.w3.org/2000/svg" class="text-animation ">
                            
                                                       
                            <filter id="motion-blur-filter" filterUnits="userSpaceOnUse">
                                <feGaussianBlur stdDeviation="100 0"></feGaussianBlur>
                            </filter>
                        </svg>
          <span class="theme-text-color" filter-content="S" style="color:orange">Insipre Admin</span>
        </div>
      
    </div>
    <!-- Admin Logo Ends -->

    <!-- Header Right Side starts-->
    <nav class="header-nav ms-auto">
        <ul class="list-group list-group-flush">
          <li class="list-group-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="iconify profile-icon" data-icon="gg:profile"></span>
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['UserData']['Username'] ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">

              <li>
                <a class="dropdown-item d-flex align-items-center" href="login">
                  <span class="iconify signout-icon" data-icon="akar-icons:sign-out"></span>
                  <span class="text-signout">Sign Out</span>
                </a>
              </li>

            </ul>
          </li>
        </ul>
    </nav>
    <!-- Header Right Side Ends-->

</header>
<!-- Header Section Ends-->