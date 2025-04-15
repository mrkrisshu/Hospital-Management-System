<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    
    <style type="text/css">
      :root {
        --primary: #3498db;
        --secondary: #2980b9;
        --accent: #1abc9c;
        --light: #f9f9f9;
        --dark: #2c3e50;
        --danger: #e74c3c;
        --success: #2ecc71;
      }
    
      body {
        font-family: 'Montserrat', sans-serif;
        background-image: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        background-size: cover;
        color: #34495E;
      }
      
      /* Navbar styling */
      #mainNav {
        background-color: var(--primary);
        background-image: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 15px 0;
        transition: all 0.3s ease;
      }
      
      #mainNav .navbar-brand {
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
      }
      
      #mainNav .navbar-brand:hover {
        transform: translateY(-2px);
      }
      
      #mainNav .nav-link {
        color: rgba(255,255,255,0.9) !important;
        font-weight: 500;
        padding: 10px 15px;
        transition: all 0.3s ease;
        position: relative;
      }
      
      #mainNav .nav-link:hover {
        color: white !important;
        transform: translateY(-2px);
      }
      
      #mainNav .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 15px;
        background-color: white;
        transition: width 0.3s ease;
      }
      
      #mainNav .nav-link:hover::after {
        width: calc(100% - 30px);
      }
      
      /* Card styling */
      .card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 20px;
        transition: all 0.3s ease;
      }
      
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
      }
      
      .card-body {
        padding: 30px;
      }
      
      /* Form styling */
      .form-control {
        border-radius: 50px;
        padding: 12px 20px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
        box-shadow: none;
      }
      
      .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
      }
      
      /* Button styling */
      #inputbtn {
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        background: var(--primary);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      
      #inputbtn:hover {
        background: var(--secondary);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      
      /* Animation */
      @keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-15px); }
      }
      
      .animated-image {
        animation: mover 2s infinite alternate;
      }
      
      /* Welcome text */
      .welcome-text {
        color: white;
        margin-top: 20px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0,0,0,0.2);
      }
      
      /* Icon styling */
      .fa-hospital-o {
        color: var(--primary);
        margin-bottom: 15px;
        transition: all 0.3s ease;
      }
      
      .card:hover .fa-hospital-o {
        transform: scale(1.1);
      }
      
      /* Layout adjustments */
      .container-fluid {
        padding-top: 100px;
        padding-bottom: 60px;
      }
      
      /* Image container */
      .healthcare-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
      }
      
      .healthcare-image {
        max-width: 380px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      }
      
      /* Responsive adjustments */
      @media (max-width: 768px) {
        .col-md-7 {
          padding-left: 15px !important;
          text-align: center;
        }
        
        .col-md-4 {
          right: 0 !important;
          margin: 0 auto !important;
        }
        
        .healthcare-image {
          max-width: 280px;
          margin: 0 auto;
        }
        
        .healthcare-image-container {
          margin-top: 30px;
        }
      }
    </style>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">
          <h4><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp; CHRONOHEALTH</h4>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php"><h6>HOME</h6></a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="services.html"><h6>ABOUT US</h6></a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="contact.html"><h6>CONTACT</h6></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7" style="padding-left: 100px;">
          <div class="healthcare-image-container">
            <img src="https://img.freepik.com/free-vector/doctor-nurse-giving-medical-care-patient-hospital-healthcare-workers-cartoon-characters_1150-39192.jpg" alt="Healthcare Professional" class="healthcare-image animated-image">
          </div>
          <div class="welcome-text text-center mt-4">
            <h3>Your Health Is Our Priority</h3>
            <p>Expert care when you need it most.</p>
          </div>
        </div>

        <div class="col-md-4" style="margin-top: 5%; right: 8%">
          <div class="card">
            <div class="card-body">
              <center>
                <i class="fa fa-user-md fa-3x" aria-hidden="true" style="color: var(--primary);"></i>
                <h3 style="margin-top: 10%; font-weight: 600; color: var(--dark);">Patient Login</h3>
                <form class="form-group" method="POST" action="func.php">
                  <div class="row" style="margin-top: 10%">
                    <div class="col-md-4">
                      <label style="font-weight: 500;">Email-ID: </label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="email" class="form-control" placeholder="Enter your email" required/>
                    </div>
                    
                    <div class="col-md-4" style="margin-top: 8%">
                      <label style="font-weight: 500;">Password: </label>
                    </div>
                    <div class="col-md-8" style="margin-top: 8%">
                      <input type="password" class="form-control" name="password2" placeholder="Enter your password" required/>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12" style="margin-top: 10%; text-align: center;">
                      <input type="submit" id="inputbtn" name="patsub" value="Login" class="btn">
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12" style="margin-top: 10%; text-align: center;">
                      <a href="index.php" style="color: var(--primary); text-decoration: none; font-size: 14px;">
                        Not registered? Sign up here
                      </a>
                    </div>
                  </div>
                </form>
              </center>
            </div>
          </div>
          
          <!-- Additional featured service -->
          <div class="card mt-4">
            <div class="card-body p-3">
              <div class="d-flex align-items-center">
                <img src="https://img.freepik.com/free-vector/doctors-concept-illustration_114360-1515.jpg" alt="Online Consultation" style="width: 60px; height: 60px; border-radius: 10px;">
                <div class="ml-3">
                  <h6 style="margin-bottom: 5px; font-weight: 600;">Online Consultation</h6>
                  <p style="font-size: 13px; margin-bottom: 0;">Connect with doctors from home</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>