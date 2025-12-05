document.addEventListener("DOMContentLoaded", function () {
    // Get ID from URL
    const pathArray = window.location.pathname.split('/');
    const id = pathArray[pathArray.length - 1];

    if (id && !isNaN(id)) {
        loadDetailSuratJalan(id);

        // Set print button link (if exists)
        const btnCetak = document.getElementById("btnCetak");
        if (btnCetak) {
            btnCetak.href = `/print-surat-jalan/${id}`;
        }

        // Setup Update Button Handler
        const btnUpdate = document.getElementById("btnUpdateSuratJalan");
        if (btnUpdate) {
            btnUpdate.addEventListener("click", function () {
                const form = document.getElementById("formEditSuratJalan");
                if (form.checkValidity()) {
                    const formData = new FormData(form);
                    updateSuratJalan(id, formData);
                } else {
                    form.reportValidity();
                }
            });
        }
    } else {
        alert("ID Surat Jalan tidak valid");
    }
});

const API_SURAT_JALAN = "http://127.0.0.1:8000/api/surat-jalan";

function getToken() {
    return localStorage.getItem("token");
}

function loadDetailSuratJalan(id) {
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
            renderDetailSuratJalan(data);
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal memuat data surat jalan! " + err.message);
        });
}

function renderDetailSuratJalan(data) {
    // Populate View
    setText("detailNomor", data.nomor_surat_jalan);
    setText("detailTanggal", formatDate(data.tanggal));
    setText("detailNamaPengirim", data.nama_pengirim);
    setText("detailNamaPenerima", data.nama_penerima);
    setText("detailAlamatPenerima", data.alamat_penerima);
    setText("detailTelpPenerima", data.telp_penerima);
    setText("detailNamaBarang", data.nama_barang_jasa);
    setText("detailQty", data.qty);
    setText("detailKeterangan", data.keterangan);

    const jumlah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.jumlah || 0);
    setText("detailJumlah", jumlah);

    // Populate Edit Form
    setVal("editNomor", data.nomor_surat_jalan);
    setVal("editTanggal", data.tanggal);
    setVal("editNamaPengirim", data.nama_pengirim);
    setVal("editNamaPenerima", data.nama_penerima);
    setVal("editAlamatPenerima", data.alamat_penerima);
    setVal("editTelpPenerima", data.telp_penerima);
    setVal("editNamaBarang", data.nama_barang_jasa);
    setVal("editQty", data.qty);
    setVal("editJumlah", data.jumlah);
    setVal("editKeterangan", data.keterangan);
}

function updateSuratJalan(id, formData) {
    const token = getToken();
    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json"
    };
    if (token) {
        headers["Authorization"] = "Bearer " + token;
    }

    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    fetch(`${API_SURAT_JALAN}/${id}`, {
        method: "PUT",
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error("RESPON ERROR:", text);
                throw new Error("Gagal mengupdate Surat Jalan");
            }
            return res.json();
        })
        .then(res => {
            console.log("Update Success:", res);
            alert("Surat Jalan berhasil diupdate!");

            // Close modal
            const modalEl = document.getElementById('modalEditSuratJalan');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            loadDetailSuratJalan(id); // Reload data
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Gagal mengupdate Surat Jalan");
        });
}

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
