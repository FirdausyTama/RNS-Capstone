<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SPH | RNS - Ranay Nusantara Sejathera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/head.js"></script>
</head>

<!-- body start -->

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
                            <h4 class="fs-18 fw-semibold m-0">Surat Penawaran Harga</h4>
                        </div>

                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">SPH</li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- container-fluid -->

                <!-- Start Main Widgets -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h5 class="fw-semibold mb-1">Daftar Surat Penawaran Harga</h5>
                                        <p class="text-muted mb-0">Kelola dan pantau seluruh surat penawaran Anda</p>
                                    </div>

                                    <!-- Filter & Search -->
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Filter Waktu -->
                                        <div class="dropdown">
                                            <button class="btn btn-light border dropdown-toggle" type="button"
                                                id="filterWaktu" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-calendar-range me-1"></i>
                                                <span id="selectedFilter">Semua Waktu</span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="filterWaktu">
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Hari Ini')">Hari Ini</a></li>
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Minggu Ini')">Minggu Ini</a></li>
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Bulan Ini')">Bulan Ini</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Semua Waktu')">Semua Waktu</a></li>
                                            </ul>
                                        </div>

                                        <!-- Search -->
                                        <form class="app-search">
                                            <div class="position-relative topbar-search">
                                                <input type="text" class="form-control ps-4" placeholder="Cari SPH..."
                                                    style="min-width: 200px;" id="searchInput" onkeyup="searchSPH()" />
                                                <i
                                                    class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" style="width: 50px;">No</th>
                                                <th>Nomor SPH</th>
                                                <th class="text-center">Tanggal</th>
                                                <th>Nama Perusahaan</th>
                                                <th class="text-center">Nilai Penawaran</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center" style="width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>

                                        <!-- ✅ PENTING: INI YANG DIISI JAVASCRIPT -->
                                        <tbody id="sph-table-body">
                                            <!-- Data dari API akan masuk otomatis di sini -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">Menampilkan 1–3 dari 50 SPH</small>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item"><a class="page-link" href="#">‹</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main Widgets -->
            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>document.write(new Date().getFullYear())</script> - Made with <span
                                class="mdi mdi-heart text-danger"></span> by <a href="#!"
                                class="text-reset fw-semibold">TI UMY 22</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

            <!-- Modal Tambah SPH -->
            <div class="modal fade" id="modalTambahSPH" tabindex="-1" aria-labelledby="modalTambahSPHLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="modalTambahSPHLabel">
                                <i class="mdi mdi-file-document-edit-outline me-2"></i>Tambah Surat Penawaran Harga
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahSPH">

                                <!-- Informasi Surat -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 fw-semibold"><i
                                                class="mdi mdi-information-outline me-2"></i>Informasi Surat</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nomor SPH</label>
                                                <input type="text" class="form-control" name="nomor_sph"
                                                    placeholder="Otomatis dibuat sistem" value="Otomatis dibuat sistem"
                                                    readonly style="background-color: #e9ecef; cursor: not-allowed;">
                                                <small class="text-muted">
                                                    <i class="mdi mdi-information-outline"></i>
                                                    Sistem akan auto-generate: XX/SPH/XRAY/RNS-XX/2025
                                                </small>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tanggal <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal" id="tanggalSPH"
                                                    required>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-information-outline"></i>
                                                    Tanggal tidak boleh di masa lalu
                                                </small>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tempat</label>
                                                <input type="text" class="form-control" name="tempat" value="Banten"
                                                    placeholder="Banten">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Lampiran</label>
                                                <input type="text" class="form-control" name="lampiran"
                                                    placeholder="Contoh: - atau 1 Lembar">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Hal <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="hal"
                                                    value="Penawaran Harga" readonly style="background-color: #e9ecef;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Penerima -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 fw-semibold"><i
                                                class="mdi mdi-account-outline me-2"></i>Informasi Penerima</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Kepada (Jabatan) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="kepada" value="Direktur"
                                                    placeholder="Direktur" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Perusahaan/Instansi <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama_perusahaan"
                                                    placeholder="Contoh: RSUD Tobat Balaraja" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail Penawaran -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-semibold"><i
                                                class="mdi mdi-format-list-bulleted me-2"></i>Detail Penawaran</h6>
                                        <button type="button" class="btn btn-primary btn-sm" id="btnTambahItem">
                                            <i class="mdi mdi-plus"></i> Tambah Barang
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="itemContainer">
                                            <div class="item-row border rounded p-3 mb-3 bg-light">
                                                <div class="row g-2 align-items-end">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Nama Barang <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select select-barang" name="items[0][nama]"
                                                            required>
                                                            <option value="">Pilih barang...</option>
                                                            <option value="Betre Alat" data-harga="1000000">Betre Alat
                                                            </option>
                                                            <option value="Mesin Ronsen" data-harga="40000000">Mesin
                                                                Ronsen</option>
                                                            <option value="Mesin Kursi Gigi" data-harga="300000000">
                                                                Mesin Kursi Gigi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Harga Satuan</label>
                                                        <input type="text" class="form-control harga-satuan"
                                                            name="items[0][harga_display]" placeholder="Rp 0" readonly
                                                            style="background-color: #e9ecef;">
                                                        <input type="hidden" class="harga-satuan-value"
                                                            name="items[0][harga_satuan]">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Jumlah <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control jumlah-barang"
                                                            name="items[0][jumlah]" placeholder="1" min="1" value="1"
                                                            required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Total</label>
                                                        <input type="text" class="form-control total-item"
                                                            name="items[0][total_display]" placeholder="Rp 0" readonly
                                                            style="background-color: #e9ecef;">
                                                        <input type="hidden" class="total-item-value"
                                                            name="items[0][total]">
                                                    </div>
                                                    <div class="col-md-1 text-center">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm btn-hapus-item"
                                                            style="display:none;">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-4">
                                                <div class="card bg-primary text-white">
                                                    <div class="card-body p-3">
                                                        <label class="form-label text-white mb-1">Total
                                                            Keseluruhan</label>
                                                        <h4 class="mb-0" id="totalKeseluruhan">Rp 0</h4>
                                                        <input type="hidden" name="total_keseluruhan"
                                                            id="totalKeseluruhanValue">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Penandatangan -->
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 fw-semibold"><i
                                                class="mdi mdi-pencil-outline me-2"></i>Penandatangan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Nama Penandatangan <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="penandatangan" required>
                                                    <option value="">Pilih penandatangan...</option>
                                                    <option value="Dewi Sulistiowati">Dewi Sulistiowati</option>
                                                    <option value="Heri Pirdaus, S.Tr.Kes Rad (MRI)">Heri Pirdaus,
                                                        S.Tr.Kes Rad (MRI)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="mdi mdi-close"></i> Batal
                            </button>
                            <button type="button" class="btn btn-primary" id="btnSimpanSPH">
                                <i class="mdi mdi-content-save"></i> Simpan SPH
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Button Tambah SPH -->
            <div class="content position-relative">
                <button type="button" class="btn btn-primary rounded-circle shadow-lg"
                    style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; z-index: 999;"
                    data-bs-toggle="modal" data-bs-target="#modalTambahSPH" title="Tambah SPH Baru">
                    <i class="mdi mdi-plus fs-3 text-white"></i>
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

    <!-- App js-->
    <script src="assets/js/app.js"></script>

    <!-- Custom Script untuk SPH -->
    <script>
        // Fungsi untuk set filter waktu
        function setFilter(filterName) {
            document.getElementById('selectedFilter').textContent = filterName;
            console.log('Filter dipilih:', filterName);
            // Untuk integrasi dengan backend, kirim request AJAX
        }

        // searchSPH function is now in surat-penawaran.js

        $(document).ready(function () {
            let itemCounter = 1;

            // Format Rupiah
            function formatRupiah(angka) {
                return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
            }

            // Event delegation untuk select barang
            $(document).on('change', '.select-barang', function () {
                updateHargaBarang($(this));
            });

            // Event delegation untuk jumlah barang
            $(document).on('input', '.jumlah-barang', function () {
                hitungTotalItem($(this));
            });

            // Update harga saat pilih barang
            function updateHargaBarang(select) {
                const row = select.closest('.item-row');
                const selectedOption = select.find('option:selected');
                const harga = selectedOption.attr('data-harga') || 0;
                const hargaSatuan = row.find('.harga-satuan');
                const hargaSatuanValue = row.find('.harga-satuan-value');
                const jumlah = row.find('.jumlah-barang');
                const totalItem = row.find('.total-item');
                const totalItemValue = row.find('.total-item-value');

                hargaSatuan.val(formatRupiah(parseInt(harga)));
                hargaSatuanValue.val(harga);

                const total = parseInt(harga) * parseInt(jumlah.val() || 1);
                totalItem.val(formatRupiah(total));
                totalItemValue.val(total);

                hitungTotalKeseluruhan();
            }

            // Fungsi untuk menghitung total per item
            function hitungTotalItem(input) {
                const row = input.closest('.item-row');
                const select = row.find('.select-barang');
                const selectedOption = select.find('option:selected');
                const harga = parseInt(selectedOption.attr('data-harga') || 0);
                const jumlah = parseInt(input.val()) || 0;
                const totalItem = row.find('.total-item');
                const totalItemValue = row.find('.total-item-value');

                const total = harga * jumlah;
                totalItem.val(formatRupiah(total));
                totalItemValue.val(total);

                hitungTotalKeseluruhan();
            }

            // Fungsi untuk menghitung total keseluruhan
            function hitungTotalKeseluruhan() {
                let totalSemua = 0;
                $('.item-row').each(function () {
                    const select = $(this).find('.select-barang');
                    const selectedOption = select.find('option:selected');
                    const jumlah = parseInt($(this).find('.jumlah-barang').val()) || 0;
                    const harga = parseInt(selectedOption.attr('data-harga') || 0);
                    totalSemua += harga * jumlah;
                });
                $('#totalKeseluruhan').text(formatRupiah(totalSemua));
                $('#totalKeseluruhanValue').val(totalSemua);
            }

            // Update tampilan tombol hapus
            function updateRemoveButtons() {
                const items = $('.item-row');
                items.each(function () {
                    const btnHapus = $(this).find('.btn-hapus-item');
                    if (items.length > 1) {
                        btnHapus.show();
                    } else {
                        btnHapus.hide();
                    }
                });
            }

            // Tambah item baru
            $('#btnTambahItem').click(function () {
                itemCounter++;
                const newItem = `
                <div class="item-row border rounded p-3 mb-3 bg-light">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <select class="form-select select-barang" name="items[${itemCounter}][nama]" required>
                                <option value="">Pilih barang...</option>
                                <option value="Betre Alat" data-harga="1000000">Betre Alat</option>
                                <option value="Mesin Ronsen" data-harga="40000000">Mesin Ronsen</option>
                                <option value="Mesin Kursi Gigi" data-harga="300000000">Mesin Kursi Gigi</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" class="form-control harga-satuan" name="items[${itemCounter}][harga_display]" placeholder="Rp 0" readonly style="background-color: #e9ecef;">
                            <input type="hidden" class="harga-satuan-value" name="items[${itemCounter}][harga_satuan]">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" class="form-control jumlah-barang" name="items[${itemCounter}][jumlah]" placeholder="1" min="1" value="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Total</label>
                            <input type="text" class="form-control total-item" name="items[${itemCounter}][total_display]" placeholder="Rp 0" readonly style="background-color: #e9ecef;">
                            <input type="hidden" class="total-item-value" name="items[${itemCounter}][total]">
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-danger btn-sm btn-hapus-item">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
                $('#itemContainer').append(newItem);
                updateRemoveButtons();
            });

            // Hapus item
            $(document).on('click', '.btn-hapus-item', function () {
                if ($('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                    hitungTotalKeseluruhan();
                    updateRemoveButtons();
                } else {
                    alert('Minimal harus ada 1 item!');
                }
            });

            // Simpan SPH
            $('#btnSimpanSPH').click(function () {
                const form = $('#formTambahSPH');
                if (form[0].checkValidity()) {
                    // Validasi tanggal tidak boleh di masa lalu
                    const tanggalSPH = $('input[name="tanggal"]').val();
                    const today = new Date().toISOString().split('T')[0];

                    if (tanggalSPH < today) {
                        alert('Tanggal SPH tidak boleh di masa lalu! Silakan pilih tanggal hari ini atau yang akan datang.');
                        return;
                    }

                    // Validasi minimal 1 barang dipilih
                    let adaBarang = false;
                    $('.select-barang').each(function () {
                        if ($(this).val()) {
                            adaBarang = true;
                        }
                    });

                    if (!adaBarang) {
                        alert('Pilih minimal 1 barang!');
                        return;
                    }

                    // Ambil data form
                    const formData = new FormData(form[0]);

                    // Tampilkan data yang akan disimpan (untuk testing)
                    console.log('Data SPH:');
                    for (let pair of formData.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }

                    // Kirim data ke server via API
                    submitFormSPH(formData);
                } else {
                    form[0].reportValidity();
                }
            });

            // Reset form saat modal ditutup
            $('#modalTambahSPH').on('hidden.bs.modal', function () {
                $('#formTambahSPH')[0].reset();
                // Reset ke 1 item saja
                $('#itemContainer .item-row').not(':first').remove();
                $('#itemContainer .item-row:first .select-barang').val('');
                $('#itemContainer .item-row:first .harga-satuan').val('');
                $('#itemContainer .item-row:first .jumlah-barang').val('1');
                $('#itemContainer .item-row:first .total-item').val('');
                itemCounter = 1;
                $('#totalKeseluruhan').text('Rp 0');
                updateRemoveButtons();
            });

            // Set tanggal hari ini sebagai default dan minimum
            $('#modalTambahSPH').on('shown.bs.modal', function () {
                const today = new Date().toISOString().split('T')[0];
                const tanggalInput = $('input[name="tanggal"]');
                tanggalInput.attr('min', today); // Set tanggal minimum = hari ini
                tanggalInput.val(today); // Set default value = hari ini
            });

        });
    </script>

    <!-- External JS for SPH table rendering -->
    <script src="{{ asset('assets/js/surat-penawaran.js') }}?v={{ time() }}"></script>

</body>

</html>