document.addEventListener("DOMContentLoaded", function () {
    loadInvoice();
    loadPembelianList();
});

const API_INVOICE = "http://127.0.0.1:8000/api/invoice";
const API_PEMBELIAN_LIST = "http://127.0.0.1:8000/api/invoice/pembelian-list";

function getToken() {
    const token = localStorage.getItem("token");
    if (!token) console.error("Token tidak ditemukan!");
    return token;
}

// Store pembelian data for reference
let pembelianData = [];

// Load list of available pembelian for dropdown
function loadPembelianList() {
    const token = getToken();
    if (!token) return;

    fetch(API_PEMBELIAN_LIST, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        .then(data => {
            console.log("Pembelian List:", data);
            pembelianData = data;
            const select = document.getElementById('pembelianId');
            if (select) {
                select.innerHTML = '<option value="">-- Pilih Pembelian --</option>';
                data.forEach(item => {
                    const tanggal = item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID') : '-';
                    const totalItems = item.items ? item.items.length : 0;
                    select.innerHTML += `<option value="${item.id}">${item.nama_supplier || item.nama_penerima || 'Pembelian'} - ${tanggal} (${totalItems} item)</option>`;
                });
            }
        })
        .catch(err => {
            console.error("Error loading pembelian list:", err);
        });
}

// Event listener for pembelian dropdown change
document.addEventListener("DOMContentLoaded", function () {
    const pembelianSelect = document.getElementById('pembelianId');
    if (pembelianSelect) {
        pembelianSelect.addEventListener('change', function () {
            const pembelianId = this.value;
            if (pembelianId) {
                // Find the selected pembelian data
                const selectedPembelian = pembelianData.find(p => p.id == pembelianId);
                if (selectedPembelian && selectedPembelian.items) {
                    autoFillItemsFromPembelian(selectedPembelian);
                }
            }
        });
    }
});

// Auto-fill items from pembelian data
function autoFillItemsFromPembelian(pembelian) {
    const container = document.getElementById('itemContainer');
    const placeholder = document.getElementById('itemPlaceholder');
    const tableContainer = document.getElementById('itemTableContainer');
    const namaPerusahaanInput = document.getElementById('namaPerusahaan');

    if (!container || !pembelian.items || pembelian.items.length === 0) return;

    // Show table, hide placeholder
    if (placeholder) placeholder.style.display = 'none';
    if (tableContainer) tableContainer.style.display = 'block';

    // Auto-fill nama perusahaan from pembelian data
    if (namaPerusahaanInput) {
        const namaPerusahaan = pembelian.nama_supplier || pembelian.nama_penerima || pembelian.nama_perusahaan || '';
        namaPerusahaanInput.value = namaPerusahaan;
        namaPerusahaanInput.setAttribute('readonly', true);
    }

    // Clear existing items
    container.innerHTML = '';

    // Add items from pembelian
    pembelian.items.forEach((item, index) => {
        const harga = item.harga_satuan || item.harga || 0;
        const qty = item.jumlah || item.qty || 1;
        const subtotal = harga * qty;
        const formattedHarga = parseInt(harga).toLocaleString('id-ID');
        const formattedSubtotal = parseInt(subtotal).toLocaleString('id-ID');

        const row = `
            <tr class="item-row">
              <td class="text-center">${index + 1}</td>
              <td><input type="text" class="form-control form-control-sm" name="namaItem[]" value="${item.nama_barang || ''}" readonly></td>
              <td><input type="number" class="form-control form-control-sm qty-input" name="qty[]" value="${qty}" min="1" readonly></td>
              <td><input type="text" class="form-control form-control-sm harga-input" name="hargaSatuan[]" value="${formattedHarga}" readonly></td>
              <td><input type="text" class="form-control form-control-sm subtotal-input" name="subtotal[]" value="${formattedSubtotal}" readonly></td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-secondary" disabled>
                  <i class="mdi mdi-lock"></i>
                </button>
              </td>
            </tr>`;
        container.innerHTML += row;
    });

    // Update totals
    recalculateTotals();

    // Show info that items are from pembelian
    console.log(`Loaded ${pembelian.items.length} items from Pembelian ID: ${pembelian.id}`);
}

// Recalculate totals after auto-fill
function recalculateTotals() {
    let total = 0;
    document.querySelectorAll('.subtotal-input').forEach(input => {
        const value = parseInt(input.value.replace(/\D/g, '')) || 0;
        total += value;
    });

    const subtotalInput = document.getElementById('subtotalInvoice');
    const totalInput = document.getElementById('totalInvoice');

    if (subtotalInput) subtotalInput.value = 'Rp ' + total.toLocaleString('id-ID');
    if (totalInput) totalInput.value = 'Rp ' + total.toLocaleString('id-ID');
}

let latestInvoiceNumber = 0;

function loadInvoice() {
    const token = getToken();
    if (!token) return;

    fetch(API_INVOICE, {
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
                throw new Error("Gagal memuat data Invoice");
            }
            return res.json();
        })
        .then(res => {
            console.log("Response dari API:", res);

            // Cari nomor invoice tertinggi
            if (res && res.length > 0) {
                const numbers = res.map(item => {
                    // Asumsi format: INV/XXX/RNS/YYYY atau XXX/INV-RNS/X/YYYY
                    // Kita coba ambil angka pertama yang ditemukan
                    const match = item.nomor_invoice.match(/(\d+)/);
                    return match ? parseInt(match[0]) : 0;
                });
                latestInvoiceNumber = Math.max(...numbers);
            } else {
                latestInvoiceNumber = 0;
            }

            allInvoiceData = res; // Store for reference in delete modal
            renderInvoice(res);
        })
        .catch(err => {
            console.error("Error:", err);
            const body = document.getElementById("tabelInvoice").getElementsByTagName("tbody")[0];
            body.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Gagal memuat data Invoice!</td></tr>`;
        });
}

function generateNextInvoiceNumber() {
    const nextNumber = latestInvoiceNumber + 1;
    const year = new Date().getFullYear();
    // Format: INV/001/RNS/2025 (sesuai placeholder di blade)
    // Atau format user sebelumnya: 01/INV-RNS/X/2025. Kita ikuti placeholder: INV/004/RNS/2025
    // Tapi user minta otomatis, jadi kita buat standar baru yang rapi.
    // Kita pakai format: INV/XXX/RNS/YYYY
    const paddedNumber = String(nextNumber).padStart(3, '0');
    return `INV/${paddedNumber}/RNS/${year}`;
}

// Event saat modal dibuka
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById('modalTambahInvoice');
    if (modal) {
        modal.addEventListener('show.bs.modal', function () {
            const nextInvoice = generateNextInvoiceNumber();
            document.getElementById('nomorInvoice').value = nextInvoice;
        });
    }
});

function formatTanggalIndonesia(tanggal) {
    if (!tanggal) return "-";

    const bulanIndo = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const date = new Date(tanggal);
    const hari = date.getDate();
    const bulan = bulanIndo[date.getMonth()];
    const tahun = date.getFullYear();

    return `${hari} ${bulan} ${tahun}`;
}

// Pagination variables
let currentPage = 1;
const itemsPerPage = 10;
let filteredInvoiceData = [];

function renderInvoice(data) {
    // Store for pagination
    filteredInvoiceData = data || [];
    currentPage = 1;
    renderPaginatedInvoice();
}

function renderPaginatedInvoice() {
    const body = document.getElementById("tabelInvoice").getElementsByTagName("tbody")[0];
    body.innerHTML = "";

    if (!filteredInvoiceData || filteredInvoiceData.length === 0) {
        body.innerHTML = `<tr><td colspan="6" class="text-center py-3 text-muted">Tidak ada data Invoice.</td></tr>`;
        updatePaginationInfo(0, 0, 0);
        renderPaginationControls(0);
        return;
    }

    // Calculate pagination
    const totalItems = filteredInvoiceData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
    const paginatedData = filteredInvoiceData.slice(startIndex, endIndex);

    // Render paginated data
    let no = startIndex + 1;
    paginatedData.forEach(item => {
        body.innerHTML += `
        <tr>
            <td class="text-center">${no++}</td>
            <td><strong>${item.nomor_invoice || "-"}</strong></td>
            <td class="text-center">${formatTanggalIndonesia(item.tanggal_invoice)}</td>
            <td>${item.nama_perusahaan || "-"}</td>
            <td class="text-center fw-semibold">
                Rp${Number(item.total_tagihan || 0).toLocaleString("id-ID")}
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-sm btn-primary" onclick="printInvoice(${item.id})" title="Print">
                        <i class="mdi mdi-printer text-white"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteInvoice(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete text-white"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    });

    // Update pagination info and controls
    updatePaginationInfo(startIndex + 1, endIndex, totalItems);
    renderPaginationControls(totalPages);
}

function updatePaginationInfo(start, end, total) {
    const info = document.getElementById('paginationInfo');
    if (info) {
        if (total === 0) {
            info.textContent = 'Menampilkan 0 dari 0 invoice';
        } else {
            info.textContent = `Menampilkan ${start}–${end} dari ${total} invoice`;
        }
    }
}

function renderPaginationControls(totalPages) {
    const container = document.getElementById('paginationContainer');
    if (!container) return;

    container.innerHTML = '';

    // Always show pagination even if only 1 page (like SPH)
    const pages = totalPages || 1;

    // Previous button
    container.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">‹</a>
        </li>
    `;

    // Page numbers
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(pages, startPage + maxVisiblePages - 1);

    if (endPage - startPage + 1 < maxVisiblePages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        container.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
            </li>
        `;
    }

    // Next button
    container.innerHTML += `
        <li class="page-item ${currentPage === pages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">›</a>
        </li>
    `;
}

function goToPage(page) {
    const totalPages = Math.ceil(filteredInvoiceData.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderPaginatedInvoice();
}

function getInvoiceDetail(id) {
    window.location.href = `/detail-invoice/${id}`;
}

// Store all invoice data for reference
let allInvoiceData = [];

// Fungsi untuk menampilkan modal konfirmasi hapus Invoice
window.showDeleteInvoiceModal = function (id) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('deleteInvoiceOverlay');
    if (oldModal) oldModal.remove();

    // Find Invoice data for display
    const invoiceData = allInvoiceData.find(item => item.id === id);
    const invoiceName = invoiceData?.nomor_invoice || `ID: ${id}`;

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'deleteInvoiceOverlay';
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', right: '0', bottom: '0',
        background: 'rgba(0,0,0,0.5)', backdropFilter: 'blur(4px)',
        zIndex: '99999', display: 'flex', alignItems: 'center', justifyContent: 'center',
        animation: 'fadeIn 0.2s'
    });

    // Create Modal Content
    const content = document.createElement('div');
    Object.assign(content.style, {
        background: 'white', borderRadius: '16px', padding: '32px',
        maxWidth: '400px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });

    // Warning Icon
    const icon = document.createElement('div');
    icon.innerHTML = '🗑️';
    icon.style.fontSize = '48px';
    icon.style.marginBottom = '16px';

    // Header
    const header = document.createElement('h5');
    header.textContent = 'Hapus Invoice?';
    Object.assign(header.style, {
        margin: '0 0 8px 0', fontSize: '20px', fontWeight: '600',
        color: '#1f2937'
    });

    // Message
    const message = document.createElement('p');
    message.innerHTML = `Anda akan menghapus Invoice:<br><strong style="color:#dc2626;">${invoiceName}</strong><br><br>Tindakan ini tidak dapat dibatalkan.`;
    Object.assign(message.style, {
        margin: '0 0 24px 0', color: '#6b7280', fontSize: '14px', lineHeight: '1.6'
    });

    // Button Container
    const btnContainer = document.createElement('div');
    btnContainer.style.display = 'flex';
    btnContainer.style.gap = '12px';
    btnContainer.style.justifyContent = 'center';

    // Cancel Button
    const btnBatal = document.createElement('button');
    btnBatal.textContent = 'Batal';
    btnBatal.type = 'button';
    Object.assign(btnBatal.style, {
        padding: '12px 24px', border: '1px solid #d1d5db',
        background: 'white', color: '#6b7280', borderRadius: '8px',
        fontSize: '14px', fontWeight: '500', cursor: 'pointer', flex: '1'
    });
    btnBatal.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.remove();
    });

    // Delete Button
    const btnHapus = document.createElement('button');
    btnHapus.textContent = 'Ya, Hapus';
    btnHapus.type = 'button';
    Object.assign(btnHapus.style, {
        padding: '12px 24px', border: 'none',
        background: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
        color: 'white', borderRadius: '8px',
        fontSize: '14px', fontWeight: '600', cursor: 'pointer', flex: '1'
    });
    btnHapus.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.remove();
        executeDeleteInvoice(id);
    });

    // Append elements
    btnContainer.appendChild(btnBatal);
    btnContainer.appendChild(btnHapus);

    content.appendChild(icon);
    content.appendChild(header);
    content.appendChild(message);
    content.appendChild(btnContainer);
    overlay.appendChild(content);

    // Add style for animation
    const style = document.createElement('style');
    style.textContent = '@keyframes fadeIn{from{opacity:0}to{opacity:1}}';
    overlay.appendChild(style);

    // Close on overlay click
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}

