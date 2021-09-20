<?php
include('includes/config.php');
if(isset($_GET['phone_id']))
{
$id=$_GET['phone_id'];
$sql = "delete from  tbphone WHERE phone_id=:phone_id";
$query = $dbh->prepare($sql);
$query -> bindParam(':phone_id',$id, PDO::PARAM_STR);
$query -> execute();
if ($query) {
        
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='dashboard.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='dashboard.php'</script>";
}
}
?>