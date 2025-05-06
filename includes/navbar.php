<style>
    .sticky-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #000;
        color: white;
        box-sizing: border-box; 
        z-index: 99999;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);

    }
    .menu-logo img {
        width: 140px;
        height: auto;
    }

    .menu-btn {
        font-size: 1.5rem;
        background: none;
        border: none;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
    }

    /* Menú móvil */
    #mobile-menu {
        position: fixed;
        top: 0;
        right: 0;
        width: 80vh;
        height: 100%;
        background-color: black;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        z-index: 100000;

    }

    #mobile-menu.active {
        transform: translateX(0);
    }

    #mobile-menu ul {
        list-style: none;
        text-align: center;
        padding: 0;
    }

    #mobile-menu ul li {
        margin: 20px 0;
    }

    #mobile-menu ul li a {
        text-decoration: none;
        color: white;
        font-size: 1.1rem;
        font-family: 'Nunito', sans-serif;
        align-items: center;
        justify-content: center;
        gap: 10px;
        display: flex;

    }

    #mobile-menu ul li a:hover {
        color: #ff6600;
        transform: scale(1.1);
        text-decoration: none;
        transition: transform 0.3s ease-in-out;
    }

    /* Botón de cerrar */
    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 2.5rem;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        z-index: 100001;
    }

    /* Fondo oscuro cuando el menú está abierto */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
        z-index: 99990;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }

    #mobile-menu ul li a svg {
        width: 1.7rem;
        height: 1.7rem;
        fill: white;
        align-items: center;
        justify-content: center;
    }

    #mobile-menu ul li a:hover svg {
        fill: #FF6F00;
    }

    @media (max-width: 640px) {
        #mobile-menu {
            width: 100%;

        }
    }
</style>

<div class="overlay" id="overlay"></div>

<header id="menu" class="sticky-menu">
    <a href="index.php" class="menu-logo"> <img src=".\icons\design.png" alt="Logo"></a>
    <button id="menu-btn" class="menu-btn">&#9776;</button>
</header>

