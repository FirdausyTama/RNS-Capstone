<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Admin | RNS - Ranay Nusantara Sejathera</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/head.js"></script>


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
                        


                         
                        
                    </div> <!-- container-fluid -->
<!-- Start Main Widgets -->
                    <!-- Table -->
            <div class="row">
              <div class="col-12">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table datatable align-middle" id="datatable_admin">
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
                        <tbody>
                          <!-- Contoh: Admin Aktif -->
                          <tr>
                            <td><img src="assets/images/users/user.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Atama Cahya</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-success-subtle text-success">Aktif</span></td>
                            <td>27 Oktober 2025</td>
                            <td class="text-end">
                              <button class="btn btn-sm bg-danger-subtle" onclick="hapusAkses('Atama Cahya')" data-bs-toggle="tooltip" title="Hapus Akses">
                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                              </button>
                            </td>
                          </tr>

                          <!-- Contoh: Admin Pending -->
                          <tr>
                            <td><img src="assets/images/users/user-2.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Anggi Rahma</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-warning-subtle text-warning">Menunggu ACC</span></td>
                            <td>-</td>
                            <td class="text-end">
                              <button class="btn btn-sm bg-success-subtle me-1" onclick="accAdmin('Anggi Rahma')" title="Setujui">
                                <i class="mdi mdi-check fs-14 text-success"></i>
                              </button>
                              <button class="btn btn-sm bg-danger-subtle" onclick="tolakAdmin('Anggi Rahma')" title="Tolak">
                                <i class="mdi mdi-close fs-14 text-danger"></i>
                              </button>
                            </td>
                          </tr>

                          <!-- Contoh: Admin Pending -->
                          <tr>
                            <td><img src="assets/images/users/user-4.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Deni Pratama</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-warning-subtle text-warning">Menunggu ACC</span></td>
                            <td>-</td>
                            <td class="text-end">
                              <button class="btn btn-sm bg-success-subtle me-1" onclick="accAdmin('Deni Pratama')" title="Setujui">
                                <i class="mdi mdi-check fs-14 text-success"></i>
                              </button>
                              <button class="btn btn-sm bg-danger-subtle" onclick="tolakAdmin('Deni Pratama')" title="Tolak">
                                <i class="mdi mdi-close fs-14 text-danger"></i>
                              </button>
                            </td>
                          </tr>
                          <!-- Contoh: Admin Tidak Aktif -->
                          <tr>
                            <td><img src="assets/images/users/user-3.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Nadila Putri</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-secondary-subtle text-muted">Tidak Aktif</span></td>
                            <td>19 Oktober 2025</td>
                            <td class="text-end"><span class="text-muted">-</span></td>
                          </tr>
                          <!-- Contoh: Admin Tidak Aktif -->
                          <tr>
                            <td><img src="assets/images/users/user-2.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Nadia Fani</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-secondary-subtle text-muted">Tidak Aktif</span></td>
                            <td>19 Oktober 2025</td>
                            <td class="text-end"><span class="text-muted">-</span></td>
                          </tr>
                          <!-- Contoh: Admin Tidak Aktif -->
                          <tr>
                            <td><img src="assets/images/users/user-4.jpg" alt="Admin" class="thumb-md rounded-circle avatar-border"></td>
                            <td>Kiki Saputri</td>
                            <td>Atama@gmail.com</td>
                            <td><span class="badge bg-secondary-subtle text-muted">Tidak Aktif</span></td>
                            <td>19 Oktober 2025</td>
                            <td class="text-end"><span class="text-muted">-</span></td>
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

                            
                        
                        <!-- End Main Widgets -->
                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">TI UMY 22</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.js"></script>
        <!-- Inisialisasi -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        new simpleDatatables.DataTable("#datatable_admin");
        feather.replace();
      });

      function accAdmin(nama) {
        Swal.fire({
          title: `Setujui ${nama}?`,
          text: "Admin ini akan diberikan akses.",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Setujui'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Disetujui!', `${nama} kini menjadi admin aktif.`, 'success');
          }
        });
      }

      function tolakAdmin(nama) {
        Swal.fire({
          title: `Tolak ${nama}?`,
          text: "Admin ini tidak akan mendapatkan akses.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Tolak'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Ditolak!', `${nama} telah ditolak aksesnya.`, 'error');
          }
        });
      }

      function hapusAkses(nama) {
        Swal.fire({
          title: `Hapus akses ${nama}?`,
          text: "Admin ini akan kehilangan akses ke sistem.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', `Akses ${nama} telah dicabut.`, 'success');
          }
        });
      }
    </script>
        
    </body>
</html>