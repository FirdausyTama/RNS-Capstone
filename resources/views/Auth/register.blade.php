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

    .right-side {
      flex: 1;
      background-color: #0d3b91;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .register-box {
      width: 100%;
      max-width: 360px;
    }

    .register-box h3 {
      font-weight: 700;
      margin-bottom: 5px;
    }

    .register-box p {
      font-size: 14px;
      color: #dcdcdc;
      margin-bottom: 20px;
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

    /* Alert style */
    #registerAlert {
      margin-bottom: 15px;
      display: none;
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

      <form id="registerForm">
        <!-- Alert -->
        <div id="registerAlert" class="alert text-center" role="alert"></div>

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
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="password" class="form-control" placeholder="Masukkan Password">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label">Konfirmasi Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
          </div>
        </div>

        <button type="button" class="btn btn-register w-100 py-2">Daftar</button>

        <div class="text-center mt-3 text-small">
          Anda sudah punya akun?
          <a href="/" class="text-warning">Login Disini</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/api.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btnRegister = document.querySelector(".btn-register");
      const alertBox = document.getElementById("registerAlert");

      const showAlert = (msg, type = "danger") => {
        alertBox.textContent = msg;
        alertBox.className = `alert alert-${type} text-center`;
        alertBox.style.display = "block";
      };

      if (btnRegister) {
        btnRegister.addEventListener("click", async (e) => {
          e.preventDefault();
          const name = document.getElementById("name")?.value.trim();
          const email = document.getElementById("email")?.value.trim();
          const password = document.getElementById("password")?.value.trim();
          const password_confirmation = document.getElementById("password_confirmation")?.value.trim();

          alertBox.style.display = "none";

          if (!name || !email || !password || !password_confirmation) {
            showAlert("Semua field wajib diisi!", "warning");
            return;
          }

          if (password !== password_confirmation) {
            showAlert("Password dan konfirmasi tidak sama!", "warning");
            return;
          }

          try {
            const data = await registerUser(name, email, password, password_confirmation);
            showAlert("Registrasi berhasil! Silakan login.", "success");
            setTimeout(() => window.location.href = "/", 1000);
          } catch (err) {
            // Ambil pesan error dari backend (misal: email sudah terpakai)
            showAlert(err.message || "Terjadi kesalahan, silakan coba lagi.", "danger");
          }
        });
      }

      // Fungsi registerUser
      async function registerUser(name, email, password, password_confirmation) {
        const res = await fetch('http://127.0.0.1:8000/api/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify({ name, email, password, password_confirmation })
        });

        const data = await res.json().catch(() => null);

        if (!res.ok) {
          throw {
            message: data?.message || "Terjadi kesalahan saat registrasi",
            status: res.status
          };
        }

        return data;
      }

    });
  </script>
</body>

</html>
