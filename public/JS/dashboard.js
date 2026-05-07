/**
 * Lógica para los modales del Dashboard
 */

function openModal(id) {
    console.log("Intentando abrir el modal con ID:", id);
    const modal = document.getElementById(id);
    
    if (modal) {
        modal.style.display = 'flex';
        // Evitamos que el scroll se mueva al estar el modal abierto
        document.body.style.overflow = 'hidden';
    } else {
        console.error("Error: No se encontró el modal con ID:", id);
    }
}

function closeModal(id) {
    console.log("Cerrando modal:", id);
    const modal = document.getElementById(id);
    
    if (modal) {
        modal.style.display = 'none';
        // Devolvemos el scroll al body
        document.body.style.overflow = 'auto';
    }
}

// Cerrar el modal si el usuario hace clic en el fondo oscuro
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
});