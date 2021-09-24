<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $note_id = ($_GET['note_id']);
        $note_name = $_POST['note_name'];
        $sql = "update notes set note_name=:note_name  where note_id=:note_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':note_name', $note_name, PDO::PARAM_STR);
        $query->bindParam(':note_id', $note_id, PDO::PARAM_STR);

        $query->execute();

        $msg = "อัพเดตรายการขายเรียบร้อยแล้ว";
        if ($query) {
            echo "<script>alert ('อัพเดต Note เรียบร้อยแล้ว')</script>";
            echo "<script>window.location.href='note.php'</script>";
        } else {
            echo "<script>alert('ไม่สามารถอัพเดตข้อมูลนี้ได้')</script>";
            echo "<script>window.location.href='note.php'</script>";
        }
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
            <div class="row">
                <div class="col s12">
                    <div class="page-title">แก้ไขรายการขาย</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>แก้ไข Note</h3>
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m12">
                                                    <div class="row">
                                                        <?php
                                                        $eid = intval($_GET['note_id']);
                                                        $sql = "SELECT * from  notes WHERE note_id=:note_id";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':note_id', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                                <div class="input-field col  s12">
                                                                    <label for="note_name">แก้ไขรุ่นโทรศัพท์มือถือ</label>
                                                                    <input name="note_name" id="note_name" value="<?php echo htmlentities($result->note_name); ?>" type="text" autocomplete="off" required>
                                                                    <span id="empid-availability" style="font-size:12px;"></span>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="col m6">
                                                    <div class="row">

                                                <?php }
                                                        } ?>

                                                <div class="input-field col s12">
                                                    <button type="submit" name="update" id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

                                                </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    </section>
                                </div>
                            </form>
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
        <script src="../assets/js/alpha.min.js"></script>
        <!-- <script src="../assets/js/pages/form_elements.js"></script> -->

    </body>

    </html>
<?php } ?>