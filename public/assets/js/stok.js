// ===== CEK DAN SET API_URL =====
window.API_URL = window.API_URL || "http://127.0.0.1:8000/api/stoks";

// ===== TOKEN =====
function getToken() {
    const token = localStorage.getItem("token");
    if (!token) console.error("Token tidak ditemukan!");
    return token;
}

// ===== LOAD DATA =====
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("stok-table-body")) {
        loadStok();
        loadStokSummary();
    }
});

// ===== SUMMARY =====
function updateSummary(data) {
    if (!Array.isArray(data)) data = [];

    const totalMasuk = data
        .filter((item) => item.tgl_masuk)
        .reduce((sum, item) => sum + Number(item.jumlah || 0), 0);

    const totalKeluar = data
        .filter((item) => item.tgl_keluar)
        .reduce((sum, item) => sum + Number(item.jumlah || 0), 0);

    const totalKeseluruhan = totalMasuk - totalKeluar;

    const elmMasuk = document.getElementById("totalStokMasuk");
    const elmKeluar = document.getElementById("totalStokKeluar");
    const elmKeseluruhan = document.getElementById("totalStokKeseluruhan");

    if (elmMasuk) elmMasuk.textContent = totalMasuk + " Produk";
    if (elmKeluar) elmKeluar.textContent = totalKeluar + " Produk";
    if (elmKeseluruhan) elmKeseluruhan.textContent = totalKeseluruhan;
}

// ===== PAGINATION VARIABLES =====
let allStok = [];
let filteredStok = [];
let currentPage = 1;
const rowsPerPage = 5;

// ===== LOAD STOK =====
async function loadStok() {
    const body = document.getElementById("stok-table-body");
    if (!body) return;

    const token = getToken();
    // if (!token) return; // Allow running without token for mock data

    try {
        // Try fetching from API
        const res = await fetch(window.API_URL, {
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
        });

        if (!res.ok) {
            throw new Error("API Failed");
        }

        const data = await res.json();
        allStok = data.data || [];

    } catch (err) {
        console.warn("Gagal memuat data stok (Backend belum siap). Menggunakan data dummy untuk demo pagination.");
        
        // GENERATE DUMMY DATA FOR DEMO
        allStok = [];
        for (let i = 1; i <= 35; i++) {
            allStok.push({
                id: i,
                nama_barang: `Produk Contoh ${i}`,
                kode_sku: `SKU-${1000 + i}`,
                merek: `Merek ${String.fromCharCode(65 + (i % 5))}`,
                deskripsi: `Deskripsi untuk produk contoh nomor ${i}`,
                tgl_masuk: new Date().toISOString(),
                harga: 10000 * i,
                jumlah: i % 10 === 0 ? 0 : i * 2,
                satuan: 'Pcs',
                panjang: 10 + i,
                lebar: 5 + i,
                tinggi: 2 + i,
                berat: 500 + (i * 10),
                foto: null,
                video: null
            });
        }
    }

    // Render Table with Data (Real or Dummy)
    filteredStok = [...allStok];
    renderTable(1);
    updateSummary(allStok);
    
    // Show pagination container
    const paginationContainer = document.getElementById("pagination-container");
    if (paginationContainer) {
        paginationContainer.style.display = allStok.length > 0 ? "flex" : "none";
    }
}

