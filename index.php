<html>
<head>
    <title>CHRONOHEALTH</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    
    <style>
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
            background: #f8f9fa;
            color: #333;
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
        
        /* Registration container */
        .container.register {
            margin-top: 100px;
            margin-bottom: 50px;
            padding: 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }
        
        .register-left {
            background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            padding: 30px;
            text-align: center;
            color: white;
            position: relative;
            height: 100%;
            border-radius: 15px 0 0 15px;
        }
        
        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(41, 128, 185, 0.85);
            border-radius: 15px 0 0 15px;
        }
        
        .register-left img {
            position: relative;
            margin-top: 60px;
            width: 80px;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .register-left h3 {
            position: relative;
            margin-top: 30px;
            font-weight: 600;
            font-size: 24px;
        }
        
        .register-left p {
            position: relative;
            font-weight: 400;
            padding: 20px;
        }
        
        .register-right {
            padding: 40px;
            background: white;
            border-radius: 0 15px 15px 0;
        }
        
        .register-heading {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            font-weight: 600;
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
        
        .btnRegister {
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            background: var(--primary);
            color: white;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btnRegister:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Tab styling */
        .nav-tabs {
            border: none;
            margin-bottom: 30px;
            width: 100% !important;
        }
        
        .nav-tabs .nav-item {
            width: 33.33%;
        }
        
        .nav-tabs .nav-link {
            border: none;
            border-radius: 50px;
            padding: 12px 0;
            font-weight: 500;
            color: #555;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .nav-tabs .nav-link.active {
            color: white;
            background: var(--primary);
            border: none;
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            background: rgba(52, 152, 219, 0.1);
        }
        
        /* Radio buttons */
        .maxl {
            margin: 20px 0;
        }
        
        .radio {
            display: inline-block;
            margin-right: 15px;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
        }
        
        .radio input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        
        .radio span {
            position: relative;
            padding-left: 10px;
        }
        
        .radio span:before {
            content: '';
            position: absolute;
            left: -20px;
            top: 1px;
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .radio input[type="radio"]:checked + span:before {
            border-color: var(--primary);
        }
        
        .radio input[type="radio"]:checked + span:after {
            content: '';
            position: absolute;
            left: -16px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        /* Links */
        a {
            color: var(--primary);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        a:hover {
            color: var(--secondary);
            text-decoration: none;
        }
        
        /* Message span for password matching */
        #message {
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .container.register {
                margin-top: 70px;
            }
            
            .register-left, .register-right {
                border-radius: 15px;
                padding: 20px;
            }
            
            .register-left {
                margin-bottom: 30px;
            }
            
            .nav-tabs .nav-link {
                font-size: 14px;
                padding: 10px 5px;
            }
        }
    </style>

    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('cpassword').value) {
                document.getElementById('message').style.color = '#2ecc71';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#e74c3c';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };

        function checklen() {
            var pass1 = document.getElementById("password");  
            if(pass1.value.length < 6) {  
                alert("Password must be at least 6 characters long. Try again!");  
                return false;  
            }  
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#">
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

    <div class="container register">
        <div class="row">
            <div class="col-md-4 register-left">
                <img src="https://cdn-icons-png.flaticon.com/512/4320/4320371.png" alt="Healthcare Icon"/>
                <h3>Welcome</h3>
                <p>Your health is our priority. Join us today for quality healthcare services.</p>
            </div>
            <div class="col-md-8 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Receptionist</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Register as Patient</h3>
                        <form method="post" action="func2.php">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name *" name="fname" onkeydown="return alphaOnly(event);" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email *" name="email" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" id="password" name="password" onkeyup='check();' required/>
                                    </div>
                                    <div class="form-group">
                                        <div class="maxl">
                                            <label class="radio inline"> 
                                                <input type="radio" name="gender" value="Male" checked>
                                                <span> Male </span> 
                                            </label>
                                            <label class="radio inline"> 
                                                <input type="radio" name="gender" value="Female">
                                                <span>Female </span> 
                                            </label>
                                        </div>
                                        <a href="index1.php">Already have an account?</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name *" name="lname" onkeydown="return alphaOnly(event);" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" minlength="10" maxlength="10" name="contact" class="form-control" placeholder="Your Phone *" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password *" name="cpassword" onkeyup='check();' required/><span id='message'></span>
                                    </div>
                                    <input type="submit" class="btnRegister" name="patsub1" onclick="return checklen();" value="Register"/>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Login as Doctor</h3>
                        <form method="post" action="func1.php">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="User Name *" name="username3" onkeydown="return alphaOnly(event);" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password3" required/>
                                    </div>
                                    <input type="submit" class="btnRegister" name="docsub1" value="Login"/>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Login as Admin</h3>
                        <form method="post" action="func3.php">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="User Name *" name="username1" onkeydown="return alphaOnly(event);" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password2" required/>
                                    </div>
                                    <input type="submit" class="btnRegister" name="adsub" value="Login"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>