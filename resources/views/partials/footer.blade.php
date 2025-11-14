<style>
    /* --- CSS Footer Section --- */
    .footer-section {
        background-color: #1a1f2c;
        /* Warna Dark Blue/Black Premium */
        color: #adb5bd;
        /* Warna teks abu-abu terang */
        padding-top: 70px;
        padding-bottom: 30px;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }

    /* Link Styling */
    .footer-link {
        color: #adb5bd;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        margin-bottom: 10px;
    }

    .footer-link:hover {
        color: #0d6efd;
        /* Biru saat di-hover */
        transform: translateX(5px);
        /* Geser sedikit ke kanan */
    }

    /* Headings */
    .footer-heading {
        color: #fff;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    /* Garis kecil di bawah judul */
    .footer-heading::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 40px;
        height: 3px;
        background-color: #0d6efd;
        border-radius: 2px;
    }

    /* Info Item (Alamat/Kontak) */
    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .info-item i {
        color: #0d6efd;
        margin-right: 12px;
        font-size: 1.1rem;
        margin-top: 4px;
    }

    /* Social Media Icons */
    .social-links {
        display: flex;
        gap: 15px;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-btn:hover {
        background-color: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
    }

    /* Copyright Area */
    .copyright-area {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 25px;
        margin-top: 50px;
        text-align: center;
        font-size: 0.9rem;
    }

    /* --- Floating WhatsApp Button --- */
    .floating-wa {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #25d366;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        z-index: 9999;
        text-decoration: none;
        transition: all 0.3s ease;
        animation: pulseBtn 2s infinite;
    }

    .floating-wa:hover {
        transform: scale(1.1);
        color: white;
        background-color: #20bd5a;
    }

    /* Tooltip text "Hubungi Admin" */
    .floating-wa::before {
        content: 'Hubungi Admin';
        position: absolute;
        right: 75px;
        background: #fff;
        color: #333;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .floating-wa:hover::before {
        opacity: 1;
        visibility: visible;
        right: 80px;
        /* Efek geser */
    }

    @keyframes pulseBtn {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .floating-wa {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 24px;
        }

        .footer-section {
            text-align: center;
        }

        .info-item {
            justify-content: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-heading::after {
            left: 50%;
            transform: translateX(-50%);
        }
    }
</style>

<footer class="footer-section">
    <div class="container">
        <div class="row gy-5">

            <div class="col-lg-4 col-md-6">
                <h5 class="footer-heading">GowesLurr Malang</h5>
                <p>
                    Platform penyewaan sepeda terbaik di Kota Malang.
                    Solusi transportasi ramah lingkungan dan menyehatkan untuk mahasiswa dan wisatawan.
                </p>
                <div class="social-links mt-4">
                    <a href="https://instagram.com/goweslurr_malang" target="_blank" class="social-btn"
                        title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/goweslurrmalang/?locale=id_ID" class="social-btn"
                        title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Navigasi</h5>
                <div class="d-flex flex-column">
                    <a href="#home" class="footer-link">Beranda</a>
                    <a href="#catalog" class="footer-link">Katalog Sepeda</a>
                    <a href="#how-to-order" class="footer-link">Cara Pesan</a>
                    <a href="#sewa" class="footer-link">Daftar Harga</a>
                    <a href="#lokasi" class="footer-link">Lokasi</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Hubungi Kami</h5>

                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>
                        Jl. Terusan Kesatrian No. Dalam,<br>
                        Blimbing, Kota Malang
                    </span>
                </div>

                <div class="info-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>+62 895-0498-6360</span>
                </div>

                <div class="info-item">
                    <i class="far fa-envelope"></i>
                    <span>admin@goweslurr.com</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Jam Buka</h5>
                <ul class="list-unstyled text-light opacity-75">
                    <li class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-2">
                        <span>Senin - Jumat</span>
                        <span>07.00 - 17.00</span>
                    </li>
                    <li class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-2">
                        <span>Sabtu - Minggu</span>
                        <span>06.00 - 18.00</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="copyright-area">
            <p class="mb-0">
                &copy; {{ date('Y') }} <strong>GowesLurr Malang</strong>. All Rights Reserved. <br>
                <small class="opacity-50">Team Universitas Negeri Malang DTEI Teknik Informatika</small>
            </p>
        </div>
    </div>
</footer>

<a href="https://wa.me/6289504986360?text=Halo%20Admin%20GowesLurr%2C%20saya%20mau%20tanya%20sepeda..."
    class="floating-wa" target="_blank" title="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>