<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Riwayat | RNS - Ranay Nusantara Sejathera</title>
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
                                <h4 class="fs-18 fw-semibold m-0">Riwayat Pembelian</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Riwayat Pembelian</li>
                                </ol>
                            </div>
                        </div>
                        
                        <!-- FILTER SECTION -->
          <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
              <div class="row g-3 align-items-end">
                <div class="col-md-3">
                  <label class="form-label fw-semibold">Status Pembayaran</label>
                  <select id="statusFilter" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Cicilan">Cicilan</option>
                    <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label fw-semibold">Tanggal Awal</label>
                  <input type="date" id="startDate" class="form-control">
                </div>
                <div class="col-md-3">
                  <label class="form-label fw-semibold">Tanggal Akhir</label>
                  <input type="date" id="endDate" class="form-control">
                </div>
                <div class="col-md-3 d-flex">
                  <button class="btn btn-primary me-2 w-100" id="applyFilter"><i class="mdi mdi-filter-outline me-1"></i>Filter</button>
                  <button class="btn btn-secondary w-100" id="resetFilter"><i class="mdi mdi-refresh me-1"></i>Reset</button>
                </div>
              </div>
            </div>
          </div>

                        <div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h5 class="fw-semibold mb-1">Riwayat Pembelian</h5>
          <p class="text-muted mb-0">Lihat dan kelola riwayat pembelian produk dari supplier</p>
        </div>
        <!-- Search -->
        <li class="d-none d-lg-block">
          <form class="app-search d-none d-md-block me-auto">
            <div class="position-relative topbar-search">
              <input type="text" class="form-control ps-4" placeholder="Cari transaksi..." />
              <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
            </div>
          </form>
        </li>
      </div>

      <div class="table-responsive">
        <table class="table align-middle table-hover">
          <thead class="table-light">
            <tr>
              <th scope="col" class="text-center" style="width: 60px;">No</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col" class="text-center">Tanggal</th>
              <th scope="col">Supplier</th>
              <th scope="col" class="text-center">Total Pembelian</th>
              <th scope="col" class="text-center">Status Pembayaran</th>
              <th scope="col" class="text-center" style="width: 100px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Transaksi 1 -->
            <tr>
              <td class="text-center">1</td>
              <td><strong>TRX-2025-001</strong></td>
              <td class="text-center">17 Feb 2025</td>
              <td>PT Medika Sejahtera</td>
              <td class="text-center fw-semibold">Rp 65.000.000</td>
              <td class="text-center">
                <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>
              </td>
              <td class="text-center">
                <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                  <i class="mdi mdi-eye-outline text-primary"></i>
                </button>
                <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                  <i class="mdi mdi-printer text-dark"></i>
                </a>
              </td>
            </tr>

            <!-- Transaksi 2 -->
            <tr>
              <td class="text-center">2</td>
              <td><strong>TRX-2025-002</strong></td>
              <td class="text-center">21 Feb 2025</td>
              <td>CV DentalTech</td>
              <td class="text-center fw-semibold">Rp 42.500.000</td>
              <td class="text-center">
                <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>
              </td>
              <td class="text-center">
                <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                  <i class="mdi mdi-eye-outline text-primary"></i>
                </button>
                <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                  <i class="mdi mdi-printer text-dark"></i>
                </a>
              </td>
            </tr>

            <!-- Transaksi 3 -->
            <tr>
              <td class="text-center">3</td>
              <td><strong>TRX-2025-003</strong></td>
              <td class="text-center">28 Feb 2025</td>
              <td>PT Sentosa Medika</td>
              <td class="text-center fw-semibold">Rp 89.000.000</td>
              <td class="text-center">
                <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>
              </td>
              <td class="text-center">
                <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                  <i class="mdi mdi-eye-outline text-primary"></i>
                </button>
                <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                  <i class="mdi mdi-printer text-dark"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-muted">Menampilkan 1–3 dari 50 transaksi</small>
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

                        
                    </div> <!-- container-fluid -->
                    

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a> </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

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