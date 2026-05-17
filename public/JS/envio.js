document.addEventListener('DOMContentLoaded', function() {
    const inputEmpleados = document.querySelector('input[name="cantidad_empleados"]');
    const inputsVehiculo = document.querySelectorAll('input[name="vehiculo"]');
    const displayPrecio = document.getElementById('precio-total');

    function calcularPresupuesto() {
        let total = 0;

        // 1. Cálculo por empleados (30€ cada uno)
        const numEmpleados = parseInt(inputEmpleados.value) || 0;
        total += numEmpleados * 30;

        // 2. Cálculo por vehículo (camion1=100, camion2=200...)
        const vehiculoSeleccionado = document.querySelector('input[name="vehiculo"]:checked');
        if (vehiculoSeleccionado) {
            // Extraemos el número del valor (ej: "camion3" -> 3)
            const valorVehiculo = vehiculoSeleccionado.value.replace('camion', '');
            total += parseInt(valorVehiculo) * 100;
        }

        // 3. Actualizar el texto en el HTML
        displayPrecio.innerText = total;
    }

    // Escuchar cambios en empleados
    inputEmpleados.addEventListener('input', calcularPresupuesto);

    // Escuchar cambios en los radio buttons de los vehículos
    inputsVehiculo.forEach(radio => {
        radio.addEventListener('change', calcularPresupuesto);
    });

    // Calcular por primera vez al cargar (por si hay valores por defecto)
    calcularPresupuesto();
});