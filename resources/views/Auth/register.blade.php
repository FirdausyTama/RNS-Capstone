<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Admin | PT. Ranay Nusantara Sejahtera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <style>
    body {
      margin: 0;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      display: flex;
    }

    /* Kiri */
    .left-side {
      flex: 1;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .left-side img {
      max-width: 70%;
      height: auto;
    }

    /* Kanan */
    .right-side {
      flex: 1;
      background-color: #0d3b91;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .register-box {
      width: 100%;
      max-width: 700px; /* Widened for 2 columns */
    }

    .register-box h3 {
      font-weight: 700;
      margin-bottom: 5px;
    }

    .register-box p {
      font-size: 14px;
      color: #dcdcdc;
      margin-bottom: 30px;
    }

    .input-group-text {
      background-color: #fff;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px;
    }

    .btn-register {
      background-color: #f7b733;
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .btn-register:hover {
      background-color: #e0a020;
    }

    .text-small {
      font-size: 0.9rem;
    }

    a {
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .toggle-password {
      cursor: pointer;
      background-color: #fff;
      border-left: none;
    }

    .input-group .form-control {
      border-right: none;
    }

    .input-group .toggle-password:hover {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body>
  <div class="left-side">
    <img src="{{ asset('assets/images/logo-rns-bg.png') }}" alt="Logo RNS">
  </div>

  <div class="right-side">
    <div class="register-box">
      <h3 class="text-center">Register Admin</h3>
      <p class="text-center">PT. Ranay Nusantara Sejahtera</p>
      <div id="alertBox"></div>
      <form>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" id="name" class="form-control" placeholder="Masukkan Username">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="Masukkan Email">
                     <div class="invalid-feedback">Format email tidak valid</div>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password" class="form-control" placeholder="Masukkan Password">
                    <span class="input-group-text toggle-password" onclick="togglePassword('password', this)">
                      <i class="bi bi-eye-slash"></i>
                    </span>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Konfirmasi Password</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    <span class="input-group-text toggle-password" onclick="togglePassword('password_confirmation', this)">
                      <i class="bi bi-eye-slash"></i>
                    </span>
                  </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="text" id="phone" class="form-control" placeholder="08xxxxxxxx">
                         <div class="invalid-feedback">Hanya angka diperbolehkan</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Agama</label>
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

                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    <select class="form-select" id="province" disabled>
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select class="form-select" id="regency" disabled>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kecamatan</label>
                    <select class="form-select" id="district" disabled>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-register w-100 py-2 mt-3">Daftar</button>

        <div class="text-center mt-3 text-small">
          Anda sudah punya akun?
          <a href="/" class="text-warning">Login Disini</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePassword(inputId, iconElement) {
      const input = document.getElementById(inputId);
      const icon = iconElement.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      } else {
        input.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      }
    }

    // --- Region & Validation Logic ---
    document.addEventListener("DOMContentLoaded", () => {
        const phoneInput = document.getElementById("phone");
        const emailInput = document.getElementById("email");
        const provinceSelect = document.getElementById("province");
        const regencySelect = document.getElementById("regency");
        const districtSelect = document.getElementById("district");
        
        const BASE_REGION_URL = "https://www.emsifa.com/api-wilayah-indonesia/api";

        // Validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        emailInput.addEventListener("input", function() {
            if (!emailRegex.test(this.value) && this.value !== "") {
                this.classList.add("is-invalid");
            } else {
                this.classList.remove("is-invalid");
            }
        });

        phoneInput.addEventListener("input", function() {
            if (/\D/.test(this.value)) {
                this.classList.add("is-invalid");
            } else {
                this.classList.remove("is-invalid");
            }
        });

        // Regions
        async function loadProvinces() {
            try {
                const res = await fetch(`${BASE_REGION_URL}/provinces.json`);
                const provinces = await res.json();
                provinces.forEach(p => {
                    const opt = document.createElement("option");
                    opt.value = p.id;
                    opt.textContent = p.name;
                    provinceSelect.appendChild(opt);
                });
                provinceSelect.disabled = false;
            } catch (e) { console.error(e); }
        }

        async function loadRegencies(provId) {
             regencySelect.innerHTML = '<option value="">Memuat...</option>';
             districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
             districtSelect.disabled = true;

             try {
                const res = await fetch(`${BASE_REGION_URL}/regencies/${provId}.json`);
                const regencies = await res.json();
                regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                regencies.forEach(r => {
                    const opt = document.createElement("option");
                    opt.value = r.id;
                    opt.textContent = r.name;
                    regencySelect.appendChild(opt);
                });
                regencySelect.disabled = false;
             } catch(e) { console.error(e); }
        }

        async function loadDistricts(regId) {
             districtSelect.innerHTML = '<option value="">Memuat...</option>';
             try {
                const res = await fetch(`${BASE_REGION_URL}/districts/${regId}.json`);
                const districts = await res.json();
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districts.forEach(d => {
                    const opt = document.createElement("option");
                    opt.value = d.id;
                    opt.textContent = d.name;
                    districtSelect.appendChild(opt);
                });
                districtSelect.disabled = false;
             } catch(e) { console.error(e); }
        }

        provinceSelect.addEventListener("change", (e) => loadRegencies(e.target.value));
        regencySelect.addEventListener("change", (e) => loadDistricts(e.target.value));

        loadProvinces();
    });
  </script>
  <script src="assets/js/auth.js"></script>

</body>

</html>