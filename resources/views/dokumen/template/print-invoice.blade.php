<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Detail Invoice | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Halaman detail surat invoice RNS." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/head.js"></script>

    <style>
      body {
      }
      .kop-surat {
        text-align: center;
        margin-bottom: 30px;
      }
      .kop-surat img {
        width: 100%;
        max-height: 160px;
        object-fit: contain;
      }
      .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }
      .table-custom th,
      .table-custom td {
        border: 1px solid #000;
        padding: 6px 8px;
        font-size: 15px;
      }
      .table-custom th {
        background-color: #e3f0ff;
        text-align: center;
      }
      .table-custom td {
        text-align: center;
      }
      .table-custom td:nth-child(2) {
        text-align: left;
      }
      .ttd {
        margin-top: 50px;
        text-align: right;
      }
      .ttd img {
        height: 50px;
        margin-bottom: 15px;
      }
      @media print {
      .no-print,
      .btn,
      [data-bs-toggle="tooltip"],
      .content.position-relative {
        display: none !important;
        visibility: hidden !important;
      }

      body {
        margin: 0;
        background: white;
      }

      .card {
        border: none !important;
        box-shadow: none !important;
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
                <h4 class="fs-18 fw-semibold m-0">Detail Surat Invoice</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="/invoice">Daftar Invoice</a></li>
                  <li class="breadcrumb-item active">Invoice Detail</li>
                </ol>
              </div>
            </div>
          </div>

          <!-- Start Main Content -->
          <div class="row">
            <div class="container-fluid">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  

                  <!-- Kop Surat -->
                  <div class="kop-surat">
                    <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
                  </div>

                  <!-- Isi Invoice -->
                  <div class="mb-4 d-flex justify-content-between">
                    <div>
                      <p><strong>INVOICE</strong></p>
                      <p><strong>No. Invoice:</strong> 01/INV-RNS/X/2025</p>
                      <p><strong>Tanggal:</strong> 01 Oktober 2025</p>
                    </div>
                    
                  </div>
                  <div class="mb-4">
                    <p><strong>Kepada Yth:</strong><br />
                      <strong>PT Trimeda Global Vistech</strong>
                    </p>
                  </div>

                  <!-- Tabel Barang -->
                  <table class="table-custom">
                    <thead>
                      <tr>
                        <th>Deskripsi Barang</th>
                        <th style="width: 150px;">Quantity</th>
                        <th style="width: 150px;">Harga / Karton</th>
                        <th style="width: 150px;">Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Film Inkjet Blue A4 (210 x 297)</td>
                        <td>2 Karton (20 Box)</td>
                        <td>Rp 2.300.000,-</td>
                        <td>Rp 4.600.000,-</td>
                      </tr>
                      <tr>
                        <td>Estimasi Ongkir (40Kg)</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Rp 80.000,-</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-end fw-bold">Total Pembayaran</td>
                        <td class="fw-bold">Rp 4.680.000,-</td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- Pembayaran -->
                  <div class="mt-4">
                    <h6 class="fw-semibold">Pembayaran Ditransfer Ke:</h6>
                    <table class="table table-borderless align-middle" style="font-size: 15px; width: auto;">
                      <tbody>
                        <tr>
                          <td style="width: 120px; font-weight: 500;">Bank</td>
                          <td style="width: 10px;">:</td>
                          <td>BCA</td>
                        </tr>
                        <tr>
                          <td style="font-weight: 500;">No. Rekening</td>
                          <td>:</td>
                          <td>2450782656</td>
                        </tr>
                        <tr>
                          <td style="font-weight: 500;">Atas Nama</td>
                          <td>:</td>
                          <td>Heri Pirdaus</td>
                        </tr>
                        <tr>
                          <td style="font-weight: 500;">Kode Bank</td>
                          <td>:</td>
                          <td>014</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                  <!-- Tanda Tangan -->
                  <div class="ttd">
                    <p>Hormat Kami,</p>
                    <p><strong>PT Ranay Nusantara Sejahtera</strong></p>
                    <img src="{{ asset('assets/images/ttdsurat.png') }}" alt="Tanda Tangan" />
                    <p><strong>Dewi Sulistiowati</strong></p>
                  </div>

                  <div class="text-center text-muted border-top pt-3 mt-4 fs-13">
                    Terima kasih telah menjadi bagian dari <strong>PT Ranay Nusantara Sejahtera</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Main Content -->
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col fs-13 text-muted text-center">
                &copy; <script>document.write(new Date().getFullYear())</script>
                - Made with <span class="mdi mdi-heart text-danger"></span> by
                <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
              </div>
            </div>
          </div>
        </footer>

        <!-- Floating Button -->
        <div class="content position-relative">
          <button
            type="button"
            class="btn btn-primary rounded-circle shadow-lg"
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Print Invoice"
            onclick="window.print()"
          >
            <i class="mdi mdi-printer fs-3 text-white"></i>
          </button>
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
  </body>
</html>