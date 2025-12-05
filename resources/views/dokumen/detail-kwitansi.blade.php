<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Detail Kwitansi | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detail Kwitansi Pembayaran RNS" />
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

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
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
                            <h4 class="fs-18 fw-semibold m-0">Detail Kwitansi</h4>
                        </div>

                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/kwitansi') }}">Kwitansi</a></li>
                                <li class="breadcrumb-item active">Detail</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Button Kembali -->
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ url('/kwitansi') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKwitansi">
                            <i class="mdi mdi-pencil me-1"></i> Edit Kwitansi
                        </button>
                    </div>

                    <div class="row">
                        <!-- Kolom Kiri - Informasi Kwitansi -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-4">Informasi Kwitansi</h5>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Nomor Kwitansi</div>
                                            <div class="info-value" id="nomor_kwitansi">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Tanggal</div>
                                            <div class="info-value" id="tanggal">Loading...</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Status</div>
                                        <div id="status">Loading...</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Untuk Pembayaran</div>
                                        <div class="info-value" id="keterangan">Loading...</div>
                                    </div>

                                    <hr class="my-4">

                                    <h5 class="fw-semibold mb-4">Detail Pembayaran</h5>

                                    <div class="mb-3">
                                        <div class="info-label">Total Pembayaran</div>
                                        <div class="info-value text-primary fw-bold fs-4" id="total_pembayaran">Loading...</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Terbilang</div>
                                        <div class="info-value fst-italic text-muted" id="total_bilangan">Loading...</div>
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
                                        <div class="info-label">Nama Penerima</div>
                                        <div class="info-value" id="nama_penerima">Loading...</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="info-label">Alamat</div>
                                        <div class="info-value" id="alamat_penerima">Loading...</div>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
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

    <!-- Modal Edit Kwitansi -->
    <div class="modal fade" id="modalEditKwitansi" tabindex="-1" aria-labelledby="modalEditKwitansiLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-warning text-white">
            <h5 class="modal-title text-white" id="modalEditKwitansiLabel">
              <i class="mdi mdi-pencil me-2"></i>Edit Kwitansi
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formEditKwitansi">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="editNomorKwitansi" class="form-label fw-semibold">
                    Nomor Kwitansi <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="editNomorKwitansi" name="nomor_kwitansi" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="editTanggal" class="form-label fw-semibold">
                    Tanggal <span class="text-danger">*</span>
                  </label>
                  <input type="date" class="form-control" id="editTanggal" name="tanggal" required />
                </div>
                <div class="col-12 mb-3">
                  <label for="editNamaPenerima" class="form-label fw-semibold">
                    Nama Penerima <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="editNamaPenerima" name="nama_penerima" required />
                </div>
                <div class="col-12 mb-3">
                  <label for="editAlamat" class="form-label fw-semibold">
                    Alamat <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="editAlamat" name="alamat_penerima" required />
                </div>
                <div class="col-12 mb-3">
                  <label for="editTotalBilangan" class="form-label fw-semibold">
                    Banyaknya Uang <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="editTotalBilangan" name="total_bilangan" required />
                </div>
                <div class="col-12 mb-3">
                  <label for="editKeterangan" class="form-label fw-semibold">
                    Untuk Pembayaran <span class="text-danger">*</span>
                  </label>
                  <textarea class="form-control" id="editKeterangan" name="keterangan" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="editTotalPembayaran" class="form-label fw-semibold">
                    Total Pembayaran <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="editTotalPembayaran" name="total_pembayaran" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="editStatus" class="form-label fw-semibold">
                    Status <span class="text-danger">*</span>
                  </label>
                  <select class="form-select" id="editStatus" name="status" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="mdi mdi-close me-1"></i>Batal
            </button>
            <button type="button" class="btn btn-warning text-white" id="btnUpdateKwitansi">
              <i class="mdi mdi-content-save me-1"></i>Update Kwitansi
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


    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- External JS -->
    <script src="{{ asset('assets/js/detail-kwitansi.js') }}"></script>
    <script>
        // Keep only UI specific logic if needed, but most logic is now in detail-kwitansi.js
        $(document).ready(function() {
             $('#editTotalPembayaran').on('keyup', function() {
              let value = $(this).val().replace(/\./g, '');
              if (!isNaN(value) && value !== '') {
                $(this).val(parseInt(value).toLocaleString('id-ID'));
              }
            });
        });
    </script>
</body>
</html>