// Fungsi untuk eksekusi hapus Invoice
function executeDeleteInvoice(id) {
    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        return;
    }

    fetch(`${API_INVOICE}/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal menghapus Invoice");
            }
            return res.json();
        })
        .then(res => {
            console.log("Invoice berhasil dihapus:", res);
            showInvoiceDeleteSuccessModal("Invoice berhasil dihapus!");
            loadInvoice();
        })
        .catch(err => {
            console.error("Error:", err);
            showInvoiceDeleteErrorModal("Gagal menghapus Invoice!");
        });
}

// Fungsi untuk menampilkan modal sukses hapus Invoice
window.showInvoiceDeleteSuccessModal = function (message) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('invoiceDeleteSuccessOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'invoiceDeleteSuccessOverlay';
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', right: '0', bottom: '0',
        background: 'rgba(0,0,0,0.5)', backdropFilter: 'blur(4px)',
        zIndex: '99999', display: 'flex', alignItems: 'center', justifyContent: 'center',
        animation: 'fadeIn 0.3s'
    });

    // Create Modal Content
    const content = document.createElement('div');
    Object.assign(content.style, {
        background: 'white', borderRadius: '16px', padding: '32px',
        maxWidth: '400px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });

    // Animated Success Icon (SVG)
    const iconContainer = document.createElement('div');
    iconContainer.innerHTML = `
        <svg class="inv-del-success-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="width: 80px; height: 80px; margin-bottom: 16px;">
            <circle class="inv-del-success-circle" cx="26" cy="26" r="25" fill="none" stroke="#10b981" stroke-width="2"/>
            <path class="inv-del-success-check" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    `;

    // Add CSS animations
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        @keyframes circleAnimInv {
            0% { stroke-dashoffset: 166; transform: rotate(0deg); }
            50% { stroke-dashoffset: 0; transform: rotate(180deg); }
            100% { stroke-dashoffset: 0; transform: rotate(360deg); }
        }
        @keyframes checkAnimInv {
            0% { stroke-dashoffset: 48; }
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scaleInInv {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }
        .inv-del-success-icon {
            animation: scaleInInv 0.5s ease-out;
        }
        .inv-del-success-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: circleAnimInv 0.8s ease-out forwards;
            transform-origin: center;
        }
        .inv-del-success-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: checkAnimInv 0.4s ease-out 0.5s forwards;
        }
    `;
    overlay.appendChild(animationStyle);

    // Header
    const header = document.createElement('h5');
    header.textContent = message;
    Object.assign(header.style, {
        margin: '0 0 24px 0', fontSize: '20px', fontWeight: '600',
        color: '#065f46'
    });

    // OK Button
    const btnOK = document.createElement('button');
    btnOK.textContent = 'OK';
    btnOK.type = 'button';
    Object.assign(btnOK.style, {
        padding: '12px 48px', border: 'none',
        background: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
        color: 'white', borderRadius: '10px',
        fontSize: '15px', fontWeight: '600', cursor: 'pointer'
    });
    btnOK.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.remove();
    });

    // Append elements
    content.appendChild(iconContainer);
    content.appendChild(header);
    content.appendChild(btnOK);
    overlay.appendChild(content);

    // Close on overlay click
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}

