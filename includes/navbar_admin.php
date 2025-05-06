<header id="menu" class="sticky-menu">
    <a href="dashboard.php" class="menu-logo"> <img src=".\icons\design.png" alt="Logo"></a>
    <a href="logout.php" id="menu-btn" class="menu-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.992 8.994V6.996H7.995v-2h3.997V2.999l3.998 2.998-3.998 2.998zm-1.998 2.998H5.996V2.998L2 1h7.995v2.998h1V1c0-.55-.45-.999-1-.999H.999A1.001 1.001 0 0 0 0 1v11.372c0 .39.22.73.55.91L5.996 16v-3.008h3.998c.55 0 1-.45 1-1V7.996h-1v3.998z" />
        </svg></a>
</header>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

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
        z-index: 99999;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);

    }

    .menu-logo img {
        width: 140px;
        height: auto;
    }

    .menu-btn svg {
        width: 30px;
        height: 30px;
        fill: #fff;
        cursor: pointer;
    }
</style>