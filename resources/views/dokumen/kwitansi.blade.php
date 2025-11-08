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
                      <tr>
                        <td class="text-center">1</td>
                        <td><strong>KW/001/RNS/2025</strong></td>
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
                          <a href="print-kwitansi" class="btn btn-sm btn-light border" title="Print Kwitansi">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>

                      <tr>
                        <td class="text-center">2</td>
                        <td><strong>KW/002/RNS/2025</strong></td>
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
                        <td><strong>KW/003/RNS/2025</strong></td>
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

        <!-- Floating Button Tambah Kwitansi -->
        <div class="content position-relative">
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
        </div>
      </div>
    </div>

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
                    name="nomorKwitansi"
                    placeholder="KW/004/RNS/2025"
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
                    name="tanggalKwitansi"
                    required
                  />
                </div>

                <!-- Nama Klien -->
                <div class="col-12 mb-3">
                  <label for="namaKlien" class="form-label fw-semibold">
                    Nama Klien <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="namaKlien" 
                    name="namaKlien"
                    placeholder="Contoh: PT Medika Sejahtera"
                    required
                  />
                </div>

                <!-- Keterangan Pembayaran -->
                <div class="col-12 mb-3">
                  <label for="keteranganPembayaran" class="form-label fw-semibold">
                    Keterangan Pembayaran <span class="text-danger">*</span>
                  </label>
                  <textarea 
                    class="form-control" 
                    id="keteranganPembayaran" 
                    name="keteranganPembayaran"
                    rows="3"
                    placeholder="Jelaskan detail pembayaran..."
                    required
                  ></textarea>
                </div>

                <!-- Total Pembayaran -->
                <div class="col-md-6 mb-3">
                  <label for="totalPembayaran" class="form-label fw-semibold">
                    Total Pembayaran (Rp) <span class="text-danger">*</span>
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="totalPembayaran" 
                    name="totalPembayaran"
                    placeholder="50.000.000"
                    required
                  />
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                  <label for="statusPembayaran" class="form-label fw-semibold">
                    Status <span class="text-danger">*</span>
                  </label>
                  <select class="form-select" id="statusPembayaran" name="statusPembayaran" required>
                    <option value="">Pilih Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="belum-lunas">Belum Lunas</option>
                    <option value="menunggu-verifikasi">Menunggu Verifikasi</option>
                  </select>
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
    <script>
      // Fungsi untuk set filter waktu
      function setFilter(filterName) {
        document.getElementById('selectedFilter').textContent = filterName;
        console.log('Filter dipilih:', filterName);
        // Untuk integrasi dengan backend, kirim request AJAX
      }

      // Fungsi untuk search kwitansi
      function searchKwitansi() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('tabelKwitansi');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
          let tdNo = tr[i].getElementsByTagName('td')[1]; // Nomor Kwitansi
          let tdKlien = tr[i].getElementsByTagName('td')[3]; // Nama Klien
          if (tdNo || tdKlien) {
            let txtNo = tdNo ? (tdNo.textContent || tdNo.innerText) : '';
            let txtKlien = tdKlien ? (tdKlien.textContent || tdKlien.innerText) : '';
            if (txtNo.toUpperCase().indexOf(filter) > -1 || txtKlien.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }

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

        // Handle simpan kwitansi
        $('#btnSimpanKwitansi').on('click', function() {
          const form = $('#formKwitansi')[0];
          
          if (form.checkValidity()) {
            // Ambil data dari form
            const formData = {
              nomorKwitansi: $('#nomorKwitansi').val(),
              tanggal: $('#tanggalKwitansi').val(),
              namaKlien: $('#namaKlien').val(),
              keterangan: $('#keteranganPembayaran').val(),
              totalPembayaran: $('#totalPembayaran').val(),
              status: $('#statusPembayaran').val()
            };

            // Di sini Anda bisa menambahkan AJAX request untuk menyimpan data ke server
            console.log('Data Kwitansi:', formData);

            // Tutup modal
            $('#modalTambahKwitansi').modal('hide');
            
            // Reset form
            form.reset();
            
            // Tampilkan notifikasi sukses (opsional)
            alert('Kwitansi berhasil disimpan!');
            
            // Reload halaman atau update tabel (opsional)
            // location.reload();
          } else {
            form.reportValidity();
          }
        });

        // Reset form ketika modal ditutup
        $('#modalTambahKwitansi').on('hidden.bs.modal', function() {
          $('#formKwitansi')[0].reset();
        });
      });
    </script>
  </body>
</html>