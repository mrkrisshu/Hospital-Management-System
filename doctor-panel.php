<!DOCTYPE html>
<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","zappeysfc","myhmsdb");
$doctor = $_SESSION['dname'];

if(isset($_GET['cancel'])) {
    $query=mysqli_query($con,"UPDATE appointmenttb SET doctorStatus='0' WHERE ID = '".$_GET['ID']."'");
    if($query) {
        echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Doctor Dashboard - CHRONOHEALTH</title>
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding-top: 60px;
        }
        
        .navbar {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .bg-primary {
            background: linear-gradient(135deg, #3931af 0%, #00c6ff 100%) !important;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand svg {
            margin-right: 10px;
            filter: drop-shadow(0px 0px 3px rgba(255,255,255,0.3));
        }
        
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background: linear-gradient(135deg, #3931af 0%, #00c6ff 100%);
            border-color: #3931af;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .list-group-item {
            border-radius: 5px !important;
            margin-bottom: 5px;
            border: 1px solid rgba(0,0,0,0.125);
            transition: all 0.3s ease;
        }
        
        .list-group-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin: 15px;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 20px rgba(0,0,0,0.15);
        }
        
        .card-img-container {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f5f9;
            padding: 20px;
        }
        
        .card-body {
            text-align: center;
            padding: 1.5rem;
        }
        
        .card-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #3931af;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3931af 0%, #00c6ff 100%);
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            box-shadow: 0 4px 6px rgba(57, 49, 175, 0.2);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(57, 49, 175, 0.3);
            background: linear-gradient(135deg, #322b95 0%, #00b8eb 100%);
        }
        
        .btn-danger {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
        }
        
        .btn-success {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
        }
        
        .welcome-header {
            text-align: center;
            color: #3931af;
            margin-bottom: 30px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
        }
        
        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            background-color: white;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #3931af 0%, #00c6ff 100%);
            color: white;
            border: none;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0, 198, 255, 0.05);
        }
        
        .form-control {
            border-radius: 50px;
            padding-left: 20px;
        }
        
        #inputbtn {
            border-radius: 50px;
            padding: 8px 20px;
        }
        
        .dashboard-container {
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 25px;
        }
        
        .badge {
            padding: 8px 12px;
            border-radius: 50px;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .card {
                margin: 10px 5px;
            }
            
            .table {
                font-size: 0.9rem;
            }
        }
        
        .hospital-icon {
            width: 35px;
            height: 35px;
        }
        
        .card-icon {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#">
            <svg class="hospital-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 2H5C3.89543 2 3 2.89543 3 4V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V4C21 2.89543 20.1046 2 19 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 8V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 12H16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            CHRONOHEALTH
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
                <input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
            </form>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top:50px;">
        <h3 class="welcome-header">Welcome Dr. <?php echo $_SESSION['dname'] ?></h3>
        <div class="row">
            <div class="col-md-3" style="margin-top: 3%;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">
                        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                    </a>
                    <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">
                        <i class="fa fa-calendar" aria-hidden="true"></i> Appointments
                    </a>
                    <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">
                        <i class="fa fa-list-alt" aria-hidden="true"></i> Prescription List
                    </a>
                </div>
            </div>
            <div class="col-md-9" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active dashboard-container" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <svg class="card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="4" width="18" height="18" rx="2" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V6" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 2V6" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3 10H21" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 14H8.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 14H12.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 14H16.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 18H8.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 18H12.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 18H16.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">View Appointments</h5>
                                            <a href="#list-app" onclick="document.querySelector('#list-app-list').click();" class="btn btn-primary">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Appointment List
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <svg class="card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13 2V9H20" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 13H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 17H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 9H9H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Prescriptions</h5>
                                            <a href="#list-pres" onclick="document.querySelector('#list-pres-list').click();" class="btn btn-primary">
                                                <i class="fa fa-list-alt" aria-hidden="true"></i> Prescription List
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <svg class="card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M22 4L12 14.01L9 11.01" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Patient Dashboard</h5>
                                            <a href="enter_vitals.php" class="btn btn-primary">
                                                <i class="fa fa-user-md" aria-hidden="true"></i> Patient Dashboard
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <svg class="card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 2V8H20" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 13H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 17H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 9H8" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Summary Reports</h5>
                                            <a href="handoff_summary.php" class="btn btn-primary">
                                                <i class="fa fa-file-text" aria-hidden="true"></i> View Summary
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img-container">
                                            <svg class="card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="#3931af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <circle cx="17" cy="5" r="4" fill="#FF6B6B" stroke="#3931af"/>
                                            </svg>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Smart Alerts</h5>
                                            <a href="smart_alerts.php" class="btn btn-primary">
                                                <i class="fa fa-bell" aria-hidden="true"></i> View Alerts
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade dashboard-container" id="list-app" role="tabpanel" aria-labelledby="list-app-list">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Appointment ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Prescribe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = "SELECT pid, ID, fname, lname, gender, email, contact, appdate, apptime, userStatus, doctorStatus FROM appointmenttb WHERE doctor='$doctor';";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['pid'];?></td>
                                            <td><?php echo $row['ID'];?></td>
                                            <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
                                            <td><?php echo $row['gender'];?></td>
                                            <td><?php echo $row['contact'];?></td>
                                            <td><?php echo $row['appdate'] . "<br>" . $row['apptime'];?></td>
                                            <td>
                                            <div style="display: flex; gap: 20px; margin-top: 30px;">
  

    

                                                <?php 
                                                if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                    echo "<span class='badge badge-success'>Active</span>";
                                                } elseif (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                                                    echo "<span class='badge badge-warning'>Patient Cancelled</span>";
                                                } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                    echo "<span class='badge badge-danger'>Doctor Cancelled</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                                                    <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                                                       onClick="return confirm('Are you sure you want to cancel this appointment?')"
                                                       title="Cancel Appointment"><button class="btn btn-danger">
                                                        <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                                    </button></a>
                                                <?php } else {
                                                    echo "<span class='badge badge-secondary'>Cancelled</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                                                    <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>&apptime=<?php echo $row['apptime']?>" title="Prescribe">
                                                        <button class="btn btn-success">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Prescribe
                                                        </button>
                                                    </a>
                                                <?php } else {
                                                    echo "-";
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade dashboard-container" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Appointment ID</th>
                                        <th scope="col">Appointment Date & Time</th>
                                        <th scope="col">Disease</th>
                                        <th scope="col">Allergy</th>
                                        <th scope="col">Prescription</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = "SELECT pid, fname, lname, ID, appdate, apptime, disease, allergy, prescription FROM prestb WHERE doctor='$doctor';";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['pid'];?></td>
                                            <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
                                            <td><?php echo $row['ID'];?></td>
                                            <td><?php echo $row['appdate'] . "<br>" . $row['apptime'];?></td>
                                            <td><?php echo $row['disease'];?></td>
                                            <td><?php echo $row['allergy'];?></td>
                                            <td><?php echo $row['prescription'];?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>
</html>