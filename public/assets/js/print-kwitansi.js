document.addEventListener("DOMContentLoaded", function () {
    // Get ID from URL
    const pathArray = window.location.pathname.split('/');
    const id = pathArray[pathArray.length - 1];

    if (id && !isNaN(id)) {
        loadPrintKwitansi(id);
    } else {
        alert("ID Kwitansi tidak valid");
    }
});

const API_KWITANSI = "http://127.0.0.1:8000/api/kwitansi";

function getToken() {
    return localStorage.getItem("token");
}

function loadPrintKwitansi(id) {
    const token = getToken();
    const headers = {
        "Accept": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    fetch(`${API_KWITANSI}/${id}`, {
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                throw new Error("Gagal memuat data kwitansi: " + res.status);
            }
            return res.json();
        })
        .then(res => {
            const data = res.data || res;
            renderPrintKwitansi(data);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal memuat data kwitansi! " + err.message);
        });
}

function renderPrintKwitansi(data) {
    setText("printNamaPenerima", data.nama_penerima);
    setText("printAlamatPenerima", data.alamat_penerima);
    setText("printTanggal", formatDate(data.tanggal));
    setText("printNomor", data.nomor_kwitansi);
    setText("printTerimaDari", data.nama_penerima);
    setText("printTerbilang", data.total_bilangan);
    setText("printKeterangan", data.keterangan);

    const total = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.total_pembayaran);
    setText("printTotal", total);

    // Optional: Auto print
    // setTimeout(() => window.print(), 1000);
}

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value || "-";
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
