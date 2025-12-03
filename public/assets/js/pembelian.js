document.addEventListener("DOMContentLoaded", function () {
    // loadPembelian(); // Removed auto-call to allow pages to define their own loading logic

    // Initial load for modal if needed
    const modal = document.getElementById('inputPembelianModal');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function () {
            // Only set date and generate order number if adding new (not editing)
            const editId = document.getElementById('editPembelianId').value;
            if (!editId) {
                if (!document.getElementById('tanggalPembelian').value) {
                    const today = new Date().toISOString().split('T')[0];
                    document.getElementById('tanggalPembelian').value = today;
                }
                generateNoOrder();
            }
            loadBarangOptions();
        });

        // Reset form when modal is closed
        modal.addEventListener('hidden.bs.modal', function () {
            resetForm();
        });
    }

    // Event delegation for dynamic items
    const containerBarang = document.getElementById('containerBarang');
    if (containerBarang) {
        containerBarang.addEventListener('change', function (e) {
            if (e.target.classList.contains('select-barang')) {
                updateHargaBarang(e.target);
            }
        });
        containerBarang.addEventListener('input', function (e) {
            if (e.target.classList.contains('jumlah-barang')) {
                hitungTotalItem(e.target);
            }
        });
    }

    // Add item button
    const btnTambah = document.getElementById('btnTambahBarang');
    if (btnTambah) {
        btnTambah.addEventListener('click', tambahItemBaru);
    }
});

const API_URL = "http://127.0.0.1:8000/api/pembelians";
const API_STOK_URL = "http://127.0.0.1:8000/api/stoks";
let allPembelianData = [];
let baseData = []; // Data from API after status exclude/include
let filteredData = []; // Data after search & time filter
let activeTimeFilter = 'Semua Waktu';
let itemCounter = 1;

// Pagination State
let currentPage = 1;
const itemsPerPage = 10;

function getToken() {
    const token = localStorage.getItem("token");
    if (!token) console.error("Token tidak ditemukan!");
    return token;
}

