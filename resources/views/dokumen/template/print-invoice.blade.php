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
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

  <!-- App css -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

  <script src="{{ asset('assets/js/head.js') }}"></script>

  <style>
    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 30px 40px;
      font-family: 'Times New Roman', Times, serif;
      font-size: 13px;
      line-height: 1.4;
    }

    .kop-surat {
      text-align: center;
      margin-bottom: 15px;
    }

    .kop-surat img {
      width: 100%;
      max-height: 120px;
      object-fit: contain;
    }

    /* Header Invoice - Right aligned */
    .invoice-header {
      text-align: right;
      margin-bottom: 20px;
    }

    .invoice-title {
      color: #0066cc;
      font-size: 22px;
      font-weight: bold;
      font-style: italic;
      margin-bottom: 8px;
    }

    /* Invoice Info Table - Right aligned with proper colon alignment */
    .invoice-info-table {
      margin-left: auto;
      border-collapse: collapse;
      font-size: 13px;
    }

    .invoice-info-table td {
      padding: 2px 5px;
      vertical-align: top;
    }

    .invoice-info-table td:first-child {
      text-align: right;
    }

    .invoice-info-table td:nth-child(2) {
      text-align: center;
      width: 15px;
    }

    .invoice-info-table td:last-child {
      text-align: left;
    }

    /* Company Name - Centered */
    .company-recipient {
      text-align: center;
      font-size: 16px;
      font-weight: bold;
      margin: 25px 0 15px 0;
    }

    /* Table Styling */
    .table-invoice {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      font-size: 13px;
    }

    .table-invoice th {
      background-color: #d4e8fc;
      border: none;
      padding: 8px 10px;
      text-align: center;
      font-weight: bold;
      font-style: italic;
      color: #333;
    }

    .table-invoice td {
      padding: 6px 10px;
      border: none;
      vertical-align: top;
    }

    /* Zebra striping - light blue */
    .table-invoice tbody tr {
      min-height: 25px;
    }

    .table-invoice tbody tr:nth-child(odd) {
      background-color: #e8f4fc;
    }

    .table-invoice tbody tr:nth-child(even) {
      background-color: #f5fafd;
    }

    /* Empty rows for padding */
    .table-invoice .empty-row td {
      height: 25px;
    }

    .table-invoice .col-desc {
      text-align: left;
      color: #0066cc;
      font-style: italic;
      width: 35%;
    }

    .table-invoice .col-qty {
      text-align: center;
      width: 22%;
    }

    .table-invoice .col-price {
      text-align: center;
      width: 21%;
    }

    .table-invoice .col-total {
      text-align: right;
      width: 22%;
    }

    /* Table footer styling - zebra striping continues */
    .table-invoice tfoot tr:nth-child(odd) {
      background-color: #e8f4fc;
    }

    .table-invoice tfoot tr:nth-child(even) {
      background-color: #f5fafd;
    }

    .table-invoice tfoot .empty-row td {
      height: 22px;
    }

    /* Total Row - Inside table */
    .table-invoice .total-row-label {
      text-align: right;
      font-weight: bold;
      font-style: italic;
      padding: 8px 10px !important;
    }

    .table-invoice .total-row-value {
      text-align: right;
      font-weight: bold;
      padding: 8px 10px !important;
    }

    /* Footer Section */
    .invoice-footer {
      margin-top: 25px;
    }

    .thank-you-message {
      color: #0066cc;
      font-style: italic;
      margin-bottom: 8px;
      font-size: 13px;
    }

    .bank-info {
      font-size: 12px;
      line-height: 1.5;
    }

    .bank-info strong {
      font-style: italic;
    }

    /* Signature Section - Left aligned */
    .ttd {
      margin-top: 40px;
      text-align: left;
    }

    .ttd p {
      margin: 3px 0;
      font-size: 14px;
    }

    .ttd .company-name {
      font-weight: normal;
    }

    .ttd .logo-signature {
      display: flex;
      align-items: flex-end;
      gap: 10px;
      margin: 10px 0;
    }

    .ttd .logo-small {
      height: 60px;
      width: auto;
    }

    .ttd .signature-img {
      height: 50px;
      width: auto;
    }

    .ttd .signer-name {
      font-weight: normal;
      margin-top: 5px;
    }

    @media print {

      /* Hide non-print elements */
      .no-print,
      .btn,
      [data-bs-toggle="tooltip"],
      .content.position-relative,
      .app-sidebar-menu,
      .topbar-custom,
      #app-layout>.content-page>.content>.container-fluid>.py-3,
      .breadcrumb,
      footer {
        display: none !important;
        visibility: hidden !important;
      }

      /* Reset page layout */
      body {
        margin: 0 !important;
        padding: 0 !important;
        background: white !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color-adjust: exact !important;
      }

      html,
      body {
        width: 100%;
        height: auto;
      }

      /* Remove card styling */
      .card {
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
        padding: 0 !important;
      }

      .card-body {
        padding: 0 !important;
      }

      /* Main container */
      #app-layout,
      .content-page,
      .content,
      .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
      }

      .invoice-container {
        max-width: 100%;
        padding: 15px;
        margin: 0;
      }

      /* Kop surat */
      .kop-surat {
        margin-bottom: 15px;
      }

      .kop-surat img {
        max-height: 100px;
      }

      /* Header */
      .invoice-header {
        margin-bottom: 15px;
      }

      .invoice-title {
        font-size: 20px;
      }

      /* Company name */
      .company-recipient {
        margin: 15px 0;
        font-size: 16px;
      }

      /* Table - Force borders and backgrounds */
      .table-invoice {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
      }

      .table-invoice th {
        background-color: #d4e8fc !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        border: 1px solid #ccc !important;
        padding: 6px !important;
      }

      .table-invoice td {
        border: 1px solid #ddd !important;
        padding: 6px !important;
      }

      .table-invoice tbody tr:nth-child(odd) {
        background-color: #e8f4fc !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .table-invoice tbody tr:nth-child(even) {
        background-color: #f5fafd !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .table-invoice .col-desc {
        color: #0066cc !important;
        font-style: italic;
      }

      /* Table footer - zebra striping continues */
      .table-invoice tfoot tr:nth-child(odd) {
        background-color: #e8f4fc !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .table-invoice tfoot tr:nth-child(even) {
        background-color: #f5fafd !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .table-invoice tfoot td {
        border: 1px solid #ddd !important;
        padding: 5px !important;
      }

      .table-invoice tfoot .empty-row td {
        height: 18px;
        border: none !important;
      }

      /* Total row in tfoot */
      .table-invoice .total-row-label,
      .table-invoice .total-row-value {
        font-weight: bold;
        font-size: 12px;
      }

      /* Footer */
      .invoice-footer {
        margin-top: 15px;
      }

      .thank-you-message {
        font-size: 11px;
        color: #0066cc !important;
      }

      .bank-info {
        font-size: 11px;
      }

      /* Signature */
      .ttd {
        margin-top: 20px;
      }

      .ttd p {
        font-size: 12px;
        margin: 2px 0;
      }

      .ttd .logo-small {
        height: 40px;
      }

      .ttd .signature-img {
        height: 35px;
      }

      /* Page settings */
      @page {
        size: A4;
        margin: 10mm;
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

          <!-- Button Kembali -->
          <div class="mb-3">
            <a href="{{ url('/invoice') }}" class="btn btn-light">
              <i class="mdi mdi-arrow-left me-1"></i> Kembali
            </a>
          </div>

          <!-- Card utama -->
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <!-- Loading State -->
              <div id="loading-state" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat data invoice...</p>
              </div>

              <!-- Invoice Content Container -->
              <div id="invoice-content" class="invoice-container" style="display: none;">

                <!-- Kop Surat -->
                <div class="kop-surat">
                  <img src="{{ asset('assets/images/kopsurat.png') }}" alt="Kop Surat RNS" />
                </div>

                <!-- Invoice Header - Right Aligned -->
                <div class="invoice-header">
                  <div class="invoice-title">INVOICE</div>
                  <table class="invoice-info-table">
                    <tr>
                      <td>No.Invoice</td>
                      <td>:</td>
                      <td id="nomor-invoice">-</td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td id="tanggal-invoice">-</td>
                    </tr>
                  </table>
                </div>

                <!-- Company Recipient - Centered -->
                <div class="company-recipient" id="nama-perusahaan">-</div>

                <!-- Tabel Barang -->
                <table class="table-invoice">
                  <thead>
                    <tr>
                      <th class="col-desc">Deskripsi Barang</th>
                      <th class="col-qty">QUANTITY</th>
                      <th class="col-price">Harga / Karton</th>
                      <th class="col-total">Total Harga</th>
                    </tr>
                  </thead>
                  <tbody id="items-tbody">
                    <!-- Items will be populated here -->
                  </tbody>
                  <tfoot>
                    <!-- Empty rows for visual padding -->
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <tr class="empty-row">
                      <td colspan="4"></td>
                    </tr>
                    <!-- Total Row -->
                    <tr>
                      <td colspan="2"></td>
                      <td class="total-row-label">Total Pembayaran</td>
                      <td class="total-row-value" id="total-pembayaran">Rp. 0,-</td>
                    </tr>
                  </tfoot>
                </table>

                <!-- Footer Section -->
                <div class="invoice-footer">
                  <p class="thank-you-message">Terimakasih Telah Menjadi Bagian Dari PT. Ranay Nusantara Sejahtera</p>
                  <div class="bank-info">
                    <div>Pembayaran ditransfer ke :</div>
                    <div><strong>BCA Heri Pirdaus</strong></div>
                    <div><strong>No.Rek &nbsp;&nbsp;&nbsp;: 2450782656</strong></div>
                    <div>Kode Bank : 014</div>
                  </div>
                </div>

                <!-- Tanda Tangan - Left Aligned -->
                <div class="ttd" id="ttd-section" style="display: none;">
                  <p>Hormat Kami</p>
                  <p class="company-name">PT. Ranay Nusantara Sejahtera</p>
                  <div class="logo-signature">
                    <img src="{{ asset('assets/images/logo-rns-bg.png') }}" alt="Logo RNS" class="logo-small"
                      onerror="this.style.display='none'" />
                    <img id="ttd-image-invoice" src="{{ asset('assets/images/ttdHeri.png') }}" alt="Tanda Tangan"
                      class="signature-img" />
                  </div>
                  <p class="signer-name" id="penandatangan">-</p>
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

      <!-- Floating Button -->
      <div class="content position-relative">
        <button type="button" class="btn btn-primary rounded-circle shadow-lg"
          style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;" data-bs-toggle="tooltip"
          data-bs-placement="top" title="Print Invoice" onclick="window.print()">
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
  <script src="{{ asset('assets/js/app.js') }}"></script>

  <!-- Invoice Detail Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const invoiceId = window.location.pathname.split('/').pop();
      loadInvoiceDetail(invoiceId);
    });

    function loadInvoiceDetail(id) {
      const token = localStorage.getItem('token');
      const API_INVOICE = `http://127.0.0.1:8000/api/invoice/${id}`;

      fetch(API_INVOICE, {
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
            throw new Error('Gagal memuat data invoice');
          }
          return res.json();
        })
        .then(data => {
          console.log('Invoice Data:', data);
          renderInvoiceDetail(data);
        })
        .catch(err => {
          console.error('Error:', err);
          document.getElementById('loading-state').innerHTML = `
              <div class="alert alert-danger">
                <i class="mdi mdi-alert-circle-outline me-2"></i>
                Gagal memuat data invoice!
              </div>
            `;
        });
    }

    function renderInvoiceDetail(data) {
      // Hide loading
      document.getElementById('loading-state').style.display = 'none';
      document.getElementById('invoice-content').style.display = 'block';
      document.getElementById('ttd-section').style.display = 'block';

      // Populate header info
      document.getElementById('nomor-invoice').textContent = data.nomor_invoice || '-';
      document.getElementById('tanggal-invoice').textContent = formatDate(data.tanggal_invoice) || '-';
      document.getElementById('nama-perusahaan').textContent = data.nama_perusahaan || data.nama_penerima || '-';

      // Set penandatangan and dynamic signature image
      const penandatangan = data.penandatangan || 'Dewi Sulistiowati';
      document.getElementById('penandatangan').textContent = penandatangan;

      // Determine signature image based on penandatangan name
      const ttdImage = document.getElementById('ttd-image-invoice');
      if (penandatangan.toLowerCase().includes('dewi')) {
        ttdImage.src = '/assets/images/ttdDewi.png';
      } else {
        ttdImage.src = '/assets/images/ttdHeri.png';
      }

      // Populate items - check multiple possible field names
      const tbody = document.getElementById('items-tbody');
      tbody.innerHTML = '';

      let grandTotal = 0;

      // Try different possible field names for items
      const itemsData = data.items || data.detail_barang || data.invoice_items || data.barang || [];

      console.log('Items data:', itemsData);

      if (itemsData && itemsData.length > 0) {
        itemsData.forEach((item, index) => {
          const harga = item.harga_satuan || item.harga || item.price || 0;
          const qty = item.qty || item.jumlah || item.quantity || 0;
          const subtotal = item.subtotal || item.total || (harga * qty) || 0;
          grandTotal += parseInt(subtotal);
          const row = `
              <tr>
                <td class="col-desc">${item.nama_barang || item.nama || item.name || '-'}</td>
                <td class="col-qty">${qty || '-'}</td>
                <td class="col-price">Rp. ${formatNumber(harga)},-</td>
                <td class="col-total">Rp. ${formatNumber(subtotal)},-</td>
              </tr>
            `;
          tbody.innerHTML += row;
        });
      } else {
        // Show message if no items found
        tbody.innerHTML = `
          <tr>
            <td colspan="4" class="text-center text-muted" style="padding: 20px;">
              <em>Data items tidak tersedia</em>
            </td>
          </tr>
        `;
      }

      // Add ongkir if exists
      if (data.estimasi_ongkir && data.estimasi_ongkir > 0) {
        grandTotal += parseInt(data.estimasi_ongkir);
        tbody.innerHTML += `
            <tr>
              <td class="col-desc">Estimasi Ongkir</td>
              <td class="col-qty">${data.berat_barang || '-'}Kg</td>
              <td class="col-price">-</td>
              <td class="col-total">RP. ${formatNumber(data.estimasi_ongkir)},-</td>
            </tr>
          `;
      }

      // Set total pembayaran - prefer API value if items are empty
      const totalFromAPI = data.total_tagihan || data.total_pembayaran || data.total || 0;
      const totalToShow = grandTotal > 0 ? grandTotal : parseInt(totalFromAPI);
      document.getElementById('total-pembayaran').textContent = `Rp. ${formatNumber(totalToShow)},-`;
    }

    function formatNumber(num) {
      return Number(num).toLocaleString('id-ID');
    }

    function formatDate(dateString) {
      if (!dateString) return '-';
      const date = new Date(dateString);
      const day = date.getDate().toString().padStart(2, '0');
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const year = date.getFullYear();
      return `${day}/${month}/${year}`;
    }
  </script>
</body>

</html>