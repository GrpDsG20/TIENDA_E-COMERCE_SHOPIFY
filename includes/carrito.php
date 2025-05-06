<link rel="stylesheet" href="style/carrito.css">
<!-- Ícono flotante del carrito -->
<div class="carrito" onclick="mostrarCarrito()">
    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px"
        viewBox="0 0 19.25 19.25" style="enable-background:new 0 0 19.25 19.25;" xml:space="preserve">
        <g id="Layer_1_107_">
            <path style="fill:#FFFFFF;" d="M19.006,2.97c-0.191-0.219-0.466-0.345-0.756-0.345H4.431L4.236,1.461
				C4.156,0.979,3.739,0.625,3.25,0.625H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124
				c0.016,0.053,0.029,0.103,0.054,0.151c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112
				c0.058,0.054,0.125,0.092,0.193,0.13c0.038,0.021,0.071,0.049,0.112,0.065c0.116,0.047,0.238,0.075,0.367,0.075
				c0.001,0,11.001,0,11.001,0c0.553,0,1-0.447,1-1s-0.447-1-1-1H6.097l-0.166-1H17.25c0.498,0,0.92-0.366,0.99-0.858l1-7
				C19.281,3.479,19.195,3.188,19.006,2.97z M17.097,4.625l-0.285,2H13.25v-2H17.097z M12.25,4.625v2h-3v-2H12.25z M12.25,7.625v2
				h-3v-2H12.25z M8.25,4.625v2h-3c-0.053,0-0.101,0.015-0.148,0.03l-0.338-2.03H8.25z M5.264,7.625H8.25v2H5.597L5.264,7.625z
			 M13.25,9.625v-2h3.418l-0.285,2H13.25z" />
            <circle style="fill:#FFFFFF;" cx="6.75" cy="17.125" r="1.5" />
            <circle style="fill:#FFFFFF;" cx="15.75" cy="17.125" r="1.5" />
        </g>
    </svg>
    <span id="contadorCarrito" class="contador">0</span>
</div>

<!-- Panel del carrito flotante -->
<div id="panelCarrito" class="panel-carrito">
    <button class="cerrar-carrito" onclick="cerrarCarrito()"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20"
            viewBox="0 0 52.001 52.001" style="enable-background:new 0 0 52.001 52.001;" xml:space="preserve">
            <path style="fill:#030104;" d="M47.743,41.758L33.955,26.001l13.788-15.758c2.343-2.344,2.343-6.143,0-8.486
			c-2.345-2.343-6.144-2.342-8.486,0.001L26,16.91L12.743,1.758C10.4-0.584,6.602-0.585,4.257,1.757
			c-2.343,2.344-2.343,6.143,0,8.486l13.788,15.758L4.257,41.758c-2.343,2.343-2.343,6.142-0.001,8.485
			c2.344,2.344,6.143,2.344,8.487,0L26,35.091l13.257,15.152c2.345,2.344,6.144,2.344,8.487,0
			C50.086,47.9,50.086,44.101,47.743,41.758z" />
        </svg></button>
    <h2><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30"
            viewBox="0 0 19.25 19.25" style="enable-background:new 0 0 19.25 19.25;" xml:space="preserve">
            <g id="Layer_1_107_">
                <path style="fill:#030104;" d="M19.006,2.97c-0.191-0.219-0.466-0.345-0.756-0.345H4.431L4.236,1.461
				C4.156,0.979,3.739,0.625,3.25,0.625H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124
				c0.016,0.053,0.029,0.103,0.054,0.151c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112
				c0.058,0.054,0.125,0.092,0.193,0.13c0.038,0.021,0.071,0.049,0.112,0.065c0.116,0.047,0.238,0.075,0.367,0.075
				c0.001,0,11.001,0,11.001,0c0.553,0,1-0.447,1-1s-0.447-1-1-1H6.097l-0.166-1H17.25c0.498,0,0.92-0.366,0.99-0.858l1-7
				C19.281,3.479,19.195,3.188,19.006,2.97z M17.097,4.625l-0.285,2H13.25v-2H17.097z M12.25,4.625v2h-3v-2H12.25z M12.25,7.625v2
				h-3v-2H12.25z M8.25,4.625v2h-3c-0.053,0-0.101,0.015-0.148,0.03l-0.338-2.03H8.25z M5.264,7.625H8.25v2H5.597L5.264,7.625z
				 M13.25,9.625v-2h3.418l-0.285,2H13.25z" />
                <circle style="fill:#030104;" cx="6.75" cy="17.125" r="1.5" />
                <circle style="fill:#030104;" cx="15.75" cy="17.125" r="1.5" />
        </svg>Carrito</h2>
    <ul id="listaCarrito"></ul>

    <!-- Resumen de compra -->
    <div class="resumen-carrito">
        <div class="fila">
            <span>Entrega</span>
            <span class="gratis">GRATIS</span>
        </div>
        <div class="fila">
            <span>Total</span>
            <span class="total">S/ <span id="totalCarrito">0.00</span></span>
        </div>
    </div>
    <p class="nota">Gastos de envío e impuestos calculados al finalizar la compra</p>

    <!-- Botones -->
    <button class="btn-comprar" onclick="comprar()">Finalizar compra</button>
    <button class="btn-limpiar" onclick="limpiarCarrito()"> Vaciar Carrito</button>
