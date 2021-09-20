<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $echo_name = $_POST['echo_name'];
        $sql = "INSERT INTO status_phone(echo_name) VALUES(:echo_name)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':echo_name', $echo_name, PDO::PARAM_STR);
        $query->execute();
        if ($query) {
            echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<script>window.location.href='add_brand.php'</script>";
        } else {
            echo "<script>alert('ไม่สามารถลบข้อมูลนี้ได้')</script>";
            echo "<script>window.location.href='add_brand.php'</script>";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Add_Phone</title>

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
        <script type="text/javascript">
        </script>


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
                    <div class="page-title">Add Brand</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="addemp">
                                <div>
                                    <h3>เพิ่มยี่ห้อ</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="input-field col  s12">
                                                            <label for="echo_name">ยี่ห้อที่ต้องการเพิ่ม</font></label>
                                                            <input name="echo_name" id="echo_name" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>
                                                            <span id="empid-availability" style="font-size:12px;"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <button type="submit" name="add" id="add" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

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
        <!-- <script src="../assets/js/pages/form_elements.js"></script>
         -->
    </body>

    </html>
<?php } ?>