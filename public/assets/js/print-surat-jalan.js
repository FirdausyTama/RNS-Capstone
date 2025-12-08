document.addEventListener("DOMContentLoaded", function () {
    // Get ID from URL
    const pathArray = window.location.pathname.split('/');
    const id = pathArray[pathArray.length - 1];

    if (id && !isNaN(id)) {
        loadPrintSuratJalan(id);
    } else {
        alert("ID Surat Jalan tidak valid");
    }
});

const API_SURAT_JALAN = "http://127.0.0.1:8000/api/surat-jalan";

function getToken() {
    return localStorage.getItem("token");
}

function loadPrintSuratJalan(id) {
    const token = getToken();
    const headers = {
        "Accept": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    fetch(`${API_SURAT_JALAN}/${id}`, {
        method: "GET",
        headers: headers
    })
        .then(async res => {
            if (!res.ok) {
                throw new Error("Gagal memuat data surat jalan: " + res.status);
            }
            return res.json();
        })
        .then(res => {
            const data = res.data || res;
            renderPrintSuratJalan(data);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal memuat data surat jalan! " + err.message);
        });
}

function renderPrintSuratJalan(data) {
    setText("printNamaPenerima", data.nama_penerima);
    setText("printAlamatPenerima", data.alamat_penerima);
    setText("printTelpPenerima", data.telp_penerima);
    setText("printTanggal", formatDate(data.tanggal));

    // New Layout Fields
    setText("printNamaBarang", data.nama_barang_jasa);
    setText("printQty", data.qty);
    setText("printJumlah", data.qty); // Qty and Jumlah are the same in this context
    setText("printNamaPenerimaSign", data.nama_penerima);

    // Detect Signer from Keterangan (Workaround)
    let signer = data.penandatangan;
    let cleanKeterangan = data.keterangan || "";

    if (cleanKeterangan.includes('[SIG:Dewi]')) {
        signer = "Dewi Sulistiowati";
        cleanKeterangan = cleanKeterangan.replace(' [SIG:Dewi]', '').replace('[SIG:Dewi]', '');
    }

    setText("printKeterangan", cleanKeterangan);

    // Signature Logic
    const signatureImg = document.getElementById('printSignature');
    const signerName = document.getElementById('printSignerName');

    // Check if signer contains "Dewi" (case insensitive)
    if (signer && signer.toLowerCase().includes('dewi')) {
        signatureImg.src = '/assets/images/ttd dewi.jpeg';
    } else if (signer && signer.toLowerCase().includes('arya')) {
        signatureImg.src = '/assets/images/ttd arya.png';
    } else if (signer && signer.toLowerCase().includes('heri')) {
        signatureImg.src = '/assets/images/ttd heri.png';
    } else {
        // Default to Arya if not specified (as requested)
        signatureImg.src = '/assets/images/ttd arya.png';
    }

    setText("printSignerName", signer || "MUHAMMAD ARYA");

    // Auto print
    setTimeout(() => window.print(), 1000);
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
