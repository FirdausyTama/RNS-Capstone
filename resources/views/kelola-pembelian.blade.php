<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pembelian | RNS - Ranay Nusantara Sejathera</title>
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

        <style>
            /* Floating Button Style */
            .floating-btn {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 60px;
                height: 60px;
                background: #0d6efd;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 1000;
                border: none;
            }

            .floating-btn:hover {
                background: #0b5ed7;
                transform: scale(1.1);
                box-shadow: 0 6px 16px rgba(13, 110, 253, 0.5);
            }

            .floating-btn i {
                color: white;
                font-size: 28px;
            }

            /* Modal Custom Styles */
            .modal-header {
                background: #fff;
                border-bottom: 1px solid #e9ecef;
                padding: 16px 24px;
            }

            .modal-title {
                font-size: 16px;
                font-weight: 600;
                color: #212529;
                display: flex;
                align-items: center;
            }

            .modal-title i {
                color: #ffc107;
                margin-right: 8px;
                font-size: 20px;
            }

            .modal-body {
                padding: 24px;
                background: #f8f9fa;
            }

            /* Section Styles */
            .section-card {
                background: #fff;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 16px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }

            .section-title {
                font-size: 14px;
                font-weight: 600;
                color: #495057;
                margin-bottom: 16px;
                padding-bottom: 8px;
                border-bottom: 1px solid #e9ecef;
            }

            /* Form Styles */
            .form-label {
                font-size: 12px;
                font-weight: 500;
                color: #6c757d;
                margin-bottom: 6px;
            }

            .form-control, .form-select {
                font-size: 13px;
                border: 1px solid #ced4da;
                border-radius: 6px;
                padding: 8px 12px;
                height: auto;
            }

            .form-control:focus, .form-select:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            }

            .form-control:read-only {
                background-color: #e9ecef;
            }

            /* Item Row Styles */
            .items-container {
                background: #fff;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 16px;
            }

            .item-row {
                background: #f8f9fa;
                border: 1px solid #e9ecef;
                border-radius: 6px;
                padding: 16px;
                margin-bottom: 12px;
            }

            .item-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }

            .item-label {
                font-size: 12px;
                font-weight: 500;
                color: #6c757d;
                margin-bottom: 4px;
            }

            /* Button Styles */
            .btn-add-item {
                background: #0d6efd;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 500;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .btn-add-item:hover {
                background: #0b5ed7;
            }

            .btn-remove-item {
                background: #dc3545;
                color: white;
                border: none;
                width: 32px;
                height: 32px;
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
            }

            .btn-remove-item:hover {
                background: #bb2d3b;
            }

            /* Total Section */
            .total-section {
                background: #fff;
                border-radius: 8px;
                padding: 16px 20px;
                margin-bottom: 16px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }

            .total-label {
                font-size: 14px;
                font-weight: 600;
                color: #495057;
            }

            .total-value {
                font-size: 18px;
                font-weight: 700;
                color: #0d6efd;
            }

            /* Radio Styles */
            .radio-group {
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
            }

            .radio-item {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .radio-item input[type="radio"] {
                margin: 0;
                cursor: pointer;
            }

            .radio-item label {
                margin: 0;
                font-size: 13px;
                font-weight: 500;
                color: #495057;
                cursor: pointer;
            }

            /* Modal Footer */
            .modal-footer {
                padding: 16px 24px;
                border-top: 1px solid #e9ecef;
                background: #fff;
            }

            .modal-footer .btn {
                padding: 8px 20px;
                font-size: 13px;
                font-weight: 500;
                border-radius: 6px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .floating-btn {
                    width: 50px;
                    height: 50px;
                    bottom: 20px;
                    right: 20px;
                }

                .floating-btn i {
                    font-size: 24px;
                }
            }
        </style>
    </head>

    <body data-menu-color="light" data-sidebar="default">
        @include('navbar.navbar')
        
        <div id="app-layout">
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Kelola Pembelian</h4>
                            </div>
            
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Kelola Pembelian</li>
                                </ol>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <h5 class="fw-semibold mb-1">Kelola Pembelian</h5>
                                            <p class="text-muted mb-0">Lihat dan kelola riwayat pembelian produk dari supplier</p>
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
                                                    <input type="text" class="form-control ps-4" placeholder="Cari transaksi..." style="min-width: 200px;" id="searchInput" onkeyup="searchTransaction()" />
                                                    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-hover" id="transactionTable">
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
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><strong>TRX-2025-001</strong></td>
                                                    <td class="text-center">17 Feb 2025</td>
                                                    <td>PT Medika Sejahtera</td>
                                                    <td class="text-center fw-semibold">Rp 65.000.000</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Cicilan</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-light border me-1" onclick="window.location.href='/detail-pembelian/1'" title="Lihat Detail">
                                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                        </button>
                                                        <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                                                            <i class="mdi mdi-eye-outline text-dark"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td><strong>TRX-2025-002</strong></td>
                                                    <td class="text-center">21 Feb 2025</td>
                                                    <td>CV DentalTech</td>
                                                    <td class="text-center fw-semibold">Rp 42.500.000</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Belum Lunas</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-light border me-1" onclick="window.location.href='/detail-pembelian/2'" title="Lihat Detail">
                                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                        </button>
                                                        <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                                                            <i class="mdi mdi-eye-outline text-dark"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td><strong>TRX-2025-003</strong></td>
                                                    <td class="text-center">28 Feb 2025</td>
                                                    <td>PT Sentosa Medika</td>
                                                    <td class="text-center fw-semibold">Rp 89.000.000</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Cicilan</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-light border me-1" onclick="window.location.href='/detail-pembelian/3'" title="Lihat Detail">
                                                            <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                        </button>
                                                        <a href="javascript:window.print()" class="btn btn-sm btn-light border" title="Cetak Invoice">
                                                            <i class="mdi mdi-eye-outline text-dark"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

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
                        
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Floating Button -->
        <button class="floating-btn" data-bs-toggle="modal" data-bs-target="#inputPembelianModal" title="Tambah Pembelian">
            <i class="mdi mdi-plus"></i>
        </button>

        <!-- Modal Input Pembelian -->
        <div class="modal fade" id="inputPembelianModal" tabindex="-1" aria-labelledby="inputPembelianModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputPembelianModalLabel">
                            <i class="mdi mdi-clipboard-text"></i>Input Pembelian
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPembelian">
                            <!-- Informasi Pesanan -->
                            <div class="section-card">
                                <div class="section-title">Informasi Pesanan</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="noOrder" class="form-label">No. Order</label>
                                        <input type="text" class="form-control" id="noOrder" placeholder="ORJ-2025-001" value="ORJ-2025-001" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggalPembelian" class="form-label">Tanggal Pembelian</label>
                                        <input type="date" class="form-control" id="tanggalPembelian" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Customer -->
                            <div class="section-card">
                                <div class="section-title">Data Customer</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="namaCustomer" class="form-label">Nama Customer</label>
                                        <input type="text" class="form-control" id="namaCustomer" placeholder="Masukkan nama customer" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="noTelepon" class="form-label">No. Telepon</label>
                                        <input type="tel" class="form-control" id="noTelepon" placeholder="08xx-xxxx-xxxx" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Pilih Barang -->
                            <div class="items-container">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="section-title mb-0">Pilih Barang</div>
                                    <button type="button" class="btn-add-item" id="btnTambahBarang">
                                        <i class="mdi mdi-plus"></i>Tambah Barang
                                    </button>
                                </div>
                                <div id="containerBarang">
                                    <!-- Item pertama -->
                                    <div class="item-row" data-item="1">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <div class="item-label">Nama Barang</div>
                                                <select class="form-select select-barang" required>
                                                    <option value="">Pilih barang...</option>
                                                    <option value="1" data-harga="1000000">Betre Alat</option>
                                                    <option value="2" data-harga="40000000">Mesin Ronsen</option>
                                                    <option value="3" data-harga="300000000">Mesin Kursi Gigi</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="item-label">Harga Satuan</div>
                                                <input type="text" class="form-control harga-satuan" placeholder="Rp 0" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="item-label">Jumlah</div>
                                                <input type="number" class="form-control jumlah-barang" placeholder="1" min="1" value="1" required>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="item-label">Total</div>
                                                <input type="text" class="form-control total-item" placeholder="Rp 0" readonly>
                                            </div>
                                            <div class="col-md-1 text-center">
                                                <button type="button" class="btn-remove-item" onclick="hapusItem(this)" style="display:none;">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Keseluruhan -->
                            <div class="total-section">
                                <span class="total-label">Total Keseluruhan:</span>
                                <span class="total-value" id="totalKeseluruhan">Rp 0</span>
                            </div>

                            <!-- Status Pesanan -->
                            <div class="section-card">
                                <div class="section-title">Status Pesanan</div>
                                <div class="row g-3">
                                    
                                    <div class="col-md-6">
                                        <label class="form-label d-block mb-2">Status Pembayaran</label>
                                        <div class="radio-group">
                                            <div class="radio-item">
                                                <input type="radio" id="statusLunas" name="statusPembayaran" value="Lunas">
                                                <label for="statusLunas">Lunas</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="statusCicil" name="statusPembayaran" value="Cicil" checked>
                                                <label for="statusCicil">Cicil</label>
                                            </div>
                                            <div class="radio-item">
                                                <input type="radio" id="statusBelumLunas" name="statusPembayaran" value="Belum Lunas">
                                                <label for="statusBelumLunas">Belum Lunas</label>
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
                        <button type="button" class="btn btn-primary" onclick="simpanPesanan()">
                            <i class="mdi mdi-check me-1"></i>Simpan Pesanan
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
        <script src="assets/js/app.js"></script>

        <script>
            let itemCounter = 1;

            // Format Rupiah
            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Fungsi untuk set filter waktu
            function setFilter(filterName) {
                document.getElementById('selectedFilter').textContent = filterName;
                console.log('Filter dipilih:', filterName);
                // Untuk integrasi dengan backend, kirim request AJAX
            }

            // Fungsi untuk search transaksi
            function searchTransaction() {
                let input = document.getElementById('searchInput');
                let filter = input.value.toUpperCase();
                let table = document.getElementById('transactionTable');
                let tr = table.getElementsByTagName('tr');

                for (let i = 1; i < tr.length; i++) {
                    let tdNo = tr[i].getElementsByTagName('td')[1]; // Nomor transaksi
                    let tdSupplier = tr[i].getElementsByTagName('td')[3]; // Supplier
                    if (tdNo || tdSupplier) {
                        let txtNo = tdNo ? (tdNo.textContent || tdNo.innerText) : '';
                        let txtSupplier = tdSupplier ? (tdSupplier.textContent || tdSupplier.innerText) : '';
                        if (txtNo.toUpperCase().indexOf(filter) > -1 || txtSupplier.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                        } else {
                            tr[i].style.display = 'none';
                        }
                    }
                }
            }

            // Set tanggal hari ini saat modal dibuka
            document.getElementById('inputPembelianModal').addEventListener('shown.bs.modal', function () {
                if (!document.getElementById('tanggalPembelian').value) {
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById('tanggalPembelian').value = today;
                }
            });

            // Event delegation untuk select barang
            document.getElementById('containerBarang').addEventListener('change', function(e) {
                if (e.target.classList.contains('select-barang')) {
                    updateHargaBarang(e.target);
                }
            });

            // Event delegation untuk jumlah barang
            document.getElementById('containerBarang').addEventListener('input', function(e) {
                if (e.target.classList.contains('jumlah-barang')) {
                    hitungTotalItem(e.target);
                }
            });

            // Update harga saat pilih barang
            function updateHargaBarang(select) {
                const row = select.closest('.item-row');
                const selectedOption = select.options[select.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga') || 0;
                const hargaSatuan = row.querySelector('.harga-satuan');
                const jumlah = row.querySelector('.jumlah-barang');
                const totalItem = row.querySelector('.total-item');
                
                hargaSatuan.value = formatRupiah(parseInt(harga));
                
                const total = parseInt(harga) * parseInt(jumlah.value || 1);
                totalItem.value = formatRupiah(total);
                
                hitungTotalKeseluruhan();
            }

            // Hitung total per item
            function hitungTotalItem(input) {
                const row = input.closest('.item-row');
                const select = row.querySelector('.select-barang');
                const selectedOption = select.options[select.selectedIndex];
                const harga = parseInt(selectedOption.getAttribute('data-harga') || 0);
                const jumlah = parseInt(input.value) || 0;
                const totalItem = row.querySelector('.total-item');
                
                const total = harga * jumlah;
                totalItem.value = formatRupiah(total);
                
                hitungTotalKeseluruhan();
            }

            // Hitung total keseluruhan
            function hitungTotalKeseluruhan() {
                let totalSemua = 0;
                document.querySelectorAll('.item-row').forEach(row => {
                    const select = row.querySelector('.select-barang');
                    const selectedOption = select.options[select.selectedIndex];
                    const jumlah = parseInt(row.querySelector('.jumlah-barang').value) || 0;
                    const harga = parseInt(selectedOption.getAttribute('data-harga') || 0);
                    totalSemua += harga * jumlah;
                });
                document.getElementById('totalKeseluruhan').textContent = formatRupiah(totalSemua);
            }

            // Tambah barang baru
            document.getElementById('btnTambahBarang').addEventListener('click', function() {
                itemCounter++;
                const container = document.getElementById('containerBarang');
                const newItem = document.createElement('div');
                newItem.className = 'item-row';
                newItem.setAttribute('data-item', itemCounter);
                newItem.innerHTML = `
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <div class="item-label">Nama Barang</div>
                            <select class="form-select select-barang" required>
                                <option value="">Pilih barang...</option>
                                <option value="1" data-harga="1000000">Betre Alat</option>
                                <option value="2" data-harga="40000000">Mesin Ronsen</option>
                                <option value="3" data-harga="300000000">Mesin Kursi Gigi</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="item-label">Harga Satuan</div>
                            <input type="text" class="form-control harga-satuan" placeholder="Rp 0" readonly>
                        </div>
                        <div class="col-md-2">
                            <div class="item-label">Jumlah</div>
                            <input type="number" class="form-control jumlah-barang" placeholder="1" min="1" value="1" required>
                        </div>
                        <div class="col-md-3">
                            <div class="item-label">Total</div>
                            <input type="text" class="form-control total-item" placeholder="Rp 0" readonly>
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn-remove-item" onclick="hapusItem(this)">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(newItem);
                updateRemoveButtons();
            });

            // Update tampilan tombol hapus
            function updateRemoveButtons() {
                const items = document.querySelectorAll('.item-row');
                items.forEach(item => {
                    const btnHapus = item.querySelector('.btn-remove-item');
                    if (items.length > 1) {
                        btnHapus.style.display = 'flex';
                    } else {
                        btnHapus.style.display = 'none';
                    }
                });
            }

            // Hapus item
            function hapusItem(button) {
                const item = button.closest('.item-row');
                item.remove();
                hitungTotalKeseluruhan();
                updateRemoveButtons();
            }

            // Simpan pesanan
            function simpanPesanan() {
                const form = document.getElementById('formPembelian');
                
                // Validasi form
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                // Validasi minimal 1 barang dipilih
                const barangDipilih = document.querySelectorAll('.select-barang');
                let adaBarang = false;
                barangDipilih.forEach(select => {
                    if (select.value) {
                        adaBarang = true;
                    }
                });

                if (!adaBarang) {
                    alert('Pilih minimal 1 barang!');
                    return;
                }

                // Ambil data form
                const data = {
                    noOrder: document.getElementById('noOrder').value,
                    tanggal: document.getElementById('tanggalPembelian').value,
                    namaCustomer: document.getElementById('namaCustomer').value,
                    noTelepon: document.getElementById('noTelepon').value,
                    statusPembayaran: document.querySelector('input[name="statusPembayaran"]:checked').value,
                    items: [],
                    totalKeseluruhan: document.getElementById('totalKeseluruhan').textContent
                };

                // Ambil data barang
                document.querySelectorAll('.item-row').forEach(row => {
                    const select = row.querySelector('.select-barang');
                    if (select.value) {
                        const selectedOption = select.options[select.selectedIndex];
                        data.items.push({
                            id: select.value,
                            nama: selectedOption.text,
                            harga: selectedOption.getAttribute('data-harga'),
                            jumlah: row.querySelector('.jumlah-barang').value,
                            total: row.querySelector('.total-item').value
                        });
                    }
                });

                // Log data (dalam implementasi sebenarnya, kirim ke server)
                console.log('Data Pesanan:', data);
                
                // Tampilkan notifikasi sukses
                alert('Pesanan berhasil disimpan!');
                
                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('inputPembelianModal'));
                modal.hide();
                
                // Reset form
                resetForm();
            }

            // Reset form
            function resetForm() {
                document.getElementById('formPembelian').reset();
                
                // Reset container barang ke 1 item
                const container = document.getElementById('containerBarang');
                const items = container.querySelectorAll('.item-row');
                items.forEach((item, index) => {
                    if (index > 0) {
                        item.remove();
                    }
                });
                
                // Reset item pertama
                const firstItem = container.querySelector('.item-row');
                firstItem.querySelector('.select-barang').value = '';
                firstItem.querySelector('.harga-satuan').value = '';
                firstItem.querySelector('.jumlah-barang').value = '1';
                firstItem.querySelector('.total-item').value = '';
                
                // Reset total
                document.getElementById('totalKeseluruhan').textContent = 'Rp 0';
                
                // Reset counter
                itemCounter = 1;
                
                // Update tombol hapus
                updateRemoveButtons();
            }

            // Reset form saat modal ditutup
            document.getElementById('inputPembelianModal').addEventListener('hidden.bs.modal', function () {
                // Tidak reset otomatis, biarkan user yang memutuskan
            });
        </script>
    </body>
</html>