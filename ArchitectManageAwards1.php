<!DOCTYPE html>
<html>

<?php
session_start();
require_once './db/dbConnection.php';
$_SESSION["id"] = 1;
    
    
    
    
$id = $_GET['id'];


$sql = "SELECT * FROM award WHERE id=" . $id . ";";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $category = $row["category"];
        $description = $row["description"];
        $title = $row["title"];
    }
}
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Architect WebSite | Awards</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" style="width:55px;height:55px;" class="img-circle" src="uploads/architect/<?php echo $_SESSION["id"];?>.jpeg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Priyantha Premathilake</strong>
                             </span>  </span> </a>
                        
                    </div>
                </li>
                <?php
                $sql = "select COUNT(post.id) as count from post left join project on project.id = post.project_id where post.seen = 0 and project.architect_id = ".$_SESSION["id"]." and post.byy = \"Client\";";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $count = $row["count"] ;
                    }
                }
                ?>
                
                <li>
                    <a href="notification.php"><i class="fa fa-globe"></i> <span class="nav-label">Notifications</span><span class="label label-warning pull-right"><?php echo $count;?></span></a>
                    
                </li>
                <li>
                    <a href="ongoingProjects.php"><i class="fa fa-flask"></i> <span class="nav-label">On Going Projects</span></a>
                </li>
                <li>
                    <a href="gallery.php"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span></a>
                    
                </li>
                <li class="active">
                    <a href="awards.php"><i class="fa fa-trophy"></i> <span class="nav-label">Manage Awards Received</span></a>
                    
                </li>
                <li>
                    <a href="completedProjects.php"><i class="fa fa-diamond"></i> <span class="nav-label">Completed Projects</span>  </a>
                </li>
                <li>
                    <a href="customer.php"><i class="fa fa-male"></i> <span class="nav-label">Customers</span></a>
                </li>
                <li>
                    <a href="consultant.php"><i class="fa fa-male"></i> <span class="nav-label">Consultants</span></a>
                </li>
                <li>
                    <a href="reports.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistics</span></a>
                    
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ArchitectEditProfile.php">Edit Profile</a></li>
                        <li><a href="settings.php">General Settings</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"></span>
                </li>
                

                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        
            
            </div>
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit Award</h2>
                    
                </div>
            </div>
            <br>
            <div>
            </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                
                
                
                
                
                
                
                
                
                
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group"><label class="col-lg-2 control-label">
                                Select:</label>
                    <select  id="awcat" name="category" >
                                <option class="form-control" <?php
                                if ($category == "Awards") {
                                    echo ' selected';
                                }
                                ?> value="Awards">Awards</option>
                                <option class="form-control" <?php
                                if ($category == "Academic Qualifications") {
                                    echo ' selected';
                                }
                                ?> value="Academic Qualifications">Academic Qualifications</option>
                                
                            </select>
                            </div>
                    <br><br>
                            <div class="form-group"><label class="col-lg-2 control-label">
                                Title:</label>
                    <textarea required id="awtitle" rows="1" name="title" cols="40"><?php echo $title; ?></textarea><br><br>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">
                                Description:</label>
                    <textarea required id="awdesc" rows="5" name="desc" cols="50"><?php echo $description; ?></textarea>
                            </div>
                    <br><br>
                    <div style="text-align: center;">
                        <button class="btn btn-sm btn-primary" type="button" onclick="saveAward()">Save</button>
                        
                        <button class="btn btn-sm btn-danger" type="button" onclick="deleteAward()">Remove</button>
                        <script>
                            function saveAward() {


                                var form = document.createElement("form");
                                form.setAttribute("method", "post");
                                form.setAttribute("hidden", "true");
                                form.setAttribute("action", "Projects/SaveAwards.php");




                                var aid = document.createElement("input");
                                aid.setAttribute("type", "hidden");
                                aid.setAttribute("name", "awid");
                                aid.setAttribute("value", <?php echo $id ?>);


                                form.appendChild(aid);



                                form.appendChild(document.getElementById("awcat"));
                                form.appendChild(document.getElementById("awtitle"));
                                form.appendChild(document.getElementById("awdesc"));



                                document.body.appendChild(form);
                                form.submit();
                            }

                            function deleteAward() {
                                if (confirm("Confirm delete Award ") == true) {


                                    var form = document.createElement("form");
                                    form.setAttribute("method", "post");
                                    form.setAttribute("action", "Projects/DeleteAwards.php");




                                    var aid = document.createElement("input");
                                    aid.setAttribute("type", "hidden");
                                    aid.setAttribute("name", "awid");
                                    aid.setAttribute("value", <?php echo $id ?>);


                                    form.appendChild(aid);




                                    document.body.appendChild(form);
                                    form.submit();
                                } else {

                                }

                            }
                        </script>
                        
                        </div>
                        </form>
                    </div>
            </div>
        </div>
        

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


</body>


</html>
