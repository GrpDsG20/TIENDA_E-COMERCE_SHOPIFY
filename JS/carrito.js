
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Función para agregar productos al carrito
    function agregarAlCarrito(event, nombre, imagen, precio, precio_original) {
        event.preventDefault();
        event.stopPropagation();
        const productoExistente = carrito.find((p) => p.nombre === nombre);
        productoExistente ? productoExistente.cantidad++ : carrito.push({
            nombre,
            imagen,
            precio,
            precio_original,
            cantidad: 1
        });
        localStorage.setItem('carrito', JSON.stringify(carrito));
        actualizarContador();
        actualizarListaCarrito();
    }

    // Función para actualizar el contador del carrito
    function actualizarContador() {
        document.getElementById("contadorCarrito").innerText = carrito.reduce((total, p) => total + p.cantidad, 0);
    }

    // Inicializar el contador del carrito al cargar la página
    actualizarContador();

    // Función para mostrar el panel del carrito
    function mostrarCarrito() {
        document.getElementById("panelCarrito").style.right = "0";
        actualizarListaCarrito();
    }

    // Función para cerrar el panel del carrito
    function cerrarCarrito() {
        document.getElementById("panelCarrito").style.right = "-100%";

    }

    // Función para actualizar la lista de productos en el carrito
    function actualizarListaCarrito() {
        const lista = document.getElementById("listaCarrito");
        lista.innerHTML = carrito.map((producto, index) => `
        <li class="producto-carrito">
            <img src="${producto.imagen}" alt="${producto.nombre}" class="img-carrito">
            <div class="info-producto">
                <span class="nombre-producto">${producto.nombre}</span>
                <div class="precios">
                    <span class="precio-producto">S/ ${producto.precio.toFixed(2)}</span>
                    ${producto.precio_original !== producto.precio ? 
                        `<span class="precio-original">S/ <s>${producto.precio_original.toFixed(2)}</s></span>` : ''
                    }
                </div>
            </div>
            <input type="number" value="${producto.cantidad}" class="cantidad" onchange="actualizarCantidad(${index}, this.value)" min="1">
            <button class="btn-eliminar" onclick="eliminarDelCarrito(${index})">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="24px" height="24px" viewBox="0 0 64 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M27,3L9,3C7.896,3 7,3.896 7,5C7,6.104 7.896,7 9,7L55,7C56.104,7 57,6.104 57,5C57,3.896 56.104,3 55,3L38,3C38,1.896 37.104,1 36,1L29,1C27.896,1 27,1.896 27,3Z"/>
                    <path d="M56.981,11.277C57.061,10.704 56.889,10.124 56.509,9.687C56.129,9.251 55.579,9 55,9L9,9C8.421,9 7.871,9.251 7.491,9.687C7.111,10.124 6.939,10.704 7.019,11.277L14.019,61.277C14.158,62.265 15.003,63 16,63L48,63C48.997,63 49.842,62.265 49.981,61.277L56.981,11.277ZM16.019,18.275L21.019,54.275C21.171,55.368 22.182,56.133 23.275,55.981C24.368,55.829 25.133,54.818 24.981,53.725L19.981,17.725C19.829,16.632 18.818,15.867 17.725,16.019C16.632,16.171 15.867,17.182 16.019,18.275ZM44.019,17.725L39.019,53.725C38.867,54.818 39.632,55.829 40.725,55.981C41.818,56.133 42.829,55.368 42.981,54.275L47.981,18.275C48.133,17.182 47.368,16.171 46.275,16.019C45.182,15.867 44.171,16.632 44.019,17.725ZM30,18L30,54C30,55.104 30.896,56 32,56C33.104,56 34,55.104 34,54L34,18C34,16.896 33.104,16 32,16C30.896,16 30,16.896 30,18Z"/>
                </svg>
            </button>
        </li>
    `).join('');
        document.getElementById("totalCarrito").innerText = carrito.reduce((total, p) => total + p.precio * p.cantidad, 0).toFixed(2);
    }

    // Función para actualizar la cantidad de un producto en el carrito
    function actualizarCantidad(index, cantidad) {
        carrito[index].cantidad = Math.max(1, parseInt(cantidad));
        localStorage.setItem('carrito', JSON.stringify(carrito));
        actualizarContador();
        actualizarListaCarrito();
    }

    // Función para eliminar un producto del carrito
    function eliminarDelCarrito(index) {
        carrito.splice(index, 1);
        localStorage.setItem('carrito', JSON.stringify(carrito));
        actualizarContador();
        actualizarListaCarrito();
    }

    // Función para limpiar el carrito
    function limpiarCarrito() {
        carrito = [];
        localStorage.removeItem('carrito');
        actualizarContador();
        actualizarListaCarrito();
        cerrarCarrito();
    }

    // Función para mostrar el panel de datos del cliente
    function comprar() {
        if (carrito.length) {
            document.getElementById("panelDatosCliente").style.display = "block";
        } else {
            alert("Tu carrito está vacío.");
        }
    }

    // Función para cerrar el panel de datos del cliente
    function cerrarPanelDatosCliente() {
        document.getElementById("panelDatosCliente").style.display = "none";
    }


    const provinciasPordepartamento = {
        "Amazonas": ["Chachapoyas", "Bagua", "Bongará", "Condorcanqui", "Luya", "Rodríguez de Mendoza", "Utcubamba"],
        "Áncash": ["Huaraz", "Aija", "Antonio Raymondi", "Asunción", "Bolognesi", "Carhuaz", "Carlos Fermín Fitzcarrald", "Casma", "Corongo", "Huari", "Huarmey", "Huaylas", "Mariscal Luzuriaga", "Ocros", "Pallasca", "Pomabamba", "Recuay", "Santa", "Sihuas", "Yungay"],
        "Apurímac": ["Abancay", "Andahuaylas", "Antabamba", "Aymaraes", "Cotabambas", "Chincheros", "Grau"],
        "Arequipa": ["Arequipa", "Camaná", "Caravelí", "Castilla", "Caylloma", "Condesuyos", "Islay", "La Unión"],
        "Ayacucho": ["Huamanga", "Cangallo", "Huanca Sancos", "Huanta", "La Mar", "Lucanas", "Parinacochas", "Paucar del Sara Sara", "Sucre", "Víctor Fajardo", "Vilcas Huamán"],
        "Cajamarca": ["Cajamarca", "Cajabamba", "Celendín", "Chota", "Contumazá", "Cutervo", "Hualgayoc", "Jaén", "San Ignacio", "San Marcos", "San Miguel", "San Pablo", "Santa Cruz"],
        "Callao": ["Callao"],
        "Cusco": ["Cusco", "Acomayo", "Anta", "Calca", "Canas", "Canchis", "Chumbivilcas", "Espinar", "La Convención", "Paruro", "Paucartambo", "Quispicanchi", "Urubamba"],
        "Huancavelica": ["Huancavelica", "Acobamba", "Angaraes", "Castrovirreyna", "Churcampa", "Huaytará", "Tayacaja"],
        "Huánuco": ["Huánuco", "Ambo", "Dos de Mayo", "Huacaybamba", "Huamalíes", "Leoncio Prado", "Marañón", "Pachitea", "Puerto Inca", "Lauricocha", "Yarowilca"],
        "Ica": ["Ica", "Chincha", "Nazca", "Palpa", "Pisco"],
        "Junín": ["Huancayo", "Concepción", "Chanchamayo", "Jauja", "Junín", "Satipo", "Tarma", "Yauli", "Chupaca"],
        "La Libertad": ["Trujillo", "Ascope", "Bolívar", "Chepén", "Gran Chimú", "Julcán", "Otuzco", "Pacasmayo", "Pataz", "Sánchez Carrión", "Santiago de Chuco", "Virú"],
        "Lambayeque": ["Chiclayo", "Ferreñafe", "Lambayeque"],
        "Lima": ["Lima", "Barranca", "Cajatambo", "Canta", "Cañete", "Huaral", "Huarochirí", "Huaura", "Oyón", "Yauyos"],
        "Loreto": ["Iquitos", "Alto Amazonas", "Datem del Marañón", "Loreto", "Mariscal Ramón Castilla", "Maynas", "Putumayo", "Requena", "Ucayali"],
        "Madre de Dios": ["Tambopata", "Manu", "Tahuamanu"],
        "Moquegua": ["Mariscal Nieto", "General Sánchez Cerro", "Ilo"],
        "Pasco": ["Pasco", "Daniel Alcides Carrión", "Oxapampa"],
        "Piura": ["Piura", "Ayabaca", "Huancabamba", "Morropón", "Paita", "Sechura", "Sullana", "Talara"],
        "Puno": ["Puno", "Azángaro", "Carabaya", "Chucuito", "El Collao", "Huancané", "Lampa", "Melgar", "Moho", "San Antonio de Putina", "San Román", "Sandia", "Yunguyo"],
        "San Martín": ["Moyobamba", "Bellavista", "El Dorado", "Huallaga", "Lamas", "Mariscal Cáceres", "Picota", "Rioja", "San Martín", "Tocache"],
        "Tacna": ["Tacna", "Candarave", "Jorge Basadre", "Tarata"],
        "Tumbes": ["Tumbes", "Contralmirante Villar", "Zarumilla"],
        "Ucayali": ["Coronel Portillo", "Atalaya", "Padre Abad", "Purús"]
    };


    function cargarprovincias() {
        const departamentoSelect = document.getElementById("departamento");
        const provinciaSelect = document.getElementById("provincia");
        const departamento = departamentoSelect.value;

        provinciaSelect.innerHTML = '<option value="">Selecciona un provincia</option>';

        if (departamento && provinciasPordepartamento[departamento]) {
            provinciasPordepartamento[departamento].forEach(provincia => {
                const option = document.createElement("option");
                option.value = provincia;
                option.textContent = provincia;
                provinciaSelect.appendChild(option);
            });
        }
    }


    function enviarDatos() {
        // Mostrar el efecto de carga dentro del panel
        mostrarCarga();

        // Obtener datos del cliente
        const datosCliente = {
            nombre: document.getElementById('nombre').value,
            contacto: document.getElementById('contacto').value,
            correo: document.getElementById('correo').value,
            direccion: document.getElementById('direccion').value,
            pais: document.getElementById('pais').value,
            departamento: document.getElementById('departamento').value,
            provincia: document.getElementById('provincia').value,
            distrito: document.getElementById('distrito').value,
        };

        // Obtener datos del carrito
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        const totalCarrito = document.getElementById('totalCarrito').textContent;

        // Crear el objeto con todos los datos
        const datosEnvio = {
            cliente: datosCliente,
            productos: carrito,
            total: totalCarrito,
        };

        // Enviar datos al servidor
        fetch('guardar_compra.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datosEnvio),
            })
            .then(response => response.json())
            .then(data => {
                // Forzar una duración mínima de 3 segundos para el spinner
                setTimeout(() => {
                    ocultarCarga(); // Ocultar el efecto de carga
                    limpiarCarrito(); // Limpiar el carrito
                    cerrarPanelDatosCliente(); // Cerrar el panel de datos del cliente
                }, 3000); // 3000 milisegundos = 3 segundos
            })
            .catch(error => {
                console.error('Error:', error);
                ocultarCarga(); // Ocultar el efecto de carga en caso de error
            });
    }

    function mostrarCarga() {
        const panelDatosCliente = document.getElementById('panelDatosCliente');
        const loadingOverlay = document.createElement('div');
        loadingOverlay.id = 'loading-overlay';
        loadingOverlay.innerHTML = `
        <div class="spinner"></div>
        <p class="texto-carga">Enviando...</p>
    `;
        panelDatosCliente.appendChild(loadingOverlay);
    }

    function ocultarCarga() {
        const loadingOverlay = document.getElementById('loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }
