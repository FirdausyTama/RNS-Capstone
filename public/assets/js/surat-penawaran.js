const API_SPH = "http://127.0.0.1:8000/api/surat-penawaran";

function getToken() {
    return localStorage.getItem("token");
}


function getToken() {
    return localStorage.getItem("token");
}



let currentPage = 1;
const itemsPerPage = 10;
let allSPHData = [];


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




            // Sort by ID descending (latest first)
            if (Array.isArray(allSPHData)) {
                allSPHData.sort((a, b) => b.id - a.id);
            }

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


function renderSPH(page = 1) {
    const body = document.getElementById("sph-table-body");
    if (!body) {
        console.error("Element sph-table-body tidak ditemukan!");
        return;
    }

    body.innerHTML = "";


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

        const totalRaw = item.total_keseluruhan || 0;
        const total = parseInt(totalRaw.toString().replace(/\D/g, "")) || 0;


        const currentStatus = item.status || "Menunggu";


        let bgStyle = "";
        let textStyle = "";

        if (currentStatus === "Diterima") {
            bgStyle = "#d1fae5";
            textStyle = "#065f46";
        } else if (currentStatus === "Ditolak") {
            bgStyle = "#fee2e2";
            textStyle = "#991b1b";
        } else {
            bgStyle = "#fef3c7";
            textStyle = "#92400e";
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
                    <button class="btn btn-sm btn-light border" onclick="printSPH(${item.id})" title="Print">
                        <i class="mdi mdi-printer text-dark"></i>
                    </button>
                    <button class="btn btn-sm btn-light border" onclick="deleteSPH(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete text-danger"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    });

    renderPagination(totalPages, page, startIndex + 1, endIndex > totalItems ? totalItems : endIndex, totalItems);
}


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