// Fungsi untuk menampilkan modal error hapus Invoice
window.showInvoiceDeleteErrorModal = function (message) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('invoiceDeleteErrorOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'invoiceDeleteErrorOverlay';
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', right: '0', bottom: '0',
        background: 'rgba(0,0,0,0.5)', backdropFilter: 'blur(4px)',
        zIndex: '99999', display: 'flex', alignItems: 'center', justifyContent: 'center',
        animation: 'fadeIn 0.2s'
    });

    // Create Modal Content
    const content = document.createElement('div');
    Object.assign(content.style, {
        background: 'white', borderRadius: '16px', padding: '32px',
        maxWidth: '400px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });

    // Error Icon
    const icon = document.createElement('div');
    icon.innerHTML = '❌';
    icon.style.fontSize = '56px';
    icon.style.marginBottom = '16px';

    // Header
    const header = document.createElement('h5');
    header.textContent = message;
    Object.assign(header.style, {
        margin: '0 0 24px 0', fontSize: '20px', fontWeight: '600',
        color: '#dc2626'
    });

    // OK Button
    const btnOK = document.createElement('button');
    btnOK.textContent = 'OK';
    btnOK.type = 'button';
    Object.assign(btnOK.style, {
        padding: '12px 48px', border: 'none',
        background: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
        color: 'white', borderRadius: '10px',
        fontSize: '15px', fontWeight: '600', cursor: 'pointer'
    });
    btnOK.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.remove();
    });

    // Add style for animation
    const style = document.createElement('style');
    style.textContent = '@keyframes fadeIn{from{opacity:0}to{opacity:1}}';
    overlay.appendChild(style);

    // Append elements
    content.appendChild(icon);
    content.appendChild(header);
    content.appendChild(btnOK);
    overlay.appendChild(content);

    // Close on overlay click
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}

