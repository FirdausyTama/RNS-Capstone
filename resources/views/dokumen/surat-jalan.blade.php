<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Dokumen | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Daftar Surat Jalan RNS" />
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

    <div id="app-layout">
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
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

            <div class="card shadow-sm border-0">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <h5 class="fw-semibold mb-1">Daftar Surat Jalan</h5>
                    <p class="text-muted mb-0">Kelola dan pantau seluruh surat jalan pengiriman barang Anda</p>
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
                  <table id="tabelSJ" class="table table-bordered align-middle table-hover">
                    <thead class="table-light">
                      <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nomor Surat Jalan</th>
                        <th class="text-center">Tanggal</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Tujuan</th>
                        <th class="text-center">Jumlah Barang</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td><strong>SJ/001/RNS/2025</strong></td>
                        <td class="text-center">15 Okt 2025</td>
                        <td>PT Medika Sejahtera</td>
                        <td>Jl. Melati No.45, Sleman, Yogyakarta</td>
                        <td class="text-center">12</td>
                        <td class="text-center">
                          <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Dikirim</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="print-surat-jalan" class="btn btn-sm btn-light border" title="Print Surat Jalan">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td><strong>SJ/002/RNS/2025</strong></td>
                        <td class="text-center">18 Okt 2025</td>
                        <td>CV DentalTech</td>
                        <td>Jl. Kaliurang KM 7, Yogyakarta</td>
                        <td class="text-center">8</td>
                        <td class="text-center">
                          <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Proses</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Surat Jalan">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td><strong>SJ/003/RNS/2025</strong></td>
                        <td class="text-center">20 Okt 2025</td>
                        <td>PT Sentosa Medika</td>
                        <td>Jl. Kusumanegara No.20, Yogyakarta</td>
                        <td class="text-center">10</td>
                        <td class="text-center">
                          <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Tertunda</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                          </button>
                          <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Surat Jalan">
                            <i class="mdi mdi-printer text-dark"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small class="text-muted">Menampilkan 1–3 dari 50 surat jalan</small>
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
        
        <!-- Floating Button Tambah Surat Jalan -->
        <div class="content position-relative">
          <button
            type="button"
            id="btnTambahSuratJalan"
            class="btn btn-primary rounded-circle shadow-lg"
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000;"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Tambah Surat Jalan"
          >
            <i class="mdi mdi-plus fs-3 text-white"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Form Tambah Surat Jalan -->
    <div class="modal fade" id="modalTambahSuratJalan" tabindex="-1" aria-labelledby="modalTambahSuratJalanLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalTambahSuratJalanLabel">
              <i class="mdi mdi-file-document-outline me-2"></i>Tambah Surat Jalan Baru
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formSuratJalan" action="/surat-jalan/store" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nomor_surat" class="form-label">Nomor Surat Jalan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="SJ/001/RNS/2025" required>
                  <small class="text-muted">Contoh: SJ/001/RNS/2025</small>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="nama_penerima" class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="PT Medika Sejahtera" required>
              </div>

              <div class="mb-3">
                <label for="alamat_tujuan" class="form-label">Alamat Tujuan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat_tujuan" name="alamat_tujuan" rows="3" placeholder="Jl. Melati No.45, Sleman, Yogyakarta" required></textarea>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="jumlah_barang" class="form-label">Jumlah Barang <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="0" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                  <select class="form-select" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="proses" selected>Proses</option>
                    <option value="dikirim">Dikirim</option>
                    <option value="tertunda">Tertunda</option>
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
              </div>

              <div class="alert alert-info mb-0" role="alert">
                <i class="mdi mdi-information-outline me-2"></i>
                <strong>Info:</strong> Pastikan semua data sudah benar sebelum menyimpan. Data yang tersimpan akan langsung masuk ke sistem.
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="mdi mdi-close me-1"></i>Batal
            </button>
            <button type="submit" form="formSuratJalan" class="btn btn-primary">
              <i class="mdi mdi-content-save me-1"></i>Simpan Surat Jalan
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendor JS -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <!-- Script Custom -->
    <script>
      // Fungsi untuk set filter waktu
      function setFilter(filterName) {
        document.getElementById('selectedFilter').textContent = filterName;
        console.log('Filter dipilih:', filterName);
        // Untuk integrasi dengan backend, kirim request AJAX
      }

      // Fungsi untuk search surat jalan
      function searchSuratJalan() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('tabelSJ');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
          let tdNo = tr[i].getElementsByTagName('td')[1]; // Nomor Surat Jalan
          let tdPenerima = tr[i].getElementsByTagName('td')[3]; // Nama Penerima
          if (tdNo || tdPenerima) {
            let txtNo = tdNo ? (tdNo.textContent || tdNo.innerText) : '';
            let txtPenerima = tdPenerima ? (tdPenerima.textContent || tdPenerima.innerText) : '';
            if (txtNo.toUpperCase().indexOf(filter) > -1 || txtPenerima.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }

      $(document).ready(function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Event handler untuk button tambah surat jalan - BUKA MODAL
        $('#btnTambahSuratJalan').on('click', function() {
          $('#modalTambahSuratJalan').modal('show');
        });

        // Set tanggal hari ini sebagai default saat modal dibuka
        $('#modalTambahSuratJalan').on('shown.bs.modal', function () {
          if (!$('#tanggal').val()) {
            $('#tanggal').val(new Date().toISOString().split('T')[0]);
          }
          $('#nomor_surat').focus();
        });

        // Handle form submit
        $('#formSuratJalan').on('submit', function(e) {
          e.preventDefault();
          
          // Ambil data form
          var formData = {
            nomor_surat: $('#nomor_surat').val(),
            tanggal: $('#tanggal').val(),
            nama_penerima: $('#nama_penerima').val(),
            alamat_tujuan: $('#alamat_tujuan').val(),
            jumlah_barang: $('#jumlah_barang').val(),
            status: $('#status').val(),
            keterangan: $('#keterangan').val()
          };

          console.log('Data yang akan disimpan:', formData);
          
          // Di sini nanti kirim data ke server menggunakan AJAX
          /*
          $.ajax({
            url: '/surat-jalan/store',
            method: 'POST',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              alert('Surat jalan berhasil disimpan!');
              $('#modalTambahSuratJalan').modal('hide');
              location.reload();
            },
            error: function(xhr) {
              alert('Terjadi kesalahan saat menyimpan data!');
              console.error(xhr.responseText);
            }
          });
          */
          
          // Untuk sementara hanya alert
          alert('Data surat jalan berhasil disimpan!\n\nNomor: ' + formData.nomor_surat + '\nPenerima: ' + formData.nama_penerima);
          
          // Tutup modal
          $('#modalTambahSuratJalan').modal('hide');
          
          // Reset form
          this.reset();
          
          // TODO: Reload halaman atau update tabel secara dinamis
          // location.reload();
        });

        // Reset form saat modal ditutup
        $('#modalTambahSuratJalan').on('hidden.bs.modal', function () {
          $('#formSuratJalan')[0].reset();
        });
      });
    </script>
  </body>
</html>