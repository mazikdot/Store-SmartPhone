<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // code for Inactive  employee    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update tblemployees set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:manageemployee.php');
    }



    //code for active employee
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "update tblemployees set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:manageemployee.php');
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Smart-Phone-Shop</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap');
        </style>
        <style>
            body {
                font-family: 'IBM Plex Sans Thai Looped', sans-serif;
            }
        </style>

        <!-- icon -->
        <link rel="icon" type="image/png" href="assets/images/icon.png" />
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row no-m-t no-m-b">
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">

                            <span class="card-title">รายได้ทั้งหมด</span>
                            <span class="stats-counter">
                                <?php
                                $sql = "SELECT SUM(total_phone_name) as total FROM total_phone;";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($results as $result) {
                                ?>

                                    <span class="counter"><?php echo "{$result['total']}"; ?></span>&nbsp&nbsp บาท</span>
                        <?php }
                        ?>
                        </div>
                        <div id="sparkline-bar"></div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">

                            <span class="card-title">รายได้วันนี้</span>
                            <?php
                            $sql = "SELECT (sum_teacher) as 'total' FROM (
    SELECT sum(money_today_name*amount_today) as sum_teacher FROM money_today ) sum_tea;";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $result) {
                            ?>
                                <span class="stats-counter"><span class="counter"><?php echo "{$result->total}" ?> </span>&nbsp&nbsp บาท</span>

                            <?php
                            }
                            ?>
                        </div>
                        <div id="sparkline-line"></div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">
                            <span class="card-title">จำนวนเครื่องโทรศัพท์ที่ขายไปวันนี้</span>
                            <?php
                            $sql = "SELECT SUM(phone_today_name) as sell_amount FROM phone_today;";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $result) {
                            ?>
                                <span class="stats-counter"><span class="counter"><?php echo "{$result->sell_amount}"; ?></span>&nbsp&nbsp เครื่อง</span>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="progress stats-card-progress">
                            <div class="determinate" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="page-title">รายการขายทั้งหมด</div>
                </div>

                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Smart Phone</span>
                            <span class="card-title" style="color:#dd3d36;"><a href="delete-all-list.php" onclick="return confirm('คุณต้องการที่จะลบข้อมูลโทรศัพท์เครื่องนี้ใช่หรือไม่ ?');"">ล้างรายการขายทั้งหมด</a></span>
                            <?php if ($msg) { ?><div class=" succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?>
                        </div><?php } ?>
                    <table id="example" class="display responsive-table ">
                        <thead>
                            <tr>
                                <th>โทรศัพท์ที่ขายไป</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อเครื่องที่ขายไป</th>
                                <th>ยี่ห้อ</th>
                                <th>วันที่ขาย</th>
                                <th>ข้อมูลผู้ซื้อ</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $sql = "SELECT a.sell_id as sell_id,a.sell_name as sell_name,a.sell_amount as sell_amount,a.sell_price as sell_price, a.sell_date as sell_date ,a.sell_who as sell_who, b.echo_name as echo_name FROM sell_phone as a
INNER JOIN status_phone as b ON b.echo_id = a.echo_id;";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                    <tr>
                                        <td> <?php echo htmlentities($result->sell_name); ?></td>
                                        <td><?php echo htmlentities($result->sell_amount); ?></td>
                                        <td><?php echo htmlentities($result->sell_price);  ?> <br> ยอดรวม : <?php echo ($result->sell_amount) * ($result->sell_price) ?></td>
                                        <td><?php echo htmlentities($result->echo_name); ?></td>
                                        <td><?php echo htmlentities($result->sell_date); ?></td>
                                        <td><?php echo htmlentities($result->sell_who); ?></td>

                                        </td>

                                        <td><a href="edit-list.php?sell_id=<?php echo htmlentities($result->sell_id); ?>"><i class="material-icons">mode_edit</i></a>
                                            <?php if ($result->Status == 1) { ?>
                                                <a href="delete_phone.php?sell_id=<?php echo htmlentities($result->sell_id); ?>" onclick="return confirm('');"" > <i class=" material-icons" title="Inactive">clear</i>
                                                <?php } else { ?>

                                                    <a href="delete-list.php?sell_id=<?php echo htmlentities($result->sell_id); ?>" onclick="return confirm('คุณต้องการที่จะลบข้อมูลโทรศัพท์เครื่องนี้ใช่หรือไม่ ?');""><i class=" material-icons" title="Active">delete</i>
                                                    <?php } ?>

                                                    <!-- <a href="sell_phone.php?sell_id=<?php echo htmlentities($result->sell_id); ?>"><i class="material-icons">done</i>ขาย</a> -->



                                        </td>
                                    </tr>
                            <?php $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            </div>
        </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>

    </body>

    </html>
<?php } ?>