// Fungsi wrapper untuk delete Invoice (Global) - memanggil modal
window.deleteInvoice = function (id) {
    showDeleteInvoiceModal(id);
}

// Override submit handler from inline script
document.addEventListener("DOMContentLoaded", function () {
    const btnSimpan = document.getElementById('btnSimpanInvoice');
    if (btnSimpan) {
        btnSimpan.replaceWith(btnSimpan.cloneNode(true));
        document.getElementById('btnSimpanInvoice').addEventListener('click', submitFormInvoice);
    }
});

function submitFormInvoice() {
    const form = document.getElementById('formInvoice');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        return;
    }

    const items = [];
    const rows = document.querySelectorAll('#itemContainer tr');
    rows.forEach(row => {
        const namaInput = row.querySelector('input[name="namaItem[]"]');
        const qtyInput = row.querySelector('input[name="qty[]"]');
        const hargaInput = row.querySelector('.harga-input');
        const subtotalInput = row.querySelector('.subtotal-input');

        if (namaInput && qtyInput && hargaInput) {
            items.push({
                nama_barang: namaInput.value || '',
                qty: qtyInput.value || 0,
                harga_satuan: hargaInput.value?.replace(/\D/g, '') || 0,
                subtotal: subtotalInput?.value?.replace(/\D/g, '') || 0
            });
        }
    });

    // Get pembelian_id from dropdown
    const pembelianIdSelect = document.getElementById('pembelianId');
    const pembelianId = pembelianIdSelect?.value ? parseInt(pembelianIdSelect.value) : null;

    // Build data payload
    const data = {
        tanggal_invoice: document.getElementById('tanggalInvoice')?.value || null,
        nama_penerima: document.getElementById('namaPerusahaan')?.value || '',
        pembelian_id: pembelianId, // Send pembelian_id if selected
        // If pembelian_id is set, backend will use items from Pembelian
        // If not, we send manual items
        items: pembelianId ? [] : items.map(item => ({
            nama_barang: item.nama_barang || '',
            qty: parseInt(item.qty) || 0,
            harga_satuan: parseInt(item.harga_satuan) || 0
        })),
        // Additional fields for display/compatibility
        nomor_invoice: document.getElementById('nomorInvoice')?.value || '',
        nama_perusahaan: document.getElementById('namaPerusahaan')?.value || '',
        penandatangan: document.querySelector('select[name="penandatangan"]')?.value || 'Dewi Sulistiowati',
        berat_barang: parseFloat(document.getElementById('beratBarang')?.value) || 0,
        estimasi_ongkir: parseInt(document.getElementById('estimasiOngkir')?.value?.replace(/\D/g, '')) || 0,
        total_tagihan: parseInt(document.getElementById('totalInvoice')?.value?.replace(/\D/g, '')) || 0
    };

    console.log("Data Invoice to send:", data);

    fetch(API_INVOICE, {
        method: "POST",
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
                throw new Error("Gagal menyimpan Invoice");
            }
            return res.json();
        })
        .then(response => {
            console.log("Invoice berhasil disimpan:", response);

            const modalEl = document.getElementById('modalTambahInvoice');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Show success modal
            const nomorInvoice = response?.data?.nomor_invoice || response?.nomor_invoice || document.getElementById('nomorInvoice').value;
            showInvoiceSuccessModal("Invoice", nomorInvoice);

            loadInvoice();
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal menyimpan Invoice!");
        });
}