</div>


<!-- Panel de datos del cliente -->
<div id="panelDatosCliente" class="panel-datos-cliente">
    <button class="cerrar-datos-cliente" onclick="cerrarPanelDatosCliente()">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20"
            viewBox="0 0 52.001 52.001" style="enable-background:new 0 0 52.001 52.001;" xml:space="preserve">
            <path style="fill:#030104;" d="M47.743,41.758L33.955,26.001l13.788-15.758c2.343-2.344,2.343-6.143,0-8.486
            c-2.345-2.343-6.144-2.342-8.486,0.001L26,16.91L12.743,1.758C10.4-0.584,6.602-0.585,4.257,1.757
            c-2.343,2.344-2.343,6.143,0,8.486l13.788,15.758L4.257,41.758c-2.343,2.343-2.343,6.142-0.001,8.485
            c2.344,2.344,6.143,2.344,8.487,0L26,35.091l13.257,15.152c2.345,2.344,6.144,2.344,8.487,0
            C50.086,47.9,50.086,44.101,47.743,41.758z" />
        </svg>
    </button>
    <h2>Datos del Cliente</h2>
    <form id="formDatosCliente">

        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

        <input type="text" id="contacto" name="contacto" placeholder="Número de contacto" required>

        <input type="email" id="correo" name="correo" placeholder="Correo de contacto" required>

        <input type="text" id="direccion" name="direccion" placeholder="Direccion" required>

        <select id="pais" name="pais" required>
            <option value="Perú" selected>Perú</option>
        </select>

        <select id="departamento" name="departamento" required onchange="cargarprovincias()">
            <option value="">Selecciona una departamento</option>
            <!-- departamentos de Perú -->
            <option value="Amazonas">Amazonas</option>
            <option value="Áncash">Áncash</option>
            <option value="Apurímac">Apurímac</option>
            <option value="Arequipa">Arequipa</option>
            <option value="Ayacucho">Ayacucho</option>
            <option value="Cajamarca">Cajamarca</option>
            <option value="Callao">Callao</option>
            <option value="Cusco">Cusco</option>
            <option value="Huancavelica">Huancavelica</option>
            <option value="Huánuco">Huánuco</option>
            <option value="Ica">Ica</option>
            <option value="Junín">Junín</option>
            <option value="La Libertad">La Libertad</option>
            <option value="Lambayeque">Lambayeque</option>
            <option value="Lima">Lima</option>
            <option value="Loreto">Loreto</option>
            <option value="Madre de Dios">Madre de Dios</option>
            <option value="Moquegua">Moquegua</option>
            <option value="Pasco">Pasco</option>
            <option value="Piura">Piura</option>
            <option value="Puno">Puno</option>
            <option value="San Martín">San Martín</option>
            <option value="Tacna">Tacna</option>
            <option value="Tumbes">Tumbes</option>
            <option value="Ucayali">Ucayali</option>
        </select>


        <select id="provincia" name="provincia" required>
            <option value="">Selecciona una provincia</option>
        </select>

        <input type="text" id="distrito" name="distrito" placeholder="Distrito">


        <button type="button" class="btn-enviar" onclick="enviarDatos()">Enviar</button>
        <button type="button" class="btn-cancelar" onclick="cerrarPanelDatosCliente()">Cancelar</button>
    </form>
</div>

<script src="JS/carrito.js"></script>