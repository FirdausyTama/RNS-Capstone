document.addEventListener("DOMContentLoaded", function () {
    updateTotalPelanggan();
});

const API_PEMBELIAN_LIST_DASHBOARD = "http://127.0.0.1:8000/api/pembelians";

function getToken() {
    return localStorage.getItem("token");
}

function updateTotalPelanggan() {
    const token = getToken();
    if (!token) return;

    fetch(API_PEMBELIAN_LIST_DASHBOARD, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        .then(data => {
            // Get unique customers based on receiver name
            // 'penerima_nama' for direct consumers, 'nama_perusahaan' for B2B if applicable, 
            // but based on previous files it seems we prioritize 'penerima_nama' or 'nama_perusahaan'.
            // unique names
            const customers = new Set();

            data.forEach(item => {
                const name = item.penerima_nama || item.nama_perusahaan;
                if (name) {
                    customers.add(name.trim().toLowerCase());
                }
            });

            const totalUniqueCustomers = customers.size;

            const element = document.getElementById('totalPelanggan');
            if (element) {
                element.innerText = totalUniqueCustomers;
            }
        })
        .catch(err => console.error("Error loading dashboard data:", err));
}
