<style>
/* --- CSS Hero Section --- */
.hero-section {
    background: linear-gradient(135deg, #ffffff 0%, #f4f7fa 100%);
    min-height: 100vh;
    /* Full layar */
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding-top: 80px;
    padding-bottom: 50px;
}

/* Typography */
.hero-title {
    font-weight: 800;
    color: #2c3e50;
    line-height: 1.2;
    letter-spacing: -1px;
}

.hero-title span {
    color: #0d6efd;
    position: relative;
    display: inline-block;
}

.hero-title span::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 8px;
    bottom: 5px;
    left: 0;
    background-color: rgba(13, 110, 253, 0.2);
    z-index: -1;
    border-radius: 4px;
}

.hero-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    font-weight: 400;
}

/* Buttons */
.btn-hero-primary {
    background-color: #0d6efd;
    color: #fff;
    font-weight: 600;
    padding: 12px 35px;
    border-radius: 50px;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
}

.btn-hero-primary:hover {
    transform: translateY(-3px);
    background-color: #0b5ed7;
    box-shadow: 0 15px 30px rgba(13, 110, 253, 0.3);
}

/* --- CSS SLIDER KHUSUS --- */
.hero-slider-wrapper {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 600px;
    /* Batas lebar agar tidak terlalu besar */
    margin: 0 auto;
}

/* Blob di belakang slider */
.hero-blob {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 140%;
    height: 140%;
    /* background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23EBF2FF' d='M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-5.3C93.5,8.6,82.2,21.4,71.1,32.2C60,43,49.1,51.8,37.4,59.3C25.7,66.8,13.2,72.9,-0.7,74.1C-14.6,75.3,-28.1,71.6,-40.5,64.5C-52.9,57.4,-64.2,46.9,-71.5,34.3C-78.8,21.7,-82.1,7,-80.1,-6.8C-78.1,-20.6,-70.8,-33.5,-60.8,-43.4C-50.8,-53.3,-38.1,-60.2,-25.3,-68.2C-12.5,-76.2,-0.4,-85.3,12.9,-87.4C26.2,-89.5,30.5,-83.6,44.7,-76.4Z' transform='translate(100 100)' /%3E%3C/svg%3E"); */
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    z-index: -1;
    /* Di belakang gambar */
    animation: pulseBlob 8s infinite alternate;
}

/* Style Gambar Slider */
.hero-slider-img {
    width: 100%;
    height: 400px;
    /* Tinggi tetap agar layout tidak lompat-lompat */
    object-fit: contain;
    /* Gambar tidak akan gepeng/terpotong */
    filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.1));
    /* Bayangan lembut */
    transition: transform 0.5s ease;
}

/* Animasi Fade Carousel Bootstrap agar lebih smooth */
.carousel-fade .carousel-item {
    opacity: 0;
    transition-duration: .8s;
    /* Durasi transisi diperlambat sedikit biar elegan */
    transition-property: opacity;
}

.carousel-fade .carousel-item.active,
.carousel-fade .carousel-item-next.carousel-item-start,
.carousel-fade .carousel-item-prev.carousel-item-end {
    opacity: 1;
}

.carousel-fade .active.carousel-item-start,
.carousel-fade .active.carousel-item-end {
    opacity: 0;
}

/* Animations Keyframes */
@keyframes pulseBlob {
    0% {
        transform: translate(-50%, -50%) scale(1);
    }

    100% {
        transform: translate(-50%, -50%) scale(1.1);
    }
}

/* Responsive Mobile */
@media (max-width: 991.98px) {
    .hero-section {
        text-align: center;
        padding-top: 100px;
        height: auto;
        min-height: auto;
    }

    .hero-title {
        font-size: 2.2rem;
    }

    .hero-slider-img {
        height: 300px;
        /* Di HP gambar lebih kecil sedikit */
    }

    .hero-content {
        margin-bottom: 2rem;
    }
}
</style>

<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center flex-column-reverse flex-lg-row">

            <div class="col-lg-6 hero-content animate__animated animate__fadeInLeft">
                <span
                    class="badge bg-white text-primary border border-primary mb-3 px-3 py-2 rounded-pill fw-medium shadow-sm">
                    Sewa Sepeda Nomor 1 di Malang
                </span>

                <h1 class="display-4 hero-title mb-3">
                    Jelajahi Kota Malang <br>
                    Sewanya di <span>GowesLurr</span>
                </h1>

                <p class="hero-subtitle pe-lg-5">
                    Nikmati kebebasan penuh berkeliling Malang dengan sistem <strong>Lepas Kunci</strong>.
                    Durasi fleksibel mulai dari <strong>1 Hari hingga 30 Hari</strong>.
                    Ambil sepedanya, atur sendiri rute dan petualanganmu!
                </p>

                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="#catalog"
                        class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold d-flex align-items-center">
                        Lihat Katalog
                    </a>
                </div>
            </div>

            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="hero-slider-wrapper">

                    <div class="hero-blob"></div>

                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                        data-bs-interval="3000">

                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="{{ asset('images/slider/hero.png') }}" class="hero-slider-img"
                                    alt="Sepeda Utama">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/1.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 1">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/2.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 2">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/3.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 3">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/4.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 4">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/5.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 5">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/6.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 6">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/7.png') }}" class="hero-slider-img"
                                    alt="Koleksi Sepeda 7">
                            </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-primary rounded-circle p-3"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-primary rounded-circle p-3"
                                aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>