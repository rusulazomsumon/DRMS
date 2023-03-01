<?php 
  include("../connection.php");
	// include("../functions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>DRMS Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- @@@@@@@@@@@@@@@@@@@@Left Sidebar@@@@@@@@@@@@@@@@@@ -->
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
           <li class="nav-item">
              <a class="nav-link active" href="https://localhost/drms/">
                <span data-feather="home"></span>
                DRMS
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="jobsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Student
                </a>
                <div class="dropdown-menu" aria-labelledby="studentDropdown">
                    <a class="dropdown-item" href="../dashboard/add_student.php">Add Student</a>
                    <a class="dropdown-item" href="../dashboard/">All Student</a>
                    <a class="dropdown-item" href="#">Settings</a>
                </div>
            </li>
            <style>
            .dropdown:hover .dropdown-menu {
              display: block;
            }
            </style>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- @@@@@@@@@@@@@@@@@@@Main Content@@@@@@@@@@@@@@@@ -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Job Listing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Result</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Users</a>
            </li>
          </ul>
        </div>
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link" href="#">Hello, Admin</a>
          <a class="nav-item nav-link" href="#">Logout</a>
        </div>
      </nav>
