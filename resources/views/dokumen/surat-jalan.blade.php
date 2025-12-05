<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Surat Jalan | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Daftar Surat Jalan RNS" />
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
                <h4 class="fs-18 fw-semibold m-0">Surat Jalan</h4>
              </div>

              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                  <li class="breadcrumb-item active">Surat Jalan</li>
                </ol>
              </div>
            </div>

            <!-- Card Table -->
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <h5 class="fw-semibold mb-1">Daftar Surat Jalan</h5>
                    <p class="text-muted mb-0">Kelola dan pantau seluruh surat jalan pengiriman Anda</p>
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
                        <input type="text" class="form-control ps-4" placeholder="Cari surat jalan..." style="min-width: 200px;" id="searchInput" onkeyup="searchSuratJalan()" />
                        <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="tabelSuratJalan" class="table table-bordered align-middle table-hover">
                    <thead class="table-light">
                      <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th class="text-center">Tanggal</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Penerima</th>
                        <th>Nama Barang/Jasa</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Data will be loaded via JS -->
                    </tbody>
                  </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small class="text-muted">Menampilkan data surat jalan</small>
                  <nav>
                    <ul class="pagination pagination-sm mb-0">
                      <!-- Pagination logic can be added here -->
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

    <!-- Floating Button Tambah Surat Jalan -->
    <button
      type="button"
      id="btnTambahSuratJalan"
      class="btn btn-primary rounded-circle shadow-lg"
      style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000;"
      data-bs-toggle="modal"
      data-bs-target="#modalTambahSuratJalan"
      title="Tambah Surat Jalan"
    >
      <i class="mdi mdi-plus fs-3 text-white"></i>
    </button>

    <!-- Modal Tambah Surat Jalan -->
    <div class="modal fade" id="modalTambahSuratJalan" tabindex="-1" aria-labelledby="modalTambahSuratJalanLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalTambahSuratJalanLabel">
              <i class="mdi mdi-truck-delivery me-2"></i>Tambah Surat Jalan Baru
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formSuratJalan">
              <div class="row">
                <!-- Tanggal -->
                <div class="col-md-6 mb-3">
                  <label for="tanggalSuratJalan" class="form-label fw-semibold">
                    Tanggal <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="date" 
                    class="form-control" 
                    id="tanggalSuratJalan" 
                    name="tanggal"
                    required
                  />
                </div>

                <!-- Nama Pengirim -->
                <div class="col-md-6 mb-3">
                  <label for="namaPengirim" class="form-label fw-semibold">
                    Nama Pengirim <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="namaPengirim" 
                    name="nama_pengirim"
                    placeholder="Contoh: PT RNS"
                    required
                  />
                </div>

                <!-- Nama Penerima -->
                <div class="col-md-6 mb-3">
                  <label for="namaPenerima" class="form-label fw-semibold">
                    Nama Penerima <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="namaPenerima" 
                    name="nama_penerima"
                    placeholder="Contoh: RSUD Serang"
                    required
                  />
                </div>

                <!-- Telp Penerima -->
                <div class="col-md-6 mb-3">
                  <label for="telpPenerima" class="form-label fw-semibold">
                    No. Telp Penerima <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="telpPenerima" 
                    name="telp_penerima"
                    placeholder="081234567890"
                    required
                  />
                </div>

                <!-- Alamat Penerima -->
                <div class="col-12 mb-3">
                  <label for="alamatPenerima" class="form-label fw-semibold">
                    Alamat Penerima <span class="text-danger">*</span>
                  </label>
                  <textarea 
                    class="form-control" 
                    id="alamatPenerima" 
                    name="alamat_penerima"
                    rows="2"
                    placeholder="Alamat lengkap penerima"
                    required
                  ></textarea>
                </div>

                <!-- Nama Barang/Jasa -->
                <div class="col-12 mb-3">
                  <label for="namaBarangJasa" class="form-label fw-semibold">
                    Nama Barang/Jasa <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="namaBarangJasa" 
                    name="nama_barang_jasa"
                    placeholder="Contoh: Jasa Service MRI"
                    required
                  />
                </div>

                <!-- Qty & Jumlah -->
                <div class="col-md-6 mb-3">
                  <label for="qty" class="form-label fw-semibold">
                    Qty <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="number" 
                    class="form-control" 
                    id="qty" 
                    name="qty"
                    placeholder="1"
                    required
                  />
                </div>

                <div class="col-md-6 mb-3">
                  <label for="jumlah" class="form-label fw-semibold">
                    Jumlah (Rp) <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="number" 
                    class="form-control" 
                    id="jumlah" 
                    name="jumlah"
                    placeholder="1000000"
                    required
                  />
                </div>

                <!-- Keterangan -->
                <div class="col-12 mb-3">
                  <label for="keterangan" class="form-label fw-semibold">
                    Keterangan
                  </label>
                  <textarea 
                    class="form-control" 
                    id="keterangan" 
                    name="keterangan"
                    rows="2"
                    placeholder="Catatan tambahan..."
                  ></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="mdi mdi-close me-1"></i>Batal
            </button>
            <button type="button" class="btn btn-primary" id="btnSimpanSuratJalan">
              <i class="mdi mdi-content-save me-1"></i>Simpan Surat Jalan
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
    <script src="{{ asset('assets/js/surat-jalan.js') }}"></script>
    <script>
      $(document).ready(function() {
        // Set tanggal hari ini sebagai default
        const today = new Date().toISOString().split('T')[0];
        $('#tanggalSuratJalan').val(today);
      });
    </script>
  </body>
</html>
