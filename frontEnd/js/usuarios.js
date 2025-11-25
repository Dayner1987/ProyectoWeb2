// usuarios.js
const usersBody = document.getElementById("usersBody");
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");
const roleFilter = document.getElementById("roleFilter");
const addUserBtn = document.getElementById("addUserBtn");

// URL base del backend para listar usuarios
const BASE_URL = "/DisenioWeb2/backEnd/public/usuarios";

// Map para filtrar roles por nombre
const roleMap = { "empleado": 2, "cliente": 3, "all": "all" };

// Función para cargar usuarios
async function loadUsers(role = "all", search = "") {
    usersBody.innerHTML = `<tr><td colspan="5" class="text-center py-4">Cargando...</td></tr>`;

    try {
        const response = await fetch(BASE_URL);
        const usuarios = await response.json();

        console.log("Usuarios desde backend:", usuarios); // depuración

        // Filtrar por rol si no es "all"
        let filteredUsers = usuarios;
        if (role !== "all") {
            filteredUsers = usuarios.filter(u => u.Roles_idRoles === roleMap[role]);
        }

        // Filtrar por búsqueda
        if (search.trim() !== "") {
            filteredUsers = filteredUsers.filter(u =>
                u.nombreUsuario.toLowerCase().includes(search.toLowerCase()) ||
                u.mailUsuario.toLowerCase().includes(search.toLowerCase()) ||
                u.ciUsuario.toLowerCase().includes(search.toLowerCase())
            );
        }

        if (filteredUsers.length === 0) {
            usersBody.innerHTML = `<tr><td colspan="5" class="text-center py-4">No hay usuarios</td></tr>`;
            return;
        }

        usersBody.innerHTML = "";

        filteredUsers.forEach(user => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td class="px-6 py-4">${user.ciUsuario}</td>
        <td class="px-6 py-4">${user.nombreUsuario}</td>
        <td class="px-6 py-4">${user.mailUsuario}</td>
        <td class="px-6 py-4">${user.Roles_idRoles === 1 ? 'Admin' : user.Roles_idRoles === 2 ? 'Empleado' : 'Cliente'}</td>
        <td class="px-6 py-4">
            <button class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500" onclick="editUser('${user.idUsuarios}')">Editar</button>
            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="deleteUser('${user.idUsuarios}')">Eliminar</button>
        </td>
    `;
    usersBody.appendChild(tr);
});


    } catch (error) {
        console.error(error);
        usersBody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-red-500">Error cargando usuarios</td></tr>`;
    }
}

// Funciones de filtro
searchBtn.addEventListener("click", () => {
    loadUsers(roleFilter.value, searchInput.value);
});

roleFilter.addEventListener("change", () => {
    loadUsers(roleFilter.value, searchInput.value);
});

// Botón para agregar usuario
addUserBtn.addEventListener("click", () => {
    window.location.href = "";
});

// Editar usuario
function editUser(id) {
    window.location.href = `/frontEnd/pages/admin/registerUser.html?id=${id}`;
}

// Eliminar usuario
async function deleteUser(id) {
    if (!confirm("¿Deseas eliminar este usuario?")) return;

    try {
        const response = await fetch(`/DisenioWeb2/backEnd/public/usuarios/delete/${id}`, {
            method: "POST"
        });
        const data = await response.json();
        alert(data.message);
        loadUsers(roleFilter.value, searchInput.value);
    } catch (error) {
        console.error(error);
        alert("Error eliminando usuario");
    }
}
// =========================
// Registrar nuevo usuario
// =========================
const saveUserBtn = document.getElementById("saveUserBtn");

saveUserBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    // Obtener valores del formulario
    const data = {
        ciUsuario: document.getElementById("reg_ci").value.trim(),
        nombreUsuario: document.getElementById("reg_nombre").value.trim(),
        mailUsuario: document.getElementById("reg_email").value.trim(),
        password: document.getElementById("reg_pass").value.trim(),
        Roles_idRoles: document.getElementById("reg_rol").value
    };

    // Validar que todos los campos estén completos
    if (!data.ciUsuario || !data.nombreUsuario || !data.mailUsuario || !data.password || !data.Roles_idRoles) {
        Swal.fire({
            icon: 'error',
            title: 'Por favor completa todos los campos'
        });
        return;
    }

    try {
        const response = await fetch("/DisenioWeb2/backEnd/public/usuarios/createUser", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
});


        const result = await response.json();

        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: result.message,
                timer: 1500,
                showConfirmButton: false
            });

            // Recargar tabla de usuarios
            loadUsers();

            // Limpiar formulario
            document.getElementById("reg_ci").value = '';
            document.getElementById("reg_nombre").value = '';
            document.getElementById("reg_email").value = '';
            document.getElementById("reg_pass").value = '';
            document.getElementById("reg_rol").value = 2; // valor por defecto Empleado
        } else {
            Swal.fire({
                icon: 'error',
                title: result.message
            });
        }

    } catch (err) {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Error al registrar usuario'
        });
    }
});

// Inicializar tabla al cargar la página
loadUsers();
