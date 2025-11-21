<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Admin | RNS - Ranay Nusantara Sejathera</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
  <meta name="author" content="Zoyothemes" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- App css -->
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <script src="assets/js/head.js"></script>

  <style>
    .avatar-initial {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background-color: #d9edf7;
      /* warna latar (ubah sesuai tema) */
      color: #31708f;
      /* warna teks */
      font-weight: bold;
      font-size: 14px;
      text-transform: uppercase;
    }
  </style>

</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">
  @include('navbar.navbar')
  <!-- Begin page -->
  <div id="app-layout">
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

          <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
              <h4 class="fs-18 fw-semibold m-0">Kelola Admin</h4>
            </div>

            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                <li class="breadcrumb-item active">Kelola Admin</li>
              </ol>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
              <input type="text" id="searchInput" class="form-control w-auto" placeholder="Cari admin...">
            </div>
          </div>

        </div> <!-- container-fluid -->
        <!-- Start Main Widgets -->
        <!-- Table -->
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-middle" id="datatable_admin">
                    <thead class="table-light">
                      <tr>
                        <th>Foto</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Terakhir Aktif</th>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- content -->

  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col fs-13 text-muted text-center">
          &copy; <script>
            document.write(new Date().getFullYear())
          </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a>
        </div>
      </div>
    </div>
  </footer>
  </div>
  </div>

  <script src="assets/libs/jquery/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>

  <!-- App js-->
  <script src="assets/js/app.js"></script>
  <script src="assets/js/auth.js"></script>
  <!-- Inisialisasi -->
  <script>
    document.addEventListener("DOMContentLoaded", async () => {
  const dataTableElement = document.querySelector("#datatable_admin");
  let dataTable;

  function renderAdminRow(admin) {
    const initials = admin.name
      .split(" ")
      .map(n => n[0])
      .join("")
      .substring(0, 2)
      .toUpperCase();

    let statusLabel = "";
    let statusClass = "";

    if (admin.status.toLowerCase() === "active") {
      statusLabel = "Aktif";
      statusClass = "bg-success-subtle text-success";
    } else if (admin.status.toLowerCase() === "pending") {
      statusLabel = "Menunggu ACC";
      statusClass = "bg-warning-subtle text-warning";
    } else {
      statusLabel = "Tidak Aktif";
      statusClass = "bg-secondary-subtle text-muted";
    }

    const lastActive = admin.updated_at ?
      new Date(admin.updated_at).toLocaleDateString("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric"
      }) : "-";

    return `
      <tr>
        <td><div class="avatar-initial">${initials}</div></td>
        <td>${admin.name}</td>
        <td>${admin.email}</td>
        <td><span class="badge ${statusClass}">${statusLabel}</span></td>
        <td>${lastActive}</td>
        <td class="text-end">
          ${admin.status === "pending" ? `
            <button class="btn btn-sm bg-success-subtle me-1" onclick="approveAdmin('${admin.id}')">
              <i class="mdi mdi-check fs-14 text-success"></i>
            </button>
            <button class="btn btn-sm bg-danger-subtle" onclick="rejectAdmin('${admin.id}')">
              <i class="mdi mdi-close fs-14 text-danger"></i>
            </button>` :
            admin.status === "active" ? `
            <button class="btn btn-sm bg-danger-subtle" onclick="deleteAdmin('${admin.id}', '${admin.name.replace(/'/g,"\\'")}')">
              <i class="mdi mdi-delete fs-14 text-danger"></i>
            </button>` : "-"
          }
        </td>
      </tr>
    `;
  }

  async function populateAdminTable() {
    const admins = await fetchAdmins();
    const tbody = dataTableElement.querySelector("tbody");
    tbody.innerHTML = admins.map(renderAdminRow).join("");

    if (!dataTable) {
      dataTable = new simpleDatatables.DataTable(dataTableElement, {
        searchable: true,  // Aktifkan search
        perPage: 10,       // 10 row per halaman
        perPageSelect: [5, 10, 15, 20] // dropdown pilihan perPage
      });
    } else {
      dataTable.refresh();
    }

    // Search custom input
    const searchInput = document.querySelector("#searchInput");
    searchInput.addEventListener("input", (e) => {
      dataTable.search(e.target.value);
    });
  }

  await populateAdminTable();
});


  </script>
</body>

</html>