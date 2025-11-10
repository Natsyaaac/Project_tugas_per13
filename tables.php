<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "database_bigdata_kampus";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama_mhs'];
    $nim  = $_POST['nim_mhs'];
    $jk   = $_POST['jenis_klm'];
    $usia = $_POST['usia_mhs'];
    $tgl  = $_POST['tanggal_lhr'];
    $id_detail = 1;

    // ✅ Gunakan Prepared Statement tanpa kolom `id` (karena AUTO_INCREMENT)
    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama_mhs, nim_mhs, jenis_klm, usia_mhs, tanggal_lhr, id_detail)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisi", $nama, $nim, $jk, $usia, $tgl, $id_detail);

    if ($stmt->execute()) {
        // ✅ Redirect otomatis agar halaman refresh dan data terbaru tampil langsung
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'tables.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Gagal menyimpan data: " . $stmt->error . "');
              </script>";
    }

    $stmt->close();
}

// ✅ Tampilkan data mahasiswa dari yang terbaru ke lama
$sql = "SELECT id, nama_mhs, jenis_klm, usia_mhs, tanggal_lhr FROM mahasiswa ORDER BY id DESC";
$result = $conn->query($sql);
?>

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
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <!-- <div class="card mb-4">
                        <div class="card-body">
                            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.
                        </div>
                    </div> -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <div class="card-body">
                                <table id="tabelMahasiswa_table" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>id</th>
                                            <th>nama_mhs</th>
                                            <th>jenis_klm</th>
                                            <th>usia_mhs</th>
                                            <th>tanggal_lhr</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['id']) ?></td>
                                                <td><?= htmlspecialchars($row['nama_mhs']) ?></td>
                                                <td><?= htmlspecialchars($row['jenis_klm']) ?></td>
                                                <td><?= htmlspecialchars($row['usia_mhs']) ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_lhr']) ?></td>
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
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-user-plus me-2"></i>
                            <strong>Form Tambah Data Mahasiswa Baru</strong>
                        </div>
                        <div class="card-body">
                            <form id="formMahasiswa" class="needs-validation" novalidate method="POST" novalidate>
                                <div class="row g-3">
                                    <!-- <div class="col-md-12">
                                        <label for="id_mhs" class="form-label">
                                            <i class="fas fa-hashtag me-1"></i>ID Mahasiswa
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-key"></i>
                                            </span>
                                            <input type="number" class="form-control" id="id_mhs" name="id_mhs" placeholder="Masukkan ID (Auto increment)" required>
                                            <div class="invalid-feedback">
                                                ID mahasiswa wajib diisi.
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>ID unik untuk identifikasi mahasiswa
                                        </small>
                                    </div> -->

                                    <div class="col-md-6">
                                        <label for="nama_mhs" class="form-label">
                                            <i class="fas fa-user me-1"></i>Nama Lengkap Mahasiswa
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" placeholder="Masukkan nama lengkap" required>
                                        <div class="invalid-feedback">
                                            Nama mahasiswa wajib diisi.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nim_mhs" class="form-label">
                                            <i class="fas fa-id-card me-1"></i>NIM (Nomor Induk Mahasiswa)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="nim_mhs" name="nim_mhs" placeholder="Contoh: 210001" required>
                                        <div class="invalid-feedback">
                                            NIM mahasiswa wajib diisi.
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="jenis_klm" class="form-label">
                                            <i class="fas fa-venus-mars me-1"></i>Jenis Kelamin
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="jenis_klm" name="jenis_klm" required>
                                            <option value="" selected disabled>Pilih jenis kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih jenis kelamin.
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="usia_mhs" class="form-label">
                                            <i class="fas fa-calendar-alt me-1"></i>Usia
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="usia_mhs" name="usia_mhs" min="17" max="50" placeholder="Masukkan usia" required>
                                        <div class="invalid-feedback">
                                            Usia mahasiswa wajib diisi (17-50 tahun).
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="tanggal_lhr" class="form-label">
                                            <i class="fas fa-birthday-cake me-1"></i>Tanggal Lahir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control" id="tanggal_lhr" name="tanggal_lhr" required>
                                        <div class="invalid-feedback">
                                            Tanggal lahir wajib diisi.
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
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Simpan Data Mahasiswa
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
    <!-- jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <!-- SB Admin Scripts -->
    <script src="js/scripts.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#tabelMahasiswa_table').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50]
            });
        });


        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>
<?php $conn->close(); ?>