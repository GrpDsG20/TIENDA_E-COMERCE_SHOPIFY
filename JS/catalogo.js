
        document.getElementById('price-slider').addEventListener('input', function() {
            document.getElementById('price-value').textContent = this.value;
        });

        // Establecer el valor inicial a 100 cuando se cargue la página, pero el slider comienza en 500
        document.getElementById('price-value').textContent = 500;

        document.addEventListener("DOMContentLoaded", function() {
            const categoryFilter = document.getElementById("category-filter");
            const priceSlider = document.getElementById("price-slider");
            const popularityFilter = document.getElementById("popularity-filter");
            const productosContainer = document.getElementById("productos");

            function fetchProducts() {
                const category = categoryFilter.value;
                const price = priceSlider.value;
                const popularity = popularityFilter.value;

                const params = new URLSearchParams({
                    category,
                    price,
                    popularity
                });

                fetch("filtrar_productos.php?" + params.toString())
                    .then(response => response.text())
                    .then(data => {
                        productosContainer.innerHTML = data;
                    })
                    .catch(error => console.error("Error:", error));
            }

            // Detectar cambios y aplicar filtros automáticamente
            categoryFilter.addEventListener("change", fetchProducts);
            priceSlider.addEventListener("input", function() {
                document.getElementById("price-value").textContent = this.value;
                fetchProducts();
            });
            popularityFilter.addEventListener("change", fetchProducts);

            // Cargar todos los productos al inicio
            fetchProducts();
        });

        
