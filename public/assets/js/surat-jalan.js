document.addEventListener("DOMContentLoaded", function () {
    loadSuratJalan();

    const btnSimpan = document.getElementById("btnSimpanSuratJalan");
    if (btnSimpan) {
        btnSimpan.addEventListener("click", submitFormSuratJalan);
    }
});

const API_SURAT_JALAN = "http://127.0.0.1:8000/api/surat-jalan";

function getToken() {
    return localStorage.getItem("token");
}

function loadSuratJalan() {
    const token = getToken();
    const headers = {
        "Accept": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    fetch(API_SURAT_JALAN, {
        method: "GET",
        headers: headers
    })
        .then(res => {
            if (!res.ok) throw new Error("Gagal memuat data surat jalan");
            return res.json();
        })
        .then(res => {
            const data = res.data || res;
            renderTable(data);
        })
        .catch(err => {
            console.error("Error:", err);
            // alert("Gagal memuat data surat jalan");
        });
}

function renderTable(data) {
    const tbody = document.querySelector("#tabelSuratJalan tbody");
    if (!tbody) return;

    tbody.innerHTML = "";
    let no = 1;

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" class="text-center">Belum ada data surat jalan</td></tr>`;
        return;
    }

    data.forEach(item => {
        tbody.innerHTML += `
        <tr>
            <td class="text-center">${no++}</td>
            <td class="text-center">${formatDate(item.tanggal)}</td>
            <td>${item.nama_penerima || "-"}</td>
            <td>${item.alamat_penerima || "-"}</td>
            <td>${item.nama_barang_jasa || "-"}</td>
            <td class="text-center">${item.qty || "0"}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                    <a href="detail-surat-jalan/${item.id}" class="btn btn-sm btn-light border" title="Lihat Detail">
                        <i class="mdi mdi-eye-outline text-info"></i>
                    </a>
                    <a href="print-surat-jalan/${item.id}" class="btn btn-sm btn-light border" title="Print Surat Jalan">
                        <i class="mdi mdi-printer text-dark"></i>
                    </a>
                    <button class="btn btn-sm btn-light border" onclick="deleteSuratJalan(${item.id})" title="Hapus">
                        <i class="mdi mdi-delete-outline text-danger"></i>
                    </button>
                </div>
            </td>
        </tr>
        `;
    });
}

function submitFormSuratJalan() {
    const form = document.getElementById("formSuratJalan");
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    const token = getToken();
    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        headers["X-CSRF-TOKEN"] = csrfToken;
    }

    fetch(API_SURAT_JALAN, {
        method: "POST",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal menyimpan surat jalan");
            }
            return res.json();
        })
        .then(res => {
            alert("Surat Jalan berhasil disimpan!");
            const modalEl = document.getElementById('modalTambahSuratJalan');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
            form.reset();
            loadSuratJalan();
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal menyimpan surat jalan! " + err.message);
        });
}

function deleteSuratJalan(id) {
    if (!confirm("Apakah Anda yakin ingin menghapus surat jalan ini?")) return;

    const token = getToken();
    const headers = {
        "Accept": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        headers["X-CSRF-TOKEN"] = csrfToken;
    }

    fetch(`${API_SURAT_JALAN}/${id}`, {
        method: "DELETE",
        headers: headers
    })
        .then(res => {
            if (!res.ok) throw new Error("Gagal menghapus data");
            return res.json();
        })
        .then(res => {
            alert("Data berhasil dihapus");
            loadSuratJalan();
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal menghapus data");
        });
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
