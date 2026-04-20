let ultimaPosicion = window.pageYOffset;
const menu = document.getElementById("menu");

function toggleLogin() {
    var modal = document.getElementById("loginModal");
    if (modal.style.display === "block") {
        modal.style.display = "none";
    } else {
        modal.style.display = "block";
    }
}

window.addEventListener("scroll", function() {
    let posicionActual = window.pageYOffset;

    if(posicionActual > ultimaPosicion && posicionActual > 150){
        menu.classList.add("oculto");
    } else {
        menu.classList.remove("oculto");
    }

    ultimaPosicion = posicionActual;
});

// Cerrar si el usuario hace clic fuera de la cajita blanca

window.onclick = function(event) {
    var modal = document.getElementById("loginModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Funciones para envios
    Funciones para evitar mudanza sin iniciar sesión
*/


function notLogged() {
    document.getElementById('overlayWarning').style.display = 'flex';
}

function cerrarWarning() {
    document.getElementById('overlayWarning').style.display = 'none';
}

function irAlLogin() {
    cerrarWarning();
    toggleLogin(); 
}

/* Funcion para abrir el formulario de mudanza*/

function toggleMudanza() {
    const modal = document.getElementById('overlayMudanza');
    if (modal.style.display === 'flex') {
        modal.style.display = 'none';
    } else {
        modal.style.display = 'flex';
    }
}