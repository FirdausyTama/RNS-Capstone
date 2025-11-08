<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Surat Jalan | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Format Surat Jalan RNS" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- App CSS -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <style>

      /* Header / Kop Surat */
      .kop-surat {
        text-align: center;
        margin-bottom: 25px;
      }

      .kop-surat img {
        width: 100%;
        max-height: 150px;
        object-fit: contain;
      }

      /* Informasi Penerima */
      .info-table {
        width: 100%;
        font-size: 14px;
        margin-bottom: 15px;
      }

      .info-table td {
        padding: 3px 6px;
        vertical-align: top;
      }

      .info-table td:first-child {
        width: 160px;
        font-weight: bold;
      }

      /* Judul Surat Jalan */
      .title-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px 0 8px 0;
      }

      .title-container h4 {
        flex-grow: 1;
        text-align: center;
        font-weight: bold;
        margin: 0;
      }

      .title-container .tanggal {
        font-size: 14px;
        white-space: nowrap;
      }

      /* Tabel Barang */
      .sj-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 14px;
      }

      .sj-table th,
      .sj-table td {
        border: 1px solid #000;
        padding: 8px;
      }

      .sj-table th {
        background-color: #eef7ff;
        text-align: center;
      }

      .sj-table td:nth-child(2) {
        text-align: left;
      }

      .sj-table td {
        text-align: center;
      }

      /* Tanda tangan */
      .sign-section {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
        font-size: 14px;
      }

      .sign-box {
        width: 45%;
        text-align: center;
      }

      .sign-box img {
        height: 70px;
        margin: 8px 0;
      }

      /* Footer note */
      .footer-note {
        border-top: 1px solid #ccc;
        margin-top: 50px;
        padding-top: 6px;
        text-align: center;
        font-size: 13px;
        color: #444;
      }

      /* Tombol print */
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
                <h4 class="fs-18 fw-semibold m-0">Surat Jalan</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="/surat-jalan">Halaman</a></li>
                  <li class="breadcrumb-item active">Detail Surat Jalan</li>
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

                <!-- Info Penerima -->
                <table class="info-table">
                  <tr>
                    <td>KEPADA YTH</td>
                    <td>: RS KENCANA SERANG</td>
                  </tr>
                  <tr>
                    <td>ALAMAT</td>
                    <td>: JL. JENDRAL AHMAD YANI NO.21-23, SUMURPECUNG SERANG, CIMUNCANG, KEC.SERANG – BANTEN 42117</td>
                  </tr>
                  <tr>
                    <td>TELP. COSTUMER</td>
                    <td>: (0254) 211554</td>
                  </tr>
                  <tr>
                    <td>KETERANGAN</td>
                    <td>: PENGECEKAN ALAT</td>
                  </tr>
                </table>

                <!-- Judul -->
                <div class="title-container">
                  <h4>SURAT JALAN</h4>
                  <div class="tanggal">Tanggal : 03/10/2024</div>
                </div>

                <!-- Tabel Barang -->
                <table class="sj-table">
                  <thead>
                    <tr>
                      <th style="width: 40px;">NO</th>
                      <th>NAMA BARANG / JASA</th>
                      <th style="width: 60px;">QTY</th>
                      <th style="width: 80px;">JUMLAH</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Pengecekan Alat Xray Mobile GE Optima XR200AMX</td>
                      <td>1</td>
                      <td>1</td>
                    </tr>
                  </tbody>
                </table>

                <!-- Tanda Tangan -->
                <div class="sign-section">
                  <div class="sign-box">
                    <p><strong>CUSTOMER / PIHAK RS</strong></p>
                    <br /><br />
                    <img src="" alt="Tanda Tangan" />
                    <p><u>RS KENCANA SERANG</u></p>
                  </div>
                  <div class="sign-box">
                    <p><strong>ENGINEER</strong></p>
                    <br /><br />
                    <img src="" alt="Tanda Tangan" />
                    <p><u>MUHAMMAD ARYA</u></p>
                  </div>
                </div>

                <!-- Footer note -->
                <div class="footer-note">
                  Terima kasih telah mempercayakan layanan kepada
                  <strong>PT Ranay Nusantara Sejahtera</strong>
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

        <!-- Tombol Print -->
        <div class="content position-relative">
          <button
            type="button"
            class="btn btn-primary rounded-circle shadow-lg no-print"
            style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Print Surat Jalan"
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

    <!-- App JS -->
    <script src="assets/js/app.js"></script>
  </body>
</html>
