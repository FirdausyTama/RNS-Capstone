<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Kwitansi | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Daftar Kwitansi Pembayaran RNS" />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <h5 class="fw-semibold mb-1">Daftar Kwitansi Pembayaran</h5>
                    <p class="text-muted mb-0">Kelola dan pantau seluruh kwitansi transaksi Anda</p>
                  </div>
                  
                  <!-- Filter & Search -->
                  <div class="d-flex align-items-center gap-2">
                    <!-- Filter Waktu -->
                    <div class="dropdown">
                      <button class="btn btn-light border dropdown-toggle" type="button" id="filterWaktu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-calendar-range me-1"></i>
                        <span id="selectedFilter">Semua Waktu</span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="filterWaktu">
                        <li><a class="dropdown-item" href="#" onclick="setFilter('Hari Ini')">Hari Ini</a></li>
                        <li><a class="dropdown-item" href="#" onclick="setFilter('Minggu Ini')">Minggu Ini</a></li>
                        <li><a class="dropdown-item" href="#" onclick="setFilter('Bulan Ini')">Bulan Ini</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="setFilter('Semua Waktu')">Semua Waktu</a></li>
                      </ul>
                    </div>
                    
                    <!-- Search -->
                    <form class="app-search">
                      <div class="position-relative topbar-search">
                        <input type="text" class="form-control ps-4" placeholder="Cari kwitansi..." style="min-width: 200px;" id="searchInput" onkeyup="searchKwitansi()" />
                        <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                      </div>
                    </form>
                  </div>
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
                      <!-- Data will be loaded via JS -->
                    </tbody>
                  </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small class="text-muted">Menampilkan 1–3 dari 50 kwitansi</small>
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
      </div>
    </div>

    <!-- Floating Button Tambah Kwitansi (Kanan Bawah) -->
    <button
      type="button"
      id="btnTambahKwitansi"
      class="btn btn-primary rounded-circle shadow-lg"
      style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000;"
      data-bs-toggle="modal"
      data-bs-target="#modalTambahKwitansi"
      title="Tambah Kwitansi"
    >
      <i class="mdi mdi-plus fs-3 text-white"></i>
    </button>

    <!-- Modal Tambah Kwitansi -->
    <div class="modal fade" id="modalTambahKwitansi" tabindex="-1" aria-labelledby="modalTambahKwitansiLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalTambahKwitansiLabel">
              <i class="mdi mdi-receipt me-2"></i>Tambah Kwitansi Baru
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formKwitansi">
              <div class="row">
                <!-- Nomor Kwitansi -->
                <div class="col-md-6 mb-3">
                  <label for="nomorKwitansi" class="form-label fw-semibold">
                    Nomor Kwitansi <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="nomorKwitansi" 
                    name="nomor_kwitansi"
                    placeholder="04/RNS/AKUN/IX/2025"
                    required
                  />
                </div>

                <!-- Tanggal -->
                <div class="col-md-6 mb-3">
                  <label for="tanggalKwitansi" class="form-label fw-semibold">
                    Tanggal <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="date" 
                    class="form-control" 
                    id="tanggalKwitansi" 
                    name="tanggal"
                    required
                  />
                </div>

                <!-- Nama Pelanggan -->
                <div class="col-12 mb-3">
                  <label for="namaPenerima" class="form-label fw-semibold">
                    Nama Pelanggan <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="namaPenerima" 
                    name="nama_penerima"
                    placeholder="Contoh: PT Medika Sejahtera"
                    required
                  />
                </div>

                <!-- Alamat -->
                <div class="col-12 mb-3">
                  <label for="alamatPenerima" class="form-label fw-semibold">
                    Alamat <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="alamatPenerima" 
                    name="alamat_penerima"
                    placeholder="Jakarta, Indonesia"
                    required
                  />
                </div>

                <!-- Banyaknya Uang -->
                <div class="col-12 mb-3">
                  <label for="totalBilangan" class="form-label fw-semibold">
                    Banyaknya Uang <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="totalBilangan" 
                    name="total_bilangan"
                    placeholder="Dua puluh ribu rupiah"
                    required
                  />
                </div>

                <!-- Untuk Pembayaran -->
                <div class="col-12 mb-3">
                  <label for="keteranganPembayaran" class="form-label fw-semibold">
                    Untuk Pembayaran <span class="text-danger">*</span>
                  </label>
                  <textarea 
                    class="form-control" 
                    id="keteranganPembayaran" 
                    name="keterangan"
                    rows="3"
                    placeholder="Jelaskan detail pembayaran..."
                    required
                  ></textarea>
                </div>

                <!-- Total Jumlah -->
                <div class="col-md-6 mb-3">
                  <label for="totalPembayaran" class="form-label fw-semibold">
                    Total Jumlah <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="totalPembayaran" 
                    name="total_pembayaran"
                    placeholder="50000000"
                    required
                  />
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                  <label for="statusPembayaran" class="form-label fw-semibold">
                    Status <span class="text-danger">*</span>
                  </label>
                  <select class="form-select" id="statusPembayaran" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                  </select>
                </div>

                <!-- Penandatangan -->
                <div class="col-12 mb-3">
                  <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                      <h6 class="mb-0 fw-semibold"><i class="mdi mdi-pencil-outline me-2"></i>Penandatangan</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="form-label">Nama Penandatangan <span class="text-danger">*</span></label>
                          <select class="form-select" name="penandatangan" required>
                            <option value="">Pilih penandatangan...</option>
                            <option value="Dewi Sulistiowati">Dewi Sulistiowati</option>
                            <option value="Heri Pirdaus, S.Tr.Kes Rad (MRI)">Heri Pirdaus, S.Tr.Kes Rad (MRI)</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="mdi mdi-close me-1"></i>Batal
            </button>
            <button type="button" class="btn btn-primary" id="btnSimpanKwitansi">
              <i class="mdi mdi-content-save me-1"></i>Simpan Kwitansi
            </button>
          </div>
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

    <!-- Script untuk Handle Form -->
    <script src="{{ asset('assets/js/kwitansi.js') }}"></script>
    <script>
      $(document).ready(function() {
        // Format angka dengan titik pemisah ribuan
        $('#totalPembayaran').on('keyup', function() {
          let value = $(this).val().replace(/\./g, '');
          if (!isNaN(value) && value !== '') {
            $(this).val(parseInt(value).toLocaleString('id-ID'));
          }
        });

        // Set tanggal hari ini sebagai default
        const today = new Date().toISOString().split('T')[0];
        $('#tanggalKwitansi').val(today);
      });
    </script>
  </body>
</html>