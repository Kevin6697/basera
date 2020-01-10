<?php
session_start();
require_once('Maincontroller.php');
$controller = new Maincontroller();

// $amt=$_SESSION['finalamt'];
// echo "<pre>";

/**
 * Created by PhpStorm.
 * User: Vaibhav Shah
 * Date: 2/24/2018
 * Time: 2:19 PM
 */
//echo "<pre>";

$id=$_POST['razorpay_payment_id'];
//print_r($_POST);
if(isset($id))
{
     $result = $controller->insertBooking();
    // $_SESSION['id']=$id;
     // print_r($result);
     if($result)
     {
        header('Location: thanks-page.php');
     }
     else
     {
        echo "<script>alert('Transaction Fail.....!!!')</script>";
     }

    //header("Location:checkout.php");
    // $stfid = $_SESSION['staffid'];
    // $date = $_SESSION['date'];
    // $time = $_SESSION['time'];

    //     $result1 = mysqli_query($conn, $insert);
    //     if ($result1) {
    //         echo "<script>alert('Data saved..!')</script>";
    //         $_SESSION['amt'] = $amount;
    //         header("Location:checkout.php");
    //         $_SESSION['finalamt'] = $offerprice;
    //     }



}
else
{
    echo "Unsucessfull";
    
}
die();
?>

