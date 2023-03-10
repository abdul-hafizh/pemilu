<?php
    session_start();
    if($_SESSION["user"] < 1) header("Location: index.php");
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Pemilihan Ketua 2022</title>
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
                        <a href="logout.php" class="btn btn-danger btn-sm"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <?php 
            require_once("config.php");

            $have_count = 0;
            $select = $db->prepare('SELECT * FROM result_polling WHERE user_id = ?');
            $select->execute([$_SESSION["user"]]);
            if ($select->rowCount() > 0) {
                $have_count = 1;
            } else {
                $have_count = 2;
            }
        ?>

        <!-- start team -->
        <section class="section bg-light" id="team">
            <div class="p-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Selamat Datang <span class="text-danger"><?php echo $_SESSION["nama"]; ?></span></h3>
                            <p class="text-muted mb-4 ff-secondary">Anda harus memilih 13 kandidat.</p>
                        </div>
                    </div>
                </div>
                <form action="submit.php" method="post" id="target">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["user"];?>">
                    <input type="hidden" name="have_count" value="<?php echo $_SESSION["have_count"];?>">
                    <div class="row">
                            <?php                                
                                $sql = "SELECT id, nama_lengkap, nomor_urut FROM kandidat ORDER BY id";
                                $row = $db->prepare($sql);
                                $row->execute();
                                $hasil = $row->fetchAll();

                                foreach($hasil as $v){
                            ?>
                            <div class="col-lg-2 col-sm-6">
                                <div class="card">
                                    <div class="form-check form-check-danger">
                                        <input class="form-check-input" type="checkbox" name="kandidat_check[]" value="<?php echo $v['id'];?>" id="<?php echo $v['nomor_urut'];?>" onclick="theFunc()">
                                    </div>                                                                    
                                    <div class="card-body text-center p-0">
                                        <h4><?php echo $v['nomor_urut'];?></h4>
                                        <h5 class="mb-1"><?php echo $v['nama_lengkap'];?></h5> 
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        <?php } ?>                   
                    </div>
                    <!-- end row -->
                    
                    <div class="row">
                        <div class="col-12 text-center mt-5">
                            <button type="button" class="btn btn-primary"  onclick="theSubmit()"> <i class="ri-send-plane-fill"></i> Submit <span id="pilihan"></span></button>                            
                        </div>
                    </div>
                    <!-- end row -->

                </form>
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
                                </script> ?? Pemilihan Ketua
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

    <!--Swiper slider js-->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- landing init -->
    <script src="assets/js/pages/landing.init.js"></script>

    <script>
        
        function theFunc() { 
            document.getElementById("pilihan").innerHTML  = " (Pilihan : " + document.querySelectorAll('input[type="checkbox"]:checked').length + " Kandidat)";
        }

        function theSubmit() { 
            if (document.querySelectorAll('input[type="checkbox"]:checked').length > 13) {
                alert("Tidak bisa memilih lebih dari 13 Kandidat.");
                return false;

            } else if (document.querySelectorAll('input[type="checkbox"]:checked').length < 13) {
                alert("Anda harus memilih 13 Kandidat.");
                return false;

            } else {
                document.getElementById("target").submit();
                
            }
        }

    </script>

</body>

</html>