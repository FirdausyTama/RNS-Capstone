<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Detail Pembelian | RNS - Ranay Nusantara Sejathera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detail Transaksi Pembelian" />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 19px;
            top: 45px;
            bottom: -15px;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
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
                            <h4 class="fs-18 fw-semibold m-0">Detail Pembelian</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/kelola-pembelian') }}">Kelola Pembelian</a></li>
                                <li class="breadcrumb-item active">Detail Pembelian</li>
                            </ol>
                        </div>
                    </div>

                    <div class="mb-3">
                        <a href="{{ url('/kelola-pembelian') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-semibold mb-0">Informasi Pesanan</h6>
                                        <span class="badge bg-success text-white px-3 py-2">Dikirim</span> 
                                    </div>
                                    <div class="mb-0">
                                        <table class="table table-sm mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-muted border-0 ps-0">Nomor Transaksi</td>
                                                    <td class="fw-semibold border-0">TRX-2025-001</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted border-0 ps-0">Tanggal Pembelian</td>
                                                    <td class="fw-semibold border-0">17 Februari 2025</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted border-0 ps-0">Status Pembayaran</td>
                                                    <td class="border-0">
                                                        <span class="badge bg-warning bg-opacity-10 text-warning">Cicilan</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="fw-semibold mb-3">Data Customer</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="mdi mdi-account text-primary fs-4"></i> </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">Dr. Ahmad Hidayat</h6>
                                            <small class="text-muted">0812-3456-7890</small> </div>
                                    </div>
                                    <div class="border-top pt-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="mdi mdi-map-marker-outline text-muted me-2"></i> <small class="text-muted">Alamat Customer</small> </div>
                                        <p class="fw-semibold mb-0">Jl. Kesehatan No. 45, Yogyakarta</p> </div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="fw-semibold mb-3">Ringkasan Pembayaran</h6>
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <div class="border rounded p-3 text-center">
                                                <i class="mdi mdi-cash-check text-success fs-3 mb-2"></i>
                                                <h6 class="mb-0 text-success">Rp 250.000.000</h6>
                                                <small class="text-muted">Terbayar</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border rounded p-3 text-center">
                                                <i class="mdi mdi-cash-clock text-warning fs-3 mb-2"></i>
                                                <h6 class="mb-0 text-warning">Rp 135.000.000</h6>
                                                <small class="text-muted">Sisa</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light rounded p-3">
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Total Transaksi</small>
                                            <h5 class="fw-bold text-primary mb-0">Rp 385.000.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-semibold mb-0">Detail Barang</h6>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">3 Item</span>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 50px;">No</th>
                                                    <th>Nama Barang</th>
                                                    <th class="text-center" style="width: 100px;">Jumlah</th>
                                                    <th class="text-end" style="width: 140px;">Harga</th>
                                                    <th class="text-end" style="width: 140px;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>
                                                        <div class="fw-semibold">Mesin Kursi Gigi</div>
                                                        <small class="text-muted">SKU003</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-light text-dark">1 Unit</span>
                                                    </td>
                                                    <td class="text-end">Rp 300.000.000</td>
                                                    <td class="text-end fw-bold">Rp 300.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>
                                                        <div class="fw-semibold">Batre Alat</div>
                                                        <small class="text-muted">SKU001</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-light text-dark">5 Pcs</span>
                                                    </td>
                                                    <td class="text-end">Rp 1.000.000</td>
                                                    <td class="text-end fw-bold">Rp 5.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>
                                                        <div class="fw-semibold">Mesin Ronsen</div>
                                                        <small class="text-muted">SKU002</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-light text-dark">2 Unit</span>
                                                    </td>
                                                    <td class="text-end">Rp 40.000.000</td>
                                                    <td class="text-end fw-bold">Rp 80.000.000</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-light">
                                                <tr>
                                                    <td colspan="4" class="text-end fw-bold">Total Keseluruhan</td>
                                                    <td class="text-end fw-bold text-primary fs-5">Rp 385.000.000</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="fw-semibold mb-3">Riwayat Pembayaran</h6>
                                    <div class="timeline">
                                        <div class="timeline-item mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="mdi mdi-check text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fw-semibold">Pembayaran Cicilan 1</h6>
                                                    <p class="text-muted mb-1 small">Pembayaran awal transaksi</p>
                                                    <small class="text-muted">17 Feb 2025, 10:30 WIB</small>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-success bg-opacity-10 text-success">Rp 100.000.000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item mb-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="mdi mdi-check text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fw-semibold">Pembayaran Cicilan 2</h6>
                                                    <p class="text-muted mb-1 small">Cicilan tahap kedua</p>
                                                    <small class="text-muted">17 Mar 2025, 14:20 WIB</small>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-success bg-opacity-10 text-success">Rp 150.000.000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="mdi mdi-clock-outline text-warning"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 fw-semibold">Cicilan Terakhir</h6>
                                                    <p class="text-muted mb-1 small">Menunggu pembayaran</p>
                                                    <small class="text-muted">Jatuh tempo: 17 Apr 2025</small>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-warning bg-opacity-10 text-warning">Rp 135.000.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                            &copy; <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    
</body>
</html>