<nav id="mobile-menu">
    <button class="close-btn" id="close-btn">&times;</button>
    <ul>
        <li><a href="index.php"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 460.298 460.297" style="enable-background:new 0 0 460.298 460.297;"
                    xml:space="preserve">
                    <path d="M230.149,120.939L65.986,256.274c0,0.191-0.048,0.472-0.144,0.855c-0.094,0.38-0.144,0.656-0.144,0.852v137.041
			c0,4.948,1.809,9.236,5.426,12.847c3.616,3.613,7.898,5.431,12.847,5.431h109.63V303.664h73.097v109.64h109.629
			c4.948,0,9.236-1.814,12.847-5.435c3.617-3.607,5.432-7.898,5.432-12.847V257.981c0-0.76-0.104-1.334-0.288-1.707L230.149,120.939
			z" />
                    <path d="M457.122,225.438L394.6,173.476V56.989c0-2.663-0.856-4.853-2.574-6.567c-1.704-1.712-3.894-2.568-6.563-2.568h-54.816
			c-2.666,0-4.855,0.856-6.57,2.568c-1.711,1.714-2.566,3.905-2.566,6.567v55.673l-69.662-58.245
			c-6.084-4.949-13.318-7.423-21.694-7.423c-8.375,0-15.608,2.474-21.698,7.423L3.172,225.438c-1.903,1.52-2.946,3.566-3.14,6.136
			c-0.193,2.568,0.472,4.811,1.997,6.713l17.701,21.128c1.525,1.712,3.521,2.759,5.996,3.142c2.285,0.192,4.57-0.476,6.855-1.998
			L230.149,95.817l197.57,164.741c1.526,1.328,3.521,1.991,5.996,1.991h0.858c2.471-0.376,4.463-1.43,5.996-3.138l17.703-21.125
			c1.522-1.906,2.189-4.145,1.991-6.716C460.068,229.007,459.021,226.961,457.122,225.438z" />
                </svg>
                Inicio</a></li>
        <li><a href=".\Catologo.php"><svg id="icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: none;
                            }
                        </style>
                    </defs>
                    <title />
                    <path d="M26,2H8A2,2,0,0,0,6,4V8H4v2H6v5H4v2H6v5H4v2H6v4a2,2,0,0,0,2,2H26a2,2,0,0,0,2-2V4A2,2,0,0,0,26,2Zm0,26H8V24h2V22H8V17h2V15H8V10h2V8H8V4H26Z" transform="translate(0 0)" />
                    <rect height="2" width="8" x="14" y="8" />
                    <rect height="2" width="8" x="14" y="15" />
                    <rect height="2" width="8" x="14" y="22" />
                    <rect class="cls-1" data-name="&lt;Transparent Rectangle&gt;" height="32" id="_Transparent_Rectangle_" width="32" />
                </svg>
                Todos los Productos</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" focusable="false" viewBox="0 0 12 12">
                    <path fill="currentColor"
                        d="M3.15 11.96c-.14 0-.25-.05-.34-.11-.29-.2-.36-.58-.2-1.03L4.3 6H3.24a.74.74 0 01-.62-.32c-.14-.21-.15-.48-.04-.74L4.42.66c.16-.38.57-.66.97-.66H9.1c.26 0 .49.12.62.32a.8.8 0 01.04.74L7.68 5h1.09c.33 0 .58.16.69.42.05.15.13.53-.34.98l-5.27 5.22c-.28.26-.52.34-.7.34z" />
                </svg>Nuevos Productos</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" focusable="false" viewBox="0 0 12 12">
                    <path fill="currentColor"
                        d="M3.15 11.96c-.14 0-.25-.05-.34-.11-.29-.2-.36-.58-.2-1.03L4.3 6H3.24a.74.74 0 01-.62-.32c-.14-.21-.15-.48-.04-.74L4.42.66c.16-.38.57-.66.97-.66H9.1c.26 0 .49.12.62.32a.8.8 0 01.04.74L7.68 5h1.09c.33 0 .58.16.69.42.05.15.13.53-.34.98l-5.27 5.22c-.28.26-.52.34-.7.34z" />
                </svg>Lo mas vendido</a></li>
        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" focusable="false" viewBox="0 0 12 12">
                    <path fill="currentColor"
                        d="M3.15 11.96c-.14 0-.25-.05-.34-.11-.29-.2-.36-.58-.2-1.03L4.3 6H3.24a.74.74 0 01-.62-.32c-.14-.21-.15-.48-.04-.74L4.42.66c.16-.38.57-.66.97-.66H9.1c.26 0 .49.12.62.32a.8.8 0 01.04.74L7.68 5h1.09c.33 0 .58.16.69.42.05.15.13.53-.34.98l-5.27 5.22c-.28.26-.52.34-.7.34z" />
                </svg>Ofertas Relampago</a></li>
        <li><a href="#"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: none;
                            }
                        </style>
                    </defs>
                    <title />
                    <g data-name="Layer 2" id="Layer_2">
                        <path d="M16,12a2,2,0,1,1,2-2A2,2,0,0,1,16,12Zm0-2Z" />
                        <path d="M16,29A13,13,0,1,1,29,16,13,13,0,0,1,16,29ZM16,5A11,11,0,1,0,27,16,11,11,0,0,0,16,5Z" />
                        <path d="M16,24a2,2,0,0,1-2-2V16a2,2,0,0,1,4,0v6A2,2,0,0,1,16,24Zm0-8v0Z" />
                    </g>
                    <g id="frame">
                        <rect class="cls-1" height="32" width="32" />
                    </g>
                </svg>
                Ayuda</a></li>

    </ul>
</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('overlay');

    function openMenu() {
        mobileMenu.classList.add('active');
        overlay.classList.add('active');
    }

    function closeMenu() {
        mobileMenu.classList.remove('active');
        overlay.classList.remove('active');
    }

    menuBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
</script>