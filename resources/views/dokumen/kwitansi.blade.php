<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Dokumen | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Daftar Kwitansi Pembayaran RNS" />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/head.js"></script>
  </head>

  <body data-menu-color="light" data-sidebar="default">
    @include('navbar.navbar')

    <!-- Begin page -->
    <div id="app-layout">
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <!-- Header -->
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Kwitansi</h4>
              </div>

              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                  <li class="breadcrumb-item active">Kwitansi</li>
                </ol>
              </div>
            </div>

            <!-- Card Table -->
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h5 class="fw-semibold mb-1">Daftar Kwitansi Pembayaran</h5>
                    <p class="text-muted mb-0">Kelola dan pantau seluruh kwitansi transaksi Anda</p>
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
                  <table id="tabelKwitansi" class="table table-bordered align-middle table-hover">
                    <thead class="table-light">
                      <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nomor Kwitansi</th>
                        <th class="text-center">Tanggal</th>
                        <th>Nama Klien</th>
                        <th>Keterangan Pembayaran</th>
                        <th class="text-center">Total Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td>KW/001/RNS/2025</td>
                        <td class="text-center">15 Okt 2025</td>
                        <td>PT Medika Sejahtera</td>
                        <td>Pembayaran termin pertama proyek alat kesehatan</td>
                        <td class="text-center fw-semibold">Rp 50.000.000</td>
                        <td class="text-center">
                          <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Kwitansi">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>

                      <tr>
                        <td class="text-center">2</td>
                        <td>KW/002/RNS/2025</td>
                        <td class="text-center">18 Okt 2025</td>
                        <td>CV DentalTech</td>
                        <td>Pembayaran sebagian untuk pembelian alat laboratorium</td>
                        <td class="text-center fw-semibold">Rp 25.000.000</td>
                        <td class="text-center">
                          <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Belum Lunas</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Kwitansi">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>

                      <tr>
                        <td class="text-center">3</td>
                        <td>KW/003/RNS/2025</td>
                        <td class="text-center">22 Okt 2025</td>
                        <td>PT Sentosa Medika</td>
                        <td>Pembayaran akhir pengadaan barang proyek X</td>
                        <td class="text-center fw-semibold">Rp 70.000.000</td>
                        <td class="text-center">
                          <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Menunggu Verifikasi</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Kwitansi">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col fs-13 text-muted text-center">
                &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                - Made with <span class="mdi mdi-heart text-danger"></span> by
                <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
              </div>
            </div>
          </div>
        </footer>
        <!-- Floating Button Tambah Kwitansi -->
            <div class="content position-relative">
              <button
                type="button"
                class="btn btn-primary rounded-circle shadow-lg"
                style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Tambah Kwitansi"
              >
                <i class="mdi mdi-plus fs-3 text-white"></i>
              </button>
            </div>
      </div>
    </div>

    <!-- Vendor -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
  </body>
</html>
