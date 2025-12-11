// Konfigurasi API (Port 8000 - Backend API terpisah dari Frontend 8001)
const API_SPH = "http://127.0.0.1:8000/api/surat-penawaran";

// Fungsi untuk ambil token dari localStorage
function getToken() {
    return localStorage.getItem("token");
}

// Fungsi untuk ambil status overrides dari localStorage
function getStatusOverrides() {
    const saved = localStorage.getItem("sph_status_overrides");
    return saved ? JSON.parse(saved) : {};
}

// Fungsi untuk simpan status override ke localStorage
function saveStatusOverride(id, status) {
    const overrides = getStatusOverrides();
    overrides[id] = status;
    localStorage.setItem("sph_status_overrides", JSON.stringify(overrides));
}

// Variabel global untuk pagination
let currentPage = 1;
const itemsPerPage = 10;
let allSPHData = [];

// Fungsi utama untuk load data SPH
function loadSPH() {
    const token = getToken();
    if (!token) {
        console.error("Token tidak ditemukan!");
        return;
    }

    fetch(`${API_SPH}?t=${new Date().getTime()}`, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        mode: "cors"
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal memuat data SPH");
            }
            return res.json();
        })
        .then(res => {
            console.log("Data SPH berhasil dimuat:", res);
            allSPHData = res.data || res;

            // Apply localStorage status overrides
            const overrides = getStatusOverrides();
            allSPHData = allSPHData.map(item => {
                if (overrides[item.id]) {
                    item.status = overrides[item.id];
                    console.log(`Applied localStorage override for ID ${item.id}: ${item.status}`);
                }
                return item;
            });

            // Initialize filtered data with all data
            filteredSPHData = [...allSPHData];

            currentPage = 1;
            renderSPH(currentPage);
        })
        .catch(err => {
            console.error("Error:", err);
            const body = document.getElementById("sph-table-body");
            if (body) {
                body.innerHTML = `<tr><td colspan="7" class="text-center py-3 text-danger">Gagal memuat data SPH.</td></tr>`;
            }
        });
}

