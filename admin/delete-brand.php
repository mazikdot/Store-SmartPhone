<?php
include('includes/config.php');
if(isset($_GET['echo_id']))
{
$id=$_GET['echo_id'];
$sql = "delete from status_phone WHERE echo_id=:echo_id";
$query = $dbh->prepare($sql);
$query -> bindParam(':echo_id',$id, PDO::PARAM_STR);
$query -> execute();
if ($sql) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='add-smart-phone.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='add-smart-phone.php'</script>";
}
}
?>