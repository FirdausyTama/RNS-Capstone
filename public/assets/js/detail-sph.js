document.addEventListener("DOMContentLoaded", function () {
    const pathArray = window.location.pathname.split('/');
    const id = pathArray[pathArray.length - 1];

    if (id && !isNaN(id)) {
        // Load stok data first, then load detail
        loadStokData().then(() => {
            loadDetailSPH(id);
        });

        const btnPrint = document.getElementById("btnPrintSPH");
        if (btnPrint) {
            btnPrint.href = `/print-sph/${id}`;
        }

        const btnUpdate = document.getElementById("btnUpdateSPH");
        if (btnUpdate) {
            btnUpdate.addEventListener("click", function () {
                const form = document.getElementById("formEditSPH");
                if (form.checkValidity()) {
                    updateSPH(id);
                } else {
                    form.reportValidity();
                }
            });
        }
    } else {
        console.error("ID SPH tidak valid");
        alert("ID SPH tidak valid");
    }
});

const API_SPH = "http://127.0.0.1:8000/api/surat-penawaran";
const API_STOK = "http://127.0.0.1:8000/api/stoks";
let editItemsData = [];
let stokData = [];

function getToken() {
    return localStorage.getItem("token");
}

function formatRupiah(angka) {
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
}

function loadStokData() {
    const token = getToken();
    if (!token) return Promise.resolve();

    return fetch(API_STOK, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        .then(res => {
            stokData = res.data || res || [];
            console.log("Stok data loaded:", stokData);
        })
        .catch(err => {
            console.error("Error loading stok:", err);
        });
}

function loadDetailSPH(id) {
    const token = getToken();
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const headers = {
        "Accept": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }
    if (csrfToken) {
        headers["X-CSRF-TOKEN"] = csrfToken;
    }

    fetch(`${API_SPH}/${id}`, {
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal memuat detail SPH: " + res.status + " " + res.statusText);
            }
            return res.json();
        })
        .then(res => {
            console.log("Response Detail:", res);
            const data = res.data || res;
            renderDetailSPH(data);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal memuat detail SPH! " + err.message);
        });
}

function renderDetailSPH(data) {
    setText("nomor_sph", data.nomor_sph);
    setText("tanggal", formatDate(data.tanggal));
    setText("tempat", data.tempat);
    setText("lampiran", data.lampiran);
    setText("hal", data.hal);
    setText("jabatan_tujuan", data.jabatan_tujuan);
    setText("nama_perusahaan", data.nama_perusahaan);
    setText("total_keseluruhan", formatRupiah(data.total_keseluruhan));
    setText("penandatangan", data.penandatangan);
    setText("created_at", data.created_at ? new Date(data.created_at).toLocaleString('id-ID') : '-');

    // Status Badge
    const statusEl = document.getElementById("status");
    if (statusEl) {
        let statusHtml = '';
        const status = (data.status || "Menunggu").toLowerCase();
        if (status === 'diterima') {
            statusHtml = '<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Diterima</span>';
        } else if (status === 'ditolak') {
            statusHtml = '<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Ditolak</span>';
        } else {
            statusHtml = '<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Menunggu</span>';
        }
        statusEl.innerHTML = statusHtml;
    }

    // Populate Items Table
    const tbody = document.getElementById("items-tbody");
    if (tbody && data.detail_barang && data.detail_barang.length > 0) {
        tbody.innerHTML = '';
        data.detail_barang.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama || '-'}</td>
                    <td>${item.jumlah || '-'} Pack</td>
                    <td>${formatRupiah(item.harga_satuan || 0)}</td>
                    <td>${formatRupiah(item.total || 0)}</td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    // Populate Edit Form
    setVal("editTanggal", data.tanggal);
    setVal("editTempat", data.tempat);
    setVal("editLampiran", data.lampiran);
    setVal("editHal", data.hal);
    setVal("editJabatanTujuan", data.jabatan_tujuan);
    setVal("editNamaPerusahaan", data.nama_perusahaan);
    setVal("editPenandatangan", data.penandatangan);
    setVal("editStatus", data.status || "Menunggu");

    // Store and populate items for editing
    editItemsData = data.detail_barang || [];
    populateEditItems();
}

function createItemDropdown(selectedValue = '') {
    console.log('Creating dropdown with stokData:', stokData);
    console.log('Selected value:', selectedValue);

    let options = '<option value="">Pilih barang...</option>';
    stokData.forEach(item => {
        const selected = item.nama_barang === selectedValue ? 'selected' : '';
        options += `<option value="${item.nama_barang}" data-harga="${item.harga}" ${selected}>${item.nama_barang}</option>`;
    });

    console.log('Dropdown options created:', options);
    return options;
}

function populateEditItems() {
    const tbody = document.getElementById("editItemsBody");
    if (!tbody) return;

    tbody.innerHTML = '';

    editItemsData.forEach((item, index) => {
        addEditItemRowWithData(item, index);
    });

    updateEditTotal();
}

