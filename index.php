<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_praktikum_lanjut";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_mahasiswa = $_POST["id_mahasiswa"];
    $id_buku = $_POST["id_buku"];

    if (!empty($id_mahasiswa) && !empty($id_buku)) {
        $sql = "CALL prosesPeminjamanBuku(?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_mahasiswa, $id_buku);

        if ($stmt->execute()) {
            $message = "✅ Peminjaman berhasil diproses!";
        } else {
            $message = "❌ Gagal memproses peminjaman: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "⚠️ Harap isi semua field terlebih dahulu!";
    }
}

// Ambil data dari view
$sql = "SELECT id_peminjaman, nama_mahasiswa, nim, judul_buku, kategori_buku, tanggal_pinjam, tanggal_kembali 
        FROM view_peminjaman_aktif";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#tabelMahasiswa').DataTable({
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50]
            });
        });
    </script>
</head>

<?php if (!empty($message)): ?>
    <script>
        alert("<?= addslashes($message) ?>");
    </script>
<?php endif; ?>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
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
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Table Peminjaman UM Metro</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!--  <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <div class="card-body">
                                <table id="tabelMahasiswa" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>id_peminjaman</th>
                                            <th>nama_mahasiswa</th>
                                            <th>nim</th>
                                            <th>judul_buku</th>
                                            <th>tanggal_pinjam</th>
                                            <th>kategori_buku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['id_peminjaman']) ?></td>
                                                <td><?= htmlspecialchars($row['nama_mahasiswa']) ?></td>
                                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                                <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
                                                <td><?= htmlspecialchars($row['kategori_buku']) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Data mahasiswa tidak ditemukan.</p>
                            <?php endif; ?>
                            </div>
                    </div>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-book-reader me-2"></i>
                            <strong>Form Peminjaman Buku</strong>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="formPeminjaman" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="id_buku" class="form-label">
                                            <i class="fas fa-book me-1"></i>ID Buku
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="id_buku" name="id_buku" placeholder="Masukkan ID Buku" required>
                                        <div class="invalid-feedback">
                                            ID Buku wajib diisi.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="id_mahasiswa" class="form-label">
                                            <i class="fas fa-user-graduate me-1"></i>ID Mahasiswa
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="id_mahasiswa" name="id_mahasiswa" placeholder="Masukkan ID Mahasiswa" required>
                                        <div class="invalid-feedback">
                                            ID Mahasiswa wajib diisi.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-info d-flex align-items-center" role="alert">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <small>Pastikan semua data yang diisi sudah benar sebelum menyimpan. Field yang ditandai dengan <span class="text-danger">*</span> wajib diisi.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="my-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="fas fa-undo me-1"></i>Reset Form
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-1"></i>Simpan Data Peminjaman
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="js/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
</body>

</html>
<?php $conn = null; ?>