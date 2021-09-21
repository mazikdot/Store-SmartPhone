<?php
include('includes/config.php');
if(isset($_GET['note_id']))
{
$id=$_GET['note_id'];
$sql = "delete from notes WHERE note_id=:note_id";
$query = $dbh->prepare($sql);
$query -> bindParam(':note_id',$id, PDO::PARAM_STR);
$query -> execute();
if ($sql) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href='note.php'</script>";
} else {
    echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
    echo "<script>window.location.href='note.php'</script>";
}
}
?>