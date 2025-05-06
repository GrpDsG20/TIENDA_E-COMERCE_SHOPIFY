
        function aplicarFiltro() {
            const filtroEstado = document.getElementById('filtro-estado').value;
            const porPagina = document.getElementById('por-pagina').value;
            window.location.href = `?pagina=1&estado=${filtroEstado}&por_pagina=${porPagina}`;
        }

        function filtrarTabla() {
            const buscar = document.getElementById('buscar').value.toLowerCase();
            const filtroEstado = document.getElementById('filtro-estado').value;
            const filas = document.querySelectorAll('#tabla-pedidos tbody tr');

            filas.forEach(fila => {
                const nombreCliente = fila.querySelector('td[data-label="Cliente"]').textContent.toLowerCase();
                const idCompra = fila.querySelector('td[data-label="ID Compra"]').textContent;
                const estado = fila.querySelector('.estado').value;

                const coincideBusqueda = nombreCliente.includes(buscar) || idCompra.includes(buscar);
                const coincideEstado = filtroEstado === '' || estado === filtroEstado;

                if (coincideBusqueda && coincideEstado) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        }

        function actualizarEstado(idCompra, estado) {
            fetch('actualizar_estado.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: idCompra,
                        estado: estado
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Estado actualizado correctamente.');
                        if (estado === 'cancelado') {
                            // Eliminar después de 30 días
                            setTimeout(() => {
                                window.location.href = 'eliminar_pedido.php?id=' + idCompra;
                            }, 30 * 24 * 60 * 60 * 1000); // 30 días en milisegundos
                        }
                    } else {
                        alert('Error al actualizar el estado.');
                    }
                });
        }