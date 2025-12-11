document.addEventListener("DOMContentLoaded", function () {
    loadKwitansi();

    // Event listener for form submission
    const btnSimpan = document.getElementById("btnSimpanKwitansi");
    if (btnSimpan) {
        btnSimpan.addEventListener("click", function () {
            const form = document.getElementById("formKwitansi");
            if (form.checkValidity()) {
                const formData = new FormData(form);
                submitFormKwitansi(formData);
            } else {
                form.reportValidity();
            }
        });
    }
});

// Global state
let allData = [];
let filteredData = [];
let currentPage = 1;
let itemsPerPage = 5;
let currentFilter = 'Semua Waktu';
let currentSearch = '';

function setFilter(filter) {
    currentFilter = filter;
    document.getElementById('selectedFilter').innerText = filter;
    currentPage = 1;
    applyFilterAndRender();
}

function searchKwitansi() {
    currentSearch = document.getElementById('searchInput').value;
    currentPage = 1;
    applyFilterAndRender();
}

function applyFilterAndRender() {
    // Filter data
    filteredData = allData.filter(item => {
        // 1. Time Filter
        let passTime = true;
        const itemDate = new Date(item.tanggal);
        const today = new Date();

        if (currentFilter === 'Hari Ini') {
            passTime = isSameDay(itemDate, today);
        } else if (currentFilter === 'Minggu Ini') {
            passTime = isSameWeek(itemDate, today);
        } else if (currentFilter === 'Bulan Ini') {
            passTime = isSameMonth(itemDate, today);
        }

        // 2. Search Filter
        let passSearch = true;
        if (currentSearch) {
            const searchLower = currentSearch.toLowerCase();
            const no = (item.nomor_kwitansi || '').toLowerCase();
            const nama = (item.nama_penerima || '').toLowerCase();
            const ket = (item.keterangan || '').toLowerCase();
            passSearch = no.includes(searchLower) || nama.includes(searchLower) || ket.includes(searchLower);
        }

        return passTime && passSearch;
    });

    // Render current page
    renderCurrentPage();
}

function renderCurrentPage() {
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageData = filteredData.slice(start, end);

    renderKwitansi(pageData, start + 1);
    renderPagination();
}

// Helper dates
function isSameDay(d1, d2) {
    return d1.getFullYear() === d2.getFullYear() &&
        d1.getMonth() === d2.getMonth() &&
        d1.getDate() === d2.getDate();
}

function isSameMonth(d1, d2) {
    return d1.getFullYear() === d2.getFullYear() &&
        d1.getMonth() === d2.getMonth();
}

function isSameWeek(d1, d2) {
    const oneDay = 24 * 60 * 60 * 1000;
    const diffDays = Math.round(Math.abs((d1 - d2) / oneDay));
    return diffDays <= 7; // Rough approximation, can be improved
}

const API_KWITANSI = "http://127.0.0.1:8000/api/kwitansi";

function getToken() {
    return localStorage.getItem("token");
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

function formatRupiah(angka) {
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
}

function loadKwitansi() {
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

    // Try to fetch ALL data by passing a large per_page
    // If API ignores it, we work with what we get
    const params = new URLSearchParams();
    params.append('per_page', 1000);

    fetch(`${API_KWITANSI}?${params.toString()}`, {
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                throw new Error("Gagal memuat data Kwitansi");
            }
            return res.json();
        })
        .then(res => {
            console.log("Response dari API:", res);
            // Handle if response is { data: [...] } or just [...]
            let data = [];
            if (Array.isArray(res)) {
                data = res;
            } else if (res.data && Array.isArray(res.data)) {
                data = res.data;
            }

            allData = data;
            // Initial render
            applyFilterAndRender();
        })
        .catch(err => {
            console.error("Error:", err);
            const body = document.querySelector("#tabelKwitansi tbody");
            if (body) body.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Gagal memuat data Kwitansi!</td></tr>`;
        });
}

function renderKwitansi(data, startNo = 1) {
    const body = document.querySelector("#tabelKwitansi tbody");
    if (!body) return;

    body.innerHTML = "";

    if (!data || data.length === 0) {
        body.innerHTML = `<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada data Kwitansi.</td></tr>`;
        return;
    }

    let no = startNo;

    data.forEach(item => {
        body.innerHTML += `
        <tr>
            <td class="text-center">${no++}</td>
            <td><strong>${item.nomor_kwitansi || "-"}</strong></td>
            <td class="text-center">${formatDate(item.tanggal)}</td>
            <td>${item.nama_penerima || "-"}</td>
            <td>${(item.keterangan || "-").replace(' [SIG:Dewi]', '').replace('[SIG:Dewi]', '')}</td>
            <td class="text-center fw-semibold">
                ${formatRupiah(item.total_pembayaran || 0)}
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                    <a href="detail-kwitansi/${item.id}" class="btn btn-sm btn-light border" title="Lihat Detail">
                        <i class="mdi mdi-eye-outline text-info"></i>
                    </a>
                    <a href="print-kwitansi/${item.id}" class="btn btn-sm btn-light border" title="Print Kwitansi">
                        <i class="mdi mdi-printer text-dark"></i>
                    </a>
                    <button class="btn btn-sm btn-light border" onclick="deleteKwitansi(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete-outline text-danger"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    });
}