// Fungsi untuk format tanggal Indonesia
function formatTanggalIndonesia(dateString) {
    const bulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const date = new Date(dateString);
    const day = date.getDate();
    const month = bulan[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
}

// Fungsi untuk render tabel SPH
function renderSPH(page = 1) {
    const body = document.getElementById("sph-table-body");
    if (!body) {
        console.error("Element sph-table-body tidak ditemukan!");
        return;
    }

    body.innerHTML = "";

    // Use filteredSPHData for rendering (supports search)
    const dataToRender = filteredSPHData.length > 0 || document.getElementById('searchInput')?.value
        ? filteredSPHData
        : allSPHData;

    if (!dataToRender || dataToRender.length === 0) {
        body.innerHTML = `<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada data SPH.</td></tr>`;
        renderPagination(0, 1, 0, 0, 0);
        return;
    }

    const totalItems = dataToRender.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = dataToRender.slice(startIndex, endIndex);

    let no = startIndex + 1;

    paginatedData.forEach(item => {
        // Safer number formatting
        const totalRaw = item.total_keseluruhan || 0;
        const total = parseInt(totalRaw.toString().replace(/\D/g, "")) || 0;

        // Current status (case-insensitive)
        const currentStatus = item.status || "Menunggu";

        // Determine colors based on status
        let bgStyle = "";
        let textStyle = "";

        if (currentStatus === "Diterima") {
            bgStyle = "#d1fae5"; // Light Green
            textStyle = "#065f46"; // Dark Green
        } else if (currentStatus === "Ditolak") {
            bgStyle = "#fee2e2"; // Light Red
            textStyle = "#991b1b"; // Dark Red
        } else {
            bgStyle = "#fef3c7"; // Light Yellow (Menunggu)
            textStyle = "#92400e"; // Dark Yellow
        }

        body.innerHTML += `
        <tr>
            <td class="text-center">${no++}</td>
            <td><strong>${item.nomor_sph || "-"}</strong></td>
            <td class="text-center">${formatTanggalIndonesia(item.tanggal)}</td>
            <td>${item.nama_perusahaan || "-"}</td>
            <td class="text-center fw-semibold">
                Rp${total.toLocaleString("id-ID")}
            </td>
            <td class="text-center">
                <select class="form-select form-select-sm status-dropdown" 
                        data-id="${item.id}" 
                        onchange="updateStatusDropdown(this)"
                        style="
                            min-width: 140px; 
                            font-weight: 600; 
                            text-align: center; 
                            border: none; 
                            border-radius: 8px;
                            padding: 8px 12px;
                            background-color: ${bgStyle}; 
                            color: ${textStyle};
                            cursor: pointer;
                            appearance: none; /* Remove default arrow for cleaner look */
                            -webkit-appearance: none;
                        ">
                    <option value="Menunggu" ${currentStatus === 'Menunggu' ? 'selected' : ''} style="background: white; color: black;">⏳ Menunggu</option>
                    <option value="Diterima" ${currentStatus === 'Diterima' ? 'selected' : ''} style="background: white; color: black;">✅ Diterima</option>
                    <option value="Ditolak" ${currentStatus === 'Ditolak' ? 'selected' : ''} style="background: white; color: black;">❌ Ditolak</option>
                </select>
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-sm btn-primary" onclick="printSPH(${item.id})" title="Print">
                        <i class="mdi mdi-printer text-white"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteSPH(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete text-white"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    });

    renderPagination(totalPages, page, startIndex + 1, endIndex > totalItems ? totalItems : endIndex, totalItems);
}

// Fungsi untuk render pagination
function renderPagination(totalPages, currentPageNum, startItem, endItem, totalItems) {
    const paginationInfo = document.querySelector('.d-flex.justify-content-between.align-items-center.mt-3 small');
    const paginationNav = document.querySelector('.d-flex.justify-content-between.align-items-center.mt-3 nav ul');

    if (!paginationInfo || !paginationNav) return;

    if (totalItems === 0) {
        paginationInfo.textContent = 'Tidak ada data SPH';
    } else {
        paginationInfo.textContent = `Menampilkan ${startItem}–${endItem} dari ${totalItems} SPH`;
    }

    paginationNav.innerHTML = '';

    if (totalPages === 0) return;

    const prevDisabled = currentPageNum === 1 ? 'disabled' : '';
    paginationNav.innerHTML += `
        <li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" onclick="changePage(${currentPageNum - 1}); return false;">‹</a>
        </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
        const active = i === currentPageNum ? 'active' : '';
        paginationNav.innerHTML += `
            <li class="page-item ${active}">
                <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
            </li>
        `;
    }

    const nextDisabled = currentPageNum === totalPages ? 'disabled' : '';
    paginationNav.innerHTML += `
        <li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" onclick="changePage(${currentPageNum + 1}); return false;">›</a>
        </li>
    `;
}

// Fungsi untuk chang page
function changePage(page) {
    const totalPages = Math.ceil(filteredSPHData.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderSPH(currentPage);
    document.getElementById('sph-table-body').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Variabel untuk menyimpan data yang sudah difilter
let filteredSPHData = [];

// Fungsi untuk pencarian SPH
function searchSPH() {
    const searchTerm = document.getElementById('searchInput')?.value?.toLowerCase() || '';

    if (!searchTerm) {
        // Reset ke semua data
        filteredSPHData = allSPHData;
    } else {
        // Filter berdasarkan nomor_sph atau nama_perusahaan
        filteredSPHData = allSPHData.filter(item => {
            const nomorSph = (item.nomor_sph || '').toLowerCase();
            const namaPerusahaan = (item.nama_perusahaan || '').toLowerCase();
            return nomorSph.includes(searchTerm) || namaPerusahaan.includes(searchTerm);
        });
    }

    currentPage = 1;
    renderSPH(currentPage);
}

// Make searchSPH globally accessible
window.searchSPH = searchSPH;

// Fungsi untuk menampilkan modal konfirmasi hapus
window.showDeleteConfirmModal = function (id) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('deleteConfirmOverlay');
    if (oldModal) oldModal.remove();

    // Find SPH data for display
    const sphData = allSPHData.find(item => item.id === id);
    const sphName = sphData?.nomor_sph || `ID: ${id}`;

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'deleteConfirmOverlay';
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
    header.textContent = 'Hapus Surat Penawaran?';
    Object.assign(header.style, {
        margin: '0 0 8px 0', fontSize: '20px', fontWeight: '600',
        color: '#1f2937'
    });

    // Message
    const message = document.createElement('p');
    message.innerHTML = `Anda akan menghapus SPH:<br><strong style="color:#dc2626;">${sphName}</strong><br><br>Tindakan ini tidak dapat dibatalkan.`;
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
        executeDeleteSPH(id);
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

// Fungsi untuk eksekusi hapus SPH (dipanggil dari modal)
function executeDeleteSPH(id) {
    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        return;
    }

    fetch(`${API_SPH}/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        mode: "cors"
    })
        .then(async res => {
            if (!res.ok) throw new Error("Gagal menghapus SPH");
            return res.json();
        })
        .then(() => {
            showDeleteSuccessModal("SPH berhasil dihapus!");
            loadSPH();
        })
        .catch(err => {
            console.error("DELETE ERROR:", err);
            showDeleteErrorModal("Gagal menghapus SPH!");
        });
}

// Fungsi untuk menampilkan modal sukses hapus
window.showDeleteSuccessModal = function (message) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('deleteSuccessOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'deleteSuccessOverlay';
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
        <svg class="delete-success-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="width: 80px; height: 80px; margin-bottom: 16px;">
            <circle class="delete-success-circle" cx="26" cy="26" r="25" fill="none" stroke="#10b981" stroke-width="2"/>
            <path class="delete-success-check" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    `;

    // Add CSS animations
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        @keyframes circleAnim {
            0% { stroke-dashoffset: 166; transform: rotate(0deg); }
            50% { stroke-dashoffset: 0; transform: rotate(180deg); }
            100% { stroke-dashoffset: 0; transform: rotate(360deg); }
        }
        @keyframes checkAnim {
            0% { stroke-dashoffset: 48; }
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }
        .delete-success-icon {
            animation: scaleIn 0.5s ease-out;
        }
        .delete-success-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: circleAnim 0.8s ease-out forwards;
            transform-origin: center;
        }
        .delete-success-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: checkAnim 0.4s ease-out 0.5s forwards;
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

// Fungsi untuk menampilkan modal error hapus
window.showDeleteErrorModal = function (message) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('deleteErrorOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'deleteErrorOverlay';
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

// Fungsi wrapper untuk delete SPH (Global) - memanggil modal
window.deleteSPH = function (id) {
    showDeleteConfirmModal(id);
}

// Fungsi untuk print SPH (Global)
window.printSPH = function (id) {
    window.location.href = '/print-sph/' + id;
}

// Load SPH saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    loadSPH();

    // Event Delegation untuk tombol-tombol di tabel
    const tableBody = document.getElementById("sph-table-body");
    if (tableBody) {
        tableBody.addEventListener("click", function (e) {
            const target = e.target.closest("button");
            if (!target) return;

            // Cari ID dari data attribute atau dari onclick
            const row = target.closest("tr");
            const deleteBtn = target.closest(".btn-danger");
            const printBtn = target.closest(".btn-primary");

            if (deleteBtn) {
                // Ambil ID dari onclick attribute
                const onclickAttr = deleteBtn.getAttribute("onclick");
                const match = onclickAttr?.match(/deleteSPH\((\d+)\)/);
                if (match) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.deleteSPH(parseInt(match[1]));
                }
            }

            if (printBtn) {
                const onclickAttr = printBtn.getAttribute("onclick");
                const match = onclickAttr?.match(/printSPH\((\d+)\)/);
                if (match) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.printSPH(parseInt(match[1]));
                }
            }
        });
    }
});

// ========== EDIT STATUS SPH (DOM API VERSION - NO ICONS) ==========
let currentEditSPHId = null;

// Make functions globally available
window.showEditStatusModal = function (id, currentStatus) {
    currentEditSPHId = id;
    console.log("Opening modal for SPH ID:", id);

    // Hapus modal lama jika ada
    const oldModal = document.getElementById('customModalOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'customModalOverlay';
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
        maxWidth: '400px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)'
    });

    // Header
    const header = document.createElement('h5');
    header.textContent = '📝 Ubah Status SPH';
    Object.assign(header.style, {
        margin: '0 0 8px 0', fontSize: '24px', fontWeight: '600',
        color: '#1f2937', textAlign: 'center'
    });

    // Status Text
    const statusP = document.createElement('p');
    statusP.innerHTML = `Status saat ini: <strong style="color:#2563eb;">${currentStatus}</strong>`;
    Object.assign(statusP.style, {
        margin: '0 0 24px 0', textAlign: 'center', color: '#6b7280', fontSize: '14px'
    });

    // Button Container
    const btnContainer = document.createElement('div');
    btnContainer.style.display = 'grid';
    btnContainer.style.gap = '12px';

    // Helper to create buttons (NO ICONS)
    function createBtn(text, color1, color2, borderColor, textColor, statusValue) {
        const btn = document.createElement('button');
        btn.type = 'button'; // Explicit type
        Object.assign(btn.style, {
            padding: '16px 24px', border: `2px solid ${borderColor}`,
            background: `linear-gradient(135deg, ${color1} 0%, ${color2} 100%)`,
            color: textColor, borderRadius: '12px', fontSize: '16px',
            fontWeight: '600', cursor: 'pointer', display: 'block',
            width: '100%', textAlign: 'center'
        });

        btn.textContent = text;

        // Add Event Listener directly
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log(`Button ${text} clicked`);
            window.updateStatusFromModal(statusValue);
        });

        return btn;
    }

    // Create Buttons (Removed Icons)
    const btnMenunggu = createBtn('Menunggu', '#fef3c7', '#fde68a', '#fbbf24', '#92400e', 'Menunggu');
    const btnDiterima = createBtn('Diterima', '#d1fae5', '#a7f3d0', '#10b981', '#065f46', 'Diterima');
    const btnDitolak = createBtn('Ditolak', '#fee2e2', '#fecaca', '#ef4444', '#991b1b', 'Ditolak');

    // Cancel Button
    const btnBatal = document.createElement('button');
    btnBatal.textContent = 'Batal';
    btnBatal.type = 'button';
    Object.assign(btnBatal.style, {
        padding: '12px 24px', border: '1px solid #d1d5db',
        background: 'white', color: '#6b7280', borderRadius: '12px',
        fontSize: '14px', fontWeight: '500', cursor: 'pointer', marginTop: '8px',
        width: '100%'
    });
    btnBatal.addEventListener('click', function (e) {
        e.preventDefault();
        window.closeCustomModal();
    });

    // Append everything
    btnContainer.appendChild(btnMenunggu);
    btnContainer.appendChild(btnDiterima);
    btnContainer.appendChild(btnDitolak);
    btnContainer.appendChild(btnBatal);

    content.appendChild(header);
    content.appendChild(statusP);
    content.appendChild(btnContainer);
    overlay.appendChild(content);

    // Add style for animation
    const style = document.createElement('style');
    style.textContent = '@keyframes fadeIn{from{opacity:0}to{opacity:1}}';
    overlay.appendChild(style);

    document.body.appendChild(overlay);
}

