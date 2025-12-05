<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Detail Stok | RNS - Ranay Nusantara Sejathera</title>
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
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-video {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-aman {
            background-color: #d1f2eb;
            color: #0f5132;
        }

        .badge-menipis {
            background-color: #fff3cd;
            color: #997404;
        }

        .badge-habis {
            background-color: #f8d7da;
            color: #842029;
        }

        .media-gallery {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .media-item {
            flex: 1;
            min-width: 280px;
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
                            <h4 class="fs-18 fw-semibold m-0">Detail Stok Produk</h4>
                        </div>

                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/kelola-stok') }}">Kelola Stok</a></li>
                                <li class="breadcrumb-item active">Detail Stok</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Button Kembali -->
                    <div class="mb-3">
                        <a href="{{ url('/kelola-stok') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <!-- Kolom Kiri - Informasi Produk -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-4">Informasi Produk</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Nama Barang</div>
                                            <div class="info-value" id="namaBarang">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Kode SKU</div>
                                            <div class="info-value" id="kodeSKU">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Merek</div>
                                            <div class="info-value" id="merek">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Tanggal Masuk</div>
                                            <div class="info-value" id="tanggalMasuk">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Deskripsi</div>
                                        <div class="info-value" id="deskripsi">Loading...</div>
                                    </div>

                                    <hr class="my-4">

                                    <h5 class="fw-semibold mb-4">Harga & Stok</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Harga Jual</div>
                                            <div class="info-value text-success fw-bold" id="hargaJual">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Satuan</div>
                                            <div class="info-value" id="satuan">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Jumlah</div>
                                            <div class="info-value" id="jumlah">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Stok Tersedia</div>
                                            <div class="info-value" id="stokTersedia">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Status Stok</div>
                                        <div id="statusStok">Loading...</div>
                                    </div>

                                    <hr class="my-4">

                                    <h5 class="fw-semibold mb-4">Dimensi & Berat</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="info-label">Panjang</div>
                                            <div class="info-value" id="panjang">- cm</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">Lebar</div>
                                            <div class="info-value" id="lebar">- cm</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">Tinggi</div>
                                            <div class="info-value" id="tinggi">- cm</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">Berat</div>
                                            <div class="info-value" id="berat">- gr</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Media -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-4">Media Produk</h5>

                                    <div class="media-gallery">
                                        <!-- Foto Produk -->
                                        <div class="media-item" id="fotoContainer" style="display: none;">
                                            <div class="info-label mb-2">Foto Produk</div>
                                            <img id="fotoProduk" src="" alt="Foto Produk" class="product-image">
                                        </div>

                                        <!-- Video Produk -->
                                        <div class="media-item" id="videoContainer" style="display: none;">
                                            <div class="info-label mb-2">Video Produk</div>
                                            <video id="videoProduk" controls class="product-video">
                                                <source src="" type="video/mp4">
                                                Browser Anda tidak mendukung video.
                                            </video>
                                        </div>

                                        <!-- Placeholder jika tidak ada media -->
                                        <div class="media-item text-center" id="noMediaPlaceholder">
                                            <div class="border border-2 border-dashed rounded p-5">
                                                <i class="mdi mdi-image-off fs-1 text-muted d-block mb-2"></i>
                                                <span class="text-muted">Tidak ada media</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- End Content-->
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
        // Fungsi untuk format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + Number(angka).toLocaleString('id-ID');
        }

        // Fungsi untuk format tanggal
        function formatTanggal(tanggal) {
            if (!tanggal) return '-';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(tanggal).toLocaleDateString('id-ID', options);
        }

        // Fungsi untuk mendapatkan status stok
        function getStatusBadge(jumlah) {
            if (jumlah >= 5) {
                return '<span class="status-badge badge-aman">Stok Aman</span>';
            } else if (jumlah > 0) {
                return '<span class="status-badge badge-menipis">Stok Menipis</span>';
            } else {
                return '<span class="status-badge badge-habis">Stok Habis</span>';
            }
        }

        // ✅ FUNGSI BARU: Ambil ID dari URL path Laravel
        function getStokIdFromUrl() {
            // Ambil URL path: /detail-stok/1 → ambil angka 1
            const pathArray = window.location.pathname.split('/');
            const id = pathArray[pathArray.length - 1];
            
            // Validasi apakah ID adalah angka
            if (id && !isNaN(id)) {
                return id;
            }
            
            return null;
        }

        // ✅ FUNGSI LOAD DARI API
        function loadFromAPI(id) {
            const token = localStorage.getItem("token");
            
            if (!token) {
                alert("Token tidak ditemukan! Silakan login kembali.");
                window.location.href = "/";
                return;
            }

            // Show loading state
            console.log("Mengambil data untuk ID:", id);

            fetch(`http://127.0.0.1:8000/api/stoks/${id}`, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            .then(async res => {
                if (!res.ok) {
                    const text = await res.text();
                    console.error("RESPON ERROR:", text);
                    throw new Error("Gagal memuat detail stok");
                }
                return res.json();
            })
            .then(response => {
                console.log("Response dari API:", response);
                
                const data = response.data;
                
                // Populate data ke halaman
                document.getElementById('namaBarang').textContent = data.nama_barang || '-';
                document.getElementById('kodeSKU').textContent = data.kode_sku || '-';
                document.getElementById('merek').textContent = data.merek || '-';
                document.getElementById('tanggalMasuk').textContent = formatTanggal(data.tgl_masuk);
                document.getElementById('deskripsi').textContent = data.deskripsi || '-';
                document.getElementById('hargaJual').textContent = formatRupiah(data.harga);
                document.getElementById('satuan').textContent = data.satuan || 'Pcs';
                document.getElementById('jumlah').textContent = data.jumlah + ' ' + (data.satuan || 'Pcs');
                document.getElementById('stokTersedia').textContent = data.jumlah + ' ' + (data.satuan || 'Pcs');
                document.getElementById('statusStok').innerHTML = getStatusBadge(data.jumlah);
                
                // Dimensi & Berat (jika ada)
                document.getElementById('panjang').textContent = (data.panjang || '-') + ' cm';
                document.getElementById('lebar').textContent = (data.lebar || '-') + ' cm';
                document.getElementById('tinggi').textContent = (data.tinggi || '-') + ' cm';
                document.getElementById('berat').textContent = (data.berat || '-') + ' gr';
                
                // Handle foto
                if (data.foto) {
                    const fotoUrl = `http://127.0.0.1:8000/storage/${data.foto}`;
                    document.getElementById('fotoProduk').src = fotoUrl;
                    document.getElementById('fotoContainer').style.display = 'block';
                    document.getElementById('noMediaPlaceholder').style.display = 'none';
                }
                
                // Handle video
                if (data.video) {
                    const videoUrl = `http://127.0.0.1:8000/storage/${data.video}`;
                    document.getElementById('videoProduk').querySelector('source').src = videoUrl;
                    document.getElementById('videoProduk').load();
                    document.getElementById('videoContainer').style.display = 'block';
                    document.getElementById('noMediaPlaceholder').style.display = 'none';
                }
            })
            .catch(err => {
                console.error("Error:", err);
                alert('Gagal memuat detail stok! ' + err.message);
                window.location.href = '/kelola-stok';
            });
        }

        // ✅ FUNGSI UTAMA: Load detail stok
        function loadDetailStok() {
            // Ambil ID dari URL
            const stokId = getStokIdFromUrl();

            if (!stokId) {
                alert('ID Stok tidak ditemukan di URL!');
                window.location.href = '/kelola-stok';
                return;
            }

            // Load data dari API
            loadFromAPI(stokId);
        }



        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadDetailStok();
        });
    </script>
</body>

</html>