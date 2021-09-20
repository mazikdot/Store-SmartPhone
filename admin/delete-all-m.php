<?php
include('includes/config.php');
if(isset($_GET['id_total_phone']))
{
$id=$_GET['id_total_phone'];
$sql = "delete from total_phone WHERE id_total_phone=:id_total_phone";
$query = $dbh->prepare($sql);
$query -> bindParam(':id_total_phone',$id, PDO::PARAM_STR);
$query -> execute();
if ($query) {
        
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='manage-list.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='manage-list.php'</script>";
}
}
?>