// ===== RENDER TABLE (PAGINATED) =====
function renderTable(page = 1) {
    const body = document.getElementById("stok-table-body");
    if (!body) return;

    currentPage = page;
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedItems = filteredStok.slice(start, end);

    body.innerHTML = "";

    if (paginatedItems.length === 0) {
        body.innerHTML = `<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada data stok.</td></tr>`;
        return;
    }

    paginatedItems.forEach((item) => {
        const foto = item.foto
            ? `http://127.0.0.1:8000/storage/${item.foto}`
            : "assets/images/logo-sm.png";

        const hargaNumber = Number(item.harga) || 0;
        const jumlahNumber = Number(item.jumlah) || 0;

        let badge = "";
        if (jumlahNumber >= 5)
            badge = `<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Stok Aman</span>`;
        else if (jumlahNumber > 0)
            badge = `<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Stok Menipis</span>`;
        else
            badge = `<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Stok Habis</span>`;

        body.innerHTML += `
        <tr>
            <td class="text-center"><img src="${foto}" class="rounded" width="60" height="60" style="object-fit: cover;"></td>
            <td>
                <h6 class="fw-semibold mb-1 text-dark">${item.nama_barang || "-"}</h6>
                <small class="text-muted">${item.deskripsi || ""}</small>
            </td>
            <td class="text-center">${formatTanggal(item.tgl_masuk)}</td>
            <td class="text-center fw-semibold">Rp${hargaNumber.toLocaleString("id-ID")}</td>
            <td class="text-center">${badge}</td>
            <td class="text-center fw-semibold">${jumlahNumber} ${item.satuan || ''}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-light border me-1" onclick="openEditModal(${item.id})" title="Edit">
                    <i class="mdi mdi-square-edit-outline text-primary"></i>
                </button>
                <button class="btn btn-sm btn-light border me-1" onclick="window.location.href='/stok/detail-stok/${item.id}'" title="Detail">
                    <i class="mdi mdi-eye-outline text-muted"></i>
                </button>
                <button class="btn btn-sm btn-light border" onclick="deleteStok(${item.id})" title="Hapus">
                    <i class="mdi mdi-delete-outline text-danger"></i>
                </button>
            </td>
        </tr>`;
    });

    setupPagination();
}

// ===== SETUP PAGINATION =====
function setupPagination() {
    const paginationControls = document.getElementById("pagination-controls");
    const paginationInfo = document.getElementById("pagination-info");
    
    if (!paginationControls || !paginationInfo) return;

    const totalItems = filteredStok.length;
    const totalPages = Math.ceil(totalItems / rowsPerPage);
    
    // Update Info Text
    const startItem = totalItems === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
    const endItem = Math.min(currentPage * rowsPerPage, totalItems);
    paginationInfo.innerText = `Menampilkan ${startItem}-${endItem} dari ${totalItems} transaksi`;

    paginationControls.innerHTML = "";

    if (totalPages <= 1) return;

    // Prev Button
    const prevLi = document.createElement("li");
    prevLi.className = `page-item ${currentPage === 1 ? "disabled" : ""}`;
    prevLi.innerHTML = `<a class="page-link" href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>`;
    prevLi.onclick = () => { if (currentPage > 1) renderTable(currentPage - 1); };
    paginationControls.appendChild(prevLi);

    // Page Numbers
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement("li");
        li.className = `page-item ${currentPage === i ? "active" : ""}`;
        li.innerHTML = `<a class="page-link" href="javascript:void(0);">${i}</a>`;
        li.onclick = () => renderTable(i);
        paginationControls.appendChild(li);
    }

    // Next Button
    const nextLi = document.createElement("li");
    nextLi.className = `page-item ${currentPage === totalPages ? "disabled" : ""}`;
    nextLi.innerHTML = `<a class="page-link" href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>`;
    nextLi.onclick = () => { if (currentPage < totalPages) renderTable(currentPage + 1); };
    paginationControls.appendChild(nextLi);
}