function addEditItemRowWithData(item, index) {
    const tbody = document.getElementById("editItemsBody");
    if (!tbody) return;

    const row = document.createElement('tr');

    // Smart fallback: use input if stok empty, dropdown if stok available
    const namaBarangCell = stokData.length > 0
        ? `<select class="form-select form-select-sm select-barang-edit" data-index="${index}" required>
                ${createItemDropdown(item.nama)}
           </select>`
        : `<input type="text" class="form-control form-control-sm" value="${item.nama || ''}" data-index="${index}" placeholder="Nama Barang" required>`;

    row.innerHTML = `
        <td>${namaBarangCell}</td>
        <td><input type="number" class="form-control form-control-sm jumlah-edit" value="${item.jumlah || 1}" min="1" data-index="${index}" required></td>
        <td><input type="number" class="form-control form-control-sm harga-satuan-edit" value="${item.harga_satuan || 0}" min="0" data-index="${index}" required></td>
        <td><input type="text" class="form-control form-control-sm" value="${formatNumber(item.total || 0)}" readonly></td>
        <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="removeEditItemRow(${index})"><i class="mdi mdi-delete"></i></button></td>
    `;

    tbody.appendChild(row);

    // Attach event listeners
    if (stokData.length > 0) {
        const selectEl = row.querySelector('.select-barang-edit');
        selectEl.addEventListener('change', function () {
            onItemSelectChange(this);
        });
    } else {
        // For text input, update nama on change
        const inputEl = row.querySelector('input[type="text"]');
        inputEl.addEventListener('input', function () {
            if (editItemsData[index]) {
                editItemsData[index].nama = this.value;
            }
        });
    }

    const jumlahEl = row.querySelector('.jumlah-edit');
    const hargaEl = row.querySelector('.harga-satuan-edit');

    jumlahEl.addEventListener('input', function () {
        onItemQuantityChange(this);
    });

    hargaEl.addEventListener('input', function () {
        onItemPriceChange(this);
    });
}

function onItemSelectChange(selectElement) {
    const index = parseInt(selectElement.getAttribute('data-index'));
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const itemName = selectedOption.value;
    const itemHarga = selectedOption.getAttribute('data-harga');

    if (editItemsData[index]) {
        editItemsData[index].nama = itemName;
        editItemsData[index].harga_satuan = parseFloat(itemHarga) || 0;
        recalculateEditItem(index);
    }
}

function onItemQuantityChange(inputElement) {
    const index = parseInt(inputElement.getAttribute('data-index'));
    const value = parseFloat(inputElement.value) || 0;

    if (editItemsData[index]) {
        editItemsData[index].jumlah = value;
        recalculateEditItem(index);
    }
}

function onItemPriceChange(inputElement) {
    const index = parseInt(inputElement.getAttribute('data-index'));
    const value = parseFloat(inputElement.value) || 0;

    if (editItemsData[index]) {
        editItemsData[index].harga_satuan = value;
        recalculateEditItem(index);
    }
}

function addEditItemRow() {
    const newItem = { nama: '', jumlah: 1, harga_satuan: 0, total: 0 };
    editItemsData.push(newItem);
    populateEditItems();
}

function recalculateEditItem(index) {
    if (editItemsData[index]) {
        const jumlah = parseFloat(editItemsData[index].jumlah) || 0;
        const hargaSatuan = parseFloat(editItemsData[index].harga_satuan) || 0;
        editItemsData[index].total = jumlah * hargaSatuan;

        populateEditItems();
    }
}

function removeEditItemRow(index) {
    if (confirm('Hapus item ini?')) {
        editItemsData.splice(index, 1);
        populateEditItems();
    }
}

function updateEditTotal() {
    const total = calculateTotal();
    const display = document.getElementById("editTotalDisplay");
    if (display) {
        display.textContent = formatNumber(total);
    }
}

function updateSPH(id) {
    const token = getToken();
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }
    if (csrfToken) {
        headers["X-CSRF-TOKEN"] = csrfToken;
    }

    const data = {
        tanggal: document.getElementById("editTanggal").value,
        tempat: document.getElementById("editTempat").value,
        lampiran: document.getElementById("editLampiran").value,
        hal: document.getElementById("editHal").value,
        jabatan_tujuan: document.getElementById("editJabatanTujuan").value,
        nama_perusahaan: document.getElementById("editNamaPerusahaan").value,
        penandatangan: document.getElementById("editPenandatangan").value,
        status: document.getElementById("editStatus").value,
        detail_barang: editItemsData,
        total_keseluruhan: calculateTotal()
    };

    console.log("Data to update:", data);

    fetch(`${API_SPH}/${id}`, {
        method: "PUT",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal mengupdate SPH");
            }
            return res.json();
        })
        .then(res => {
            console.log("Update Success:", res);
            alert("SPH berhasil diupdate!");

            const modalEl = document.getElementById('modalEditSPH');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            loadDetailSPH(id);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal mengupdate SPH: " + err.message);
        });
}

function calculateTotal() {
    let total = 0;
    editItemsData.forEach(item => {
        total += parseFloat(item.total) || 0;
    });
    return total;
}

function formatNumber(num) {
    return Number(num).toLocaleString('id-ID');
}

// Helper functions
function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value || "-";
}

function setVal(id, value) {
    const el = document.getElementById(id);
    if (el) el.value = value || "";
}

function formatDate(dateString) {
    if (!dateString) return "-";
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}
