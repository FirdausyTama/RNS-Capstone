<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Surat Penawaran Harga | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Surat penawaran harga resmi PT Ranay Nusantara Sejahtera." />
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

      /* Kop Surat */
      .kop-surat {
        text-align: center;
        margin-bottom: 30px;
      }

      .kop-surat img {
        width: 100%;
        max-height: 160px;
        object-fit: contain;
      }

      /* Tabel isi */
      table.table-borderless td {
        padding: 3px 6px;
        vertical-align: top;
        font-size: 15px;
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
        margin-bottom: 20px;
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
            <!-- Header halaman -->
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Surat Penawaran Harga</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="/surat">Halaman</a></li>
                  <li class="breadcrumb-item active">Penawaran Harga</li>
                </ol>
              </div>
            </div>

            <!-- Card utama -->
            <div class="card shadow-sm border-0">
              <div class="card-body">

                

                <!-- Kop Surat -->
                <div class="kop-surat">
                  <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
                </div>

                <!-- Isi Surat -->
                <div class="mb-4 text-end">
                  <p>Banten, 17 Februari 2025</p>
                </div>
                
                <table class="table table-borderless mb-3">
                  <tr><td style="width: 80px;">No.</td><td>: 03/SPH/XRAY/RNS-II/2025</td></tr>
                  <tr><td>Lampiran</td><td>: -</td></tr>
                  <tr><td>Hal</td><td>: <strong>Penawaran Harga</strong></td></tr>
                </table>
                

                <p><strong>Kepada Yth.</strong><br>
                   <strong>D i r e k t u r</strong><br>
                   RSUD Tobat Balaraja</p>

                <p>Dengan hormat,</p>

                <p style="text-align: justify;">
                  Terimakasih atas kesempatan yang diberikan kepada kami, kami selaku Perusahaan Suplier Alat - alat Kesehatan dan Jasa
                  Pemeliharaan / Perbaikan Alat - alat kesehatan, dengan ini perkenankan kami mengajukan penawaran harga barang dan jasa dengan rincian sebagai berikut :
                </p>

                <!-- Tabel Penawaran -->
                <table class="table-custom">
                  <thead>
                    <tr>
                      <th style="width: 40px;">No</th>
                      <th>Deskripsi</th>
                      <th style="width: 90px;">Qty</th>
                      <th style="width: 140px;">Harga Satuan</th>
                      <th style="width: 140px;">Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Service On CPU Board Panoramic Rotograph</td>
                      <td>1 Pack</td>
                      <td>Rp. 29.500.000</td>
                      <td>Rp. 29.500.000</td>
                    </tr>

                    <tr>
                      <td colspan="4" class="text-end fw-bold">TOTAL</td>
                      <td class="fw-bold">Rp. 65.000.000</td>
                    </tr>
                  </tbody>
                </table>

                <p class="fst-italic mt-2" style="font-size: 14px;">
                  Catatan : Harga tidak terikat, sewaktu-waktu dapat berubah
                </p>

                <p style="text-align: justify; font-size: 15px;">
                  Demikian surat penawaran barang dan jasa ini kami sampaikan, kami berharap menjadi mitra dalam penyediaan
                  layanan kesehatan yang Anda butuhkan.
                </p>

                <p>Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>

                <!-- Tanda Tangan -->
                <div class="ttd">
                  <p>Hormat kami,</p>
                  <p><strong>PT. RANAY NUSANTARA SEJAHTERA</strong></p>
                  <img src="{{ asset('assets/images/ttdsurat.png') }}" alt="Tanda Tangan">
                  <p><strong>Heri Pirdaus, S.Tr.Kes Rad (MRI)</strong></p>
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
                &copy;
                <script>document.write(new Date().getFullYear())</script>
                - Made with <span class="mdi mdi-heart text-danger"></span> by
                <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
              </div>
            </div>
          </div>
        </footer>

        <!-- Tombol Print Mengambang -->
        <div class="content position-relative">
          <button
            type="button"
            class="btn btn-primary rounded-circle shadow-lg"
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Print Surat Penawaran"
            onclick="window.print()"
          >
            <i class="mdi mdi-printer fs-3 text-white"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Vendor JS -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
