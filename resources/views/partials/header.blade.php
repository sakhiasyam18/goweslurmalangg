<style>
/* --- Navbar Styling --- */
.navbar-clean {
    background-color: rgba(255, 255, 255, 0.95);
    /* Putih transparan */
    backdrop-filter: blur(10px);
    /* Efek blur di belakang */
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
    /* Bayangan sangat halus */
    padding-top: 15px;
    padding-bottom: 15px;
    transition: all 0.3s ease;
}

/* Logo Styling */
.logo-img {
    height: 45px;
    /* Tinggi tetap agar layout stabil */
    width: auto;
    object-fit: contain;
}

/* Link Navigasi */
.nav-link-custom {
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    color: #2c3e50 !important;
    margin: 0 12px;
    position: relative;
    padding: 5px 0;
    transition: color 0.3s ease;
}

.nav-link-custom:hover {
    color: #0d6efd !important;
    /* Biru Bootstrap */
}

/* Animasi Garis Bawah saat Hover */
.nav-link-custom::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: #0d6efd;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link-custom:hover::after {
    width: 100%;
}

/* Tombol Hamburger (Mobile) */
.navbar-toggler {
    border: none;
    padding: 0;
    color: #2c3e50;
}

.navbar-toggler:focus {
    box-shadow: none;
    outline: none;
}

/* Mobile Menu Adjustment */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-top: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .nav-link-custom {
        margin: 5px 0;
        display: block;
        text-align: center;
        /* Menu tengah di HP */
    }

    .nav-link-custom::after {
        display: none;
        /* Matikan garis animasi di HP biar bersih */
    }
}
</style>

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-clean">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo GowesLurr" class="logo-img">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars fa-lg"></span> </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#how-to-order">Cara Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#catalog">Katalog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#sewa">Harga Sewa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#lokasi">Lokasi</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>