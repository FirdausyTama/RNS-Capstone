<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Detail Produk | RNS - Ranay Nusantara Sejathera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Detail informasi produk"/>
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

    <body data-menu-color="light" data-sidebar="default">
        @include('navbar.navbar')
        
        <div id="app-layout">
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <!-- Breadcrumb -->
                        @php
                            // Data Produk (Nanti bisa diganti dengan data dari database)
                            $products = [
                                1 => [
                                    'sku' => 'SKU001',
                                    'nama' => 'Batre Alat',
                                    'deskripsi' => 'Batre dengan kualitas tinggi tahan sampai 10 tahun',
                                    'harga' => 1000000,
                                    'stok' => 45,
                                    'satuan' => 'Pcs',
                                    'status' => 'Stok Aman',
                                    'status_class' => 'success',
                                    'kategori' => 'Alat Medis',
                                    'merek' => 'Energizer',
                                    'tanggal' => '10 September 2025',
                                    'views' => 127,
                                    'terjual' => 45,
                                    'dimensi' => ['panjang' => 10, 'lebar' => 5, 'tinggi' => 3, 'berat' => 150],
                                    'deskripsi_lengkap' => 'Batre berkualitas tinggi dengan daya tahan lama hingga 10 tahun. Cocok untuk berbagai peralatan medis dan elektronik. Dilengkapi dengan teknologi anti-bocor dan performa stabil dalam berbagai kondisi suhu. Produk ini telah tersertifikasi dan aman digunakan untuk peralatan medis.',
                                    'foto' => 'https://img.lazcdn.com/g/ff/kf/Se6d7760ca3654638a487d3345ea0cdb1o.jpg_960x960q80.jpg_.webp',
                                    'riwayat' => [
                                        ['type' => 'masuk', 'jumlah' => 20, 'keterangan' => 'Penambahan dari supplier', 'tanggal' => '10 Nov 2025, 14:30'],
                                        ['type' => 'keluar', 'jumlah' => 5, 'keterangan' => 'Penjualan kepada Rumah Sakit X', 'tanggal' => '05 Nov 2025, 09:15'],
                                        ['type' => 'awal', 'jumlah' => 30, 'keterangan' => 'Input stok pertama kali', 'tanggal' => '01 Nov 2025, 10:00'],
                                    ]
                                ],
                                2 => [
                                    'sku' => 'SKU002',
                                    'nama' => 'Mesin Ronsen',
                                    'deskripsi' => 'Mesin ronsen produksi china dengan tambahan ronsen gigi',
                                    'harga' => 40000000,
                                    'stok' => 10,
                                    'satuan' => 'Unit',
                                    'status' => 'Stok Rendah',
                                    'status_class' => 'warning',
                                    'kategori' => 'Alat Medis',
                                    'merek' => 'Mindray',
                                    'tanggal' => '12 Maret 2025',
                                    'views' => 89,
                                    'terjual' => 12,
                                    'dimensi' => ['panjang' => 150, 'lebar' => 80, 'tinggi' => 180, 'berat' => 250000],
                                    'deskripsi_lengkap' => 'Mesin ronsen digital produksi China dengan kualitas tinggi. Dilengkapi dengan fitur ronsen gigi untuk pemeriksaan dental yang lebih detail. Menggunakan teknologi imaging terkini dengan resolusi tinggi untuk hasil diagnosa yang akurat. Cocok untuk rumah sakit, klinik, dan praktek dokter gigi. Sudah tersertifikasi dan aman digunakan sesuai standar medis internasional. Garansi 2 tahun dengan service center tersedia di seluruh Indonesia.',
                                    'foto' => 'https://www.alatkedokteran.id/wp-content/uploads/2016/01/wsr-40.jpg',
                                    'riwayat' => [
                                        ['type' => 'keluar', 'jumlah' => 2, 'keterangan' => 'Penjualan ke RS Bhayangkara', 'tanggal' => '08 Nov 2025, 11:20'],
                                        ['type' => 'masuk', 'jumlah' => 5, 'keterangan' => 'Penambahan dari supplier', 'tanggal' => '20 Okt 2025, 09:00'],
                                        ['type' => 'awal', 'jumlah' => 7, 'keterangan' => 'Input stok pertama kali', 'tanggal' => '12 Mar 2025, 14:00'],
                                    ]
                                ],
                                3 => [
                                    'sku' => 'SKU003',
                                    'nama' => 'Mesin Kursi Gigi',
                                    'deskripsi' => 'Kursi khusus dokter gigi dengan berbagai macam fitur',
                                    'harga' => 300000000,
                                    'stok' => 0,
                                    'satuan' => 'Unit',
                                    'status' => 'Stok Habis',
                                    'status_class' => 'danger',
                                    'kategori' => 'Peralatan Dokter Gigi',
                                    'merek' => 'Sirona Dental',
                                    'tanggal' => '09 September 2025',
                                    'views' => 156,
                                    'terjual' => 8,
                                    'dimensi' => ['panjang' => 200, 'lebar' => 120, 'tinggi' => 150, 'berat' => 180000],
                                    'deskripsi_lengkap' => 'Kursi gigi elektrik premium dengan berbagai fitur canggih untuk kenyamanan pasien dan kemudahan dokter. Dilengkapi dengan kontrol elektrik untuk mengatur posisi kursi, headrest yang dapat disesuaikan, sistem penyiraman air otomatis, dan lampu LED terintegrasi untuk pencahayaan optimal. Desain ergonomis dengan bahan kulit sintetis yang mudah dibersihkan dan tahan lama. Cocok untuk klinik gigi modern dan praktek dokter spesialis. Garansi 3 tahun dari distributor resmi.',
                                    'foto' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIUln6ypMWAN2rDOZjmMat-iaSmanFM4kF3w&s',
                                    'fitur' => ['Lampu LED Built-in', 'Water Supply System', 'Adjustable Headrest', 'Electric Control Panel'],
                                    'riwayat' => [
                                        ['type' => 'keluar', 'jumlah' => 1, 'keterangan' => 'Penjualan terakhir ke Klinik Smile Dental', 'tanggal' => '05 Nov 2025, 16:45'],
                                        ['type' => 'keluar', 'jumlah' => 2, 'keterangan' => 'Penjualan ke RS Premier Jatinegara', 'tanggal' => '28 Okt 2025, 10:30'],
                                        ['type' => 'awal', 'jumlah' => 3, 'keterangan' => 'Input stok pertama kali', 'tanggal' => '09 Sep 2025, 08:00'],
                                    ]
                                ],
                            ];

                            // Ambil ID dari URL
                            $id = request()->segment(2) ?? 1;
                            $product = $products[$id] ?? $products[1];
                        @endphp

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- Tombol Back -->
                                    <a href="{{ url('/kelola-stok') }}" class="btn btn-light border d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" title="Kembali">
                                        <i class="mdi mdi-arrow-left fs-5"></i>
                                    </a>
                                    <div>
                                        <h4 class="fs-18 fw-semibold m-0">Detail Produk</h4>
                                        <small class="text-muted">Informasi lengkap produk</small>
                                    </div>
                                </div>

                                @if($product['status_class'] === 'danger')
                                <!-- Alert Stok Habis -->
                                <div class="card shadow-sm border-0 border-danger">
                                    <div class="card-body">
                                        <div class="alert alert-danger bg-danger-subtle border-0 mb-0" role="alert">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-alert-circle-outline fs-3 me-2"></i>
                                                <div>
                                                    <h6 class="mb-1 fw-semibold">Stok Habis!</h6>
                                                    <small>Segera lakukan pemesanan ulang untuk produk ini</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ url('/kelola-stok') }}">Kelola Stok</a></li>
                                    <li class="breadcrumb-item active">Detail Produk</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Kolom Kiri - Foto & Video -->
                            <div class="col-lg-5">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <!-- Foto Utama -->
                                        <div class="mb-3">
                                            <div class="border rounded position-relative" style="height: 400px; overflow: hidden;">
                                                <img id="mainImage" src="{{ $product['foto'] }}" 
                                                     alt="{{ $product['nama'] }}" 
                                                     class="w-100 h-100" 
                                                     style="object-fit: contain;">
                                                <div class="position-absolute top-0 end-0 m-3">
                                                    <span class="badge bg-{{ $product['status_class'] }} px-3 py-2">{{ $product['status'] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Thumbnail Foto -->
                                        <div class="d-flex gap-2 overflow-auto pb-2">
                                            <div class="border rounded" style="min-width: 80px; height: 80px; cursor: pointer;" onclick="changeImage(this)">
                                                <img src="{{ $product['foto'] }}" 
                                                     alt="Thumbnail" 
                                                     class="w-100 h-100 rounded" 
                                                     style="object-fit: cover;">
                                            </div>
                                            <div class="border rounded" style="min-width: 80px; height: 80px; cursor: pointer;" onclick="changeImage(this)">
                                                <img src="https://via.placeholder.com/400x400?text=Foto+2" 
                                                     alt="Thumbnail" 
                                                     class="w-100 h-100 rounded" 
                                                     style="object-fit: cover;">
                                            </div>
                                            <div class="border rounded" style="min-width: 80px; height: 80px; cursor: pointer;" onclick="changeImage(this)">
                                                <img src="https://via.placeholder.com/400x400?text=Foto+3" 
                                                     alt="Thumbnail" 
                                                     class="w-100 h-100 rounded" 
                                                     style="object-fit: cover;">
                                            </div>
                                            <div class="border rounded bg-light d-flex align-items-center justify-content-center" style="min-width: 80px; height: 80px; cursor: pointer;">
                                                <div class="text-center">
                                                    <i class="mdi mdi-video fs-3 text-muted"></i>
                                                    <small class="d-block text-muted">Video</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Quick Stats -->
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Statistik Cepat</h6>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="mdi mdi-eye-outline text-primary fs-3 mb-2"></i>
                                                    <h6 class="mb-0">{{ $product['views'] }}</h6>
                                                    <small class="text-muted">Views</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="mdi mdi-cart-outline text-success fs-3 mb-2"></i>
                                                    <h6 class="mb-0">{{ $product['terjual'] }}</h6>
                                                    <small class="text-muted">Terjual</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Detail Produk -->
                            <div class="col-lg-7">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <!-- Header Produk -->
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <span class="badge bg-primary-subtle text-primary mb-2">{{ $product['sku'] }}</span>
                                                <h4 class="fw-bold mb-2">{{ $product['nama'] }}</h4>
                                                <p class="text-muted mb-0">{{ $product['deskripsi'] }}</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTambahStok"><i class="mdi mdi-square-edit-outline me-2"></i>Edit Produk</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="mdi mdi-delete-outline me-2"></i>Hapus Produk</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Informasi Harga & Stok -->
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <div class="bg-light rounded p-3">
                                                    <small class="text-muted d-block mb-1">Harga Jual</small>
                                                    <h4 class="fw-bold text-primary mb-0">Rp {{ number_format($product['harga'], 0, ',', '.') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light rounded p-3">
                                                    <small class="text-muted d-block mb-1">Stok Tersedia</small>
                                                    <h4 class="fw-bold text-{{ $product['status_class'] }} mb-0">{{ $product['stok'] }} <small class="text-muted fs-14">{{ $product['satuan'] }}</small></h4>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Informasi Detail -->
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-3">Informasi Detail</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-muted" style="width: 40%;">Kategori</td>
                                                            <td class="fw-semibold">{{ $product['kategori'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Merek</td>
                                                            <td class="fw-semibold">{{ $product['merek'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Tanggal Input</td>
                                                            <td class="fw-semibold">{{ $product['tanggal'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Satuan</td>
                                                            <td class="fw-semibold">{{ $product['satuan'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Status Stok</td>
                                                            <td><span class="badge bg-{{ $product['status_class'] }}-subtle text-{{ $product['status_class'] }}">{{ $product['status'] }}</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Dimensi & Berat -->
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-3">Dimensi & Berat</h6>
                                            <div class="row g-3">
                                                <div class="col-6 col-md-3">
                                                    <div class="border rounded p-2 text-center">
                                                        <small class="text-muted d-block">Panjang</small>
                                                        <span class="fw-semibold">{{ $product['dimensi']['panjang'] }} cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="border rounded p-2 text-center">
                                                        <small class="text-muted d-block">Lebar</small>
                                                        <span class="fw-semibold">{{ $product['dimensi']['lebar'] }} cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="border rounded p-2 text-center">
                                                        <small class="text-muted d-block">Tinggi</small>
                                                        <span class="fw-semibold">{{ $product['dimensi']['tinggi'] }} cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="border rounded p-2 text-center">
                                                        <small class="text-muted d-block">Berat</small>
                                                        <span class="fw-semibold">{{ $product['dimensi']['berat'] >= 1000 ? number_format($product['dimensi']['berat']/1000, 0) . ' kg' : $product['dimensi']['berat'] . ' gr' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if(isset($product['fitur']))
                                        <!-- Spesifikasi Tambahan (Khusus Kursi Gigi) -->
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-3">Spesifikasi Tambahan</h6>
                                            <div class="row g-2">
                                                @foreach($product['fitur'] as $fitur)
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                                        <small>{{ $fitur }}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Deskripsi Lengkap -->
                                        <div class="mb-4">
                                            <h6 class="fw-semibold mb-3">Deskripsi Lengkap</h6>
                                            <p class="text-muted mb-0">{{ $product['deskripsi_lengkap'] }}</p>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ url('/kelola-stok') }}" class="btn btn-outline-secondary">
                                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                            </a>
                                            <button class="btn btn-primary flex-grow-1" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                                                <i class="mdi mdi-square-edit-outline me-1"></i>Edit Produk
                                            </button>
                                            <button class="btn btn-outline-secondary" onclick="window.print()">
                                                <i class="mdi mdi-printer-outline"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary">
                                                <i class="mdi mdi-share-variant-outline"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Riwayat Stok -->
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Riwayat Perubahan Stok</h6>
                                        <div class="timeline">
                                            @foreach($product['riwayat'] as $key => $riwayat)
                                            @php
                                                $badgeClass = $riwayat['type'] === 'masuk' ? 'success' : ($riwayat['type'] === 'keluar' ? 'warning' : 'primary');
                                                if($riwayat['type'] === 'keluar' && $product['stok'] === 0 && $key === 0) {
                                                    $badgeClass = 'danger';
                                                }
                                                $iconClass = $riwayat['type'] === 'keluar' ? 'minus' : 'plus';
                                                $label = $riwayat['type'] === 'masuk' ? 'Stok Masuk' : ($riwayat['type'] === 'keluar' ? 'Stok Keluar' : 'Stok Awal');
                                                if($riwayat['type'] === 'keluar' && $product['stok'] === 0 && $key === 0) {
                                                    $label = 'Stok Keluar - Habis';
                                                }
                                                $sign = $riwayat['type'] === 'keluar' ? '-' : '+';
                                            @endphp
                                            <div class="timeline-item {{ $key < count($product['riwayat']) - 1 ? 'mb-3' : '' }}">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="bg-{{ $badgeClass }}-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="mdi mdi-{{ $iconClass }} text-{{ $badgeClass }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 fw-semibold">{{ $label }}</h6>
                                                        <p class="text-muted mb-1 small">{{ $riwayat['keterangan'] }}</p>
                                                        <small class="text-muted">{{ $riwayat['tanggal'] }}</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-{{ $badgeClass }}-subtle text-{{ $badgeClass }}">{{ $sign }}{{ $riwayat['jumlah'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a> 
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal Edit (sama seperti modal tambah stok) -->
        <div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light border-0">
                        <h5 class="modal-title fw-semibold" id="modalTambahStokLabel">
                            <i class="mdi mdi-square-edit-outline text-primary me-2"></i>Edit Produk
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <!-- Form fields sama seperti modal input sebelumnya -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 text-muted">Informasi Dasar</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="namaBarang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="namaBarang" value="Batre Alat">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kodeSKU" class="form-label">Kode SKU</label>
                                        <input type="text" class="form-control" id="kodeSKU" value="SKU001">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kategori">
                                            <option value="1" selected>Alat Medis</option>
                                            <option value="2">Peralatan Laboratorium</option>
                                            <option value="3">Obat-obatan</option>
                                            <option value="4">Consumables</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="merek" class="form-label">Merek</label>
                                        <input type="text" class="form-control" id="merek" value="Energizer">
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info bg-info-subtle border-0 d-flex align-items-center mb-0" role="alert">
                                <i class="mdi mdi-information-outline me-2"></i>
                                <small>Perubahan akan tersimpan dan memperbarui data produk</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">
                            <i class="mdi mdi-content-save-outline me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor Scripts -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        
        <!-- Custom Script -->
        <script>
            // Fungsi untuk mengganti gambar utama saat thumbnail diklik
            function changeImage(element) {
                const imgSrc = element.querySelector('img').src;
                document.getElementById('mainImage').src = imgSrc;
                
                // Hapus border aktif dari semua thumbnail
                document.querySelectorAll('.border.rounded[onclick]').forEach(el => {
                    el.classList.remove('border-primary');
                    el.style.borderWidth = '1px';
                });
                
                // Tambahkan border aktif ke thumbnail yang diklik
                element.classList.add('border-primary');
                element.style.borderWidth = '2px';
            }

            // Set border aktif pada thumbnail pertama saat load
            document.addEventListener('DOMContentLoaded', function() {
                const firstThumbnail = document.querySelector('.border.rounded[onclick]');
                if (firstThumbnail) {
                    firstThumbnail.classList.add('border-primary');
                    firstThumbnail.style.borderWidth = '2px';
                }
            });
        </script>
    </body>
</html>