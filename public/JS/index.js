function toggleLogin() {
    var modal = document.getElementById("loginModal");
    if (modal.style.display === "block") {
        modal.style.display = "none";
    } else {
        modal.style.display = "block";
    }
}

// Cerrar si el usuario hace clic fuera de la cajita blanca
window.onclick = function(event) {
    var modal = document.getElementById("loginModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}