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

const API_KWITANSI = "http://127.0.0.1:8000/api/kwitansi";

function getToken() {
    // In a real app, you might store this in localStorage or cookie. 
    // For this Laravel app, if we are using Sanctum/Passport with web routes, 
    // we might rely on the session cookie or a meta tag.
    // However, the user example used localStorage.getItem("token").
    // I will stick to the user's pattern but also check for a meta tag if needed later.
    const token = localStorage.getItem("token");
    // if (!token) console.error("Token tidak ditemukan!");
    return token;
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
    // Note: If the API is protected by Sanctum and we are on the same domain, 
    // we might not need the Bearer token if axios/fetch sends cookies. 
    // But following the user's example which explicitly uses a token.
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

    fetch(API_KWITANSI, {
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal memuat data Kwitansi");
            }
            return res.json();
        })
        .then(res => {
            console.log("Response dari API:", res);
            // Assuming the API returns { data: [...] } or just [...]
            // Adjust based on actual API response structure. 
            // Laravel Resource collections usually return { data: [...] }
            const data = res.data || res;
            renderKwitansi(data);
        })
        .catch(err => {
            console.error("Error:", err);
            const body = document.querySelector("#tabelKwitansi tbody");
            if (body) body.innerHTML = `<tr><td colspan="8" class="text-center text-danger">Gagal memuat data Kwitansi!</td></tr>`;
        });
}

function renderKwitansi(data) {
    const body = document.querySelector("#tabelKwitansi tbody");
    if (!body) return;

    body.innerHTML = "";

    if (!data || data.length === 0) {
        body.innerHTML = `<tr><td colspan="8" class="text-center py-3 text-muted">Tidak ada data Kwitansi.</td></tr>`;
        return;
    }

    let no = 1;

    data.forEach(item => {
        let badge = "";
        const status = (item.status || "").toLowerCase();

        if (status === "lunas")
            badge = `<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>`;
        else if (status === "belum lunas")
            badge = `<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Belum Lunas</span>`;
        else if (status === "menunggu verifikasi")
            badge = `<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Menunggu Verifikasi</span>`;
        else if (status === "belum diterima")
            badge = `<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Belum Diterima</span>`;
        else
            badge = `<span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">${item.status || "-"}</span>`;

        body.innerHTML += `
        <tr>
            <td class="text-center">${no++}</td>
            <td><strong>${item.nomor_kwitansi || "-"}</strong></td>
            <td class="text-center">${formatDate(item.tanggal)}</td>
            <td>${item.nama_penerima || "-"}</td>
            <td>${item.keterangan || "-"}</td>
            <td class="text-center fw-semibold">
                ${formatRupiah(item.total_pembayaran || 0)}
            </td>
            <td class="text-center">
                ${badge}
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

    // Update pagination info if needed (static for now based on user code)
    const info = document.querySelector(".text-muted.small");
    if (info) info.innerText = `Menampilkan ${data.length} kwitansi`;
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

    // Clean up currency format for total_pembayaran
    if (data.total_pembayaran) {
        data.total_pembayaran = data.total_pembayaran.replace(/\./g, '');
    }

    console.log("Data yang akan dikirim:", data);

    fetch(API_KWITANSI, {
        method: "POST",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                // Try to parse JSON error if possible
                try {
                    const json = JSON.parse(text);
                    if (json.message) {
                        throw new Error(json.message);
                    }
                } catch (e) { }
                throw new Error("Gagal menyimpan Kwitansi: " + text.substring(0, 100));
            }
            return res.json();
        })
        .then(res => {
            console.log("Kwitansi berhasil disimpan:", res);
            alert("Kwitansi berhasil disimpan!");

            // Close modal
            const modalEl = document.getElementById('modalTambahKwitansi');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Reset form
            document.getElementById("formKwitansi").reset();

            loadKwitansi(); // Reload data
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal menyimpan Kwitansi! " + err.message);
        });
}

function deleteKwitansi(id) {
    if (!confirm("Apakah Anda yakin ingin menghapus Kwitansi ini?")) {
        return;
    }

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
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal menghapus Kwitansi");
            }
            return res.json();
        })
        .then(res => {
            console.log("Kwitansi berhasil dihapus:", res);
            alert("Kwitansi berhasil dihapus!");
            loadKwitansi(); // Reload data
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal menghapus Kwitansi!");
        });
}

function searchKwitansi() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toUpperCase();
    let table = document.getElementById('tabelKwitansi');
    let tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        let tdNo = tr[i].getElementsByTagName('td')[1]; // Nomor Kwitansi
        let tdKlien = tr[i].getElementsByTagName('td')[3]; // Nama Klien
        if (tdNo || tdKlien) {
            let txtNo = tdNo ? (tdNo.textContent || tdNo.innerText) : '';
            let txtKlien = tdKlien ? (tdKlien.textContent || tdKlien.innerText) : '';
            if (txtNo.toUpperCase().indexOf(filter) > -1 || txtKlien.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}
