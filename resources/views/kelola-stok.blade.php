<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Stok | RNS - Ranay Nusantara Sejathera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>
    
    <style>
        .preview-image,
        .preview-video {
            display: none;
            margin-top: 10px;
            position: relative;
        }

        .preview-image.show,
        .preview-video.show {
            display: block;
        }

        .preview-image img {
            max-width: 100%;
            max-height: 150px;
            object-fit: contain;
            border-radius: 4px;
        }

        .preview-video video {
            max-width: 100%;
            max-height: 150px;
            border-radius: 4px;
        }

        .remove-media {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 14px;
            line-height: 1;
            cursor: pointer;
            z-index: 5;
        }

        .remove-media:hover {
            background: #c82333;
        }

        .upload-box {
            cursor: pointer;
        }
    </style>
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
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
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
                                    <tbody id="stok-table-body">
                                        <tr>
                                            <td colspan="7" class="text-center py-3 text-muted">Memuat data...</td>
                                        </tr>
                                    </tbody>

                                </table>
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
                            &copy; <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
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
                    <form id="formTambahStok" enctype="multipart/form-data">
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
                                    <label for="merek" class="form-label">Merek</label>
                                    <input type="text" class="form-control" id="merek" placeholder="Nama merek">
                                </div>
                                
                            </div>
                        </div>

                        <!-- Foto/Video Barang -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3 text-muted">Foto/Video Barang</h6>
                            <div class="row g-3">
                                <!-- Upload Video -->
                                <div class="col-md-6">
                                    <div class="border border-2 border-dashed rounded p-4 text-center upload-box" onclick="document.getElementById('uploadVideo').click()" style="cursor: pointer;">
                                        <input type="file" id="uploadVideo" name="video" accept="video/mp4,video/avi,video/mov" style="display: none;" onchange="handleVideoUpload(this)">
                                        <div id="videoPlaceholder">
                                            <i class="mdi mdi-video-outline fs-1 text-muted d-block mb-2"></i>
                                            <span class="text-muted" id="videoFileName">Tambah Video</span>
                                        </div>
                                        <div class="preview-video" id="videoPreview">
                                            <button type="button" class="remove-media" onclick="removeVideo(event)">×</button>
                                            <video id="videoElement" controls style="width: 100%;"></video>
                                            <small class="text-muted d-block mt-2" id="videoFileNamePreview"></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Foto -->
                                <div class="col-md-6">
                                    <div class="border border-2 border-dashed rounded p-4 text-center upload-box" onclick="document.getElementById('uploadFoto').click()" style="cursor: pointer;">
                                        <input type="file" id="uploadFoto" name="foto" accept="image/jpeg,image/png,image/webp" style="display: none;" onchange="handleFotoUpload(this)">
                                        <div id="fotoPlaceholder">
                                            <i class="mdi mdi-camera-outline fs-1 text-muted d-block mb-2"></i>
                                            <span class="text-muted" id="fotoFileName">Tambah Foto</span>
                                        </div>
                                        <div class="preview-image" id="fotoPreview">
                                            <button type="button" class="remove-media" onclick="removeFoto(event)">×</button>
                                            <img id="fotoElement" src="" alt="Preview">
                                            <small class="text-muted d-block mt-2" id="fotoFileNamePreview"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <small class="text-muted">Format foto: JPG, PNG, WEBP (maks 5MB). Format video: MP4, AVI, MOV (maks 10MB)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Harga & Stok -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3 text-muted">Harga & Stok</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl_masuk">
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
                    <button type="button" class="btn btn-primary" onclick="submitTambahStok()">
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

        // Handle Video Upload dengan Preview
        function handleVideoUpload(input) {
            const file = input.files[0];
            if (file) {
                // Validasi ukuran (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran video maksimal 10MB!');
                    input.value = '';
                    return;
                }

                // Validasi format
                const validFormats = ['video/mp4', 'video/avi', 'video/quicktime'];
                if (!validFormats.includes(file.type)) {
                    alert('Format video harus MP4, AVI, atau MOV!');
                    input.value = '';
                    return;
                }

                // Tampilkan preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('videoElement').src = e.target.result;
                    document.getElementById('videoFileNamePreview').textContent = file.name;
                    document.getElementById('videoPlaceholder').style.display = 'none';
                    document.getElementById('videoPreview').classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        // Handle Foto Upload dengan Preview
        function handleFotoUpload(input) {
            const file = input.files[0];
            if (file) {
                // Validasi ukuran (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran foto maksimal 5MB!');
                    input.value = '';
                    return;
                }

                // Validasi format
                const validFormats = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validFormats.includes(file.type)) {
                    alert('Format foto harus JPG, PNG, atau WEBP!');
                    input.value = '';
                    return;
                }

                // Tampilkan preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('fotoElement').src = e.target.result;
                    document.getElementById('fotoFileNamePreview').textContent = file.name;
                    document.getElementById('fotoPlaceholder').style.display = 'none';
                    document.getElementById('fotoPreview').classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove Video
        function removeVideo(event) {
            event.stopPropagation();
            document.getElementById('uploadVideo').value = '';
            document.getElementById('videoElement').src = '';
            document.getElementById('videoFileNamePreview').textContent = '';
            document.getElementById('videoPreview').classList.remove('show');
            document.getElementById('videoPlaceholder').style.display = 'block';
        }

        // Remove Foto
        function removeFoto(event) {
            event.stopPropagation();
            document.getElementById('uploadFoto').value = '';
            document.getElementById('fotoElement').src = '';
            document.getElementById('fotoFileNamePreview').textContent = '';
            document.getElementById('fotoPreview').classList.remove('show');
            document.getElementById('fotoPlaceholder').style.display = 'block';
        }

        // Reset form saat modal ditutup
        document.getElementById('modalTambahStok').addEventListener('hidden.bs.modal', function () {
            document.getElementById('formTambahStok').reset();
            
            // Reset video
            document.getElementById('videoElement').src = '';
            document.getElementById('videoFileNamePreview').textContent = '';
            document.getElementById('videoPreview').classList.remove('show');
            document.getElementById('videoPlaceholder').style.display = 'block';
            
            // Reset foto
            document.getElementById('fotoElement').src = '';
            document.getElementById('fotoFileNamePreview').textContent = '';
            document.getElementById('fotoPreview').classList.remove('show');
            document.getElementById('fotoPlaceholder').style.display = 'block';
        });

        // Initialize tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script src="{{ asset('assets/js/stok.js') }}"></script>
</body>

</html>