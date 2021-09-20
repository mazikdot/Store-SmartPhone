<?php
include('includes/config.php');

{
$sql = "delete from  total_phone2 ";
$query = $dbh->prepare($sql);
$query -> bindParam(':sell_id',$id, PDO::PARAM_STR);
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