// Load semua data pembelian
function loadPembelian(status = null, excludeStatus = null) {
    const token = getToken();
    if (!token) return;

    let url = API_URL;
    if (status) {
        url += `?status=${status}`;
    }

    fetch(url, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal memuat data pembelian");
            }
            return res.json();
        })
        .then(data => {
            // Store full data for order number generation BEFORE filtering
            allPembelianData = [...data];

            // Filter excludeStatus if provided
            if (excludeStatus) {
                data = data.filter(item => item.status_pembayaran !== excludeStatus);
            }

            // Sort by no_order ascending
            data.sort((a, b) => a.no_order.localeCompare(b.no_order));

            baseData = data; // Store base data for filtering
            applyFilters(); // Apply current filters (time & search)
        })
        .catch(err => {
            console.error("Error:", err);
            const body = document.getElementById("stok-table-body");
            if (body) body.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Gagal memuat data pembelian!</td></tr>`;
        });
}

// Set Time Filter
function setFilter(period) {
    activeTimeFilter = period;
    const filterLabel = document.getElementById('selectedFilter');
    if (filterLabel) {
        filterLabel.textContent = period;
    }
    applyFilters();
}

// Search Transaction (Wrapper for applyFilters)
function searchTransaction() {
    applyFilters();
}

// Centralized Filter Logic
function applyFilters() {
    if (!baseData) return;

    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    const today = new Date();

    filteredData = baseData.filter(item => {
        const itemDate = new Date(item.tgl_transaksi);

        // 1. Time Filter
        let timeMatch = true;
        if (activeTimeFilter === 'Hari Ini') {
            timeMatch = itemDate.toDateString() === today.toDateString();
        } else if (activeTimeFilter === 'Minggu Ini') {
            // Calculate start of week (Monday) and end of week (Sunday)
            const currentDay = today.getDay(); // 0 (Sun) - 6 (Sat)
            const diffToMon = currentDay === 0 ? 6 : currentDay - 1; // Days to subtract to get Monday

            const startOfWeek = new Date(today);
            startOfWeek.setDate(today.getDate() - diffToMon);
            startOfWeek.setHours(0, 0, 0, 0);

            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            endOfWeek.setHours(23, 59, 59, 999);

            // Reset itemDate time to compare dates properly or keep as is if strict
            // itemDate is likely YYYY-MM-DD from server, so it defaults to 00:00:00 UTC or Local
            // Let's ensure we compare correctly. 
            // Assuming tgl_transaksi is YYYY-MM-DD.
            const d = new Date(itemDate);
            d.setHours(0, 0, 0, 0);

            // Adjust start/end to be safe
            const s = new Date(startOfWeek); s.setHours(0, 0, 0, 0);
            const e = new Date(endOfWeek); e.setHours(23, 59, 59, 999);

            timeMatch = d >= s && d <= e;
        } else if (activeTimeFilter === 'Bulan Ini') {
            timeMatch = itemDate.getMonth() === today.getMonth() && itemDate.getFullYear() === today.getFullYear();
        }

        // 2. Search Filter
        const noOrder = item.no_order ? item.no_order.toLowerCase() : '';
        const nama = item.penerima_nama ? item.penerima_nama.toLowerCase() : '';
        const searchMatch = noOrder.includes(searchTerm) || nama.includes(searchTerm);

        return timeMatch && searchMatch;
    });

    // Reset to page 1 when filters change
    currentPage = 1;
    renderPagination();
    renderPageData();
}

// Render Pagination Controls
function renderPagination() {
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const paginationList = document.getElementById('paginationList');
    const paginationInfo = document.getElementById('paginationInfo');

    if (!paginationList || !paginationInfo) return;

    // Update Info Text
    const startItem = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
    paginationInfo.textContent = `Menampilkan ${startItem}–${endItem} dari ${totalItems} transaksi`;

    // Generate Pagination Buttons
    let html = '';

    // Prev Button
    html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">‹</a>
             </li>`;

    // Page Numbers
    // Simple logic: show all pages if <= 7, otherwise show with ellipsis (simplified for now)
    // For better UX with many pages, we might need a more complex logic.
    // Let's stick to simple for now as requested "per 10 list aja".

    for (let i = 1; i <= totalPages; i++) {
        // Show first, last, current, and neighbors
        if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                     </li>`;
        } else if (i === currentPage - 2 || i === currentPage + 2) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }

    // Next Button
    html += `<li class="page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">›</a>
             </li>`;

    paginationList.innerHTML = html;
}

// Change Page
function changePage(page) {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;

    currentPage = page;
    renderPagination();
    renderPageData();
}

// Render Data for Current Page
function renderPageData() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = filteredData.slice(startIndex, endIndex);

    // Pass the startIndex to renderPembelian so it can number rows correctly
    renderPembelian(pageData, startIndex);
}

// Render data pembelian ke tabel
function renderPembelian(data, startIndex = 0) {
    const body = document.getElementById("stok-table-body");
    if (!body) return;

    body.innerHTML = "";

    if (!data || data.length === 0) {
        body.innerHTML = `<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada data pembelian.</td></tr>`;
        return;
    }

    data.forEach((item, index) => {
        // Format status pembayaran
        let badgePembayaran = "";
        switch (item.status_pembayaran) {
            case 'lunas':
                badgePembayaran = `<span class="badge bg-success-subtle text-success">Lunas</span>`;
                break;
            case 'cicilan':
                badgePembayaran = `<span class="badge bg-warning-subtle text-warning">Cicilan</span>`;
                break;
            case 'belum_lunas':
                badgePembayaran = `<span class="badge bg-danger-subtle text-danger">Belum Lunas</span>`;
                break;
        }

        // Format tanggal
        const tanggal = new Date(item.tgl_transaksi).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });

        body.innerHTML += `
            <tr>
                <td class="text-center fw-semibold">${startIndex + index + 1}</td>
                <td>
                    <h6 class="fw-semibold mb-1 text-dark">${item.no_order}</h6>
                </td>
                <td class="text-center">${tanggal}</td>
                <td>
                    <h6 class="fw-semibold mb-1">${item.penerima_nama}</h6>
                </td>
                <td class="text-center fw-semibold text-primary">
                    Rp ${Number(item.grand_total).toLocaleString("id-ID")}
                </td>
                <td class="text-center">${badgePembayaran}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light border me-1" onclick="detailPembelian(${item.id})" title="Detail">
                        <i class="mdi mdi-eye-outline text-muted"></i>
                    </button>
                    ${!document.title.includes('Riwayat') ? `
                    <button class="btn btn-sm btn-light border me-1" onclick="editPembelian(${item.id})" title="Edit">
                        <i class="mdi mdi-square-edit-outline text-primary"></i>
                    </button>` : ''}
                    <button class="btn btn-sm btn-light border" onclick="deletePembelian(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete-outline text-danger"></i>
                    </button>
                </td>
            </tr>
        `;
    });
}

// Generate nomor order otomatis: TRX-YYYY-XXX
function generateNoOrder() {
    const today = new Date();
    const year = today.getFullYear();
    const prefix = `TRX-${year}-`;

    // Filter orders from current year
    const currentYearOrders = allPembelianData.filter(item => item.no_order && item.no_order.startsWith(prefix));

    let maxSequence = 0;
    currentYearOrders.forEach(item => {
        const parts = item.no_order.split('-');
        if (parts.length === 3) {
            const seq = parseInt(parts[2]);
            if (!isNaN(seq) && seq > maxSequence) {
                maxSequence = seq;
            }
        }
    });

    const nextSequence = (maxSequence + 1).toString().padStart(3, '0');
    const noOrder = `${prefix}${nextSequence}`;

    const inputNoOrder = document.getElementById('noOrder');
    if (inputNoOrder) inputNoOrder.value = noOrder;
}

// Load Barang Options
function loadBarangOptions() {
    const token = getToken();
    if (!token) return;

    fetch(API_STOK_URL, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        .then(res => {
            updateDropdownBarang(res.data);
        })
        .catch(err => console.error("Error loading barang:", err));
}

function updateDropdownBarang(barangList) {
    const dropdowns = document.querySelectorAll('.select-barang');
    dropdowns.forEach(dropdown => {
        // Save current selection
        const currentVal = dropdown.value;

        dropdown.innerHTML = '<option value="">Pilih barang...</option>';
        if (barangList && barangList.length > 0) {
            barangList.forEach(barang => {
                dropdown.innerHTML += `<option value="${barang.id}" data-harga="${barang.harga_jual || barang.harga}">${barang.nama_barang}</option>`;
            });
        }

        // Restore selection if possible
        if (currentVal) dropdown.value = currentVal;
    });
}

// Item Management
function tambahItemBaru() {
    itemCounter++;
    const container = document.getElementById('containerBarang');
    const newItem = document.createElement('div');
    newItem.className = 'item-row';
    newItem.setAttribute('data-item', itemCounter);
    newItem.innerHTML = `
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <div class="item-label">Nama Barang</div>
                <select class="form-select select-barang" required>
                    <option value="">Pilih barang...</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="item-label">Harga Satuan</div>
                <input type="text" class="form-control harga-satuan" placeholder="Rp 0" readonly>
            </div>
            <div class="col-md-2">
                <div class="item-label">Jumlah</div>
                <input type="number" class="form-control jumlah-barang" placeholder="1" min="1" value="1" required>
            </div>
            <div class="col-md-3">
                <div class="item-label">Total</div>
                <input type="text" class="form-control total-item" placeholder="Rp 0" readonly>
            </div>
            <div class="col-md-1 text-center">
                <button type="button" class="btn-remove-item" onclick="hapusItem(this)">
                    <i class="mdi mdi-delete"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
    updateRemoveButtons();
    loadBarangOptions();
}

function hapusItem(button) {
    const item = button.closest('.item-row');
    item.remove();
    hitungTotalKeseluruhan();
    updateRemoveButtons();
}

function updateRemoveButtons() {
    const items = document.querySelectorAll('.item-row');
    items.forEach(item => {
        const btnHapus = item.querySelector('.btn-remove-item');
        if (items.length > 1) {
            btnHapus.style.display = 'flex';
        } else {
            btnHapus.style.display = 'none';
        }
    });
}

// Calculations
function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function updateHargaBarang(select) {
    const row = select.closest('.item-row');
    const selectedOption = select.options[select.selectedIndex];
    const harga = selectedOption.getAttribute('data-harga') || 0;
    const hargaSatuan = row.querySelector('.harga-satuan');
    const jumlah = row.querySelector('.jumlah-barang');
    const totalItem = row.querySelector('.total-item');

    hargaSatuan.value = formatRupiah(parseInt(harga));

    const total = parseInt(harga) * parseInt(jumlah.value || 1);
    totalItem.value = formatRupiah(total);

    hitungTotalKeseluruhan();
}

function hitungTotalItem(input) {
    const row = input.closest('.item-row');
    const select = row.querySelector('.select-barang');
    const selectedOption = select.options[select.selectedIndex];
    const harga = parseInt(selectedOption.getAttribute('data-harga') || 0);
    const jumlah = parseInt(input.value) || 0;
    const totalItem = row.querySelector('.total-item');

    const total = harga * jumlah;
    totalItem.value = formatRupiah(total);

    hitungTotalKeseluruhan();
}

function hitungTotalKeseluruhan() {
    let totalSemua = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const select = row.querySelector('.select-barang');
        if (select && select.selectedIndex >= 0) {
            const selectedOption = select.options[select.selectedIndex];
            const jumlah = parseInt(row.querySelector('.jumlah-barang').value) || 0;
            const harga = parseInt(selectedOption.getAttribute('data-harga') || 0);
            totalSemua += harga * jumlah;
        }
    });
    document.getElementById('totalKeseluruhan').textContent = formatRupiah(totalSemua);
}

