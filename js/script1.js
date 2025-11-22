// Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

// Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

var loginBtn = document.getElementById("loginBtn");
var errorMsg = document.getElementById("errorMsg");

// Nueva variable para el mensaje de éxito
var mensajeRegistro = document.getElementById("mensajeRegistro");

// Mostrar la fecha actual
const fechaHoy = new Date();
const opcionesFecha = { year: 'numeric', month: 'long', day: 'numeric' };
const fechaFormateada = fechaHoy.toLocaleDateString('es-ES', opcionesFecha);
document.getElementById('fecha').textContent = `Fecha: ${fechaFormateada}`;

// Prevenir que el formulario de registro recargue la página y limpiar los campos
document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la recarga de la página

    // Procesar los datos de registro
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('passwordReg').value;

    if (nombre && correo && usuario && password) {
        // Mostrar mensaje de éxito
        mensajeRegistro.style.display = 'block';

        // Limpiar los campos del formulario
        document.getElementById('registerForm').reset();

        // Ocultar el mensaje después de 3 segundos
        setTimeout(function() {
            mensajeRegistro.style.display = "none";
        }, 3000);
    } else {
        alert("Por favor, completa todos los campos.");
    }
});

// FUNCIONES
function anchoPage() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
    }
}

anchoPage();

function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

// Validación de inicio de sesión
loginBtn.addEventListener("click", function() {
    const validUser = "joanydiesay15@gmail.com";
    const validPassword = "123456";

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email === validUser && password === validPassword) {
        window.location.href = "index.html";
    } else {
        errorMsg.textContent = "Acceso Denegado, usuario o contraseña incorrectos.";
    }
});