// ===== SEARCH FUNCTION =====
function searchProduct() {
    const input = document.getElementById("searchInput");
    const term = input.value.toLowerCase();
    
    filteredStok = allStok.filter(item => 
        (item.nama_barang && item.nama_barang.toLowerCase().includes(term)) ||
        (item.kode_sku && item.kode_sku.toLowerCase().includes(term)) ||
        (item.merek && item.merek.toLowerCase().includes(term))
    );
    
    renderTable(1); // Reset to page 1
}
// ==================== OPEN DETAIL MODAL ====================
function openDetailModal(id) {
    // Ambil port dari URL saat ini
    const currentPort = window.location.port || '8001';
    const apiUrl = `http://127.0.0.1:${currentPort}/api/stoks/${id}`;
    
    const modal = new bootstrap.Modal(document.getElementById("detailStokModal"));
    const contentDiv = document.getElementById("detailStokContent");
    
    // Show loading
    contentDiv.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-3">Memuat detail produk...</p>
        </div>
    `;
    
    modal.show();
    
    // Fetch detail data
    const token = localStorage.getItem("token");
    
    fetch(apiUrl, {
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(res => {
        if (!res.ok) throw new Error('Gagal memuat data');
        return res.json();
    })
    .then(response => {
        if (response.data) {
            renderDetailStokModal(response.data, id);
        } else {
            throw new Error('Data tidak ditemukan');
        }
    })
    .catch(err => {
        console.error(err);
        contentDiv.innerHTML = `
            <div class="alert alert-danger">
                <i class="mdi mdi-alert"></i> Terjadi kesalahan: ${err.message}
            </div>
        `;
    });
}

// ==================== RENDER DETAIL MODAL ====================
function renderDetailStokModal(data, id) {
    const currentPort = window.location.port || '8001';
    const storageBaseUrl = `http://127.0.0.1:${currentPort}/storage`;
    const contentDiv = document.getElementById("detailStokContent");
    
    // Tentukan apakah ada media
    const hasFoto = data.foto ? true : false;
    const hasVideo = data.video ? true : false;
    const hasMedia = hasFoto || hasVideo;
    
    const fotoUrl = data.foto ? `${storageBaseUrl}/${data.foto}` : '';
    const videoUrl = data.video ? `${storageBaseUrl}/${data.video}` : '';
    
    contentDiv.innerHTML = `
        <div class="row">
            <!-- Kiri: Informasi Produk -->
            <div class="col-lg-8">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            <i class="mdi mdi-information-outline text-primary"></i> Informasi Produk
                        </h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Nama Barang</small>
                                <div class="fw-semibold">${data.nama_barang || '-'}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Kode SKU</small>
                                <div class="fw-semibold">${data.kode_sku || '-'}</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Merek</small>
                                <div class="fw-semibold">${data.merek || '-'}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Tanggal Masuk</small>
                                <div class="fw-semibold">${formatTanggal(data.tgl_masuk)}</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Deskripsi</small>
                            <div class="fw-semibold">${data.deskripsi || '-'}</div>
                        </div>

                        <hr>
                        <h5 class="fw-bold mb-3">
                            <i class="mdi mdi-currency-usd text-success"></i> Harga & Stok
                        </h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Harga Jual</small>
                                <div class="fw-semibold text-primary fs-5">${formatRupiah(data.harga || 0)}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Satuan</small>
                                <div class="fw-semibold">${data.satuan || 'Pcs'}</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Jumlah</small>
                                <div class="fw-semibold">${data.jumlah || 0} ${data.satuan || 'Pcs'}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Stok Tersedia</small>
                                <div class="fw-semibold">${data.jumlah || 0} ${data.satuan || 'Pcs'}</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Status Stok</small>
                            <div>${getStatusBadge(data.jumlah || 0)}</div>
                        </div>

                        <hr>
                        <h5 class="fw-bold mb-3">
                            <i class="mdi mdi-ruler text-info"></i> Dimensi & Berat
                        </h5>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <small class="text-muted">Panjang</small>
                                <div class="fw-semibold">${data.panjang || '-'} cm</div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Lebar</small>
                                <div class="fw-semibold">${data.lebar || '-'} cm</div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Tinggi</small>
                                <div class="fw-semibold">${data.tinggi || '-'} cm</div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Berat</small>
                                <div class="fw-semibold">${data.berat || '-'} gr</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Media & Aksi -->
            <div class="col-lg-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            <i class="mdi mdi-image-multiple text-warning"></i> Media Produk
                        </h5>
                        <div class="media-gallery" style="display:flex; flex-direction:column; gap:1.5rem;">
                            ${hasFoto ? `
                            <div class="media-item">
                                <small class="text-muted d-block mb-2">Foto Produk</small>
                                <img src="${fotoUrl}" class="product-image" alt="Foto Produk" style="width:100%; max-height:300px; object-fit:cover; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
                            </div>
                            ` : ''}
                            
                            ${hasVideo ? `
                            <div class="media-item">
                                <small class="text-muted d-block mb-2">Video Produk</small>
                                <video controls class="product-video" style="width:100%; max-height:300px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
                                    <source src="${videoUrl}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            </div>
                            ` : ''}
                            
                            ${!hasMedia ? `
                            <div class="media-item text-center">
                                <div class="border border-2 border-dashed rounded p-5 text-muted" style="background:#f8f9fa;">
                                    <i class="mdi mdi-image-off fs-1 d-block mb-2"></i>
                                    <div>Tidak ada media</div>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            <i class="mdi mdi-cog-outline text-secondary"></i> Aksi
                        </h5>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="editStokFromModal(${id})">
                                <i class="mdi mdi-square-edit-outline"></i> Edit Produk
                            </button>
                            <button class="btn btn-danger" onclick="deleteStokFromModal(${id})">
                                <i class="mdi mdi-delete-outline"></i> Hapus Produk
                            </button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="mdi mdi-close"></i> Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Helper functions
function formatRupiah(angka) { 
    return 'Rp ' + Number(angka).toLocaleString('id-ID'); 
}

function formatRupiahInput(input) {
    let value = input.value.replace(/[^,\d]/g, '').toString();
    let split = value.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    input.value = rupiah;
}

function formatTanggal(tanggal) { 
    if (!tanggal) return '-';
    return new Date(tanggal).toLocaleDateString('id-ID', {
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    }); 
}

function getStatusBadge(jumlah) {
    jumlah = Number(jumlah) || 0;
    if (jumlah >= 5) 
        return '<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Stok Aman</span>';
    if (jumlah > 0) 
        return '<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Stok Menipis</span>';
    return '<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Stok Habis</span>';
}

// Fungsi untuk edit dari modal
function editStokFromModal(id) {
    const modalEl = document.getElementById('detailStokModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
    
    setTimeout(() => {
        openEditModal(id);
    }, 300);
}

// Fungsi untuk hapus dari modal
function deleteStokFromModal(id) {
    const modalEl = document.getElementById('detailStokModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
    
    setTimeout(() => {
        deleteStok(id);
    }, 300);
}

// ===== SUMMARY API =====
async function loadStokSummary() {
    const token = getToken();
    if (!token) return;

    try {
        const res = await fetch("http://127.0.0.1:8000/api/stoks/summary", {
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
        });

        if (!res.ok) throw new Error("Gagal memuat summary stok");

        const data = await res.json();

        const elmMasuk = document.getElementById("totalStokMasuk");
        const elmKeluar = document.getElementById("totalStokKeluar");
        const elmKeseluruhan = document.getElementById("totalStokKeseluruhan");

        if (elmMasuk) elmMasuk.textContent = data.total_masuk + " Produk";
        if (elmKeluar) elmKeluar.textContent = data.total_keluar + " Produk";
        if (elmKeseluruhan) elmKeseluruhan.textContent = data.total_keseluruhan;
    } catch (err) {
        console.error("Gagal memuat summary:", err);
    }
}

function increaseQty() {
    let input = document.getElementById("jumlah");
    input.value = parseInt(input.value) + 1;
}

function decreaseQty() {
    let input = document.getElementById("jumlah");
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
    }
}



function handleVideoUpload(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 10 * 1024 * 1024) {
            alert("Ukuran video maksimal 10MB!");
            input.value = "";
            return;
        }

        const validFormats = ["video/mp4", "video/avi", "video/quicktime"];
        if (!validFormats.includes(file.type)) {
            alert("Format video harus MP4, AVI, atau MOV!");
            input.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("videoElement").src = e.target.result;
            document.getElementById("videoFileNamePreview").textContent =
                file.name;
            document.getElementById("videoPlaceholder").style.display = "none";
            document.getElementById("videoPreview").classList.add("show");
        };
        reader.readAsDataURL(file);
    }
}

