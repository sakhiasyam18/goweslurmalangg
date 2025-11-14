<style>
    .footer {
        background-color: #3a5393;
        color: #fff;
        padding: 3rem 1rem;
    }

    .footer a {
        color: #d1d5db;
        text-decoration: none;
    }

    .footer a:hover {
        color: #fff;
    }

    .footer-logo {
        height: 60px;
        /* ukuran proporsional */
        margin-top: -20px;
        width: auto;
        /* biar tidak gepeng */
        object-fit: contain;
        /* menjaga proporsi logo */
    }

    .logo-img {
        height: 80px;
        /* tinggi logo */
        width: auto;
        /* biar proporsional */
        /* pastikan tidak bulat */
        /* biar gambar tidak gepeng */
    }

    /* Floating Contact Buttons */
    .floating-contact {
        position: fixed;
        right: 0;
        bottom: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        z-index: 9999;
    }

    .contact-btn {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 10px 0 0 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        margin: 3px 0;
    }

    /* Warna tombol */
    .arrow {
        background-color: #1c1c1c;
    }

    .whatsapp {
        background-color: #3a5393;
    }

    .phone {
        background-color: #eae6e6;
        color: #000;
    }

    /* Efek hover */
    .contact-btn:hover {
        filter: brightness(1.08);
        transform: translateX(-4px) scale(1.03);
    }
</style>

<!-- FOOTER -->

<footer id="contact" class="footer mt-5 text-light py-5">
    <div class="container">
        <div class="row gy-4">
            <!-- Logo & Info -->
            <div class="col-md-3">
                <img src="{{ asset('images/logo.png') }}" alt="GowesLurr Logo" class="footer-logo mb-3"
                    style="width:150px;">
                <div class="">
                    <i data-feather="map-pin" class="me-2" style=""></i>
                    <p class="small mb-0">
                        Jl. Terusan Kesatrian No. Dalam, Kesatrian, Kec. Blimbing,<br>
                        Kota Malang, Jawa Timur 65126
                    </p>
                </div>

                <div class="col-md-3">
                    <i data-feather="instagram" class="me-2" style="width:18px;height:18px;"></i>
                    <p class="small mb-0">@goweslurr_malang</p>
                </div>
            </div>

            <!-- MENU -->
            <div class="col-md-3">
                <h5 class="fw-semibold mb-3">Navigation</h5>
                <ul class="list-unstyled">
                    {{-- Link mengarah ke ID section di halaman utama --}}
                    <li class="mb-1"><a href="#home" class="text-light text-decoration-none">Home</a></li>
                    <li class="mb-1"><a href="#sewa" class="text-light text-decoration-none">Sewa Sepeda</a></li>
                    <li class="mb-1"><a href="#catalog" class="text-light text-decoration-none">Katalog</a></li>
                    <li><a href="#lokasi" class="text-light text-decoration-none">Lokasi</a></li>
                </ul>
            </div>
            <!-- Kontak -->
            <div class="col-md-3">
                <h5 class="fw-semibold mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled small mb-3">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Malang, Jawa Timur</li>
                    <li class="mb-2"><i class="bi bi-whatsapp me-2 "></i> +62 895-0498-6360</li>
                    <li><i class="bi bi-envelope-fill me-2"></i> admin@goweslurr.com</li>
                </ul>

                <div class="d-flex gap-3 mt-3">
                    <a href="https://instagram.com/goweslurr_malang" class="text-light fs-5 icon-hover"
                        title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/goweslurrmalang/?locale=id_ID" class="text-light fs-5 icon-hover"
                        title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.tiktok.com/@goweslurr" class="text-light fs-5 icon-hover" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="col-md-3">
                <h5 class="fw-semibold mb-3">Jam Operasional</h5>
                <ul class="list-unstyled small mb-0">
                    <li>Senin - Minggu</li>
                    <li>07.00 - 15.00</li>
                </ul>
            </div>
        </div>

        <hr class="border-light mt-4">
        <div class="copyright-area text-center">
            <p class="mb-0">
                &copy; {{ date('Y') }} <strong>GowesLurr Malang</strong>. All Rights Reserved. <br>
                <small class="opacity-50">Team Universitas Negeri Malang DTEI Teknik Informatika</small>
            </p>
        </div>
    </div>
</footer>
<!-- Floating Contact Buttons (revisi) -->
<div id="contact" class="floating-contact">
    <!-- Arrow toggle: beri id toggleContact -->
    <a href="#" id="toggleContact" class="contact-btn arrow" aria-label="Toggle kontak">
        <i class="bi bi-arrow-up"></i>
    </a>
    <!-- wrapper yang akan disembunyikan / dimunculkan -->
    <div class="contact-buttons">
        <a href="https://wa.me/6289504986360?text=Halo%20Admin%20GowesLurr%2C%20saya%20mau%20tanya%20sepeda..."
            target="_blank" class="contact-btn whatsapp" aria-label="WhatsApp">
            <i class="bi bi-whatsapp"></i>
            </href=>
            <a href="tel:089504986360" class="contact-btn phone" aria-label="Telepon">
                <i class="bi bi-telephone-fill"></i>
            </a>
    </div>
</div>