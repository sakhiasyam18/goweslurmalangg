<style>
    #home,
    .hero-section {
        padding-top: 1.5rem !important;
    }

    .navbar {
        padding: 0.5rem 1rem !important;
    }


    .navbar-brand {
        font-weight: 700;
        font-size: 1.6rem;
    }

    .hero-section {
        width: 100vw;
        /* Full lebar layar */
        /* Full tinggi layar */
        background: #fff;
        overflow: hidden;
    }

    .hero-decor {
        position: absolute;
        top: -50px;
        right: -80px;
        width: 110%;
        height: 120%;
        background: #e9eef6;
        border-radius: 50px;
        z-index: 0;
        /* di belakang gambar */
    }

    .hero-image {
        position: relative;
        z-index: 1;
        /* di depan kotak */
        max-width: 100%;
        top: -15px;
        left: -80px;
        height: auto;
        object-fit: cover;
        display: block;
        margin: 0 auto;
    }

    .hero-section a {
        border-radius: 50px;
        background-color: #3a5393;
    }


    @media (max-width: 576px) {
        .hero-section {
            padding: 3rem 1rem;
        }

        .hero-decor {
            top: -10px;
            right: -20px;
            width: 140%;
            height: 110%;
            border-radius: 30px;
        }

        .circle-decor {
            opacity: 0.3;
        }

        .order-icon {
            width: 60px;
            height: 60px;
            font-size: 1.3rem;
        }

        .order-frame {
            padding: 2rem 1rem;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
        }

        .hero-image {
            left: 0;
            margin-top: 2rem;
            max-width: 90%;
        }

        .hero-decor {
            top: -20px;
            right: -40px;
            width: 130%;
            height: 115%;
            border-radius: 40px;
        }
</style>
<section id="home" class="hero-section align-items-center">
    <div class="container">
        <div class="row align-items-center flex-wrap">
            <div class="col-md-6 mb-4 text-center text-md-start">
                <h3 class="fw-normal mb-3 display-6">
                    Nikmati Malang <br>
                    dengan Gowesan <br>Seru Bareng <br>
                    <span class="fw-semibold">goweslurr</span>. <br>
                    Gowes Santai, Harga Bersahabat!
                </h3>

                <a href="#sewa" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                    Sewa Sekarang →
                </a>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="hero-slider-wrapper position-relative">

                    <div class="hero-blob"></div>

                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                        data-bs-interval="3000">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="{{ asset('images/slider/hero.png') }}" class="img-fluid hero-slider-img"
                                    alt="Sepeda Utama">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/1.png') }}" class="img-fluid hero-slider-img"
                                    alt="Koleksi 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/2.png') }}" class="img-fluid hero-slider-img"
                                    alt="Koleksi 2">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/5.png') }}" class="img-fluid hero-slider-img"
                                    alt="Koleksi 5">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/6.png') }}" class="img-fluid hero-slider-img"
                                    alt="Koleksi 6">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/slider/7.png') }}" class="img-fluid hero-slider-img"
                                    alt="Koleksi 7">
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>