
document.addEventListener("DOMContentLoaded", function() {
    loadStok();
});

const API_URL = "http://127.0.0.1:8000/api/stoks"; 

function getToken() {
    const token = localStorage.getItem("token");
    if (!token) console.error("Token tidak ditemukan!");
    return token;
}


function loadStok() {
    const token = getToken();
    if (!token) return;

    fetch(API_URL, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(async res => {
        if (!res.ok) {
            const text = await res.text();
            console.error("RESPON ERROR:", text);
            throw new Error("Gagal memuat data stok");
        }
        return res.json();
    })
    .then(res => renderStok(res.data))
    .catch(err => {
        console.error("Error:", err);
        const body = document.getElementById("stok-table-body");
        body.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Gagal memuat data stok!</td></tr>`;
    });
}


function renderStok(data) {
    const body = document.getElementById("stok-table-body");
    body.innerHTML = "";

    if (!data || data.length === 0) {
        body.innerHTML = `<tr><td colspan="6" class="text-center py-3 text-muted">Tidak ada data stok.</td></tr>`;
        return;
    }

    data.forEach(item => {
        const foto = item.foto 
            ? `http://127.0.0.1:8000/storage/${item.foto}` 
            : 'assets/images/placeholder.png';

        let badge = "";
        if (item.jumlah >= 5) badge = `<span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Stok Aman</span>`;
        else if (item.jumlah > 0) badge = `<span class="badge bg-warning-subtle text-warning fw-semibold px-3 py-2">Stok Menipis</span>`;
        else badge = `<span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">Stok Habis</span>`;

        body.innerHTML += `
    <tr>
        <td class="text-center"><img src="${foto}" class="rounded" width="60" height="60"></td>

        <td>
            <h6 class="fw-semibold mb-1 text-dark">${item.nama_barang || "-"}</h6>
            <small class="text-muted">${item.deskripsi || ""}</small>
        </td>

        <td class="text-center">
            ${item.tgl_masuk ? item.tgl_masuk : "-"}
        </td>

        <td class="text-center fw-semibold">
            Rp${Number(item.harga).toLocaleString("id-ID")}
        </td>

        <td class="text-center">${badge}</td>

        <td class="text-center fw-semibold">${item.jumlah}</td>

        <td class="text-center">
            <button class="btn btn-sm btn-light border me-1" onclick="updateStok(${item.id})"><i class="mdi mdi-square-edit-outline text-primary"></i></button>
            <button class="btn btn-sm btn-light border me-1" onclick="getStokDetail(${item.id})"><i class="mdi mdi-eye-outline text-muted"></i></button>
            <button class="btn btn-sm btn-light border" onclick="deleteStok(${item.id})"><i class="mdi mdi-delete-outline text-danger"></i></button>
        </td>
    </tr>
`;

    });
}


async function getStokDetail(id) {
    try {
        const response = await fetch(`/stoks/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Detail Stok:', data);
        
        return data; 
        
    } catch (error) {
        console.error('Gagal mengambil detail stok:', error);
    }
}

async function updateStok(id, updatedStokData) {
    try {
        const response = await fetch(`/stoks/${id}`, {
            method: 'PUT', 
            headers: {
                'Content-Type': 'application/json',
                
            },
            body: JSON.stringify(updatedStokData),
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const result = await response.json();
        alert('Stok berhasil diperbarui!');
        console.log('Hasil Update:', result);
        
    } catch (error) {
        console.error('Gagal memperbarui stok:', error);
    }
}

function deleteStok(id) {
    if (!confirm("Apakah Anda yakin ingin menghapus stok ini?")) return;

    const token = getToken();
    if (!token) return;

    fetch(`${API_URL}/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(async res => {
        if (!res.ok) {
            const text = await res.text();
            console.error("RESPON ERROR:", text);
            throw new Error("Gagal menghapus stok");
        }
        return res.json();
    })
    .then(res => {
        alert(res.message || "Stok berhasil dihapus!");
        loadStok();
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Gagal menghapus stok!");
    });
}

function submitTambahStok() {
    const token = localStorage.getItem("token");
    if (!token) return alert("Token tidak ditemukan!");

    const formData = new FormData();

    formData.append('nama_barang', document.getElementById('namaBarang').value);
    formData.append('harga', document.getElementById('hargaJual').value);
    formData.append('jumlah', document.getElementById('jumlah').value);
    formData.append('tgl_masuk', document.getElementById('tgl_masuk').value || new Date().toISOString().split('T')[0]);
    formData.append('user_id', 1);

    const foto = document.getElementById('uploadFoto').files[0];
    if (foto) formData.append('foto', foto);

    const video = document.getElementById('uploadVideo').files[0];
    if (video) formData.append('video', video);

    fetch("http://127.0.0.1:8000/api/stoks", {
        method: "POST",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        body: formData,
    })
    .then(async res => {
        if (!res.ok) {
            const text = await res.text();
            console.error("RESPON ERROR:", text);
            throw new Error("Gagal menambah stok");
        }
        return res.json();
    })
    .then(res => {
        alert(res.message || "Stok berhasil ditambahkan!");

        document.getElementById('formTambahStok').reset();

        const modal = bootstrap.Modal.getInstance(document.getElementById('modalTambahStok'));
        modal.hide();

        setTimeout(() => {
            location.reload();
        }, 500);
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Gagal menambah stok!");
    });
}
