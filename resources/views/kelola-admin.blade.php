<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Admin | RNS - Ranay Nusantara Sejathera</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
  <meta name="author" content="Zoyothemes" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

  
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
      color: #31708f;
      font-weight: bold;
      font-size: 14px;
      text-transform: uppercase;
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
                <li class="breadcrumb-item"><a href="javascript: void(0);">Halaman</a></li>
                <li class="breadcrumb-item active">Kelola Admin</li>
              </ol>
            </div>
          </div>
          
          <div class="row mb-3">
             <div class="col-12 d-flex justify-content-between align-items-center">
                 <button class="btn btn-primary" onclick="openCreateModal()">
                     <i class="mdi mdi-plus me-1"></i> Tambah Admin
                 </button>
                 <!-- Search can be handled by JS as well, but keeping simple for now -->
             </div>
          </div>

        </div> 
        
        
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
  </div> 

  <!-- Modal Admin -->
  <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-semibold" id="modalTitle">
                    <i class="mdi mdi-account-plus text-primary me-2"></i>Tambah Admin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="adminForm">
                <div class="modal-body p-4">
                    <input type="hidden" id="adminId">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" required placeholder="Masukkan Username">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required placeholder="Masukkan Email">
                            <div class="invalid-feedback">Format email tidak valid (contoh@email.com)</div>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
                        </div>

                        <div class="col-md-6" id="roleField">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">No. HP</label>
                            <input type="text" class="form-control" id="phone" placeholder="Contoh: 08123456789">
                            <div class="invalid-feedback">Nomor HP harus berupa angka</div>
                        </div>

                        <div class="col-md-6">
                            <label for="religion" class="form-label">Agama</label>
                            <select class="form-select" id="religion">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="statusField">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="province" class="form-label">Provinsi</label>
                            <select class="form-select" id="province" disabled>
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="regency" class="form-label">Kabupaten/Kota</label>
                            <select class="form-select" id="regency" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="district" class="form-label">Kecamatan</label>
                            <select class="form-select" id="district" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">
                         <i class="mdi mdi-content-save-outline me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>

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
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

  <script src="assets/js/app.js"></script>
  <script src="assets/js/kelola-admin.js"></script>
  
</body>

</html>