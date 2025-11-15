<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | PT. Ranay Nusantara Sejahtera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

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
    .login-box {
      width: 100%;
      max-width: 360px;
      background: transparent;
    }
    .login-box h3 {
      font-weight: 700;
      margin-bottom: 5px;
    }
    .login-box p {
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
    .btn-login {
      background-color: #f7b733;
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.2s;
    }
    .btn-login:hover {
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
    #loginAlert {
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
    <div class="login-box">
      <h3 class="text-center">Login</h3>
      <p class="text-center">PT. Ranay Nusantara Sejahtera</p>

      <form id="loginForm">
        <!-- Alert Bootstrap -->
        <div id="loginAlert" class="alert text-center" role="alert"></div>

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

        <div class="d-flex justify-content-end mb-3">
          <a href="#" class="text-white text-small">Lupa Password?</a>
        </div>

        <button type="button" class="btn btn-login w-100 py-2">Masuk</button>

        <div class="text-center mt-3 text-small">
          Anda belum punya akun?
          <a href="register" class="text-warning">Register Disini</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/api.js') }}"></script> <!-- harus ada dulu -->
<script>
const btnLogin = document.querySelector(".btn-login");
const alertBox = document.getElementById("loginAlert");

const showAlert = (msg, type = "danger") => {
    alertBox.textContent = msg;
    alertBox.className = `alert alert-${type} text-center`;
    alertBox.style.display = "block";
};

if (btnLogin) {
    btnLogin.addEventListener("click", async (e) => {
        e.preventDefault();
        const email = document.getElementById("email")?.value.trim();
        const password = document.getElementById("password")?.value.trim();

        alertBox.style.display = "none";

        if (!email || !password) {
            showAlert("Email dan password harus diisi!", "warning");
            return;
        }

        try {
            const data = await loginUser(email, password);

            showAlert("Login berhasil!", "success");
            localStorage.setItem("token", data.token);
            localStorage.setItem("user", JSON.stringify(data.user));

            setTimeout(() => window.location.href = "/dashboard", 800);

        } catch (err) {
            showAlert(err.message || "Terjadi kesalahan, silakan coba lagi.", 
                      err.status === 403 ? "warning" : "danger");
        }
    });
}
</script>
</body>

</html>
