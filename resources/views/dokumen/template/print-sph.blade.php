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
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

  <!-- App css -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

  <script src="{{ asset('assets/js/head.js') }}"></script>

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
      @page {
        size: A4;
        margin: 15mm;
      }

      body, html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background: white;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .no-print,
      .btn,
      [data-bs-toggle="tooltip"],
      .content.position-relative,
      .breadcrumb,
      .navbar-custom,
      .left-side-menu,
      .footer {
        display: none !important;
        visibility: hidden !important;
      }

      .card {
        border: none !important;
        box-shadow: none !important;
        width: 100% !important;
        margin: 0 !important;
      }

      /* Reset Layout Containers */
      #app-layout, .content-page, .content, .container-fluid, .card-body {
          margin: 0 !important;
          padding: 0 !important;
          height: auto !important;
          width: 100% !important;
          max-width: 100% !important;
          display: block !important;
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
                <li class="breadcrumb-item"><a href="/sph">Daftar SPH</a></li>
                <li class="breadcrumb-item active">SPH Detail</li>
              </ol>
            </div>
          </div>

          <!-- Button Kembali -->
          <div class="mb-3 no-print">
            <a href="{{ url('/sph') }}" class="btn btn-light">
              <i class="mdi mdi-arrow-left me-1"></i> Kembali
            </a>
          </div>

          <!-- Card utama -->
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <!-- Kop Surat -->
              <div class="kop-surat">
                <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
              </div>

              <!-- Loading State -->
              <div id="loading-state" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat data SPH...</p>
              </div>

              <!-- Content Container -->
              <div id="sph-content" style="display: none;">
                <!-- Isi Surat -->
                <div class="mb-4 text-end">
                  <p><span id="tempat-sph">-</span>, <span id="tanggal-sph">-</span></p>
                </div>

                <table class="table table-borderless mb-3">
                  <tr>
                    <td style="width: 80px;">No.</td>
                    <td>: <span id="nomor-sph">-</span></td>
                  </tr>
                  <tr>
                    <td>Lampiran</td>
                    <td>: <span id="lampiran-sph">-</span></td>
                  </tr>
                  <tr>
                    <td>Hal</td>
                    <td>: <strong><span id="hal-sph">Penawaran Harga</span></strong></td>
                  </tr>
                </table>

                <p><strong>Kepada Yth.</strong><br>
                  <strong id="jabatan-tujuan">-</strong><br>
                  <span id="nama-perusahaan-sph">-</span>
                </p>

                <p>Dengan hormat,</p>

                <p style="text-align: justify;">
                  Terimakasih atas kesempatan yang diberikan kepada kami, kami selaku Perusahaan Suplier Alat - alat
                  Kesehatan dan Jasa Pemeliharaan / Perbaikan Alat - alat kesehatan, dengan ini perkenankan kami
                  mengajukan penawaran
                  harga barang dan jasa dengan rincian sebagai berikut :
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
                  <tbody id="items-tbody-sph">
                    <!-- Items will be populated here -->
                  </tbody>
                </table>

                <p class="fst-italic mt-2" style="font-size: 14px;">
                  Catatan : Harga tidak terikat, sewaktu-waktu dapat berubah
                </p>

                <p style="text-align: justify; font-size: 15px;">
                  Demikian surat penawaran barang dan jasa ini kami sampaikan, kami berharap menjadi mitra dalam
                  penyediaan layanan kesehatan yang Anda butuhkan.
                </p>

                <p>Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>

                <!-- Tanda Tangan -->
                <div class="ttd" id="ttd-section-sph" style="display: none;">
                  <p>Hormat kami,</p>
                  <p><strong>PT. RANAY NUSANTARA SEJAHTERA</strong></p>
                  <img id="ttd-image-sph" src="{{ asset('assets/images/ttdHeri.png') }}" alt="Tanda Tangan">
                  <p><strong id="penandatangan-sph">-</strong></p>
                </div>
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
        <button type="button" class="btn btn-primary rounded-circle shadow-lg"
          style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;" data-bs-toggle="tooltip"
          data-bs-placement="top" title="Print Surat Penawaran" onclick="window.print()">
          <i class="mdi mdi-printer fs-3 text-white"></i>
        </button>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- Vendor JS -->
  <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>

  <!-- SPH Detail Script -->
  <script>       document.addEventListener('DOMContentLoaded', function () {
      const sphId = window.location.pathname.split('/').pop();
      loadSPHDetail(sphId);
    });

    function loadSPHDetail(id) {
      const token = localStorage.getItem('token');
      const API_SPH = `http://127.0.0.1:8000/api/surat-penawaran/${id}`;

      fetch(API_SPH, {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + token,
          'Accept': 'application/json'
        }
      })
        .then(async res => {
          if (!res.ok) {
            const text = await res.text();
            console.error('RESPON ERROR:', text);
            throw new Error('Gagal memuat data SPH');
          }
          return res.json();
        })
        .then(data => {
          console.log('SPH Data:', data);
          renderSPHDetail(data);
        })
        .catch(err => {
          console.error('Error:', err);
          document.getElementById('loading-state').innerHTML = `
              <div class="alert alert-danger">
                <i class="mdi mdi-alert-circle-outline me-2"></i>
                Gagal memuat data SPH!
              </div>
            `;
        });
    }

    function renderSPHDetail(data) {
      // Hide loading
      document.getElementById('loading-state').style.display = 'none';
      document.getElementById('sph-content').style.display = 'block';
      document.getElementById('ttd-section-sph').style.display = 'block';

      // Populate header info
      document.getElementById('tempat-sph').textContent = data.tempat || 'Banten';
      document.getElementById('tanggal-sph').textContent = formatDate(data.tanggal) || '-';
      document.getElementById('nomor-sph').textContent = data.nomor_sph || '-';
      document.getElementById('lampiran-sph').textContent = data.lampiran || '-';
      document.getElementById('hal-sph').textContent = data.hal || 'Penawaran Harga';
      document.getElementById('jabatan-tujuan').textContent = data.jabatan_tujuan || 'Direktur';
      document.getElementById('nama-perusahaan-sph').textContent = data.nama_perusahaan || '-';

      // Set penandatangan and dynamic signature image
      const penandatangan = data.penandatangan || 'Heri Pirdaus, S.Tr.Kes Rad (MRI)';
      document.getElementById('penandatangan-sph').textContent = penandatangan;

      // Determine signature image based on penandatangan name
      const ttdImage = document.getElementById('ttd-image-sph');
      if (penandatangan.toLowerCase().includes('dewi')) {
        ttdImage.src = '/assets/images/ttdDewi.png';
      } else {
        ttdImage.src = '/assets/images/ttdHeri.png';
      }

      // Populate items
      const tbody = document.getElementById('items-tbody-sph');
      tbody.innerHTML = '';

      if (data.detail_barang && data.detail_barang.length > 0) {
        data.detail_barang.forEach((item, index) => {
          const row = `
              <tr>
                <td>${index + 1}</td>
                <td style="text-align: left;">${item.nama || '-'}</td>
                <td>${item.jumlah || '-'} Pack</td>
                <td>Rp. ${formatNumber(item.harga_satuan || 0)}</td>
                <td>Rp. ${formatNumber(item.total || 0)}</td>
              </tr>
            `;
          tbody.innerHTML += row;
        });
      }

      // Total row
      tbody.innerHTML += `
          <tr>
            <td colspan="4" class="text-end fw-bold">TOTAL</td>
            <td class="fw-bold">Rp. ${formatNumber(data.total_keseluruhan || 0)}</td>
          </tr>
        `;
    }

    function formatNumber(num) {
      return Number(num).toLocaleString('id-ID');
    }

    function formatDate(dateString) {
      if (!dateString) return '-';
      const options = { day: 'numeric', month: 'long', year: 'numeric' };
      const date = new Date(dateString);
      return date.toLocaleDateString('id-ID', options);
    }
  </script>
</body>

</html>