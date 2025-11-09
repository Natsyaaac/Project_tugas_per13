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
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                        <!-- Authentication -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                            aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.php">Login</a>
                                <a class="nav-link" href="register.php">Register</a>
                                <a class="nav-link" href="password.php">Forgot Password</a>
                            </nav>
                        </div>

                        <!-- Data Mahasiswa -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseData_mhs" aria-expanded="false"
                            aria-controls="pagesCollapseData_mhs">
                            Data Mahasiswa
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseData_mhs" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tableWanita.php">Filter Mahasiswa Wanita</a>
                                <a class="nav-link" href="tablePria.php">Filter Mahasiswa Pria</a>
                            </nav>
                        </div>

                        <!-- About -->
                        <a class="nav-link" href="about.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
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