// Fungsi untuk menampilkan modal sukses Invoice
window.showInvoiceSuccessModal = function (title, identifier) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('successInvoiceOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'successInvoiceOverlay';
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', right: '0', bottom: '0',
        background: 'rgba(0,0,0,0.5)', backdropFilter: 'blur(4px)',
        zIndex: '99999', display: 'flex', alignItems: 'center', justifyContent: 'center',
        animation: 'fadeIn 0.3s'
    });

    // Create Modal Content
    const content = document.createElement('div');
    Object.assign(content.style, {
        background: 'white', borderRadius: '16px', padding: '32px',
        maxWidth: '420px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });

    // Animated Success Icon (SVG)
    const iconContainer = document.createElement('div');
    iconContainer.innerHTML = `
        <svg class="success-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="width: 80px; height: 80px; margin-bottom: 16px;">
            <circle class="success-checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#10b981" stroke-width="2"/>
            <path class="success-checkmark-check" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    `;

    // Add CSS animations for checkmark
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        @keyframes circleAnimation {
            0% { stroke-dashoffset: 166; transform: rotate(0deg); }
            50% { stroke-dashoffset: 0; transform: rotate(180deg); }
            100% { stroke-dashoffset: 0; transform: rotate(360deg); }
        }
        @keyframes checkAnimation {
            0% { stroke-dashoffset: 48; }
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }
        .success-checkmark {
            animation: scaleIn 0.5s ease-out;
        }
        .success-checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: circleAnimation 0.8s ease-out forwards;
            transform-origin: center;
        }
        .success-checkmark-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: checkAnimation 0.4s ease-out 0.5s forwards;
        }
    `;
    overlay.appendChild(animationStyle);

    // Header
    const header = document.createElement('h5');
    header.textContent = `${title} Berhasil Dibuat!`;
    Object.assign(header.style, {
        margin: '0 0 12px 0', fontSize: '22px', fontWeight: '600',
        color: '#065f46'
    });

    // Invoice Number Display
    const invoiceNumber = document.createElement('div');
    invoiceNumber.innerHTML = `<span style="color:#6b7280;">Nomor Invoice:</span><br><strong style="font-size:18px; color:#1f2937;">${identifier}</strong>`;
    Object.assign(invoiceNumber.style, {
        background: '#f0fdf4', padding: '16px', borderRadius: '12px',
        margin: '16px 0 24px 0', border: '1px solid #bbf7d0'
    });

    // OK Button
    const btnOK = document.createElement('button');
    btnOK.textContent = 'OK, Mengerti';
    btnOK.type = 'button';
    Object.assign(btnOK.style, {
        padding: '14px 32px', border: 'none',
        background: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
        color: 'white', borderRadius: '10px',
        fontSize: '15px', fontWeight: '600', cursor: 'pointer', width: '100%'
    });
    btnOK.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.remove();
    });

    // Append elements
    content.appendChild(iconContainer);
    content.appendChild(header);
    content.appendChild(invoiceNumber);
    content.appendChild(btnOK);
    overlay.appendChild(content);

    // Close on overlay click
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}

window.printInvoice = function (id) {
    window.location.href = '/print-invoice/' + id;
}

// Search function for invoice
function searchInvoice() {
    const searchTerm = document.getElementById('searchInput')?.value?.toLowerCase() || '';

    if (!searchTerm) {
        // Reset to all data
        filteredInvoiceData = allInvoiceData;
    } else {
        // Filter by nomor_invoice or nama_perusahaan
        filteredInvoiceData = allInvoiceData.filter(item => {
            const nomorInvoice = (item.nomor_invoice || '').toLowerCase();
            const namaPerusahaan = (item.nama_perusahaan || '').toLowerCase();
            return nomorInvoice.includes(searchTerm) || namaPerusahaan.includes(searchTerm);
        });
    }

    currentPage = 1;
    renderPaginatedInvoice();
}

// Make searchInvoice globally accessible
window.searchInvoice = searchInvoice;