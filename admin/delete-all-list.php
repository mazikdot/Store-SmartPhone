<?php
include('includes/config.php');

{
$sql = "delete from  sell_phone ";
$query = $dbh->prepare($sql);
$query -> bindParam(':sell_id',$id, PDO::PARAM_STR);
$query -> execute();
if ($query) {
        
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='list-sell.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='list-sell.php'</script>";
}
}
?>