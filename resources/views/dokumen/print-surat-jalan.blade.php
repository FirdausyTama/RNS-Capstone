<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Surat Jalan | RNS - Ranay Nusantara Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Format Surat Jalan RNS" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <style>
      body {
        font-family: "Times New Roman", serif;
        color: #000;
        background: #fff;
        margin: 40px 70px;
      }

      /* Header / Kop Surat */
      .kop-surat {
        text-align: center;
        margin-bottom: 25px;
      }
      .kop-surat img {
        width: 100%;
        max-height: 140px;
        object-fit: contain;
      }

      /* Informasi RS */
      .info-table {
        width: 100%;
        font-size: 14px;
        margin-bottom: 10px;
      }
      .info-table td {
        padding: 3px 6px;
        vertical-align: top;
      }
      .info-table td:first-child {
        width: 130px;
      }

      /* Judul Surat Jalan */
      .title-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px 0 8px 0;
      }
      .title-container h3 {
        text-align: center;
        font-weight: bold;
        flex-grow: 1;
        margin: 0;
      }
      .title-container .tanggal {
        text-align: right;
        font-size: 14px;
        white-space: nowrap;
      }

      /* Table Barang */
      .sj-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
        font-size: 14px;
      }
      .sj-table th,
      .sj-table td {
        border: 1px solid #000;
        padding: 8px;
      }
      .sj-table th {
        text-align: center;
        background-color: #f0f5ff;
        font-weight: bold;
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
        margin-top: 60px;
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

      /* Garis bawah ucapan terima kasih */
      .footer-note {
        border-top: 1px solid #ccc;
        margin-top: 40px;
        padding-top: 7px;
        text-align: center;
        font-size: 13px;
        color: #444;
      }

      /* Tombol Print */
      .no-print {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 999;
      }

      @media print {
        .no-print,
        .navbar,
        .sidebar,
        header,
        footer {
          display: none !important;
        }
        body {
          margin: 10mm 15mm;
          background: #fff;
        }
      }
    </style>
  </head>

  <body>
    <!-- Tombol print hanya muncul di layar -->
    <div class="no-print">
      <button onclick="window.print()" class="btn btn-primary rounded-circle shadow-lg"
        style="width: 60px; height: 60px;">
        <i class="mdi mdi-printer fs-3 text-white"></i>
      </button>
    </div>

    <!-- Header -->
    <div class="kop-surat">
      <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
    </div>

    <!-- Informasi Penerima -->
    <table class="info-table">
      <tr>
        <td><strong>KEPADA YTH</strong></td>
        <td>: RS KENCANA SERANG</td>
      </tr>
      <tr>
        <td><strong>ALAMAT</strong></td>
        <td>: JL. JENDRAL AHMAD YANI NO.21-23, SUMURPECUNG SERANG, CIMUNCANG, KEC.SERANG – BANTEN 42117</td>
      </tr>
      <tr>
        <td><strong>TELP. COSTUMER</strong></td>
        <td>: (0254) 211554</td>
      </tr>
      <tr>
        <td><strong>KETERANGAN</strong></td>
        <td>: PENGECEKAN ALAT</td>
      </tr>
    </table>

    <!-- Judul -->
    <div class="title-container">
      <h3>SURAT JALAN</h3>
      <div class="tanggal">Tanggal : 03/10/2024</div>
    </div>

    <!-- Table Barang -->
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
        <p><strong>COSTUMER / PIHAK RS</strong></p>
        <br /><br /><br />
        <p><u>RS KENCANA SERANG</u></p>
      </div>
      <div class="sign-box">
        <p><strong>ENGINEER</strong></p>
        <br/><br /><br />
        <p><u>MUHAMMAD ARYA</u></p>
      </div>
    </div>

    <!-- Footer note -->
    <div class="footer-note">
      Terima kasih telah mempercayakan layanan kepada <strong>PT Ranay Nusantara Sejahtera</strong>
    </div>
  </body>
</html>
