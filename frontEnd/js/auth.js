document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const usuario = document.getElementById("usuario").value;
  const password = document.getElementById("password").value;

  const res = await fetch("http://localhost/DisenioWeb2/backEnd/public/login", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ usuario, password })
  });

  const data = await res.json();

  if (data.token) {
    localStorage.setItem("token", data.token);
    const payload = JSON.parse(atob(data.token.split(".")[1]));
    const rol = payload.data.rol;

    if (rol === 1) window.location = "pages/admin/index.html";
    if (rol === 2) window.location = "pages/empleado/index.html";
    if (rol === 3) window.location = "pages/cliente/index.html";
  } else {
    alert("Usuario o contraseña incorrecta");
  }
});