window.closeCustomModal = function () {
    const modal = document.getElementById('customModalOverlay');
    if (modal) modal.remove();
    currentEditSPHId = null;
}

// Fungsi untuk update status via dropdown (Connected to Backend API)
window.updateStatusDropdown = function (selectElement) {
    const id = parseInt(selectElement.dataset.id);
    const newStatus = selectElement.value;
    const originalStatus = allSPHData.find(item => item.id === id)?.status || "Menunggu";

    console.log("UPDATE STATUS (API):", { id, status: newStatus, url: `${API_SPH}/${id}` });

    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        selectElement.value = originalStatus; // Revert
        return;
    }

    // Show loading state
    selectElement.disabled = true;
    selectElement.style.opacity = "0.6";

    // Send PUT request to backend
    fetch(`${API_SPH}/${id}`, {
        method: "PUT",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        mode: "cors",
        body: JSON.stringify({ status: newStatus })
    })
        .then(async res => {
            const text = await res.text();
            console.log("RESPONSE STATUS:", res.status);
            console.log("RESPONSE RAW:", text);

            if (!res.ok) {
                throw new Error(text || "Gagal mengupdate status SPH");
            }
            return text ? JSON.parse(text) : {};
        })
        .then(() => {
            // Update local data
            const sphIndex = allSPHData.findIndex(item => item.id === id);
            if (sphIndex !== -1) {
                allSPHData[sphIndex].status = newStatus;
            }

            // Update Colors Dynamically
            if (newStatus === "Diterima") {
                selectElement.style.backgroundColor = "#d1fae5";
                selectElement.style.color = "#065f46";
            } else if (newStatus === "Ditolak") {
                selectElement.style.backgroundColor = "#fee2e2";
                selectElement.style.color = "#991b1b";
            } else {
                selectElement.style.backgroundColor = "#fef3c7";
                selectElement.style.color = "#92400e";
            }

            console.log("Status berhasil diupdate ke database:", { id, status: newStatus });
        })
        .catch(err => {
            console.error("FETCH ERROR:", err);
            alert("❌ Gagal mengupdate status: " + err.message);
            // Revert to original status
            selectElement.value = originalStatus;
        })
        .finally(() => {
            // Remove loading state
            selectElement.disabled = false;
            selectElement.style.opacity = "1";
        });
}

