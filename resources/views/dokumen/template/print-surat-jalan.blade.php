<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Cetak Surat Jalan | RNS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>

    <style>
      body {
      }

      /* Header: Logo lengkap */
      .sj-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .sj-header img {
        width: 100%;
        max-height: 160px;
        object-fit: contain;
      }

      /* Area utama surat jalan */
      .sj-main {
        margin-top: 10px;
      }

      /* Dua kolom atas */
      .sj-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 16px;
      }

      .sj-left {
        flex: 1 1 60%;
        background: #dbeaff;
        border: 1px solid #000;
        padding: 10px;
      }

      .sj-left b {
        display: block;
        background: #bcd9ff;
        text-align: center;
        font-weight: bold;
        border-bottom: 1px solid #000;
        padding: 4px 0;
        margin-bottom: 6px;
      }

      .sj-left .address {
        font-size: 13px;
        line-height: 1.4;
        color: #000;
      }

      .sj-right {
        flex: 0 0 32%;
        border: 1px solid #000;
        background: #fff;
        padding: 6px 10px;
      }

      .sj-right table {
        width: 100%;
        font-size: 13px;
      }

      .sj-right td {
        padding: 3px 4px;
      }

      /* Judul */
      .sj-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 2px;
      }

      .sj-title {
        text-align: center;
        letter-spacing: 8px;
        font-size: 13px;
        margin-bottom: 14px;
      }

      /* Tabel Barang */
      .sj-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 13px;
      }
      .sj-table th, .sj-table td {
        border: 1px solid #000;
        padding: 8px;
      }
      .sj-table th {
        background-color: #f0f0f0;
        text-align: center;
      }

      /* Signature */
      .sj-sign {
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        font-size: 13px;
      }
      .sj-sign-box {
        text-align: center;
        width: 200px;
      }
      .sj-sign-space {
        height: 80px;
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
                <h4 class="fs-18 fw-semibold m-0">Detail Surat Jalan</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="/surat-jalan">Halaman</a></li>
                  <li class="breadcrumb-item active">Surat Jalan Detail</li>
                </ol>
              </div>
            </div>

            <!-- Card utama -->
            <div class="card shadow-sm border-0">
              <div class="card-body">

                <!-- SURAT JALAN CONTENT -->
                <div class="sj-main">

                  <!-- Kop Surat -->
                  <div class="sj-header">
                    <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
                  </div>

                  <!-- Kotak kiri-kanan -->
                  <div class="sj-row">
                    <div class="sj-left">
                      <b>KEPADA YTH.</b>
                      <div class="address">
                        <strong id="printNamaPenerima">Loading...</strong><br />
                        <span id="printAlamatPenerima">Loading...</span><br>
                        <span id="printTelpPenerima">Loading...</span>
                      </div>
                    </div>

                    <div class="sj-right">
                      <table>
                        <tr>
                          <td style="width:45%;"><strong>Tanggal</strong></td>
                          <td>:</td>
                          <td style="text-align:right;" id="printTanggal">Loading...</td>
                        </tr>
                        <tr>
                          <td><strong>No. SJ</strong></td>
                          <td>:</td>
                          <td style="text-align:right;" id="printNomor">Loading...</td>
                        </tr>
                        <tr>
                          <td><strong>Pengirim</strong></td>
                          <td>:</td>
                          <td style="text-align:right;" id="printNamaPengirim">Loading...</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <!-- Judul -->
                  <div class="sj-subtitle">SURAT JALAN</div>
                  <div class="sj-title">DELIVERY ORDER</div>

                  <!-- Tabel Barang -->
                  <table class="sj-table">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Nama Barang / Jasa</th>
                        <th width="10%">Qty</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td id="printNamaBarang">Loading...</td>
                        <td class="text-center" id="printQty">Loading...</td>
                        <td id="printKeterangan">Loading...</td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- Blok tanda tangan -->
                  <div class="sj-sign">
                    <div class="sj-sign-box">
                      <p>Penerima,</p>
                      <div class="sj-sign-space"></div>
                      <p>( .................................... )</p>
                    </div>
                    <div class="sj-sign-box">
                      <p>Hormat Kami,</p>
                      <p><strong>PT. Ranay Nusantara Sejahtera</strong></p>
                      <img src="{{ asset('assets/images/ttdsurat.png') }}" alt="Tanda Tangan" style="height: 80px; margin: 10px 0;">
                      <p><strong>Heri Pirdaus, S.Tr.Kes Rad (MRI)</strong></p>
                    </div>
                  </div>
                </div>
                <!-- /sj-main -->

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
            title="Print Surat Jalan"
            onclick="window.print()"
          >
            <i class="mdi mdi-printer fs-3 text-white"></i>
          </button>
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
    <script src="{{ asset('assets/js/print-surat-jalan.js') }}"></script>
  </body>
</html>
