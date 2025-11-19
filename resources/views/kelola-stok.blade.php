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
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('assets/js/head.js') }}"></script>
    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">
        @include('navbar.navbar')
        <!-- Begin page -->
        <div id="app-layout">
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
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Kelola Stok</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Start Main Widgets -->
                        <div class="row">
                            <!-- 🟢 Stok Aman -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="p-2 border border-success border-opacity-10 bg-success-subtle rounded-2 me-2">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                    <i class="mdi mdi-check-circle-outline text-white fs-5"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Masuk</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 fs-22 text-dark me-3">15 Produk</h3>
                                            <div class="text-center">
                                                <span class="text-success fs-14"><i class="mdi mdi-trending-up fs-14"></i> +8.2%</span>
                                                <p class="text-muted fs-13 mb-0">7 Hari Terakhir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 🟡 Stok Keluar -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-2 me-2">
                                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                    <i class="mdi mdi-alert-outline text-white fs-5"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Keluar</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 fs-22 text-dark me-3">6 Produk</h3>
                                            <div class="text-center">
                                                <span class="text-warning fs-14"><i class="mdi mdi-trending-down fs-14"></i> -2.3%</span>
                                                <p class="text-muted fs-13 mb-0">7 Hari Terakhir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 🟣 Total Stok Keseluruhan -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                    <i class="mdi mdi-package-variant-closed text-white fs-5"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-15 fw-semibold">Total Stok Keseluruhan</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 fs-22 text-dark me-3">900</h3>
                                            <div class="text-center">
                                                <span class="text-primary fs-14"><i class="mdi mdi-trending-up fs-14"></i> +10%</span>
                                                <p class="text-muted fs-13 mb-0">7 Hari Terakhir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h5 class="fw-semibold mb-1">Daftar Stok Produk</h5>
                                        <p class="text-muted mb-0">Kelola dan pantau stok produk Anda</p>
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
                                                <input type="text" class="form-control ps-4" placeholder="Search..." style="min-width: 200px;" id="searchInput" onkeyup="searchProduct()" />
                                                <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-hover" id="productTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="text-center" style="width: 80px;">Foto</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col" class="text-center">Tanggal</th>
                                                <th scope="col" class="text-center">Harga</th>
                                                <th scope="col" class="text-center">Status Stok</th>
                                                <th scope="col" class="text-center">Jumlah</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Produk 1: Batre Alat -->
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
                                                <td class="text-center fw-semibold">10-09-2025</td>
                                                <td class="text-center fw-semibold">Rp1.000.000</td>
                                                <td class="text-center">
                                                    <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Stok Aman</span>
                                                </td>
                                                <td class="text-center fw-semibold">45</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-light border me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                                                        <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                    </button>
                                                    <a href="{{ url('/detail-stok/1') }}" class="btn btn-sm btn-light border" title="Lihat Detail">
                                                        <i class="mdi mdi-eye-outline text-muted"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Produk 2: Mesin Ronsen -->
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
                                                <td class="text-center fw-semibold">12-03-2025</td>
                                                <td class="text-center fw-semibold">Rp40.000.000</td>
                                                <td class="text-center">
                                                    <span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Stok Rendah</span>
                                                </td>
                                                <td class="text-center fw-semibold">10</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-light border me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                                                        <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                    </button>
                                                    <a href="{{ url('/detail-stok/2') }}" class="btn btn-sm btn-light border" title="Lihat Detail">
                                                        <i class="mdi mdi-eye-outline text-muted"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Produk 3: Mesin Kursi Gigi -->
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
                                                <td class="text-center fw-semibold">09-09-2025</td>
                                                <td class="text-center fw-semibold">Rp300.000.000</td>
                                                <td class="text-center">
                                                    <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Stok Habis</span>
                                                </td>
                                                <td class="text-center fw-semibold">0</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-light border me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                                                        <i class="mdi mdi-square-edit-outline text-primary"></i>
                                                    </button>
                                                    <a href="{{ url('/detail-stok/3') }}" class="btn btn-sm btn-light border" title="Lihat Detail">
                                                        <i class="mdi mdi-eye-outline text-muted"></i>
                                                    </a>
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
                <button type="button" class="btn btn-primary rounded-circle shadow-lg"
                        style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 1000;"
                        data-bs-toggle="modal" data-bs-target="#modalTambahStok"
                        title="Tambah Stok">
                    <i class="mdi mdi-plus fs-3 text-white"></i>
                </button>
            </div>
        </div>

        <!-- Modal Tambah Stok -->
        <div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light border-0">
                        <h5 class="modal-title fw-semibold" id="modalTambahStokLabel">
                            <i class="mdi mdi-package-variant-plus text-warning me-2"></i>Input Stok
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <!-- Informasi Dasar -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 text-muted">Informasi Dasar</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="namaBarang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="namaBarang" placeholder="Masukkan nama barang">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kodeSKU" class="form-label">Kode SKU</label>
                                        <input type="text" class="form-control" id="kodeSKU" placeholder="SKU001">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kategori">
                                            <option selected>Pilih kategori</option>
                                            <option value="1">Alat Medis</option>
                                            <option value="2">Peralatan Laboratorium</option>
                                            <option value="3">Obat-obatan</option>
                                            <option value="4">Consumables</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="merek" class="form-label">Merek</label>
                                        <input type="text" class="form-control" id="merek" placeholder="Nama merek">
                                    </div>
                                    <div class="col-12">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" rows="3" placeholder="Deskripsikan barang Anda..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto/Video Barang -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 text-muted">Foto/Video Barang</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="border border-2 border-dashed rounded p-4 text-center" style="cursor: pointer;">
                                            <input type="file" id="uploadVideo" class="d-none" accept="video/*">
                                            <label for="uploadVideo" style="cursor: pointer;">
                                                <i class="mdi mdi-video-outline fs-1 text-muted d-block mb-2"></i>
                                                <span class="text-muted">Tambah Video</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border border-2 border-dashed rounded p-4 text-center" style="cursor: pointer;">
                                            <input type="file" id="uploadFoto" class="d-none" accept="image/*" multiple>
                                            <label for="uploadFoto" style="cursor: pointer;">
                                                <i class="mdi mdi-camera-outline fs-1 text-muted d-block mb-2"></i>
                                                <span class="text-muted">Tambah Foto</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 5MB per foto</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Harga & Stok -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 text-muted">Harga & Stok</h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="hargaJual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id="hargaJual" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                            <input type="number" class="form-control text-center" id="jumlah" value="0" min="0">
                                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="stokTersedia" class="form-label">Stok Tersedia</label>
                                        <input type="number" class="form-control" id="stokTersedia" placeholder="5" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <select class="form-select" id="satuan">
                                            <option selected>Pilih satuan</option>
                                            <option value="pcs">Pcs</option>
                                            <option value="box">Box</option>
                                            <option value="unit">Unit</option>
                                            <option value="pack">Pack</option>
                                            <option value="kg">Kg</option>
                                            <option value="liter">Liter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dimensi & Berat (optional) -->
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-3 text-muted">Dimensi & Berat (optional)</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="panjang" class="form-label">Panjang (cm)</label>
                                        <input type="number" class="form-control" id="panjang" placeholder="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lebar" class="form-label">Lebar (cm)</label>
                                        <input type="number" class="form-control" id="lebar" placeholder="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tinggi" class="form-label">Tinggi (cm)</label>
                                        <input type="number" class="form-control" id="tinggi" placeholder="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="berat" class="form-label">Berat (gr)</label>
                                        <input type="number" class="form-control" id="berat" placeholder="0">
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info bg-info-subtle border-0 d-flex align-items-center mb-0" role="alert">
                                <i class="mdi mdi-information-outline me-2"></i>
                                <small>Sistem akan mengupdate stok otomatis saat tersimpan</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">
                            <i class="mdi mdi-content-save-outline me-1"></i>Tambah Barang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        
        <!-- Custom Script -->
        <script>
            // Fungsi untuk menambah jumlah
            function increaseQty() {
                let input = document.getElementById('jumlah');
                input.value = parseInt(input.value) + 1;
            }

            // Fungsi untuk mengurangi jumlah
            function decreaseQty() {
                let input = document.getElementById('jumlah');
                if (parseInt(input.value) > 0) {
                    input.value = parseInt(input.value) - 1;
                }
            }

            // Fungsi untuk set filter waktu
            function setFilter(filterName) {
                document.getElementById('selectedFilter').textContent = filterName;
                console.log('Filter dipilih:', filterName);
            }

            // Fungsi untuk search produk
            function searchProduct() {
                let input = document.getElementById('searchInput');
                let filter = input.value.toUpperCase();
                let table = document.getElementById('productTable');
                let tr = table.getElementsByTagName('tr');

                // Loop melalui semua baris tabel, sembunyikan yang tidak cocok
                for (let i = 1; i < tr.length; i++) {
                    let td = tr[i].getElementsByTagName('td')[1]; // Kolom nama produk
                    if (td) {
                        let txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                        } else {
                            tr[i].style.display = 'none';
                        }
                    }
                }
            }

            // Initialize tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>
</html>