function handleFotoUpload(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert("Ukuran foto maksimal 5MB!");
            input.value = "";
            return;
        }

        const validFormats = ["image/jpeg", "image/png", "image/webp"];
        if (!validFormats.includes(file.type)) {
            alert("Format foto harus JPG, PNG, atau WEBP!");
            input.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("fotoElement").src = e.target.result;
            document.getElementById("fotoFileNamePreview").textContent =
                file.name;
            document.getElementById("fotoPlaceholder").style.display = "none";
            document.getElementById("fotoPreview").classList.add("show");
        };
        reader.readAsDataURL(file);
    }
}

function removeVideo(event) {
    event.stopPropagation();
    document.getElementById("uploadVideo").value = "";
    document.getElementById("videoElement").src = "";
    document.getElementById("videoFileNamePreview").textContent = "";
    document.getElementById("videoPreview").classList.remove("show");
    document.getElementById("videoPlaceholder").style.display = "block";
}

function removeFoto(event) {
    event.stopPropagation();
    document.getElementById("uploadFoto").value = "";
    document.getElementById("fotoElement").src = "";
    document.getElementById("fotoFileNamePreview").textContent = "";
    document.getElementById("fotoPreview").classList.remove("show");
    document.getElementById("fotoPlaceholder").style.display = "block";
}

