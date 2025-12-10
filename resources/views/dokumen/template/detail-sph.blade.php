<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Detail SPH | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detail Surat Penawaran Harga RNS" />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>

    <style>
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
    </style>
</head>

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
                            <h4 class="fs-18 fw-semibold m-0">Detail Surat Penawaran Harga</h4>
                        </div>

                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/sph') }}">SPH</a></li>
                                <li class="breadcrumb-item active">Detail</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Button Kembali & Edit -->
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ url('/sph') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSPH">
                            <i class="mdi mdi-pencil me-1"></i> Edit SPH
                        </button>
                    </div>

                    <div class="row">
                        <!-- Kolom Kiri - Informasi SPH -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-4">Informasi Surat Penawaran</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Nomor SPH</div>
                                            <div class="info-value" id="nomor_sph">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Tanggal</div>
                                            <div class="info-value" id="tanggal">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Tempat</div>
                                            <div class="info-value" id="tempat">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Lampiran</div>
                                            <div class="info-value" id="lampiran">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Hal</div>
                                        <div class="info-value" id="hal">Loading...</div>
                                    </div>

                                    <hr class="my-4">

                                    <h5 class="fw-semibold mb-4">Detail Barang</h5>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="items-tbody">
                                                <tr>
                                                    <td colspan="5" class="text-center">Loading...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Total Keseluruhan</div>
                                        <div class="info-value text-primary fw-bold fs-4" id="total_keseluruhan">
                                            Loading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Data Penerima -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-4">Data Penerima</h5>

                                    <div class="mb-3">
                                        <div class="info-label">Jabatan Tujuan</div>
                                        <div class="info-value" id="jabatan_tujuan">Loading...</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Nama Perusahaan</div>
                                        <div class="info-value" id="nama_perusahaan">Loading...</div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Penandatangan</div>
                                            <div class="info-value" id="penandatangan">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Status</div>
                                            <div class="info-value" id="status">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Dibuat Pada</div>
                                        <div class="info-value fs-6" id="created_at">-</div>
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
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!"
                                class="text-reset fw-semibold">TI UMY 22</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
    </div>

    <!-- Modal Edit SPH -->
    <div class="modal fade" id="modalEditSPH" tabindex="-1" aria-labelledby="modalEditSPHLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title text-white" id="modalEditSPHLabel">
                        <i class="mdi mdi-pencil me-2"></i>Edit Surat Penawaran Harga
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditSPH">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="editTanggal" name="tanggal" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editTempat" name="tempat" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Lampiran <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editLampiran" name="lampiran" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Hal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editHal" name="hal" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jabatan Tujuan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editJabatanTujuan" name="jabatan_tujuan"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Perusahaan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editNamaPerusahaan" name="nama_perusahaan"
                                    required />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Penandatangan <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="editPenandatangan" name="penandatangan" required>
                                    <option value="">Pilih penandatangan...</option>
                                    <option value="Dewi Sulistiowati">Dewi Sulistiowati</option>
                                    <option value="Heri Pirdaus, S.Tr.Kes Rad (MRI)">Heri Pirdaus, S.Tr.Kes Rad (MRI)
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="">Pilih status...</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>

                        <!-- Detail Barang Section -->
                        <div class="col-12 mb-3">
                            <hr>
                            <h6 class="fw-semibold mb-3"><i class="mdi mdi-package-variant me-2"></i>Detail Barang</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" id="editItemsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 40%">Nama Barang</th>
                                            <th style="width: 15%">Jumlah</th>
                                            <th style="width: 20%">Harga Satuan</th>
                                            <th style="width: 20%">Total</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="editItemsBody">
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addEditItemRow()">
                                <i class="mdi mdi-plus me-1"></i>Tambah Barang
                            </button>
                        </div>

                        <!-- Total -->
                        <div class="col-12">
                            <div class="alert alert-primary">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Total Keseluruhan:</h6>
                                    <h5 class="mb-0">Rp <span id="editTotalDisplay">0</span></h5>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-warning text-white" id="btnUpdateSPH">
                        <i class="mdi mdi-content-save me-1"></i>Update SPH
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
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- External JS -->
    <script src="{{ asset('assets/js/detail-sph.js') }}"></script>
</body>

</html>