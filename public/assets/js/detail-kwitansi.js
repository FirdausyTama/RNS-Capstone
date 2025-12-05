document.addEventListener("DOMContentLoaded", function () {
    // Get ID from URL
    const pathArray = window.location.pathname.split('/');
    const id = pathArray[pathArray.length - 1];

    if (id && !isNaN(id)) {
        loadDetailKwitansi(id);

        // Setup Edit Button Handler
        const btnUpdate = document.getElementById("btnUpdateKwitansi");
        if (btnUpdate) {
            btnUpdate.addEventListener("click", function () {
                const form = document.getElementById("formEditKwitansi");
                if (form.checkValidity()) {
                    const formData = new FormData(form);
                    updateKwitansi(id, formData);
                } else {
                    form.reportValidity();
                }
            });
        }
    } else {
        console.error("ID Kwitansi tidak valid");
        alert("ID Kwitansi tidak valid");
    }
});

const API_KWITANSI = "http://127.0.0.1:8000/api/kwitansi";

function getToken() {
    return localStorage.getItem("token");
}

function formatRupiah(angka) {
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
}

function loadDetailKwitansi(id) {
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
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal memuat detail Kwitansi: " + res.status + " " + res.statusText);
            }
            return res.json();
        })
        .then(res => {
            console.log("Response Detail:", res);
            const data = res.data || res;
            renderDetailKwitansi(data);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal memuat detail kwitansi! " + err.message);
        });
}

function renderDetailKwitansi(data) {
    // Populate View
    setText("nomor_kwitansi", data.nomor_kwitansi);
    setText("tanggal", formatDate(data.tanggal));
    setText("nama_penerima", data.nama_penerima);
    setText("alamat_penerima", data.alamat_penerima);
    setText("keterangan", data.keterangan);
    setText("total_pembayaran", formatRupiah(data.total_pembayaran));
    setText("total_bilangan", data.total_bilangan);
    setText("created_at", data.created_at ? new Date(data.created_at).toLocaleString('id-ID') : '-');

    // Status Badge
    const statusEl = document.getElementById("status");
    if (statusEl) {
        let statusHtml = '';
        const status = (data.status || "").toLowerCase();
        if (status === 'lunas') {
            statusHtml = '<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Lunas</span>';
        } else if (status === 'belum lunas') {
            statusHtml = '<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Belum Lunas</span>';
        } else if (status === 'belum diterima') {
            statusHtml = '<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Belum Diterima</span>';
        } else {
            statusHtml = `<span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">${data.status || '-'}</span>`;
        }
        statusEl.innerHTML = statusHtml;
    }

    // Populate Edit Form
    setVal("editNomorKwitansi", data.nomor_kwitansi);
    setVal("editTanggal", data.tanggal);
    setVal("editNamaPenerima", data.nama_penerima);
    setVal("editAlamat", data.alamat_penerima);
    setVal("editTotalBilangan", data.total_bilangan);
    setVal("editKeterangan", data.keterangan);
    setVal("editTotalPembayaran", parseInt(data.total_pembayaran));
    setVal("editStatus", data.status);
}

function updateKwitansi(id, formData) {
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

    // Clean up currency
    if (data.total_pembayaran) {
        data.total_pembayaran = data.total_pembayaran.toString().replace(/\./g, '');
    }

    fetch(`${API_KWITANSI}/${id}`, {
        method: "PUT",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal mengupdate Kwitansi");
            }
            return res.json();
        })
        .then(res => {
            console.log("Update Success:", res);
            alert("Kwitansi berhasil diupdate!");

            // Close modal
            const modalEl = document.getElementById('modalEditKwitansi');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            loadDetailKwitansi(id); // Reload data
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal mengupdate Kwitansi");
        });
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
