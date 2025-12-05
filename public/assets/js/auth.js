
const API_URL = "http://127.0.0.1:8000/api";
const token = localStorage.getItem("token");
const tableBody = document.getElementById("admin-table-body");

let allAdmins = [];
let currentPage = 1;
const rowsPerPage = 10;

// ===== LOGIN =====
async function loginUser(email, password) {
    const res = await fetch(`${API_URL}/login`, {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({ email, password }),
    });

    const data = await res.json().catch(() => null);
    if (!res.ok) throw { message: data?.message || "Terjadi kesalahan saat login", status: res.status };
    if (data.user?.status?.toLowerCase() === "pending") throw { message: "Akun Anda belum disetujui oleh owner!", status: 403 };

    return data;
}

// ===== REGISTER =====
async function registerUser(name, email, password, password_confirmation) {
    const res = await fetch(`${API_URL}/register`, {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({ name, email, password, password_confirmation }),
    });

    if (!res.ok) {
        const errJson = await res.json().catch(() => null);
        console.error("Register failed:", errJson || res.statusText);
        throw res;
    }

    return await res.json();
}

async function fetchAdmins() {
    try {
        const res = await fetch(`${API_URL}/admins`, { headers: { Authorization: `Bearer ${token}` } });
        if (!res.ok) throw new Error("Gagal mengambil data admin");
        const data = await res.json();
        return data.data || data;
    } catch (err) {
        console.error("fetchAdmins error:", err);
        return [];
    }
}
async function loadAdmins() {
    if (!tableBody) return;
    tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-3">Memuat data...</td></tr>`;
    allAdmins = await fetchAdmins();
    displayAdmins();
}

function displayAdmins() {
    if (!tableBody) return;

    const searchValue = document.getElementById("searchInput")?.value?.toLowerCase() || "";
    const filtered = allAdmins.filter(a =>
        a.name.toLowerCase().includes(searchValue) || a.email.toLowerCase().includes(searchValue)
    );

    const start = (currentPage - 1) * rowsPerPage;
    const paginated = filtered.slice(start, start + rowsPerPage);

    tableBody.innerHTML = "";
    if (paginated.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-3">Tidak ada data</td></tr>`;
        document.getElementById("pagination").innerHTML = "";
        return;
    }

    paginated.forEach(a => {
        const statusBadge =
            a.status === "active" ? `<span class="badge bg-success-subtle text-success">Aktif</span>` :
                a.status === "pending" ? `<span class="badge bg-warning-subtle text-warning">Menunggu ACC</span>` :
                    `<span class="badge bg-secondary-subtle text-muted">Tidak Aktif</span>`;

        const initials = a.name.split(" ").map(n => n[0]).join("").substring(0, 2).toUpperCase();

        const actionBtns = a.status === "pending" ?
            `<button class="btn btn-sm bg-success-subtle me-1" onclick="approveAdmin(${a.id}, '${a.name}')">
                <i class="mdi mdi-check fs-14 text-success"></i>
             </button>
             <button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin(${a.id}, '${a.name}')">
                <i class="mdi mdi-close fs-14 text-danger"></i>
             </button>` :
            a.status === "active" ?
                `<button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin(${a.id}, '${a.name}')">
                <i class="mdi mdi-delete fs-14 text-danger"></i>
             </button>` :
                `<span class="text-muted">-</span>`;

        const lastActive = a.updated_at ? new Date(a.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

        tableBody.innerHTML += `
          <tr>
            <td><div class="avatar-initial">${initials}</div></td>
            <td>${a.name}</td>
            <td>${a.email}</td>
            <td>${statusBadge}</td>
            <td>${lastActive}</td>
            <td class="text-end">${actionBtns}</td>
          </tr>`;
    });

    setupPagination(filtered.length);
}

function setupPagination(totalRows) {
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const pagination = document.getElementById("pagination");
    if (!pagination) return;

    pagination.innerHTML = "";
    if (totalPages === 0) return;

    pagination.innerHTML += `<li><button ${currentPage === 1 ? 'disabled' : ''} onclick="goToPage(${currentPage - 1})">«</button></li>`;
    for (let i = 1; i <= totalPages; i++)
        pagination.innerHTML += `<li><button class="${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button></li>`;
    pagination.innerHTML += `<li><button ${currentPage === totalPages ? 'disabled' : ''} onclick="goToPage(${currentPage + 1})">»</button></li>`;
}

function goToPage(p) { currentPage = p; displayAdmins(); }

function approveAdmin(id, name) {
    Swal.fire({ title: `Setujui admin ${name}?`, icon: "question", showCancelButton: true, confirmButtonText: "Ya, Setujui" })
        .then(res => {
            if (res.isConfirmed)
                fetch(`${API_URL}/admins/${id}/approve`, { method: "PUT", headers: { Authorization: `Bearer ${token}` } })
                    .then(() => Swal.fire("Berhasil!", "Admin disetujui.", "success")).then(loadAdmins)
                    .catch(() => Swal.fire("Gagal!", "Gagal menyetujui admin.", "error"));
        });
}

function rejectAdmin(id, name) {
    Swal.fire({ title: `Tolak admin ${name}?`, icon: "warning", showCancelButton: true, confirmButtonText: "Ya, Tolak" })
        .then(res => {
            if (res.isConfirmed)
                fetch(`${API_URL}/admins/${id}/reject`, { method: "DELETE", headers: { Authorization: `Bearer ${token}` } })
                    .then(() => Swal.fire("Dihapus!", "Admin telah dihapus.", "success")).then(loadAdmins)
                    .catch(() => Swal.fire("Gagal!", "Gagal menghapus admin.", "error"));
        });
}

function deleteAdmin(id, name) {
    Swal.fire({
        title: `Hapus admin ${name}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus"
    }).then(res => {
        if (res.isConfirmed) {
            fetch(`${API_URL}/admins/${id}/reject`, {
                method: "DELETE",
                headers: { Authorization: `Bearer ${token}` }
            })
                .then(() => Swal.fire("Dihapus!", "Admin telah dihapus.", "success"))
                .then(loadAdmins)
                .catch(() => Swal.fire("Gagal!", "Gagal menghapus admin.", "error"));
        }
    });
}


document.getElementById("searchInput")?.addEventListener("input", () => { currentPage = 1; displayAdmins(); });


document.addEventListener("DOMContentLoaded", () => {

    document.querySelector(".btn-login")?.addEventListener("click", async e => {
        e.preventDefault();
        const email = document.getElementById("email")?.value;
        const password = document.getElementById("password")?.value;
        if (!email || !password) return console.warn("Email atau password kosong");

        try {
            const data = await loginUser(email, password);
            localStorage.setItem("token", data.token);
            localStorage.setItem("user", JSON.stringify(data.user));
            localStorage.setItem("role", data.user.role);
            window.location.href = "/dashboard";
        } catch (err) { console.error("Login error:", err); }
    });

    document.querySelector(".btn-register")?.addEventListener("click", async e => {
        e.preventDefault();
        const name = document.getElementById("name")?.value;
        const email = document.getElementById("email")?.value;
        const password = document.getElementById("password")?.value;
        const password_confirmation = document.getElementById("password_confirmation")?.value;
        if (!name || !email || !password || !password_confirmation) return console.warn("Semua field wajib diisi");
        if (password !== password_confirmation) return console.warn("Password dan konfirmasi tidak sama");

        try {
            const data = await registerUser(name, email, password, password_confirmation);
            console.log("Register berhasil:", data);
            window.location.href = "/";
        } catch (err) { console.error("Register error:", err); }
    });

    if (tableBody) loadAdmins();
});
