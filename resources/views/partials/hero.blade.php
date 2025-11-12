<section id="home" class="hero-section d-flex align-items-center">
    <div class="container-fluid px-5">
        <div class="row align-items-center flex-wrap">
            <div class="col-md-6 mb-4 text-center text-md-start">
                <h3 class="fw-normal mb-3 display-6">
                    Nikmati Malang <br>
                    dengan Gowesan <br>Seru Bareng <br> 
                    <span class="fw-semibold">goweslurr</span>. <br>
                    Gowes Santai, Harga Bersahabat!
                </h3>

                <a href="{{ route('pembayaran.create') }}" 
                   class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                    Sewa Sekarang →
                </a>
            </div>
            <div class="col-md-6 text-center position-relative">
                <div class="hero-decor"></div>
                <img src="{{ asset('images/hero.png') }}" 
                     alt="Gowes Bareng" 
                     class="img-fluid hero-image shadow-lg">
            </div>
        </div>
    </div>
</section>