// ===== EDIT MODAL HANDLERS =====

function handleEditVideoUpload(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 10 * 1024 * 1024) {
            alert("Ukuran video maksimal 10MB!");
            input.value = "";
            return;
        }

        const validFormats = ["video/mp4", "video/avi", "video/quicktime"];
        if (!validFormats.includes(file.type)) {
            alert("Format video harus MP4, AVI, atau MOV!");
            input.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("editVideoElement").src = e.target.result;
            document.getElementById("editVideoName").textContent = file.name;
            document.getElementById("editVideoPlaceholder").style.display = "none";
            document.getElementById("editVideoPreview").style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

function handleEditFotoUpload(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert("Ukuran foto maksimal 5MB!");
            input.value = "";
            return;
        }

        const validFormats = ["image/jpeg", "image/png", "image/webp"];
        if (!validFormats.includes(file.type)) {
            alert("Format foto harus JPG, PNG, atau WEBP!");
            input.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("editFotoElement").src = e.target.result;
            document.getElementById("editFotoName").textContent = file.name;
            document.getElementById("editFotoPlaceholder").style.display = "none";
            document.getElementById("editFotoPreview").style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

function removeEditVideo(event) {
    event.stopPropagation();
    document.getElementById("editUploadVideo").value = "";
    document.getElementById("editVideoElement").src = "";
    document.getElementById("editVideoName").textContent = "";
    document.getElementById("editVideoPreview").style.display = "none";
    document.getElementById("editVideoPlaceholder").style.display = "block";
}

function removeEditFoto(event) {
    event.stopPropagation();
    document.getElementById("editUploadFoto").value = "";
    document.getElementById("editFotoElement").src = "";
    document.getElementById("editFotoName").textContent = "";
    document.getElementById("editFotoPreview").style.display = "none";
    document.getElementById("editFotoPlaceholder").style.display = "block";
}

document
    .getElementById("modalTambahStok")
    .addEventListener("hidden.bs.modal", function () {
        document.getElementById("formTambahStok").reset();

        document.getElementById("videoElement").src = "";
        document.getElementById("videoFileNamePreview").textContent = "";
        document.getElementById("videoPreview").classList.remove("show");
        document.getElementById("videoPlaceholder").style.display = "block";

        document.getElementById("fotoElement").src = "";
        document.getElementById("fotoFileNamePreview").textContent = "";
        document.getElementById("fotoPreview").classList.remove("show");
        document.getElementById("fotoPlaceholder").style.display = "block";
    });

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function formatTrend(percent) {
    if (percent > 0) {
        return `<i class="mdi mdi-arrow-up-bold text-success me-1"></i> +${percent}%`;
    } else if (percent < 0) {
        return `<i class="mdi mdi-arrow-down-bold text-danger me-1"></i> ${percent}%`;
    } else {
        return `<i class="mdi mdi-minus text-secondary me-1"></i> 0%`;
    }
}

async function loadWeeklySummary() {
    try {
        const res = await fetch(`${API_URL}/weekly-summary`);
        if (!res.ok) throw new Error("Gagal memuat summary mingguan");

        const data = await res.json();

        // Masuk
        if (document.getElementById("totalStokMasuk7Hari")) {
            document.getElementById("totalStokMasuk7Hari").innerHTML =
                formatTrend(data.persen_masuk);
        }

        // Keluar
        if (document.getElementById("totalStokKeluar7Hari")) {
            document.getElementById("totalStokKeluar7Hari").innerHTML =
                formatTrend(data.persen_keluar);
        }

        // Total keseluruhan
        if (document.getElementById("totalKeseluruhanPersen")) {
            document.getElementById("totalKeseluruhanPersen").innerHTML =
                formatTrend(data.persen_total);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

async function getStokDetail(id) {
    const token = getToken();
    if (!token) return alertError("Token tidak ditemukan!");

    try {
        const response = await fetch(`${API_URL}/stoks/${id}`, {
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log("Detail Stok:", data);

        return data;
    } catch (error) {
        console.error("Gagal mengambil detail stok:", error);
        alertError("Gagal mengambil detail stok!");
    }
}

function deleteStok(id) {
    alertConfirmDelete(() => {
        const token = getToken();
        if (!token) return alertError("Token tidak ditemukan!");

        fetch(`${API_URL}/stoks/${id}`, {
            method: "DELETE",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
        })
            .then(async (res) => {
                if (!res.ok) {
                    const text = await res.text();
                    console.error("RESPON ERROR:", text);
                    throw new Error("Gagal menghapus stok");
                }
                return res.json();
            })
            .then((res) => {
                alertSuccess(res.message || "Stok berhasil dihapus!");
                loadStok();
            })
            .catch((err) => {
                console.error("Error:", err);
                alertError("Gagal menghapus stok!");
            });
    });
}

async function openEditModal(id) {
    const token = getToken();
    if (!token) return alertError("Token tidak ditemukan!");

    try {
        const res = await fetch(`${API_URL}/stoks/${id}`, {
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
        });

        if (!res.ok) throw new Error("Gagal mengambil detail stok");

        const data = await res.json();

        document.getElementById("editId").value = data.data.id || "";
        document.getElementById("editNamaBarang").value =
            data.data.nama_barang || "";
        
        // Format harga dengan ribuan
        let harga = data.data.harga || "";
        if (harga) {
            harga = harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        document.getElementById("editHargaJual").value = harga;
        
        document.getElementById("editJumlah").value = data.data.jumlah || "";
        document.getElementById("editTglMasuk").value = data.data.tgl_masuk || "";
        document.getElementById("editSatuan").value = data.data.satuan || "";

        // Populate missing fields
        document.getElementById("editKodeSKU").value = data.data.kode_sku || "";
        document.getElementById("editMerek").value = data.data.merek || "";
        document.getElementById("editPanjang").value = data.data.panjang || "";
        document.getElementById("editLebar").value = data.data.lebar || "";
        document.getElementById("editTinggi").value = data.data.tinggi || "";
        document.getElementById("editBerat").value = data.data.berat || "";

        if (data.data.foto) {
            document.getElementById(
                "editFotoElement"
            ).src = `http://127.0.0.1:8000/storage/${data.data.foto}`;
            document.getElementById("editFotoName").textContent = data.data.foto
                .split("/")
                .pop();
            document.getElementById("editFotoPreview").style.display = "block";
            document.getElementById("editFotoPlaceholder").style.display =
                "none";
        }

        if (data.data.video) {
            document.getElementById(
                "editVideoElement"
            ).src = `http://127.0.0.1:8000/storage/${data.data.video}`;
            document.getElementById("editVideoName").textContent =
                data.data.video.split("/").pop();
            document.getElementById("editVideoPreview").style.display = "block";
            document.getElementById("editVideoPlaceholder").style.display =
                "none";
        }

        const modal = new bootstrap.Modal(
            document.getElementById("modalEditStok")
        );
        modal.show();
    } catch (err) {
        console.error(err);
        alertError("Gagal memuat data untuk diedit");
    }
}

async function submitUpdateStok() {
    const token = getToken();
    if (!token) return alertError("Token tidak ditemukan!");

    const id = document.getElementById("editId").value;

    const formData = new FormData();
    formData.append(
        "nama_barang",
        document.getElementById("editNamaBarang").value
    );
    
    // Hapus titik sebelum kirim ke server
    let harga = document.getElementById("editHargaJual").value;
    harga = harga.replace(/\./g, "");
    formData.append("harga", harga);
    
    formData.append("jumlah", document.getElementById("editJumlah").value);
    formData.append("tgl_masuk", document.getElementById("editTglMasuk").value);
    formData.append("user_id", 1);

    formData.append("kode_sku", document.getElementById("editKodeSKU").value);
    formData.append("merek", document.getElementById("editMerek").value);
    formData.append("satuan", document.getElementById("editSatuan").value);
    formData.append("panjang", document.getElementById("editPanjang").value);
    formData.append("lebar", document.getElementById("editLebar").value);
    formData.append("tinggi", document.getElementById("editTinggi").value);
    formData.append("berat", document.getElementById("editBerat").value);

    const foto = document.getElementById("editUploadFoto")?.files[0];
    if (foto) formData.append("foto", foto);

    const video = document.getElementById("editUploadVideo")?.files[0];
    if (video) formData.append("video", video);

    try {
        const response = await fetch(`${API_URL}/stoks/${id}`, {
            method: "POST",
            headers: {
                "X-HTTP-Method-Override": "PUT",
                Authorization: "Bearer " + token,
                Accept: "application/json",
            },
            body: formData,
        });

        if (!response.ok) {
            const text = await response.text();
            console.log("Server Response:", text); // 🔥 Debug response 422
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        alertSuccess("Stok berhasil diperbarui!");
        bootstrap.Modal.getInstance(
            document.getElementById("modalEditStok")
        ).hide();
        loadStok();
    } catch (err) {
        console.error(err);
        alertError("Gagal memperbarui stok!");
    }
}

function editIncreaseQty() {
    const input = document.getElementById("editJumlah");
    let current = parseInt(input.value) || 0;
    input.value = current + 1;
}

function editDecreaseQty() {
    const input = document.getElementById("editJumlah");
    let current = parseInt(input.value) || 0;
    if (current > 0) input.value = current - 1;
}

document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, "0");
    const dd = String(today.getDate()).padStart(2, "0");
    const todayStr = `${yyyy}-${mm}-${dd}`;
    const tglMasuk = document.getElementById("tgl_masuk");
    if (tglMasuk) {
        tglMasuk.value = todayStr;
        tglMasuk.max = todayStr;
    }

    const editTglMasuk = document.getElementById("editTglMasuk");
    if (editTglMasuk) {
        editTglMasuk.max = todayStr;
    }
});

function submitTambahStok() {
    const token = localStorage.getItem("token");
    if (!token) return alertError("Token tidak ditemukan!");

    const formData = new FormData();

    formData.append("nama_barang", document.getElementById("namaBarang").value);
    
    // Hapus titik sebelum kirim ke server
    let harga = document.getElementById("hargaJual").value;
    harga = harga.replace(/\./g, "");
    formData.append("harga", harga);

    formData.append("jumlah", document.getElementById("jumlah").value);
    formData.append(
        "tgl_masuk",
        document.getElementById("tgl_masuk").value ||
            new Date().toISOString().split("T")[0]
    );
    formData.append("user_id", 1);

    const foto = document.getElementById("uploadFoto").files[0];
    if (foto) formData.append("foto", foto);

    const video = document.getElementById("uploadVideo").files[0];
    if (video) formData.append("video", video);

    fetch("http://127.0.0.1:8000/api/stoks", {
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
            Accept: "application/json",
        },
        body: formData,
    })
        .then(async (res) => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal menambah stok");
            }
            return res.json();
        })
        .then((res) => {
            alertSuccess(res.message || "Stok berhasil ditambahkan!");

            document.getElementById("formTambahStok").reset();

            const modal = bootstrap.Modal.getInstance(
                document.getElementById("modalTambahStok")
            );
            modal.hide();

            setTimeout(() => {
                location.reload();
            }, 500);
        })
        .catch((err) => {
            console.error("Error:", err);
            alertError("Gagal menambah stok!");
        });
}


function formatDateToYYYYMMDD(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
}

document
    .getElementById("modalTambahStok")
    .addEventListener("show.bs.modal", function () {
        const today = new Date();
        document.getElementById("tgl_masuk").value =
            formatDateToYYYYMMDD(today);
    });

document
    .getElementById("modalEditStok")
    .addEventListener("show.bs.modal", function () {
        const today = new Date();
        const editTanggal = document.getElementById("editTglMasuk");

        if (!editTanggal.value) {
            editTanggal.value = formatDateToYYYYMMDD(today);
        }
    });

function setFilter(filterName) {
    document.getElementById("selectedFilter").textContent = filterName;

    const now = new Date();
    let startDate, endDate;

    // Reset filteredStok to allStok before applying date filter
    // Note: This might conflict if we want to combine search + date filter.
    // For now, let's assume date filter resets search or works on allStok.
    // Ideally, we should chain filters, but let's keep it simple as per request.
    
    switch (filterName) {
        case "Hari Ini":
            startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1);
            break;
        case "Minggu Ini":
            const day = now.getDay() || 7; // Get current day number, converting Sun (0) to 7
            if(day !== 1) now.setHours(-24 * (day - 1)); // Set to Monday of this week
            startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + 7);
            break;
        case "Bulan Ini":
            startDate = new Date(now.getFullYear(), now.getMonth(), 1);
            endDate = new Date(now.getFullYear(), now.getMonth() + 1, 1);
            break;
        case "Semua Waktu":
        default:
            startDate = null;
            endDate = null;
    }

    if (!startDate || !endDate) {
        filteredStok = [...allStok];
    } else {
        filteredStok = allStok.filter(item => {
            if (!item.tgl_masuk) return false;
            const itemDate = new Date(item.tgl_masuk);
            return itemDate >= startDate && itemDate < endDate;
        });
    }

    renderTable(1);
}
// function formatRupiahInput(input) {
//     // Ambil angka mentah hanya digit
//     let angka = input.value.replace(/\D/g, "");

//     // Simpan RAW NUMBER ke dataset
//     input.dataset.raw = angka; // <-- ini yg dipakai buat kirim ke API

//     // Format tampilan (ribuan)
//     let reverse = angka.toString().split("").reverse().join("");
//     let ribuan = reverse.match(/\d{1,3}/g);
//     let hasil = ribuan.join(".").split("").reverse().join("");

//     // Tampilkan
//     input.value = hasil;
// }
