<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <title>Kelola Admin | PT. Ranay Nusantara Sejahtera</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="Kelola admin untuk sistem RNS" name="description" />
  <meta content="RNS" name="author" />
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- App css -->
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <script src="assets/js/head.js"></script>

  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background-color: #f8f9fa;
      font-weight: 600;
      color: #212529;
      padding: 12px 16px;
      border-bottom: 1px solid #dee2e6;
      text-align: left;
    }

    td {
      padding: 12px 16px;
      border-bottom: 1px solid #f1f1f1;
      vertical-align: middle;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .avatar-initial {
      height: 40px;
      width: 40px;
      border-radius: 50%;
      background-color: #d1e7ff;
      color: #0d6efd;
      font-weight: 600;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-transform: uppercase;
    }

    .badge {
      font-size: 12px;
      padding: 6px 10px;
      border-radius: 6px;
    }

    .bg-success-subtle {
      background-color: #d1f2e1;
    }

    .bg-warning-subtle {
      background-color: #fff4d2;
    }

    .bg-secondary-subtle {
      background-color: #e4e6eb;
    }

    .text-success {
      color: #198754 !important;
    }

    .text-warning {
      color: #ffc107 !important;
    }

    .text-muted {
      color: #6c757d !important;
    }

    .btn-sm {
      padding: 5px 8px;
      border-radius: 6px;
    }

    .bg-danger-subtle {
      background-color: #f8d7da;
    }

    .text-end {
      text-align: right;
    }

    /* Search dan pagination */
    .table-controls {
      display: flex;
      justify-content: flex-end;
      align-items: none;
      margin-bottom: 15px;
    }

    .search-box input {
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .pagination {
      display: flex;
      list-style: none;
      justify-content: center;
      align-items: center;
      gap: 6px;
      padding: 0;
      margin-top: 20px;
    }

    .pagination li {
      display: inline-block;
    }

    .pagination button {
      border: 1px solid #dee2e6;
      background-color: white;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.2s;
    }

    .pagination button:hover {
      background-color: #f1f1f1;
    }

    .pagination button.active {
      background-color: #108dff;
      color: white;
      border-color: #108dff;
    }

    .pagination button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
</head>

<body data-menu-color="light" data-sidebar="default">
  @include('navbar.navbar')

  <div id="app-layout">
    <div class="content-page">
      <div class="content">

        <div class="container-fluid">
          <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
              <h4 class="fs-18 fw-semibold m-0">Kelola Admin</h4>
            </div>
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active">Kelola Admin</li>
              </ol>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-body">

                <div class="table-controls">
                  <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari admin...">
                  </div>
                </div>

                <div class="table-responsive">
                  <table id="datatable_admin" class="align-middle">
                    <thead>
                      <tr>
                        <th>Pengguna</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Diperbarui Pada</th>
                        <th class="text-end">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="admin-table-body">
                      <tr>
                        <td colspan="6" class="text-center text-muted py-3">Memuat data...</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="d-flex justify-content-end">
                  <ul id="pagination" class="pagination"></ul>
                </div>


              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">© PT. Ranay Nusantara Sejahtera</div>
          <div class="col-sm-6 text-sm-end d-none d-sm-block">2025</div>
        </div>
      </div>
    </footer>
  </div>

  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>
  <script src="assets/js/app.js"></script>

  <script>
    const token = localStorage.getItem("token");
    const tableBody = document.getElementById("admin-table-body");
    const API_URL = "http://127.0.0.1:8000/api";

    let allAdmins = [];
    let currentPage = 1;
    const rowsPerPage = 10;

    async function loadAdmins() {
      tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-3">Memuat data...</td></tr>`;

      try {
        const res = await fetch(`${API_URL}/admins`, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        });

        if (!res.ok) throw new Error("Gagal memuat data dari API.");

        const result = await res.json();
        allAdmins = result.data || result;
        displayAdmins();
      } catch (err) {
        console.error("Gagal memuat data admin:", err);
        tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger py-3">Gagal memuat data admin</td></tr>`;
      }
    }

    function displayAdmins() {
      const searchValue = document.getElementById("searchInput").value.toLowerCase();
      const filteredAdmins = allAdmins.filter(a =>
        a.name.toLowerCase().includes(searchValue) ||
        a.email.toLowerCase().includes(searchValue)
      );

      const start = (currentPage - 1) * rowsPerPage;
      const paginatedAdmins = filteredAdmins.slice(start, start + rowsPerPage);

      tableBody.innerHTML = "";

      if (paginatedAdmins.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-3">Tidak ada data</td></tr>`;
        document.getElementById("pagination").innerHTML = "";
        return;
      }

      paginatedAdmins.forEach((admin) => {
        const statusBadge =
          admin.status === "active" ?
          `<span class="badge bg-success-subtle text-success">Aktif</span>` :
          admin.status === "pending" ?
          `<span class="badge bg-warning-subtle text-warning">Menunggu ACC</span>` :
          `<span class="badge bg-secondary-subtle text-muted">Tidak Aktif</span>`;

        const actionBtns =
          admin.status === "pending" ?
          `
              <button class="btn btn-sm bg-success-subtle me-1" onclick="approveAdmin(${admin.id}, '${admin.name}')">
                <i class="mdi mdi-check fs-14 text-success"></i>
              </button>
              <button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin(${admin.id}, '${admin.name}')">
                <i class="mdi mdi-close fs-14 text-danger"></i>
              </button>` :
          admin.status === "active" ?
          `
              <button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin(${admin.id}, '${admin.name}')">
                <i class="mdi mdi-delete fs-14 text-danger"></i>
              </button>` :
          `<span class="text-muted">-</span>`;

        const lastActive = admin.updated_at ?
          new Date(admin.updated_at).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          }) :
          '-';

        const initials = admin.name
          .split(" ")
          .map(n => n[0])
          .join("")
          .substring(0, 2)
          .toUpperCase();

        tableBody.innerHTML += `
          <tr>
            <td><div class="avatar-initial">${initials}</div></td>
            <td>${admin.name}</td>
            <td>${admin.email}</td>
            <td>${statusBadge}</td>
            <td>${lastActive}</td>
            <td class="text-end">${actionBtns}</td>
          </tr>`;
      });

      setupPagination(filteredAdmins.length);
    }

    function setupPagination(totalRows) {
      const totalPages = Math.ceil(totalRows / rowsPerPage);
      const pagination = document.getElementById("pagination");
      pagination.innerHTML = "";

      // Pagination tetap muncul meski cuma 1 halaman
      const prevDisabled = currentPage === 1 ? "disabled" : "";
      const nextDisabled = currentPage === totalPages ? "disabled" : "";

      // Tombol sebelumnya
      pagination.innerHTML += `
    <li><button ${prevDisabled} onclick="goToPage(${currentPage - 1})">«</button></li>
  `;

      // Nomor halaman
      for (let i = 1; i <= totalPages; i++) {
        pagination.innerHTML += `
      <li><button class="${i === currentPage ? "active" : ""}" onclick="goToPage(${i})">${i}</button></li>
    `;
      }

      // Tombol berikutnya
      pagination.innerHTML += `
    <li><button ${nextDisabled} onclick="goToPage(${currentPage + 1})">»</button></li>
  `;
    }


    function goToPage(page) {
      currentPage = page;
      displayAdmins();
    }

    document.getElementById("searchInput").addEventListener("input", () => {
      currentPage = 1;
      displayAdmins();
    });

    function approveAdmin(id, name) {
      Swal.fire({
        title: `Setujui admin ${name}?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Setujui",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`${API_URL}/admins/${id}/approve`, {
              method: "PUT",
              headers: {
                Authorization: `Bearer ${token}`
              },
            })
            .then(() => Swal.fire("Berhasil!", "Admin disetujui.", "success"))
            .then(() => loadAdmins())
            .catch(() => Swal.fire("Gagal!", "Gagal menyetujui admin.", "error"));
        }
      });
    }

    function rejectAdmin(id, name) {
      Swal.fire({
        title: `Tolak admin ${name}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Tolak",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`${API_URL}/admins/${id}/reject`, {
              method: "DELETE",
              headers: {
                Authorization: `Bearer ${token}`
              },
            })
            .then(() => Swal.fire("Dihapus!", "Admin telah dihapus.", "success"))
            .then(() => loadAdmins())
            .catch(() => Swal.fire("Gagal!", "Gagal menghapus admin.", "error"));
        }
      });
    }

    loadAdmins();
  </script>
</body>

</html>