<?php
    session_start();
    if($_SESSION["admin"] < 1) header("Location: admin.php");
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Pemilihan Ketua 2022 (ADMIN)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <h2>Pemilihan Ketua <?php echo date('Y');?></h2>
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example"></ul>

                    <div class="">                        
                        <a href="logout_admin.php" class="btn btn-danger btn-sm"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start team -->
        <section class="section bg-light" id="team">
            <div class="p-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Selamat Datang <span class="text-danger">ADMIN</span></h3>
                            <p class="text-muted mb-4 ff-secondary">To achieve this, it would be necessary to have uniform grammar,
                                pronunciation and more common words. If several languages coalesce the grammar. 
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo minima eius vel nihil ex in corrupti velit dicta 
                                soluta dolorum nobis voluptates accusantium, amet odit adipisci perferendis, quisquam at laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="row">         
                    <div class="col-lg-3 col-sm-12">
                    </div> <!-- end col-->           
                    <div class="col-lg-6 col-sm-12">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top List Kandidat</h4>                                
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kandidat</th>
                                                <th>Nomor Urut</th>
                                                <th>Jumlah</th>
                                                <th>Persent (%)</th>
                                            </tr>
                                            <?php      
                                                require_once("config.php");        
                                                
                                                $select = $db->prepare('SELECT id FROM users');
                                                $select->execute();                                                

                                                $sql = "SELECT *, jml / " . $select->rowCount() . " * 100 as persent FROM vw_pooling_result ORDER BY jml DESC";
                                                $row = $db->prepare($sql);
                                                $row->execute();
                                                $hasil = $row->fetchAll();
                                                $no = 1;
                                                foreach($hasil as $v){
                                            ?>

                                            <tr>
                                                <td>
                                                    <span class="text-muted"><?php echo $no++; ?></span>
                                                </td>
                                                <td>
                                                    <?php echo $v["nama_lengkap"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $v["nomor_urut"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($v["jml"]); ?>
                                                </td>
                                                <td>
                                                    <?php if($v["persent"] > 50) { ?>
                                                        <h5 class="fs-14 mb-0"><?php echo (float)$v["persent"]; ?>% <i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>

                                                    <?php } else { ?>
                                                            <h5 class="fs-14 mb-0"><?php echo (float)$v["persent"]; ?>% <i class="ri-bar-chart-fill text-danger fs-16 align-middle ms-2"></i></h5>

                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table><!-- end table -->
                                </div>

                                <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="text-muted">Showing <span class="fw-semibold">All</span> Results</div>
                                    </div>
                                    <ul class="pagination pagination-separated pagination-sm mb-0">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link">←</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- .card-body-->
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                    <div class="col-lg-3 col-sm-12">
                    </div> <!-- end col-->                    
                </div> <!-- end row-->
            </div> <!-- end row-->
            </div>
            <!-- end container -->
        </section>
        <!-- end team -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row text-center text-sm-start align-items-center">
                    <div class="col-sm-6">
                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Pemilihan Ketua
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-github-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-dribbble-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- landing init -->
    <script src="assets/js/pages/landing.init.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-analytics.init.js"></script>
    
</body>

</html>