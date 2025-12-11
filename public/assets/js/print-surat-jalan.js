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
    } else if (cleanKeterangan.includes('[SIG:Heri]')) {
        signer = "Heri Pirdaus, S.Tr.Kes Rad (MRI)";
        cleanKeterangan = cleanKeterangan.replace(' [SIG:Heri]', '').replace('[SIG:Heri]', '');
    }

    setText("printKeterangan", cleanKeterangan);

    // Signature Logic
    const signatureImg = document.getElementById('printSignature');

    if (signer && signer.toLowerCase().includes('dewi')) {
        signatureImg.src = '/assets/images/ttd dewi.jpeg';
        signatureImg.style.display = 'block';
    } else if (signer && signer.toLowerCase().includes('heri')) {
        signatureImg.src = '/assets/images/ttd heri.png';
        signatureImg.style.display = 'block';
    } else {
        // Empty signature (use sender name)
        signatureImg.src = '';
        signatureImg.style.display = 'none';
        signer = data.nama_pengirim; // Use sender name
    }

    setText("printSignerName", signer || data.nama_pengirim || "PENGIRIM");

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