function renderPagination() {
    const container = document.getElementById('paginationContainer');
    const info = document.getElementById("paginationInfo");
    if (!container) return;

    container.innerHTML = '';

    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startItem = (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(startItem + itemsPerPage - 1, totalItems);

    if (info) {
        if (totalItems === 0) {
            info.innerText = `Menampilkan 0 kwitansi`;
        } else {
            info.innerText = `Menampilkan ${startItem}–${endItem} dari ${totalItems} kwitansi`;
        }
    }

    if (totalPages <= 1) return;

    // Previous
    const prevDisabled = currentPage === 1 ? 'disabled' : '';
    container.innerHTML += `
        <li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPage - 1})" aria-label="Previous">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>
    `;

    // Pages
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            const active = i === currentPage ? 'active' : '';
            container.innerHTML += `
                <li class="page-item ${active}">
                    <a class="page-link" href="#" onclick="event.preventDefault(); changePage(${i})">${i}</a>
                </li>
            `;
        } else if (i === currentPage - 2 || i === currentPage + 2) {
            container.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }

    // Next
    const nextDisabled = currentPage === totalPages ? 'disabled' : '';
    container.innerHTML += `
        <li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPage + 1})" aria-label="Next">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    `;
}

function changePage(page) {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderCurrentPage();
}

function submitFormKwitansi(formData) {
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

    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // WORKAROUND: Append signer to keterangan if backend doesn't support penandatangan
    if (data.penandatangan && data.penandatangan.includes('Dewi')) {
        data.keterangan = (data.keterangan || '') + ' [SIG:Dewi]';
    }

    if (data.total_pembayaran) {
        data.total_pembayaran = data.total_pembayaran.replace(/\./g, '');
    }
    delete data.status;

    fetch(API_KWITANSI, {
        method: "POST",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                try {
                    const json = JSON.parse(text);
                    if (json.message) throw new Error(json.message);
                } catch (e) { }
                throw new Error("Gagal menyimpan Kwitansi: " + text.substring(0, 100));
            }
            return res.json();
        })
        .then(res => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Kwitansi berhasil disimpan!',
                timer: 1500,
                showConfirmButton: false
            });

            const modalEl = document.getElementById('modalTambahKwitansi');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            document.getElementById("formKwitansi").reset();
            loadKwitansi();
        })
        .catch(err => {
            console.error("Error:", err);
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyimpan Kwitansi! ' + err.message
            });
        });
}

function deleteKwitansi(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data kwitansi akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
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

            fetch(`${API_KWITANSI}/${id}`, {
                method: "DELETE",
                headers: headers
            })
                .then(async res => {
                    if (!res.ok) {
                        const text = await res.text();
                        throw new Error("Gagal menghapus Kwitansi");
                    }
                    return res.json();
                })
                .then(res => {
                    Swal.fire(
                        'Terhapus!',
                        'Data kwitansi berhasil dihapus.',
                        'success'
                    );
                    loadKwitansi();
                })
                .catch(err => {
                    console.error("Error:", err);
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                });
        }
    });
}