<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Invoice | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Halaman daftar dan pengelolaan surat invoice RNS." />
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
                <h4 class="fs-18 fw-semibold m-0">Surat Invoice</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                  <li class="breadcrumb-item active">Invoice</li>
                </ol>
              </div>
            </div>
          </div>

          <!-- Start Main Widgets -->
          <div class="row">
            <div class="container-fluid">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                      <h5 class="fw-semibold mb-1">Daftar Surat Invoice</h5>
                      <p class="text-muted mb-0">Kelola dan pantau seluruh surat invoice Anda</p>
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
                          <input type="text" class="form-control ps-4" placeholder="Cari invoice..." style="min-width: 200px;" id="searchInput" onkeyup="searchInvoice()" />
                          <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table id="tabelInvoice" class="table table-bordered align-middle table-hover">
                      <thead class="table-light">
                        <tr>
                          <th class="text-center" style="width: 50px;">No</th>
                          <th>Nomor Invoice</th>
                          <th class="text-center">Tanggal</th>
                          <th>Nama Perusahaan</th>
                          <th class="text-center">Nilai Tagihan</th>
                          <th class="text-center">Status</th>
                          <th class="text-center" style="width: 100px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">1</td>
                          <td><strong>INV/001/RNS/2025</strong></td>
                          <td class="text-center">25 Okt 2025</td>
                          <td>PT Medika Sejahtera</td>
                          <td class="text-center fw-semibold">Rp 125.000.000</td>
                          <td class="text-center">
                            <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                              <i class="mdi mdi-square-edit-outline text-primary"></i>
                            </button>
                            <a href="print-invoice" class="btn btn-sm btn-light border" title="Print Invoice">
                              <i class="mdi mdi-printer text-dark"></i>
                            </a>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-center">2</td>
                          <td><strong>INV/002/RNS/2025</strong></td>
                          <td class="text-center">28 Okt 2025</td>
                          <td>CV DentalTech</td>
                          <td class="text-center fw-semibold">Rp 58.000.000</td>
                          <td class="text-center">
                            <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Belum Lunas</span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                              <i class="mdi mdi-square-edit-outline text-primary"></i>
                            </button>
                            <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Invoice">
                              <i class="mdi mdi-printer text-dark"></i>
                            </a>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-center">3</td>
                          <td><strong>INV/003/RNS/2025</strong></td>
                          <td class="text-center">29 Okt 2025</td>
                          <td>PT Sentosa Medika</td>
                          <td class="text-center fw-semibold">Rp 92.000.000</td>
                          <td class="text-center">
                            <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Dibatalkan</span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-light border me-1" title="Lihat Detail">
                              <i class="mdi mdi-square-edit-outline text-primary"></i>
                            </button>
                            <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Print Invoice">
                              <i class="mdi mdi-printer text-dark"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <small class="text-muted">Menampilkan 1–3 dari 50 invoice</small>
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
          <!-- End Main Widgets -->
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col fs-13 text-muted text-center">
                &copy; <script>document.write(new Date().getFullYear())</script> - Made with
                <span class="mdi mdi-heart text-danger"></span> by
                <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
              </div>
            </div>
          </div>
        </footer>

        <!-- Floating Button Tambah Invoice -->
        <div class="content position-relative">
          <button
            type="button"
            id="btnTambahInvoice"
            class="btn btn-primary rounded-circle shadow-lg"
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000;"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahInvoice"
            title="Tambah Invoice">
            <i class="mdi mdi-plus fs-3 text-white"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Invoice -->
    <div class="modal fade" id="modalTambahInvoice" tabindex="-1" aria-labelledby="modalTambahInvoiceLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalTambahInvoiceLabel">
              <i class="mdi mdi-file-document me-2"></i>Tambah Surat Invoice Baru
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formInvoice">
              <!-- Section 1: Informasi Invoice -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="mdi mdi-information-outline me-1"></i>Informasi Invoice
                </h6>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="nomorInvoice" class="form-label fw-semibold">
                      Nomor Invoice <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="nomorInvoice" 
                      name="nomorInvoice"
                      placeholder="INV/004/RNS/2025"
                      required
                    />
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="tanggalInvoice" class="form-label fw-semibold">
                      Tanggal Invoice <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="date" 
                      class="form-control" 
                      id="tanggalInvoice" 
                      name="tanggalInvoice"
                      required
                    />
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="tanggalJatuhTempo" class="form-label fw-semibold">
                      Tanggal Jatuh Tempo <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="date" 
                      class="form-control" 
                      id="tanggalJatuhTempo" 
                      name="tanggalJatuhTempo"
                      required
                    />
                  </div>
                </div>
              </div>

              <!-- Section 2: Informasi Pelanggan -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="mdi mdi-domain me-1"></i>Informasi Pelanggan
                </h6>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="namaPerusahaan" class="form-label fw-semibold">
                      Nama Perusahaan <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="namaPerusahaan" 
                      name="namaPerusahaan"
                      placeholder="Contoh: PT Medika Sejahtera"
                      required
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="npwpPerusahaan" class="form-label fw-semibold">
                      NPWP Perusahaan
                    </label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="npwpPerusahaan" 
                      name="npwpPerusahaan"
                      placeholder="XX.XXX.XXX.X-XXX.XXX"
                    />
                  </div>

                  <div class="col-12 mb-3">
                    <label for="alamatPerusahaan" class="form-label fw-semibold">
                      Alamat Perusahaan <span class="text-danger">*</span>
                    </label>
                    <textarea 
                      class="form-control" 
                      id="alamatPerusahaan" 
                      name="alamatPerusahaan"
                      rows="2"
                      placeholder="Masukkan alamat lengkap perusahaan"
                      required
                    ></textarea>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="kontakPerson" class="form-label fw-semibold">
                      Kontak Person
                    </label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="kontakPerson" 
                      name="kontakPerson"
                      placeholder="Nama kontak person"
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="teleponPerusahaan" class="form-label fw-semibold">
                      Nomor Telepon
                    </label>
                    <input 
                      type="tel" 
                      class="form-control" 
                      id="teleponPerusahaan" 
                      name="teleponPerusahaan"
                      placeholder="08xx-xxxx-xxxx"
                    />
                  </div>
                </div>
              </div>

              <!-- Section 3: Detail Item -->
              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="fw-bold text-primary mb-0">
                    <i class="mdi mdi-clipboard-list me-1"></i>Detail Item Invoice
                  </h6>
                  <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahItem">
                    <i class="mdi mdi-plus-circle me-1"></i>Tambah Item
                  </button>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered" id="tabelDetailItem">
                    <thead class="table-light">
                      <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 30%;">Nama Item</th>
                        <th style="width: 15%;">Qty</th>
                        <th style="width: 20%;">Harga Satuan</th>
                        <th style="width: 20%;">Subtotal</th>
                        <th style="width: 10%;" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="itemContainer">
                      <tr class="item-row">
                        <td class="text-center">1</td>
                        <td>
                          <input type="text" class="form-control form-control-sm" name="namaItem[]" placeholder="Nama barang/jasa" required>
                        </td>
                        <td>
                          <input type="number" class="form-control form-control-sm qty-input" name="qty[]" placeholder="0" min="1" value="1" required>
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm harga-input" name="hargaSatuan[]" placeholder="0" required>
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm subtotal-input" name="subtotal[]" placeholder="0" readonly>
                        </td>
                        <td class="text-center">
                          <button type="button" class="btn btn-sm btn-danger btn-hapus-item" disabled>
                            <i class="mdi mdi-delete"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Section 4: Total & Pajak -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="mdi mdi-calculator me-1"></i>Ringkasan Pembayaran
                </h6>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="subtotalInvoice" class="form-label fw-semibold">Subtotal</label>
                    <input type="text" class="form-control" id="subtotalInvoice" readonly>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="pajakPersen" class="form-label fw-semibold">Pajak (%)</label>
                    <input type="number" class="form-control" id="pajakPersen" name="pajakPersen" placeholder="11" min="0" max="100" value="11">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="nilaiPajak" class="form-label fw-semibold">Nilai Pajak</label>
                    <input type="text" class="form-control" id="nilaiPajak" readonly>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="totalInvoice" class="form-label fw-semibold">Total Tagihan</label>
                    <input type="text" class="form-control fw-bold text-primary" id="totalInvoice" readonly>
                  </div>

                  <div class="col-12 mb-3">
                    <label for="keteranganInvoice" class="form-label fw-semibold">Keterangan Tambahan</label>
                    <textarea class="form-control" id="keteranganInvoice" name="keteranganInvoice" rows="2" placeholder="Catatan atau keterangan tambahan (opsional)"></textarea>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="statusInvoice" class="form-label fw-semibold">
                      Status <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="statusInvoice" name="statusInvoice" required>
                      <option value="">Pilih Status</option>
                      <option value="lunas">Lunas</option>
                      <option value="belum-lunas">Belum Lunas</option>
                      <option value="dibatalkan">Dibatalkan</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="mdi mdi-close me-1"></i>Batal
            </button>
            <button type="button" class="btn btn-primary" id="btnSimpanInvoice">
              <i class="mdi mdi-content-save me-1"></i>Simpan Invoice
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
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- Script untuk Handle Form Invoice -->
    <script>
      // Fungsi untuk set filter waktu
      function setFilter(filterName) {
        document.getElementById('selectedFilter').textContent = filterName;
        console.log('Filter dipilih:', filterName);
        // Untuk integrasi dengan backend, kirim request AJAX
      }

      // Fungsi untuk search invoice
      function searchInvoice() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('tabelInvoice');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
          let tdNo = tr[i].getElementsByTagName('td')[1]; // Nomor Invoice
          let tdPerusahaan = tr[i].getElementsByTagName('td')[3]; // Nama Perusahaan
          if (tdNo || tdPerusahaan) {
            let txtNo = tdNo ? (tdNo.textContent || tdNo.innerText) : '';
            let txtPerusahaan = tdPerusahaan ? (tdPerusahaan.textContent || tdPerusahaan.innerText) : '';
            if (txtNo.toUpperCase().indexOf(filter) > -1 || txtPerusahaan.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = '';
            } else {
              tr[i].style.display = 'none';
            }
          }
        }
      }

      $(document).ready(function() {
        let itemCounter = 1;

        // Format rupiah
        function formatRupiah(angka) {
          if (!angka) return '0';
          return parseInt(angka.toString().replace(/\D/g, '')).toLocaleString('id-ID');
        }

        // Parse rupiah ke number
        function parseRupiah(rupiah) {
          return parseInt(rupiah.replace(/\D/g, '')) || 0;
        }

        // Set tanggal default
        const today = new Date().toISOString().split('T')[0];
        $('#tanggalInvoice').val(today);
        
        // Set jatuh tempo 30 hari dari hari ini
        const dueDate = new Date();
        dueDate.setDate(dueDate.getDate() + 30);
        $('#tanggalJatuhTempo').val(dueDate.toISOString().split('T')[0]);

        // Hitung subtotal per item
        function hitungSubtotal(row) {
          const qty = parseInt($(row).find('.qty-input').val()) || 0;
          const harga = parseRupiah($(row).find('.harga-input').val());
          const subtotal = qty * harga;
          $(row).find('.subtotal-input').val(formatRupiah(subtotal));
          hitungTotal();
        }

        // Hitung total keseluruhan
        function hitungTotal() {
          let total = 0;
          $('.subtotal-input').each(function() {
            total += parseRupiah($(this).val());
          });

          $('#subtotalInvoice').val('Rp ' + formatRupiah(total));

          const pajakPersen = parseFloat($('#pajakPersen').val()) || 0;
          const nilaiPajak = (total * pajakPersen) / 100;
          $('#nilaiPajak').val('Rp ' + formatRupiah(nilaiPajak));

          const grandTotal = total + nilaiPajak;
          $('#totalInvoice').val('Rp ' + formatRupiah(grandTotal));
        }

        // Format input harga
        $(document).on('keyup', '.harga-input', function() {
          const value = $(this).val().replace(/\D/g, '');
          $(this).val(formatRupiah(value));
          hitungSubtotal($(this).closest('tr'));
        });

        // Update saat qty berubah
        $(document).on('change', '.qty-input', function() {
          hitungSubtotal($(this).closest('tr'));
        });

        // Update saat pajak berubah
        $('#pajakPersen').on('change keyup', function() {
          hitungTotal();
        });

        // Tambah item baru
        $('#btnTambahItem').on('click', function() {
          itemCounter++;
          const newRow = `
            <tr class="item-row">
              <td class="text-center">${itemCounter}</td>
              <td>
                <input type="text" class="form-control form-control-sm" name="namaItem[]" placeholder="Nama barang/jasa" required>
              </td>
              <td>
                <input type="number" class="form-control form-control-sm qty-input" name="qty[]" placeholder="0" min="1" value="1" required>
              </td>
              <td>
                <input type="text" class="form-control form-control-sm harga-input" name="hargaSatuan[]" placeholder="0" required>
              </td>
              <td>
                <input type="text" class="form-control form-control-sm subtotal-input" name="subtotal[]" placeholder="0" readonly>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger btn-hapus-item">
                  <i class="mdi mdi-delete"></i>
                </button>
              </td>
            </tr>
          `;
          $('#itemContainer').append(newRow);
          updateDeleteButtons();
        });

        // Hapus item
        $(document).on('click', '.btn-hapus-item', function() {
          $(this).closest('tr').remove();
          updateItemNumbers();
          hitungTotal();
          updateDeleteButtons();
        });

        // Update nomor urut item
        function updateItemNumbers() {
          $('#itemContainer tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
          });
          itemCounter = $('#itemContainer tr').length;
        }

        // Update status tombol hapus
        function updateDeleteButtons() {
          const rowCount = $('#itemContainer tr').length;
          $('.btn-hapus-item').prop('disabled', rowCount <= 1);
        }

        // Format NPWP
        $('#npwpPerusahaan').on('keyup', function() {
          let value = $(this).val().replace(/\D/g, '');
          if (value.length > 15) value = value.substr(0, 15);
          
          if (value.length > 0) {
            let formatted = '';
            if (value.length >= 2) formatted += value.substr(0, 2) + '.';
            if (value.length >= 5) formatted += value.substr(2, 3) + '.';
            if (value.length >= 8) formatted += value.substr(5, 3) + '.';
            if (value.length >= 9) formatted += value.substr(8, 1) + '-';
            if (value.length >= 12) formatted += value.substr(9, 3) + '.';
            if (value.length >= 15) formatted += value.substr(12, 3);
            else if (value.length > 9) formatted += value.substr(9);
            
            $(this).val(formatted);
          }
        });

        // Simpan invoice
        $('#btnSimpanInvoice').on('click', function() {
          const form = $('#formInvoice')[0];
          
          if (form.checkValidity()) {
            // Kumpulkan data items
            const items = [];
            $('#itemContainer tr').each(function() {
              items.push({
                nama: $(this).find('input[name="namaItem[]"]').val(),
                qty: $(this).find('input[name="qty[]"]').val(),
                harga: $(this).find('.harga-input').val(),
                subtotal: $(this).find('.subtotal-input').val()
              });
            });

            const formData = {
              nomorInvoice: $('#nomorInvoice').val(),
              tanggalInvoice: $('#tanggalInvoice').val(),
              tanggalJatuhTempo: $('#tanggalJatuhTempo').val(),
              namaPerusahaan: $('#namaPerusahaan').val(),
              npwp: $('#npwpPerusahaan').val(),
              alamat: $('#alamatPerusahaan').val(),
              kontakPerson: $('#kontakPerson').val(),
              telepon: $('#teleponPerusahaan').val(),
              items: items,
              subtotal: $('#subtotalInvoice').val(),
              pajakPersen: $('#pajakPersen').val(),
              nilaiPajak: $('#nilaiPajak').val(),
              totalTagihan: $('#totalInvoice').val(),
              keterangan: $('#keteranganInvoice').val(),
              status: $('#statusInvoice').val()
            };

            console.log('Data Invoice:', formData);

            // AJAX request ke server (sesuaikan dengan endpoint Anda)
            /*
            $.ajax({
              url: '/api/invoice/store',
              method: 'POST',
              data: formData,
              success: function(response) {
                $('#modalTambahInvoice').modal('hide');
                alert('Invoice berhasil disimpan!');
                location.reload();
              },
              error: function(error) {
                alert('Gagal menyimpan invoice!');
              }
            });
            */

            // Sementara
            $('#modalTambahInvoice').modal('hide');
            alert('Invoice berhasil disimpan!');
          } else {
            form.reportValidity();
          }
        });

        // Reset form ketika modal ditutup
        $('#modalTambahInvoice').on('hidden.bs.modal', function() {
          $('#formInvoice')[0].reset();
          $('#itemContainer').html(`
            <tr class="item-row">
              <td class="text-center">1</td>
              <td>
                <input type="text" class="form-control form-control-sm" name="namaItem[]" placeholder="Nama barang/jasa" required>
              </td>
              <td>
                <input type="number" class="form-control form-control-sm qty-input" name="qty[]" placeholder="0" min="1" value="1" required>
              </td>
              <td>
                <input type="text" class="form-control form-control-sm harga-input" name="hargaSatuan[]" placeholder="0" required>
              </td>
              <td>
                <input type="text" class="form-control form-control-sm subtotal-input" name="subtotal[]" placeholder="0" readonly>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger btn-hapus-item" disabled>
                  <i class="mdi mdi-delete"></i>
                </button>
              </td>
            </tr>
          `);
          itemCounter = 1;
          $('#subtotalInvoice, #nilaiPajak, #totalInvoice').val('');
        });
      });
    </script>
  </body>
</html>