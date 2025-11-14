<style>
/* --- CSS Maps Section --- */

.map-section {
    padding: 4rem 1rem;
    background-color: #fff;
    position: relative;
}

.btn-map {
    background-color: #3a5393;
    color: white;
    border: none;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}

.btn-map:hover {
    background-color: #2e417a;
    /* sedikit lebih gelap saat hover */
}

/* Responsive */
@media (max-width: 991.98px) {
    .maps-section {
        padding: 60px 0;
        text-align: center;
        /* Rata tengah di HP */
    }

    .info-box {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .info-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }

    .map-frame-wrapper {
        height: 300px;
        /* Peta lebih pendek di HP */
        margin-top: 30px;
    }
}
</style>

<section id="lokasi" class="map-section">
    <div class="container">

        <div class="circle-decor circle-top-left"></div>
        <div class="circle-decor circle-bottom-left"></div>
        <div class="circle-decor circle-bottom-right"></div>
        <div class="container-fluid">
            <div class="row align-items-center g-4">
                <!-- Map -->
                <div class="col-md-6">
                    <div class="ratio ratio-4x3 shadow rounded-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.198864465045!2d112.64038357500694!3d-7.978386692046785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629aefb25b6af%3A0x2e42001be9d62c6e!2sGoweslurr%20malang!5e0!3m2!1sen!2sid!4v1761926482491!5m2!1sen!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <!-- Text -->
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3">Temukan lokasi persewaan sepeda GowesLurr Malang</h2>
                    <p class="text-secondary mb-4">
                        GowesLurr hadir di Malang sebagai tempat terbaik untuk menikmati serunya bersepeda.
                        Berlokasi strategis dan mudah dijangkau, kami menawarkan pengalaman bersepeda santai yang
                        menyenangkan bagi keluarga, teman, maupun wisatawan yang ingin menjelajahi keindahan kota
                        Malang.
                    </p>
                    <a href="https://maps.app.goo.gl/MxVghgNBaHZaJ7TXA" target="_blank"
                        class="btn btn-map px-4 py-2">Lihat
                        Lokasi di Peta
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>