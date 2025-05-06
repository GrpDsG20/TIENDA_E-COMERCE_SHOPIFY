
        $(document).ready(function() {
            $("#buscador").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".producto").filter(function() {
                    $(this).toggle($(this).find(".nombre").text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este producto?");
        }

        document.querySelectorAll('.agregar-carrito').forEach(boton => {
            boton.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();
                const idProducto = boton.getAttribute('data-id');
                window.location.href = `agregar_producto.php?id=${idProducto}`;
            });
        });

        document.querySelectorAll('.eliminar-producto').forEach(boton => {
            boton.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();
                if (confirmarEliminacion()) {
                    const idProducto = boton.getAttribute('data-id');
                    window.location.href = `eliminar_producto.php?id=${idProducto}`;
                }
            });
        });