// Fungsi untuk submit form SPH (Tambah Data)
window.submitFormSPH = function (formData) {
    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        return;
    }

    // Ambil data dari form menggunakan selector name karena ID tidak lengkap di blade
    const tanggal = document.querySelector('[name="tanggal"]').value;
    const tempat = document.querySelector('[name="tempat"]').value;
    const lampiran = document.querySelector('[name="lampiran"]').value;
    const hal = document.querySelector('[name="hal"]').value;
    const jabatan_tujuan = document.querySelector('[name="kepada"]').value; // Di blade name="kepada"
    const nama_perusahaan = document.querySelector('[name="nama_perusahaan"]').value;
    const penandatangan = document.querySelector('[name="penandatangan"]').value;

    // Ambil total keseluruhan dari hidden input yang diupdate oleh jQuery
    const totalKeseluruhanInput = document.getElementById('totalKeseluruhanValue');
    const total_keseluruhan = totalKeseluruhanInput ? parseInt(totalKeseluruhanInput.value) : 0;

    // Ambil item barang dari container yang benar (#itemContainer .item-row)
    const items = [];
    document.querySelectorAll("#itemContainer .item-row").forEach((row) => {
        const namaSelect = row.querySelector(".select-barang");
        const hargaInput = row.querySelector(".harga-satuan-value");
        const jumlahInput = row.querySelector(".jumlah-barang");
        const totalInput = row.querySelector(".total-item-value");

        const nama = namaSelect ? namaSelect.value : "";
        const jumlah = jumlahInput ? parseInt(jumlahInput.value) || 0 : 0;

        // Get harga from hidden input, or fallback to data-harga attribute
        let harga = hargaInput ? parseInt(hargaInput.value) || 0 : 0;
        if (harga === 0 && namaSelect) {
            const selectedOption = namaSelect.options[namaSelect.selectedIndex];
            harga = selectedOption ? parseInt(selectedOption.getAttribute('data-harga')) || 0 : 0;
        }

        // Get total from hidden input, or calculate it
        let total = totalInput ? parseInt(totalInput.value) || 0 : 0;
        if (total === 0) {
            total = harga * jumlah;
        }

        console.log("Item debug:", { nama, harga, jumlah, total, hargaInputValue: hargaInput?.value, totalInputValue: totalInput?.value });

        if (nama && jumlah > 0) {
            items.push({
                nama: nama,
                harga_satuan: harga,
                jumlah: jumlah,
                total: total
            });
        }
    });

    if (items.length === 0) {
        alert("Harap tambahkan minimal satu barang!");
        return;
    }

    const payload = {
        tanggal: tanggal,
        tempat: tempat,
        lampiran: lampiran,
        hal: hal,
        jabatan_tujuan: jabatan_tujuan,
        nama_perusahaan: nama_perusahaan,
        penandatangan: penandatangan,
        detail_barang: items,
        total_keseluruhan: total_keseluruhan, // Wajib sesuai API docs
        status: "Menunggu" // Default status
    };

    console.log("Sending Payload:", payload);

    fetch(API_SPH, {
        method: "POST",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        mode: "cors",
        body: JSON.stringify(payload)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("API Error Response:", text);
                throw new Error(text);
            }
            return res.json();
        })
        .then((response) => {
            // Tutup modal form (Bootstrap)
            const modalEl = document.getElementById('modalTambahSPH');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Reset form via jQuery trigger to handle custom resets
            $('#modalTambahSPH').trigger('hidden.bs.modal');

            // Show success modal
            const nomorSPH = response?.data?.nomor_sph || response?.nomor_sph || "Baru";
            showSuccessModal("Surat Penawaran Harga", nomorSPH);

            loadSPH();
        })
        .catch(err => {
            console.error(err);
            alert("Gagal menambahkan SPH: " + err.message);
        });
}

// Fungsi untuk menampilkan modal sukses
window.showSuccessModal = function (title, identifier) {
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('successModalOverlay');
    if (oldModal) oldModal.remove();

    // Create Overlay
    const overlay = document.createElement('div');
    overlay.id = 'successModalOverlay';
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

    // SPH Number Display
    const sphNumber = document.createElement('div');
    sphNumber.innerHTML = `<span style="color:#6b7280;">Nomor Surat:</span><br><strong style="font-size:18px; color:#1f2937;">${identifier}</strong>`;
    Object.assign(sphNumber.style, {
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
    content.appendChild(sphNumber);
    content.appendChild(btnOK);
    overlay.appendChild(content);

    // Close on overlay click
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}