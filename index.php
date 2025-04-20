<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if (@$_SESSION['admin'] || $_SESSION['kasir'] || $_SESSION['pimpinan'] || $_SESSION['supplier']) {
    include "koneksi/koneksi.php";
    include "include/kode_penjualan.php";
    include "include/kode_pembelian.php";


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>FusionLabs.id SCM</title>
        <!-- Favicon-->
        <link rel="icon" href="images/Fusionlabs_Logo.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="css/assets/satu.css" rel="stylesheet" type="text/css">
        <link href="css/assets/dua.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />

        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="css/newstyle.css" rel="stylesheet">

        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-blue">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->

        <?php
        if ($_SESSION['admin']) {
            $user_l = $_SESSION['admin'];
        } else if ($_SESSION['kasir']) {
            $user_l = $_SESSION['kasir'];
        } else if ($_SESSION['pimpinan']) {
            $user_l = $_SESSION['pimpinan'];
        } else if ($_SESSION['supplier']) {
            $user_l = $_SESSION['supplier'];
        }



        $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
        $data_u = $sql_u->fetch_assoc();
        ?>

        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="index.php">FusionLabs.id </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Call Search -->
                        <!-- #END# Call Search -->

                        <li class="pull-right"><a href="?page=profile&id=<?php echo $data_u['id']; ?>" class="js-right-sidebar" data-close="true"><i class="material-icons">person</i></a></li>
                        <li class="pull-right"><a href="?page=profile&id=<?php echo $data_u['id']; ?>" class="js-right-sidebar" data-close="true"><i class="material-icons"></i><?php echo $data_u['nama'] ?></a></li>
                        <li class="pull-right"><a onclick="return confirm('Anda ingin Logout dari web ini...???') " href="logout.php" class="js-right-sidebar" data-close="true"><i class="material-icons"></i>Logout</a></li>

                    </ul>
                </div>








            </div>




        </nav>
        <!-- #Top Bar -->


        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->

                <!-- #User Info -->
                <!-- Menu -->

                <!-- #Menu -->
                <!-- Footer -->

                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            <aside id="rightsidebar" class="sidebar">

                <?php include "include/menu.php"; ?>


                </div>
            </aside>
            <!-- #END# Right Sidebar -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <?php include "include/content.php";   ?>
                </div>
            </div>
        </section>
        <!-- Jquery Core Js -->




        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>


        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>

    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>