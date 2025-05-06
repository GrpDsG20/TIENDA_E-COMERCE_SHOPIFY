
        function calcularPrecio() {
            const precioOriginal = parseFloat(document.getElementById('precio_original').value) || 0;
            const descuento = parseFloat(document.getElementById('descuento').value) || 0;

            const precioFinal = precioOriginal - (precioOriginal * descuento / 100);
            document.getElementById('precio').value = precioFinal.toFixed(2);
        }