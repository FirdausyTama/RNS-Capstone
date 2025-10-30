<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Penawaran Harga | RNS - Ranay Nusantara Sejahtera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Times New Roman', serif;
      margin: 50px 80px;
      color: #000;
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
    .table-custom th, .table-custom td {
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
    .catatan {
      font-size: 14px;
      margin-top: 10px;
    }
    .catatan ul {
      margin-top: 5px;
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
      .no-print { display: none; }
      body { margin: 0; }
    }
  </style>
</head>
<body>

  <!-- Tombol Print -->
  <div class="text-end no-print mb-3">
    <button onclick="window.print()" class="btn btn-dark">
      <i class="mdi mdi-printer"></i> Print
    </button>
  </div>

  <!-- Kop Surat -->
  <div class="kop-surat">
    <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS">
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

</body>
</html>
