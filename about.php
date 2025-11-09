
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <!--
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.php">Login</a>
                                        <a class="nav-link" href="register.php">Register</a>
                                        <a class="nav-link" href="password.php">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseData_mhs" aria-expanded="false" aria-controls="pagesCollapseData">
                                    Data Mahasiswa
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseData_mhs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="tableWanita.php">Filter Mahasiswa Wanita</a>
                                        <a class="nav-link" href="tablePria.php">Filter Mahasiswa Pria</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="about.php">
                                     About
                                </a>
                                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.php">401 Page</a>
                                        <a class="nav-link" href="404.php">404 Page</a>
                                        <a class="nav-link" href="500.php">500 Page</a>
                                    </nav>
                                </div> -->
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <!-- <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a> -->
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
        <h1 class="mb-4 text-primary fw-bold">About This Project</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <h5 class="card-title text-dark fw-semibold">Tentang Sistem</h5>
                        <p class="card-text text-muted mt-3" style="text-align: justify;">
                            Sistem ini dikembangkan sebagai bagian dari proyek pengelolaan data mahasiswa di 
                            <strong>Universitas Muhammadiyah Metro</strong>. Tujuannya adalah untuk mempermudah
                            pengelolaan, analisis, serta visualisasi data mahasiswa antara tahun <b>2021 hingga 2025</b>. 
                            Platform ini dirancang menggunakan teknologi <b>PHP</b>, <b>MySQL</b>, dan <b>Bootstrap 5</b> 
                            dengan integrasi <b>DataTables</b> untuk menampilkan data yang interaktif dan responsif.
                        </p>
                        <p class="text-muted" style="text-align: justify;">
                            Dashboard ini diharapkan dapat membantu pihak akademik dan administrasi dalam memantau data mahasiswa,
                            termasuk informasi biodata, jenis kelamin, usia, dan tanggal lahir. 
                            Selain itu, fitur filter dan pencarian membantu mempercepat proses pencarian data.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold text-dark">Teknologi yang Digunakan</h5>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item"><i class="fas fa-code text-primary me-2"></i>PHP 8 & MySQL</li>
                            <li class="list-group-item"><i class="fas fa-paint-brush text-success me-2"></i>Bootstrap 5 (SB Admin Template)</li>
                            <li class="list-group-item"><i class="fas fa-database text-warning me-2"></i>DataTables untuk interaksi tabel</li>
                            <li class="list-group-item"><i class="fas fa-laptop-code text-danger me-2"></i>JavaScript & jQuery untuk interaktivitas</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body text-center">
                        <img src="assets/img/logo_um.png" alt="Logo UM Metro" class="img-fluid rounded-circle mb-3" style="width: 120px;">
                        <h5 class="fw-bold">Universitas Muhammadiyah Metro</h5>
                        <p class="text-muted">Jl. Ki Hajar Dewantara No.116, Iringmulyo, Metro Timur</p>
                        <p><i class="fas fa-envelope text-primary me-2"></i>info@ummetro.ac.id</p>
                        <p><i class="fas fa-globe text-success me-2"></i><a href="https://ummetro.ac.id" target="_blank" class="text-decoration-none">ummetro.ac.id</a></p>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="fw-semibold text-dark mb-2"><i class="fas fa-user text-primary me-2"></i>Developer</h6>
                        <p class="mb-0"><strong>Faiz Ilyas Zulkarnaen</strong></p>
                        <p class="text-muted mb-0">Mahasiswa Ilmu Komputer</p>
                        <p class="text-muted">Universitas Muhammadiyah Metro</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
       <!-- jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <!-- SB Admin Scripts -->
    <script src="js/scripts.js"></script>

    <!-- Inisialisasi DataTables -->
</body>
</html>
<?php $conn->close(); ?>