// Simpan pembelian baru / Update pembelian
function simpanPesanan() {
    const form = document.getElementById('formPembelian');

    // Validasi form
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const token = getToken();
    if (!token) return;

    // Validasi minimal 1 barang dipilih
    const barangDipilih = document.querySelectorAll('.select-barang');
    let items = [];

    barangDipilih.forEach(select => {
        if (select.value) {
            const row = select.closest('.item-row');
            const selectedOption = select.options[select.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga'));
            const jumlah = parseInt(row.querySelector('.jumlah-barang').value);

            items.push({
                nama_barang: selectedOption.text,
                jumlah: jumlah,
                harga_satuan: harga,
                total_harga: harga * jumlah
            });
        }
    });

    if (items.length === 0) {
        Swal.fire('Error', 'Pilih minimal 1 barang!', 'error');
        return;
    }

    // Hitung grand total
    const grandTotal = items.reduce((sum, item) => sum + item.total_harga, 0);

    // Ambil status
    const statusPembayaran = document.querySelector('input[name="statusPembayaran"]:checked').value;
    const statusPengiriman = document.querySelector('input[name="statusPengiriman"]:checked').value;

    // Cek apakah ini edit atau tambah baru
    const editId = document.getElementById('editPembelianId').value;
    const isEdit = !!editId;

    // Siapkan data untuk backend
    const data = {
        no_order: document.getElementById('noOrder').value,
        penerima_nama: document.getElementById('namaCustomer').value,
        penerima_alamat: document.getElementById('alamatCustomer').value,
        penerima_telepon: document.getElementById('noTelepon').value,
        tgl_transaksi: document.getElementById('tanggalPembelian').value,
        status_pengiriman: statusPengiriman,
        status_pembayaran: statusPembayaran,
        total_cicilan: statusPembayaran === 'cicilan' ? grandTotal : 0,
        sisa_cicilan: statusPembayaran === 'cicilan' ? grandTotal : 0,
        grand_total: grandTotal,
        items: items
    };

    const url = isEdit ? `${API_URL}/${editId}` : API_URL;
    const method = isEdit ? "PUT" : "POST";

    // Kirim ke backend
    fetch(url, {
        method: method,
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal menyimpan pembelian");
            }
            return res.json();
        })
        .then(res => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: res.message || (isEdit ? "Pembelian berhasil diupdate!" : "Pembelian berhasil disimpan!"),
                timer: 1500,
                showConfirmButton: false
            });

            // Tutup modal
            const modalEl = document.getElementById('inputPembelianModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            // Reset form
            resetForm();

            // Reload data
            // We need to know which page we are on to reload correctly
            // But since loadPembelian is global, we can just call it.
            // However, we might want to respect the current filter.
            // For now, just reloading without args might default to all, 
            // but the page specific script should handle the initial load.
            // If we are on kelola-pembelian, we want to exclude lunas.
            // If we are on riwayat-pembelian, we want only lunas.

            // Simple check:
            if (document.title.includes('Riwayat')) {
                loadPembelian('lunas');
            } else {
                loadPembelian(null, 'lunas');
            }
        })
        .catch(err => {
            console.error("Error:", err);
            Swal.fire('Error', 'Gagal menyimpan pembelian!', 'error');
        });
}

