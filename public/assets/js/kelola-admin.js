// Avoid redeclaration errors
if (typeof window.API_URL === 'undefined') {
    window.API_URL = "http://127.0.0.1:8000/api";
}

// Global functions need to be defined on window
window.openCreateModal = null;
window.editUser = null;
window.deleteUser = null;
window.approveAdmin = null;
window.rejectAdmin = null;

document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");

    // Check auth
    if (!token) {
        window.location.href = "/";
        return;
    }

    const tableBody = document.querySelector("#admin-table-body");
    const modalTitle = document.getElementById("modalTitle");
    const adminForm = document.getElementById("adminForm");
    const adminIdInput = document.getElementById("adminId");
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const passwordConfirmInput = document.getElementById("password_confirmation");
    const roleInput = document.getElementById("role");
    const statusInput = document.getElementById("status");
    const searchInput = document.getElementById("searchInput");
    
    // Modal instance
    const adminModal = new bootstrap.Modal(document.getElementById("adminModal"));

    let allUsers = [];

    // Fetch and render users
    async function fetchUsers() {
        try {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center">Memuat data...</td></tr>`;
            
            // Changed from /users to /admins based on auth.js
            const res = await fetch(`${window.API_URL}/admins`, {
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                }
            });

            if (!res.ok) throw new Error("Gagal mengambil data user");

            const responseData = await res.json();
            allUsers = responseData.data || [];

            renderTable(allUsers);
        } catch (error) {
            console.error(error);
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>`;
            Swal.fire("Error", "Gagal memuat data user", "error");
        }
    }

    function renderTable(users) {
        if (users.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
            return;
        }

        tableBody.innerHTML = users.map(user => {
            const initials = user.name
                .split(" ")
                .map(n => n[0])
                .join("")
                .substring(0, 2)
                .toUpperCase();

            let statusBadge = user.status === 'active' 
                ? '<span class="badge bg-success-subtle text-success">Aktif</span>'
                : '<span class="badge bg-warning-subtle text-warning">Pending</span>';

            const lastActive = user.updated_at ? new Date(user.updated_at).toLocaleDateString("id-ID") : "-";

            // Determine actions based on status
            let actions = '';
            
            if (user.status === 'pending') {
                 actions = `
                    <button class="btn btn-sm bg-success-subtle me-1" onclick="approveAdmin('${user.id}', '${user.name.replace(/'/g,"\\'")}')">
                      <i class="mdi mdi-check fs-14 text-success"></i>
                    </button>
                    <button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin('${user.id}', '${user.name.replace(/'/g,"\\'")}')">
                      <i class="mdi mdi-close fs-14 text-danger"></i>
                    </button>`;
            } else {
                 actions = `
                    <button class="btn btn-sm btn-info me-1" onclick="editUser('${user.id}')">
                        <i class="mdi mdi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser('${user.id}', '${user.name}')">
                        <i class="mdi mdi-delete"></i>
                    </button>`;
            }

            return `
                <tr>
                    <td><div class="avatar-initial">${initials}</div></td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${statusBadge}</td>
                    <td>${lastActive}</td>
                    <td class="text-end">
                        ${actions}
                    </td>
                </tr>
            `;
        }).join("");
    }

    const phoneInput = document.getElementById("phone");
    const religionInput = document.getElementById("religion");
    const provinceSelect = document.getElementById("province");
    const regencySelect = document.getElementById("regency");
    const districtSelect = document.getElementById("district");
    
    // --- Validation Logic ---
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    emailInput.addEventListener("input", function() {
        if (!emailRegex.test(this.value) && this.value !== "") {
            this.classList.add("is-invalid");
        } else {
            this.classList.remove("is-invalid");
        }
    });

    phoneInput.addEventListener("input", function() {
        // Remove non-numeric characters
        if (/\D/.test(this.value)) {
            this.classList.add("is-invalid");
             // Optional: strict enforce -> this.value = this.value.replace(/\D/g, '');
        } else {
            this.classList.remove("is-invalid");
        }
    });

    const BASE_REGION_URL = "https://www.emsifa.com/api-wilayah-indonesia/api";

    async function loadProvinces() {
        try {
            const res = await fetch(`${BASE_REGION_URL}/provinces.json`);
            const provinces = await res.json();
            
            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(p => {
                const opt = document.createElement("option");
                opt.value = p.id; // Use ID for fetching regencies
                opt.dataset.name = p.name; // Store name if needed
                opt.textContent = p.name;
                provinceSelect.appendChild(opt);
            });
            provinceSelect.disabled = false;
        } catch (error) {
            console.error("Gagal memuat provinsi:", error);
        }
    }

    async function loadRegencies(provinceId) {
        if (!provinceId) {
            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            regencySelect.disabled = true;
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districtSelect.disabled = true;
            return;
        }

        try {
            regencySelect.innerHTML = '<option value="">Memuat...</option>';
            regencySelect.disabled = true;
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districtSelect.disabled = true;

            const res = await fetch(`${BASE_REGION_URL}/regencies/${provinceId}.json`);
            const regencies = await res.json();

            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            regencies.forEach(r => {
                const opt = document.createElement("option");
                opt.value = r.id; 
                opt.dataset.name = r.name;
                opt.textContent = r.name;
                regencySelect.appendChild(opt);
            });
            regencySelect.disabled = false;
        } catch (error) {
            console.error("Gagal memuat kabupaten:", error);
            regencySelect.innerHTML = '<option value="">Gagal memuat data</option>';
        }
    }

    async function loadDistricts(regencyId) {
        if (!regencyId) {
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districtSelect.disabled = true;
            return;
        }

        try {
            districtSelect.innerHTML = '<option value="">Memuat...</option>';
            districtSelect.disabled = true;

            const res = await fetch(`${BASE_REGION_URL}/districts/${regencyId}.json`);
            const districts = await res.json();

            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districts.forEach(d => {
                const opt = document.createElement("option");
                opt.value = d.id; 
                opt.dataset.name = d.name;
                opt.textContent = d.name;
                districtSelect.appendChild(opt);
            });
            districtSelect.disabled = false;
        } catch (error) {
            console.error("Gagal memuat kecamatan:", error);
            districtSelect.innerHTML = '<option value="">Gagal memuat data</option>';
        }
    }

    provinceSelect.addEventListener("change", (e) => {
        loadRegencies(e.target.value);
    });

    regencySelect.addEventListener("change", (e) => {
        loadDistricts(e.target.value);
    });

    // Initial load
    loadProvinces();
    fetchUsers();


    // Search Logic
    if (searchInput) {
        searchInput.addEventListener("input", (e) => {
            const term = e.target.value.toLowerCase();
            const filtered = allUsers.filter(user => 
                user.name.toLowerCase().includes(term) || 
                user.email.toLowerCase().includes(term)
            );
            renderTable(filtered);
        });
    }

    // Assign global functions
    window.openCreateModal = function() {
        modalTitle.innerHTML = `<i class="mdi mdi-account-plus text-primary me-2"></i>Tambah Admin`;
        adminForm.reset();
        adminIdInput.value = "";
        passwordInput.required = true; 
        passwordConfirmInput.required = true;
        
        // Ensure Role & Status are visible
        const roleField = document.getElementById("roleField");
        const statusField = document.getElementById("statusField");
        if(roleField) roleField.classList.remove("d-none");
        if(statusField) statusField.classList.remove("d-none");

        // Default Active when Admin creates user
        if (statusInput) statusInput.value = "active";
        if (roleInput) roleInput.value = "admin";

        // Reset Validation Styles
        emailInput.classList.remove("is-invalid");
        if(phoneInput) phoneInput.classList.remove("is-invalid");
        regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        regencySelect.disabled = true;
        if(districtSelect) {
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districtSelect.disabled = true;
        }
        
        adminModal.show();
    };

    window.editUser = async function(id) {
        try {
            // Check if we can fetch single admin, using /admins/{id} or /users/{id}
            // Based on list being /admins, we try /admins/{id} first
            const res = await fetch(`${window.API_URL}/admins/${id}`, {
                headers: { "Authorization": `Bearer ${token}` }
            });

            // Fallback for demo if endpoint not found but list works
            // In real app, make sure route exists.
            if (!res.ok) {
                 // Try client-side find if server fetch fails (temporary fallback)
                 const user = allUsers.find(u => u.id == id);
                 if(user) {
                     await loadModalWithUser(user);
                     adminModal.show();
                     return;
                 }
                 throw new Error("Gagal mengambil detail user");
            }

            const responseData = await res.json();
            const user = responseData.data || responseData;
            await loadModalWithUser(user);
            adminModal.show();

        } catch (error) {
            Swal.fire("Error", "Gagal mengambil detail user", "error");
        }
    };
    
    async function loadModalWithUser(user) {
        adminIdInput.value = user.id;
        nameInput.value = user.name;
        emailInput.value = user.email;
        roleInput.value = user.role; 
        statusInput.value = user.status;
        
        // Populate new fields
        if(phoneInput) phoneInput.value = user.phone_number || "";
        if(religionInput) religionInput.value = user.religion_id || user.religion || ""; // Handle ID/Text mismatch resilience

        // Async Region Population
        if (user.province_id) {
            provinceSelect.value = user.province_id;
            await loadRegencies(user.province_id); // Wait for dropdown to populate
            
            if (user.regency_id) {
                regencySelect.value = user.regency_id;
                await loadDistricts(user.regency_id); // Wait for dropdown to populate
                
                if (user.district_id) {
                    districtSelect.value = user.district_id;
                }
            }
        } else {
             // Reset if no data
             regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
             regencySelect.disabled = true;
             districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
             districtSelect.disabled = true;
        }

        // Ensure Role & Status are visible
        const roleField = document.getElementById("roleField");
        const statusField = document.getElementById("statusField");
        if(roleField) roleField.classList.remove("d-none");
        if(statusField) statusField.classList.remove("d-none");
        
        // Password optional for edit
        passwordInput.value = "";
        passwordConfirmInput.value = "";
        passwordInput.required = false;
        passwordConfirmInput.required = false;
        
        // Reset validation
        emailInput.classList.remove("is-invalid");
        if(phoneInput) phoneInput.classList.remove("is-invalid");

        modalTitle.innerHTML = `<i class="mdi mdi-account-edit text-primary me-2"></i>Edit Admin`;
    }

    window.deleteUser = function(id, name) {
        Swal.fire({
            title: `Hapus ${name}?`,
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    // Using /admins/{id}/reject as per auth.js deleteAdmin implementation
                    const res = await fetch(`${window.API_URL}/admins/${id}/reject`, {
                        method: "DELETE",
                        headers: { "Authorization": `Bearer ${token}` }
                    });

                    const data = await res.json();
                    if (!res.ok) throw new Error(data.message);

                    Swal.fire("Terhapus!", data.message, "success");
                    fetchUsers();
                } catch (error) {
                    Swal.fire("Error", error.message, "error");
                }
            }
        });
    };
    
    window.approveAdmin = function(id, name) {
        Swal.fire({
            title: `Setujui admin ${name}?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Setujui",
            cancelButtonText: "Batal"
        }).then((res) => {
            if (res.isConfirmed)
                fetch(`${window.API_URL}/admins/${id}/approve`, {
                    method: "PUT",
                    headers: { "Authorization": `Bearer ${token}` },
                })
                    .then(() => {
                        Swal.fire("Berhasil!", `Admin ${name} telah disetujui.`, "success");
                        fetchUsers();
                    })
                    .catch(() =>
                        Swal.fire("Gagal!", "Gagal menyetujui admin.", "error")
                    );
        });
    }

    window.rejectAdmin = function(id, name) {
        Swal.fire({
            title: `Tolak permintaan admin ${name}?`,
            text: "Data akan dihapus permanen.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Batal",
            confirmButtonColor: "#d33"
        }).then((res) => {
            if (res.isConfirmed)
                fetch(`${window.API_URL}/admins/${id}/reject`, {
                    method: "DELETE",
                    headers: { "Authorization": `Bearer ${token}` },
                })
                    .then(() => {
                        Swal.fire("Ditolak!", `Permintaan admin ${name} telah ditolak.`, "success");
                        fetchUsers();
                    })
                    .catch(() =>
                        Swal.fire("Gagal!", "Gagal menolak admin.", "error")
                    );
        });
    }

    // Save User (Create / Update)
    adminForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        
        const id = adminIdInput.value;
        const isUpdate = !!id;
        
        // Route Strategy:
        // Create -> /users (Mapped to storeUser for Owner, supports 'active' status)
        // Update -> /admins/{id} 
        const url = isUpdate ? `${window.API_URL}/admins/${id}` : `${window.API_URL}/users`;
        const method = isUpdate ? "PUT" : "POST";

        const payload = {
            name: nameInput.value,
            email: emailInput.value,
            role: roleInput.value,
            status: statusInput.value,
            phone_number: phoneInput ? phoneInput.value : null,
            // Sending IDs for regions as per generic API structure, though backend might not be fully ready
            province_id: provinceSelect ? provinceSelect.value : null,
            regency_id: regencySelect ? regencySelect.value : null,
            // Religion ID logic (frontend has text currently, assuming backend might adjust or we send generic)
             // For now sending null or value if it matches ID. 
             // Controller expects religion_id. I'll send null to avoid 500 error if table empty.
            religion_id: null 
        };
        
        // Auto-approve (Active) when adding from Admin/Owner panel
        if (!isUpdate) {
             payload.status = 'active';
        }

        if (passwordInput.value) {
            payload.password = passwordInput.value;
            payload.password_confirmation = passwordConfirmInput.value;
        }

        try {
            const res = await fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (!res.ok) {
                // If 405 Method Not Allowed on Register (Post), it's Register. 
                // Handling generic errors:
                throw new Error(data.message || "Gagal menyimpan data");
            }

            Swal.fire("Berhasil", data.message || "Data berhasil disimpan", "success");
            adminModal.hide();
            fetchUsers();
        } catch (error) {
            Swal.fire("Error", error.message, "error");
        }
    });

    // Initial load
    fetchUsers();
});
