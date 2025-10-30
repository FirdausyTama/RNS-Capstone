<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>SPH | RNS - Ranay Nusantara Sejathera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/head.js"></script>


    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">
        @include('navbar.navbar')
        <!-- Begin page -->
        <div id="app-layout">
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Surat Penawaran Harga</h4>
                            </div>
                            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">SPH</li>
                                </ol>
                            </div>
                        </div>
                        


                         
                        
                    </div> <!-- container-fluid -->
<!-- Start Main Widgets -->
                        <div class="row">

                            <div class="container-fluid">
                            <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="fw-semibold mb-1">Daftar Surat Penawaran Harga</h5>
                                    <p class="text-muted mb-0">Kelola dan pantau seluruh surat penawaran Anda</p>
                                </div>
                                <!-- Search -->
                                    <li class="d-none d-lg-block">
                                        <form class="app-search d-none d-md-block me-auto">
                                            <div class="position-relative topbar-search">
                                                <input type="text" class="form-control ps-4" placeholder="Search..." />
                                                <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                            </div>
                                        </form>
                                    </li>
                                </div>

                                <div class="table-responsive">
                                <table id="tabelSPH" class="table table-bordered align-middle table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No</th>
                                        <th>Nomor SPH</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Nama Perusahaan</th>
                                        <th class="text-center">Nilai Penawaran</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 100px;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>SPH/001/RNS/2025</td>
                                        <td class="text-center">15 Okt 2025</td>
                                        <td>PT Medika Sejahtera</td>
                                        <td class="text-center fw-semibold">Rp 125.000.000</td>
                                        <td class="text-center">
                                        <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Disetujui</span>
                                        </td>
                                        <td class="text-center">
                                        <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                        </button>
                                        <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print SPH">
                                            <i class="mdi mdi-printer text-dark"></i>
                                        </a>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>SPH/002/RNS/2025</td>
                                        <td class="text-center">18 Okt 2025</td>
                                        <td>CV DentalTech</td>
                                        <td class="text-center fw-semibold">Rp 58.000.000</td>
                                        <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Menunggu</span>
                                        </td>
                                        <td class="text-center">
                                        <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                        </button>
                                        <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print SPH">
                                            <i class="mdi mdi-printer text-dark"></i>
                                        </a>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>SPH/003/RNS/2025</td>
                                        <td class="text-center">20 Okt 2025</td>
                                        <td>PT Sentosa Medika</td>
                                        <td class="text-center fw-semibold">Rp 92.000.000</td>
                                        <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Ditolak</span>
                                        </td>
                                        <td class="text-center">
                                        <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                        </button>
                                        <a href="/print" class="btn btn-sm btn-light border" title="Print SPH">
                                            <i class="mdi mdi-printer text-dark"></i>
                                        </a>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Main Widgets -->
                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
<!-- Floating Button Tambah Stok -->
                            <div class="content position-relative">
                            <button type="button" class="btn btn-primary rounded-circle shadow-lg"
                                    style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Stok">
                                <i class="mdi mdi-plus fs-3 text-white"></i>
                            </button>
                            </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.js"></script>
        
    </body>
</html>