function changePage(page) {
    const totalPages = Math.ceil(filteredSPHData.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderSPH(currentPage);
    document.getElementById('sph-table-body').scrollIntoView({ behavior: 'smooth', block: 'start' });
}


// Filter State
let activeTimeFilter = 'Semua Waktu';
let activeStatusFilter = 'Semua Status';
let filteredSPHData = [];

// Set Filter Waktu
window.setSphTimeFilter = function(filter) {
    activeTimeFilter = filter;
    document.getElementById('selectedFilter').textContent = filter;
    searchSPH(); // Trigger Apply Filters
}

// Alias for backward compatibility if needed, but we updated Blade
window.setFilter = window.setSphTimeFilter;

// Set Filter Status
window.setSphStatusFilter = function(filter) {
    activeStatusFilter = filter;
    document.getElementById('selectedStatusFilter').textContent = filter;
    searchSPH(); // Trigger Apply Filters
}

function searchSPH() {
    const searchTerm = document.getElementById('searchInput')?.value?.toLowerCase() || '';
    const today = new Date();

    filteredSPHData = allSPHData.filter(item => {
        const itemDate = new Date(item.tanggal);
        
        // 1. Time Filter
        let passTime = true;
        if (activeTimeFilter === 'Hari Ini') {
            passTime = isSameDay(itemDate, today);
        } else if (activeTimeFilter === 'Minggu Ini') {
             passTime = isSameWeek(itemDate, today);
        } else if (activeTimeFilter === 'Bulan Ini') {
             passTime = isSameMonth(itemDate, today);
        }

        // 2. Status Filter
        let passStatus = true;
        if (activeStatusFilter !== 'Semua Status') {
            const status = item.status || 'Menunggu';
            passStatus = status === activeStatusFilter;
        }

        // 3. Search Filter
        let passSearch = true;
        if (searchTerm) {
            const nomorSph = (item.nomor_sph || '').toLowerCase();
            const namaPerusahaan = (item.nama_perusahaan || '').toLowerCase();
            passSearch = nomorSph.includes(searchTerm) || namaPerusahaan.includes(searchTerm);
        }

        return passTime && passStatus && passSearch;
    });

    currentPage = 1;
    renderSPH(currentPage);
}



window.searchSPH = searchSPH;


window.deleteSPH = function (id) {
    const sphData = allSPHData.find(item => item.id === id);
    const sphName = sphData?.nomor_sph || `ID: ${id}`;

    Swal.fire({
        title: 'Hapus Surat Penawaran?',
        html: `Anda akan menghapus SPH:<br><strong class="text-danger">${sphName}</strong><br><br>Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            executeDeleteSPH(id);
        }
    });
}



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
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'SPH berhasil dihapus!',
                timer: 1500,
                showConfirmButton: false
            });
            loadSPH();
        })
        .catch(err => {
            console.error("DELETE ERROR:", err);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal menghapus SPH!'
            });
        });
}



window.printSPH = function (id) {
    window.location.href = '/print-sph/' + id;
}


document.addEventListener("DOMContentLoaded", function () {
    loadSPH();


    const tableBody = document.getElementById("sph-table-body");
    if (tableBody) {
        tableBody.addEventListener("click", function (e) {
            const target = e.target.closest("button");
            if (!target) return;


            const row = target.closest("tr");
            const deleteBtn = target.closest("button[onclick*='deleteSPH']");
            const printBtn = target.closest("button[onclick*='printSPH']");

            if (deleteBtn) {

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




window.updateStatusDropdown = function (selectElement) {
    const id = parseInt(selectElement.dataset.id);
    const newStatus = selectElement.value;
    const originalStatus = allSPHData.find(item => item.id === id)?.status || "Menunggu";

    console.log("UPDATE STATUS (API):", { id, status: newStatus, url: `${API_SPH}/${id}` });

    const token = getToken();
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Token tidak ditemukan! Silakan login kembali.'
        });
        selectElement.value = originalStatus;
        return;
    }


    Swal.fire({
        title: 'Ubah Status SPH?',
        text: `Anda akan mengubah status menjadi "${newStatus}".`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ubah',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (!result.isConfirmed) {
            selectElement.value = originalStatus;
            return;
        }


        selectElement.disabled = true;
        selectElement.style.opacity = "0.6";


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



                if (!res.ok) {
                    throw new Error(text || "Gagal mengupdate status SPH");
                }
                return text ? JSON.parse(text) : {};
            })
            .then(() => {

                const sphIndex = allSPHData.findIndex(item => item.id === id);
                if (sphIndex !== -1) {
                    allSPHData[sphIndex].status = newStatus;
                }


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

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Status SPH berhasil diperbarui',
                    timer: 1500,
                    showConfirmButton: false
                });

                console.log("Status berhasil diupdate ke database:", { id, status: newStatus });
            })
            .catch(err => {
                console.error("UPDATE ERROR:", err);
                selectElement.value = originalStatus;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate status SPH'
                });
            })
            .finally(() => {
                selectElement.disabled = false;
                selectElement.style.opacity = "1";
            });
    });
}


window.submitFormSPH = function (formData) {
    const token = getToken();
    if (!token) {
        alert("Token tidak ditemukan! Silakan login kembali.");
        return;
    }


    const tanggal = document.querySelector('[name="tanggal"]').value;
    const tempat = document.querySelector('[name="tempat"]').value;
    const lampiran = document.querySelector('[name="lampiran"]').value;
    const hal = document.querySelector('[name="hal"]').value;
    const jabatan_tujuan = document.querySelector('[name="kepada"]').value;
    const nama_perusahaan = document.querySelector('[name="nama_perusahaan"]').value;
    const penandatangan = document.querySelector('[name="penandatangan"]').value;


    const totalKeseluruhanInput = document.getElementById('totalKeseluruhanValue');
    const total_keseluruhan = totalKeseluruhanInput ? parseInt(totalKeseluruhanInput.value) : 0;


    const items = [];
    document.querySelectorAll("#itemContainer .item-row").forEach((row) => {
        const namaSelect = row.querySelector(".select-barang");
        const hargaInput = row.querySelector(".harga-satuan-value");
        const jumlahInput = row.querySelector(".jumlah-barang");
        const totalInput = row.querySelector(".total-item-value");

        const nama = namaSelect ? namaSelect.value : "";
        const jumlah = jumlahInput ? parseInt(jumlahInput.value) || 0 : 0;


        let harga = hargaInput ? parseInt(hargaInput.value) || 0 : 0;
        if (harga === 0 && namaSelect) {
            const selectedOption = namaSelect.options[namaSelect.selectedIndex];
            harga = selectedOption ? parseInt(selectedOption.getAttribute('data-harga')) || 0 : 0;
        }


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
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Harap tambahkan minimal satu barang!'
        });
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
        total_keseluruhan: total_keseluruhan,
        status: "Menunggu"
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

            const modalEl = document.getElementById('modalTambahSPH');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();


            $('#modalTambahSPH').trigger('hidden.bs.modal');


            const nomorSPH = response?.data?.nomor_sph || response?.nomor_sph || "Baru";

            Swal.fire({
                icon: 'success',
                title: 'Surat Penawaran Harga Berhasil Dibuat!',
                html: `<span style="color:#6b7280;">Nomor Surat:</span><br><strong style="font-size:18px; color:#1f2937;">${nomorSPH}</strong>`,
                confirmButtonText: 'OK, Mengerti'
            });

            loadSPH();
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal menambahkan SPH: ' + err.message
            });
        });
}


window.showSuccessModal = function (title, identifier) {

    const oldModal = document.getElementById('successModalOverlay');
    if (oldModal) oldModal.remove();


    const overlay = document.createElement('div');
    overlay.id = 'successModalOverlay';
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', right: '0', bottom: '0',
        background: 'rgba(0,0,0,0.5)', backdropFilter: 'blur(4px)',
        zIndex: '99999', display: 'flex', alignItems: 'center', justifyContent: 'center',
        animation: 'fadeIn 0.3s'
    });


    const content = document.createElement('div');
    Object.assign(content.style, {
        background: 'white', borderRadius: '16px', padding: '32px',
        maxWidth: '420px', width: '90%', boxShadow: '0 20px 60px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });


    const iconContainer = document.createElement('div');
    iconContainer.innerHTML = `
        <svg class="success-checkmark" xmlns="http:
            <circle class="success-checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#10b981" stroke-width="2"/>
            <path class="success-checkmark-check" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
    `;


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


    const header = document.createElement('h5');
    header.textContent = `${title} Berhasil Dibuat!`;
    Object.assign(header.style, {
        margin: '0 0 12px 0', fontSize: '22px', fontWeight: '600',
        color: '#065f46'
    });


    const sphNumber = document.createElement('div');
    sphNumber.innerHTML = `<span style="color:#6b7280;">Nomor Surat:</span><br><strong style="font-size:18px; color:#1f2937;">${identifier}</strong>`;
    Object.assign(sphNumber.style, {
        background: '#f0fdf4', padding: '16px', borderRadius: '12px',
        margin: '16px 0 24px 0', border: '1px solid #bbf7d0'
    });


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


    content.appendChild(iconContainer);
    content.appendChild(header);
    content.appendChild(sphNumber);
    content.appendChild(btnOK);
    overlay.appendChild(content);


    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) overlay.remove();
    });

    document.body.appendChild(overlay);
}