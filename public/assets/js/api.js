// ===== LOGIN =====
async function loginUser(email, password) {
  console.log("Login request:", { email, password });
  const res = await fetch('http://127.0.0.1:8000/api/login', {
    method: 'POST',
    headers: { 
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({ email, password })
  });

  const data = await res.json().catch(() => null);

  if (!res.ok) {
    // lempar error dengan pesan dari backend jika ada
    throw {
      message: data?.message || "Terjadi kesalahan saat login",
      status: res.status
    };
  }

  // cek status user
  if (data.user?.status?.toLowerCase() === "pending") {
    throw {
      message: "Akun Anda belum disetujui oleh owner!",
      status: 403
    };
  }

  console.log("Login response:", data);
  return data;
}


// ===== REGISTER =====
async function registerUser(name, email, password, password_confirmation) {
  console.log("Register request:", { name, email, password, password_confirmation });
  const res = await fetch('http://127.0.0.1:8000/api/register', {
    method: 'POST',
    headers: { 
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({ name, email, password, password_confirmation })
  });

  if (!res.ok) {
    const errJson = await res.json().catch(() => null);
    console.error("Register failed:", errJson || res.statusText);
    throw res;
  }

  const data = await res.json();
  console.log("Register response:", data);
  return data;
}

// ===== EVENT LISTENERS =====
document.addEventListener('DOMContentLoaded', () => {

  // LOGIN BUTTON
  const btnLogin = document.querySelector(".btn-login");
  if (btnLogin) {
    btnLogin.addEventListener("click", async (e) => {
      e.preventDefault();
      const email = document.getElementById("email")?.value;
      const password = document.getElementById("password")?.value;
      if (!email || !password) {
        console.warn("Email atau password kosong");
        return;
      }

      try {
        const data = await loginUser(email, password);
        localStorage.setItem("token", data.token);
        localStorage.setItem("user", JSON.stringify(data.user));
        window.location.href = "/dashboard";
      } catch (err) {
        console.error("Login button error:", err);
      }
    });
  }

  // REGISTER BUTTON
  const btnRegister = document.querySelector(".btn-register");
  if (btnRegister) {
    btnRegister.addEventListener("click", async (e) => {
      e.preventDefault();
      const name = document.getElementById("name")?.value;
      const email = document.getElementById("email")?.value;
      const password = document.getElementById("password")?.value;
      const password_confirmation = document.getElementById("password_confirmation")?.value;

      if (!name || !email || !password || !password_confirmation) {
        console.warn("Semua field wajib diisi");
        return;
      }

      if (password !== password_confirmation) {
        console.warn("Password dan konfirmasi tidak sama");
        return;
      }

      try {
        const data = await registerUser(name, email, password, password_confirmation);
        console.log("Register berhasil:", data);
        window.location.href = "/";
      } catch (err) {
        console.error("Register button error:", err);
      }
    });
  }

});