// Reset form
function resetForm() {
    document.getElementById('formPembelian').reset();
    document.getElementById('editPembelianId').value = ''; // Clear ID
    document.getElementById('inputPembelianModalLabel').innerHTML = '<i class="mdi mdi-clipboard-text"></i>Input Pembelian'; // Reset Title

    // Reset container barang ke 1 item
    const container = document.getElementById('containerBarang');
    const items = container.querySelectorAll('.item-row');
    items.forEach((item, index) => {
        if (index > 0) {
            item.remove();
        }
    });

    // Reset item pertama
    const firstItem = container.querySelector('.item-row');
    if (firstItem) {
        firstItem.querySelector('.select-barang').value = '';
        firstItem.querySelector('.harga-satuan').value = '';
        firstItem.querySelector('.jumlah-barang').value = '1';
        firstItem.querySelector('.total-item').value = '';
    }

    // Reset total
    document.getElementById('totalKeseluruhan').textContent = 'Rp 0';

    // Reset counter
    itemCounter = 1;

    // Update tombol hapus
    updateRemoveButtons();
}

// Detail pembelian
async function detailPembelian(id) {
    const token = getToken();
    if (!token) return;

    try {
        const response = await fetch(`${API_URL}/${id}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Detail Pembelian:', data);

        // Populate Modal Detail
        document.getElementById('detailNoOrder').textContent = data.no_order;
        document.getElementById('detailTanggal').textContent = new Date(data.tgl_transaksi).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('detailNama').textContent = data.penerima_nama;
        document.getElementById('detailTelepon').textContent = data.penerima_telepon || '-';
        document.getElementById('detailAlamat').textContent = data.penerima_alamat || '-';

        // Status Pengiriman
        const statusPengiriman = data.status_pengiriman || '-';
        document.getElementById('detailStatusPengiriman').textContent = statusPengiriman.charAt(0).toUpperCase() + statusPengiriman.slice(1);

        // Status Badge
        let badgeStatus = '';
        switch (data.status_pembayaran) {
            case 'lunas': badgeStatus = '<span class="badge bg-success-subtle text-success fs-6">Lunas</span>'; break;
            case 'cicilan': badgeStatus = '<span class="badge bg-warning-subtle text-warning fs-6">Cicilan</span>'; break;
            case 'belum_lunas': badgeStatus = '<span class="badge bg-danger-subtle text-danger fs-6">Belum Lunas</span>'; break;
            default: badgeStatus = '<span class="badge bg-secondary">Unknown</span>';
        }
        document.getElementById('detailStatusBadge').innerHTML = badgeStatus;

        // Cicilan Info Logic
        const cicilanContainer = document.getElementById('detailCicilanContainer');
        if (data.status_pembayaran === 'cicilan') {
            cicilanContainer.classList.remove('d-none');
            document.getElementById('detailTotalCicilan').textContent = 'Rp ' + Number(data.total_cicilan).toLocaleString('id-ID');
            document.getElementById('detailSisaCicilan').textContent = 'Rp ' + Number(data.sisa_cicilan).toLocaleString('id-ID');
        } else {
            cicilanContainer.classList.add('d-none');
        }

        // Items
        const itemsBody = document.getElementById('detailItemsBody');
        itemsBody.innerHTML = '';
        data.items.forEach(item => {
            itemsBody.innerHTML += `
                <tr>
                    <td class="ps-3">
                        <div class="fw-semibold">${item.nama_barang}</div>
                    </td>
                    <td class="text-center">${item.jumlah}</td>
                    <td class="text-end">Rp ${Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                    <td class="text-end pe-3 fw-semibold">Rp ${Number(item.total_harga).toLocaleString('id-ID')}</td>
                </tr>
            `;
        });

        // Grand Total
        document.getElementById('detailGrandTotal').textContent = 'Rp ' + Number(data.grand_total).toLocaleString('id-ID');

        // Show Modal
        const modal = new bootstrap.Modal(document.getElementById('detailPembelianModal'));
        modal.show();

        return data;

    } catch (error) {
        console.error('Gagal mengambil detail pembelian:', error);
        Swal.fire('Error', 'Gagal mengambil detail pembelian!', 'error');
    }
}

// Edit pembelian
async function editPembelian(id) {
    const token = getToken();
    if (!token) return;

    try {
        const response = await fetch(`${API_URL}/${id}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

        if (!response.ok) throw new Error("Gagal mengambil data");
        const data = await response.json();

        // Set Hidden ID
        document.getElementById('editPembelianId').value = data.id;
        document.getElementById('inputPembelianModalLabel').innerHTML = '<i class="mdi mdi-pencil"></i> Edit Pembelian';

        // Populate Form Fields
        document.getElementById('noOrder').value = data.no_order;
        document.getElementById('tanggalPembelian').value = data.tgl_transaksi;
        document.getElementById('namaCustomer').value = data.penerima_nama;
        document.getElementById('noTelepon').value = data.penerima_telepon;
        document.getElementById('alamatCustomer').value = data.penerima_alamat;

        // Set Radio Buttons
        const statusPengiriman = document.querySelector(`input[name="statusPengiriman"][value="${data.status_pengiriman}"]`);
        if (statusPengiriman) statusPengiriman.checked = true;

        const statusPembayaran = document.querySelector(`input[name="statusPembayaran"][value="${data.status_pembayaran}"]`);
        if (statusPembayaran) statusPembayaran.checked = true;

        // Populate Items
        // First, clear existing items except the first one
        const container = document.getElementById('containerBarang');
        container.innerHTML = ''; // Clear all
        itemCounter = 0;

        // Fetch stok options first to populate selects
        const stokResponse = await fetch(API_STOK_URL, {
            headers: { "Authorization": "Bearer " + token, "Accept": "application/json" }
        });
        const stokData = await stokResponse.json();
        const barangList = stokData.data;

        // Re-create items
        data.items.forEach((item, index) => {
            tambahItemBaru(); // Adds a new row
            const rows = container.querySelectorAll('.item-row');
            const currentRow = rows[rows.length - 1];

            // Populate Select
            const select = currentRow.querySelector('.select-barang');
            // Re-populate options
            select.innerHTML = '<option value="">Pilih barang...</option>';
            barangList.forEach(b => {
                select.innerHTML += `<option value="${b.id}" data-harga="${b.harga_jual || b.harga}">${b.nama_barang}</option>`;
            });

            // Select the correct item based on name (since we only save name)
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].text === item.nama_barang) {
                    select.selectedIndex = i;
                    break;
                }
            }

            // Populate other fields
            currentRow.querySelector('.jumlah-barang').value = item.jumlah;
            currentRow.querySelector('.harga-satuan').value = formatRupiah(item.harga_satuan);
            currentRow.querySelector('.total-item').value = formatRupiah(item.total_harga);
        });

        hitungTotalKeseluruhan();

        // Show Modal
        const modal = new bootstrap.Modal(document.getElementById('inputPembelianModal'));
        modal.show();

    } catch (error) {
        console.error("Error:", error);
        Swal.fire('Error', 'Gagal memuat data untuk edit', 'error');
    }
}

// Hapus pembelian
function deletePembelian(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data pembelian akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const token = getToken();
            if (!token) return;

            fetch(`${API_URL}/${id}`, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
                .then(async res => {
                    if (!res.ok) throw new Error("Gagal menghapus");
                    return res.json();
                })
                .then(res => {
                    Swal.fire(
                        'Terhapus!',
                        'Data pembelian telah dihapus.',
                        'success'
                    );
                    // Reload based on current page context
                    if (document.title.includes('Riwayat')) {
                        loadPembelian('lunas');
                    } else {
                        loadPembelian(null, 'lunas');
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    Swal.fire('Error', 'Gagal menghapus data!', 'error');
                });
        }
    });
}

// Filter berdasarkan status
function filterByStatus(status) {
    let backendStatus = null;
    switch (status) {
        case 'Lunas':
            backendStatus = 'lunas';
            break;
        case 'Cicilan':
            backendStatus = 'cicilan';
            break;
        case 'Belum Lunas':
            backendStatus = 'belum_lunas';
            break;
    }
    loadPembelian(backendStatus);
}