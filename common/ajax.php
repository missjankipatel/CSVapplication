<?php 
include_once("../classes/Managecsv.php");

$return = array("success" => 0,"error" => 1 ,"data" => "");

$action = $_POST["action"];
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$department = $_POST["department"];
$joiningdate = $_POST["joiningdate"];


$myfile = new Managecsv("../sample.csv");
if($action == "insert"){
    $data[] = array($fullname,$email,$phone,$department,$joiningdate);
    $myfile->writecsv($data);
    $return = array("success" => 1 ,"error" => 0 ,"data" => "");
    echo json_encode($return); exit;
}
else if($action == "update"){
    $data = array($fullname,$email,$phone,$department,$joiningdate);
    $rowid = $_POST["rowid"];
    $myfile->updatecsv($rowid,$data);
    $return = array("success" => 1 ,"error" => 0 ,"data" => "");
    echo json_encode($return); exit;
}else{
   $csvdata = $myfile->readcsv();
   $return = array("success" => 1 ,"error" => 0,"data" => $csvdata);
   echo json_encode($return); exit;
}
 header("Location: index.php");
?>
