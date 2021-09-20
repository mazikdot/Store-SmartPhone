<?php
include('includes/config.php');
if(isset($_GET['sell_id']))
{
$id=$_GET['sell_id'];
$sql = "delete from  sell_phone WHERE sell_id=:sell_id";
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