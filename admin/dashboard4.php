<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>ระบบจัดเก็บข้อมูลการลาออนไลน์ - สำนักงานที่ดินจังหวัดสงขลา</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/png" href="assets/images/icon.png" />

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
        <link rel="icon" type="image/png" href="/assets/images/icon.png" />

    </head>

    <body>
        <div class="loader-bg"></div>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <main class="mn-inner">
            <div class="middle-content">
                <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">

                                <span class="card-title">รายได้ทั้งหมด</span>
                                <span class="stats-counter">
                                    <?php
                                    $sql = "SELECT id from tblemployees";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $empcount = $query->rowCount();
                                    ?>

                                    <span class="counter"><?php echo htmlentities($empcount); ?></span>&nbsp&nbsp บาท</span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">

                                <span class="card-title">รายได้วันนี้</span>
                                <?php
                                $sql = "SELECT id from tbldepartments";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $dptcount = $query->rowCount();
                                ?>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($dptcount); ?> </span>&nbsp&nbsp บาท</span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
                    <div class="col s12 m12 l4">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">จำนวนเครื่องโทรศัพท์ที่ขายไป</span>
                                <?php
                                $sql = "SELECT id from  tblleaves";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $leavtypcount = $query->rowCount();
                                ?>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($leavtypcount); ?></span>&nbsp&nbsp เครื่อง</span>

                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <main class="mn-inner">
                    <div class="row">
                        <div class="col s12">
                            <div class="page-title">รายชื่อพนักงานทั้งหมด</div>
                        </div>

                        <div class="col s12 m12 l12">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title">Employees</span>
                                    <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <table id="example" class="display responsive-table ">
                                        <thead>
                                            <tr>
                                                <th>Sr no</th>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>ชื่อแผนกงาน</th>
                                                <th>สถานะ</th>
                                                <th>Reg Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sql = "SELECT EmpId,FirstName,LastName,Department,Status,RegDate,id from  tblemployees";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr>
                                                        <td> <?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($result->EmpId); ?></td>
                                                        <td><?php echo htmlentities($result->FirstName); ?>&nbsp;<?php echo htmlentities($result->LastName); ?></td>
                                                        <td><?php echo htmlentities($result->Department); ?></td>
                                                        <td><?php $stats = $result->Status;
                                                            if ($stats) {
                                                            ?>
                                                                <a class="waves-effect waves-green btn-flat m-b-xs">Active</a>
                                                            <?php } else { ?>
                                                                <a class="waves-effect waves-red btn-flat m-b-xs">Inactive</a>
                                                            <?php } ?>


                                                        </td>
                                                        <td><?php echo htmlentities($result->RegDate); ?></td>
                                                        <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id); ?>"><i class="material-icons">mode_edit</i></a>
                                                            <?php if ($result->Status == 1) { ?>
                                                                <a href="manageemployee.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('คุณต้องการที่จะลบข้อมูลพนักงานหรือไหม ?');"" > <i class=" material-icons" title="Inactive">clear</i>
                                                                <?php } else { ?>

                                                                    <a href="manageemployee.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to active this employee?');""><i class=" material-icons" title="Active">done</i>
                                                                    <?php } ?>
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

                <div class="left-sidebar-hover"></div>
            </div>

        </main>

        </div>



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