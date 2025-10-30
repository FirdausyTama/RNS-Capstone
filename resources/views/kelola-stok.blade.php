<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Stok | RNS - Ranay Nusantara Sejathera</title>
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
                                <h4 class="fs-18 fw-semibold m-0">Kelola Stok</h4>
                            </div>
                            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Kelola Stok</li>
                                </ol>
                            </div>
                        </div>
                        


                         
                        
                    </div> <!-- container-fluid -->
<!-- Start Main Widgets -->
                        <div class="row">

                            <!-- 🟢 Stok Aman -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="p-2 border border-success border-opacity-10 bg-success-subtle rounded-2 me-2">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="mdi mdi-check-circle-outline text-white fs-5"></i>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Aman</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0 fs-22 text-dark me-3">15 Produk</h3>
                                    <div class="text-center">
                                        <span class="text-success fs-14"><i class="mdi mdi-trending-up fs-14"></i> +8.2%</span>
                                        <p class="text-muted fs-13 mb-0">Last 7 days</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- 🟡 Stok Menipis -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-2 me-2">
                                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="mdi mdi-alert-outline text-white fs-5"></i>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Menipis</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0 fs-22 text-dark me-3">6 Produk</h3>
                                    <div class="text-center">
                                        <span class="text-warning fs-14"><i class="mdi mdi-trending-down fs-14"></i> -2.3%</span>
                                        <p class="text-muted fs-13 mb-0">Last 7 days</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- 🔴 Stok Habis -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-2 me-2">
                                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="mdi mdi-close-circle-outline text-white fs-5"></i>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Habis</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0 fs-22 text-dark me-3">3 Produk</h3>
                                    <div class="text-center">
                                        <span class="text-danger fs-14"><i class="mdi mdi-trending-up fs-14"></i> +5.1%</span>
                                        <p class="text-muted fs-13 mb-0">Last 7 days</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- 🟣 Total Stok Keseluruhan -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="mdi mdi-package-variant-closed text-white fs-5"></i>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0 fs-22 text-dark me-3">900</h3>
                                    <div class="text-center">
                                        <span class="text-primary fs-14"><i class="mdi mdi-trending-up fs-14"></i> +10%</span>
                                        <p class="text-muted fs-13 mb-0">Last 7 days</p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            </div>

                            <div class="container-fluid">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                        <h5 class="fw-semibold mb-1">Daftar Stok Produk</h5>
                                        <p class="text-muted mb-0">Kelola dan pantau stok produk Anda</p>
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
                                        <table class="table align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                            <th scope="col" class="text-center" style="width: 80px;">Foto</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col" class="text-center">Harga</th>
                                            <th scope="col" class="text-center">Status Stok</th>
                                            <th scope="col" class="text-center">Jumlah</th>
                                            <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Produk 1 -->
                                            <tr>
                                            <td class="text-center">
                                                <img src="https://img.lazcdn.com/g/ff/kf/Se6d7760ca3654638a487d3345ea0cdb1o.jpg_960x960q80.jpg_.webp" alt="Produk" class="rounded" width="60" height="60">
                                            </td>
                                            <td>
                                                <div>
                                                <h6 class="fw-semibold mb-1 text-dark">Batre Alat</h6>
                                                <small class="text-muted">Batre dengan kualitas tinggi tahan sampai 10 tahun</small>
                                                </div>
                                            </td>
                                            <td class="text-center fw-semibold">Rp1.000.000</td>
                                            <td class="text-center">
                                                <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Stok Aman</span>
                                            </td>
                                            <td class="text-center fw-semibold">45</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border me-1" title="Edit">
                                                <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                </button>
                                                <button class="btn btn-sm btn-light border" title="Lihat">
                                                <i class="mdi mdi-eye-outline text-muted"></i>
                                                </button>
                                            </td>
                                            </tr>

                                            <!-- Produk 2 -->
                                            <tr>
                                            <td class="text-center">
                                                <img src="https://www.alatkedokteran.id/wp-content/uploads/2016/01/wsr-40.jpg" alt="Produk" class="rounded" width="60" height="60">
                                            </td>
                                            <td>
                                                <div>
                                                <h6 class="fw-semibold mb-1 text-dark">Mesin Ronsen</h6>
                                                <small class="text-muted">Mesin ronsen produksi china dengan tambahan ronsen gigi</small>
                                                </div>
                                            </td>
                                            <td class="text-center fw-semibold">Rp40.000.000</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Stok Rendah</span>
                                            </td>
                                            <td class="text-center fw-semibold">10</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border me-1" title="Edit">
                                                <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                </button>
                                                <button class="btn btn-sm btn-light border" title="Lihat">
                                                <i class="mdi mdi-eye-outline text-muted"></i>
                                                </button>
                                            </td>
                                            </tr>

                                            <!-- Produk 3 -->
                                            <tr>
                                            <td class="text-center">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIUln6ypMWAN2rDOZjmMat-iaSmanFM4kF3w&s" alt="Produk" class="rounded" width="60" height="60">
                                            </td>
                                            <td>
                                                <div>
                                                <h6 class="fw-semibold mb-1 text-dark">Mesin Kursi Gigi</h6>
                                                <small class="text-muted">Kursi khusus dokter gigi dengan berbagai macam fitur</small>
                                                </div>
                                            </td>
                                            <td class="text-center fw-semibold">Rp300.000.000</td>
                                            <td class="text-center">
                                                <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Stok Habis</span>
                                            </td>
                                            <td class="text-center fw-semibold">0</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border me-1" title="Edit">
                                                <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                </button>
                                                <button class="btn btn-sm btn-light border" title="Lihat">
                                                <i class="mdi mdi-eye-outline text-muted"></i>
                                                </button>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">Menampilkan 1–3 dari 247 produk</small>
                                        <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item"><a class="page-link" href="#">‹</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                                        </ul>
                                        </nav>
                                    </div>
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