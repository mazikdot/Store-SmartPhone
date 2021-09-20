<?php
include('includes/config.php');
if(isset($_GET['status_id']))
{
$id=$_GET['status_id'];
$sql = "delete from phone_status WHERE status_id=:status_id";
$query = $dbh->prepare($sql);
$query -> bindParam(':status_id',$id, PDO::PARAM_STR);
$query -> execute();
if ($sql) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='add-status-phone.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='add-status-phone.php'</script>";
}
}
?>