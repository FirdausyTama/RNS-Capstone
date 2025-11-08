<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Detail Kwitansi | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Halaman detail kwitansi RNS." />
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

      /* Header: Logo lengkap */
      .kw-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .kw-header img {
        width: 100%;
        max-height: 160px;
        object-fit: contain;
      }

      /* Area utama kwitansi */
      .kw-main {
        margin-top: 10px;
      }

      /* Dua kolom atas */
      .kw-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 16px;
      }

      .kw-left {
        flex: 1 1 60%;
        background: #dbeaff;
        border: 1px solid #000;
        padding: 10px;
      }

      .kw-left b {
        display: block;
        background: #bcd9ff;
        text-align: center;
        font-weight: bold;
        border-bottom: 1px solid #000;
        padding: 4px 0;
        margin-bottom: 6px;
      }

      .kw-left .address {
        font-size: 13px;
        line-height: 1.4;
        color: #000;
      }

      .kw-right {
        flex: 0 0 32%;
        border: 1px solid #000;
        background: #fff;
        padding: 6px 10px;
      }

      .kw-right table {
        width: 100%;
        font-size: 13px;
      }

      .kw-right td {
        padding: 3px 4px;
      }

      /* Judul receipt */
      .kw-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 2px;
      }

      .kw-title {
        text-align: center;
        letter-spacing: 8px;
        font-size: 13px;
        margin-bottom: 14px;
      }

      /* Isi form */
      .kw-form {
        width: 100%;
        font-size: 14px;
        margin-top: 10px;
      }

      .kw-form td {
        padding: 6px 4px;
        vertical-align: top;
      }

      .kw-field {
        background: #eef7ff;
        border: 1px solid #cfe8ff;
        padding: 8px;
        min-height: 34px;
      }

      /* Total box */
      .kw-total {
        border: 1px solid #000;
        background: #dbeaff;
        padding: 8px 20px;
        font-weight: bold;
        display: inline-block;
        margin-top: 6px;
      }

      /* Signature */
      .kw-sign {
        margin-top: 40px;
        text-align: right;
        font-size: 13px;
        line-height: 1.5;
      }

      .kw-sign img {
        height: 80px;
        display: inline-block;
        margin: 10px 0 5px 0;
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
                <h4 class="fs-18 fw-semibold m-0">Detail Kwitansi</h4>
              </div>
              <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                  <li class="breadcrumb-item"><a href="/kwitansi">Daftar Kwitansi</a></li>
                  <li class="breadcrumb-item active">Kwitansi Detail</li>
                </ol>
              </div>
            </div>

            <!-- Card utama -->
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <!-- Tombol print -->
                <div class="text-end no-print mb-3">
                  <button onclick="window.print()" class="btn btn-dark">
                    <i class="mdi mdi-printer"></i> Print
                  </button>
                </div>

                <!-- KWITANSI CONTENT -->
                <div class="kw-main">

                  <!-- Kop Surat -->
                  <div class="kw-header">
                    <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
                  </div>

                  <!-- Kotak kiri-kanan -->
                  <div class="kw-row">
                    <div class="kw-left">
                      <b>KWITANSI TO</b>
                      <div class="address">
                        <strong>RS Fatimah Serang</strong><br />
                        Jalan Raya Serang - Cilegon km. 3,5 Drangong<br />
                        Kel. Drangong, Kec. Taktakan, Kota Serang,<br />
                        Banten 42162
                      </div>
                    </div>

                    <div class="kw-right">
                      <table>
                        <tr>
                          <td style="width:45%;"><strong>Tanggal</strong></td>
                          <td>:</td>
                          <td style="text-align:right;">11/09/2025</td>
                        </tr>
                        <tr>
                          <td><strong>No Kwitansi</strong></td>
                          <td>:</td>
                          <td style="text-align:right;">02/RNS/AKUN/IX/2025</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <!-- Judul -->
                  <div class="kw-subtitle">KWITANSI</div>
                  <div class="kw-title">R E C E I P T</div>

                  <!-- Form -->
                  <table class="kw-form">
                    <tr>
                      <td style="width:22%;">Received From / Sudah Terima Dari</td>
                      <td style="width:2%;">:</td>
                      <td><div class="kw-field"><strong>RS FATIMAH SERANG</strong></div></td>
                    </tr>

                    <tr>
                      <td>Amount in Words / Banyaknya Uang</td>
                      <td>:</td>
                      <td><div class="kw-field"><em>Enam Belas Juta Seratus Enam Puluh Enam Ribu Enam Ratus Enam Puluh Enam Koma Tujuh Rupiah</em></div></td>
                    </tr>

                    <tr>
                      <td>For Payment of / Untuk Pembayaran</td>
                      <td>:</td>
                      <td><div class="kw-field">Angsuran Ke-11 Pembelian CR FUJI Prima T2</div></td>
                    </tr>

                    <tr>
                      <td style="vertical-align:middle;">Total / Jumlah</td>
                      <td style="vertical-align:middle;">:</td>
                      <td><div class="kw-total">Rp. 16.166.666,7,-</div></td>
                    </tr>
                  </table>
                  <!-- Blok tanda tangan -->
                  <div class="kw-sign">
                    <div class="kw-sign-right">
                      <p>Hormat Kami,</p>
                      <p><strong>PT. Ranay Nusantara Sejahtera</strong></p>
                      <img src="{{ asset('assets/images/ttdsurat.png') }}" alt="Tanda Tangan Heri Pirdaus" class="kw-sign-img" />
                      <p class="sign-name">Heri Pirdaus, S.Tr.Kes Rad (MRI)</p>
                    </div>
                  </div>
                <!-- /kw-main -->
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
            title="Print Kwitansi"
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
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
  </body>
</html>
