<?php


session_start();
require_once '../db/dbConnection.php';
$_SESSION["id"] = 1;

$category = $_POST['category'];
$pdate = $_POST['pdate'];
$location = $_POST['location'];
$status = "Active";
$url = "";
$description = $_POST['description'];
$progress = "2";
$estimated_duration = $_POST['estimated_duration'];
$estimated_cost = $_POST['estimated_cost'];
$city = $_POST['city'];
$title = $_POST['title'];
$priority = $_POST['priority'];

$customer_id = $cusid;                              
$architect_id = $_SESSION["id"];
$id = $_POST["id"];

   
        //echo "test";
        $sql = "UPDATE PROJECT SET category='$category' , priority='$priority' , pdate='$pdate' , location='$location' , description='$description' ,   estimated_duration='$estimated_duration' , estimated_cost='$estimated_cost' , city='$city' , title='$title' where id='$id'" ;
        if (mysqli_query($conn, $sql)) {
            echo "<script> alert('Project Details Updated'); </script>";
            echo "<script> window.location.href='../FullProjectDetails.php?id=".$id."'; </script>";
        } else {
            echo "<script> alert('Update Failed'); </script>";
            echo "<script> window.location.href='../FullProjectDetails.php?id=".$id."'; </script>";
        }
        //header('Location: index.php');
        //$duplicate = false;
  



?>