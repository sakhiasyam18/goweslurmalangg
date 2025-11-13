<style>
  /* --- CSS Maps Section --- */
  .maps-section {
    background-color: #ffffff;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
  }

  /* Dekorasi Background (Circle Abstrak) */
  .maps-decor-circle {
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(13, 110, 253, 0.05);
    /* Biru sangat transparan */
    border-radius: 50%;
    z-index: 0;
  }

  .circle-left {
    bottom: -50px;
    left: -100px;
  }

  .circle-right {
    top: -50px;
    right: -100px;
  }

  /* Container Content */
  .maps-content-wrapper {
    position: relative;
    z-index: 2;
  }

  /* Typography */
  .maps-title {
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 1rem;
  }

  .maps-subtitle {
    color: #6c757d;
    margin-bottom: 2rem;
    font-size: 1.1rem;
  }

  /* Info Box (Alamat) */
  .info-box {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
  }

  .info-icon {
    width: 50px;
    height: 50px;
    background-color: #f0f7ff;
    color: #0d6efd;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 20px;
    flex-shrink: 0;
    /* Agar ikon tidak gepeng */
    transition: all 0.3s ease;
  }

  .info-box:hover .info-icon {
    background-color: #0d6efd;
    color: #fff;
    transform: scale(1.1);
  }

  .info-text h6 {
    font-weight: 700;
    margin-bottom: 5px;
    color: #333;
  }

  .info-text p {
    margin: 0;
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
  }

  /* Map Frame */
  .map-frame-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    /* Shadow lembut */
    border: 5px solid #fff;
    height: 400px;
    /* Tinggi peta */
  }

  .map-iframe {
    width: 100%;
    height: 100%;
    border: 0;
    filter: grayscale(0%);
    /* Ubah ke 100% jika ingin peta hitam putih */
    transition: filter 0.3s;
  }

  .map-frame-wrapper:hover .map-iframe {
    filter: grayscale(0%);
  }

  /* Tombol Buka Maps */
  .btn-maps {
    background-color: #fff;
    color: #0d6efd;
    border: 2px solid #0d6efd;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s;
    margin-top: 10px;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
  }

  .btn-maps:hover {
    background-color: #0d6efd;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
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

<section id="lokasi" class="maps-section">

  <div class="maps-decor-circle circle-left"></div>
  <div class="maps-decor-circle circle-right"></div>

  <div class="container maps-content-wrapper">
    <div class="row align-items-center">

      <div class="col-lg-5 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <h2 class="maps-title display-6">Temukan Kami di <br> Kota Malang</h2>
        <p class="maps-subtitle">
          Main ke basecamp yuk! Bisa cek unit langsung sambil ngobrolin rute gowes yang hidden gem
        </p>

        <div class="mt-4">
          <div class="info-box">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info-text">
              <h6>Alamat Lengkap</h6>
              <p>Jl. Terusan Kesatrian No. Dalam,<br>Kesatrian, Kec. Blimbing, Kota Malang</p>
            </div>
          </div>

          <div class="info-box">
            <div class="info-icon">
              <i class="far fa-clock"></i>
            </div>
            <div class="info-text">
              <h6>Jam Operasional</h6>
              <p>Buka setiap hari<br>Pukul 07.00 - 17.00 WIB</p>
            </div>
          </div>

          <div class="info-box">
            <div class="info-icon">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div class="info-text">
              <h6>Hubungi Admin</h6>
              <p>+62 895-0498-6360</p>
            </div>
          </div>

          <a href="https://maps.app.goo.gl/2xdeduqfURuxqqA38" target="_blank" class="btn-maps mt-2">
            <i class="fas fa-location-arrow me-2"></i> Petunjuk Arah
          </a>
        </div>
      </div>

      <div class="col-lg-7 animate__animated animate__fadeInRight">
        <div class="map-frame-wrapper">
          {{--
                        Iframe Google Maps
                        Tips: Ganti src di bawah dengan embed map asli lokasi Anda agar akurat.
                        Saya menggunakan titik umum di area Kesatrian, Malang sebagai contoh.
                    --}}
          <iframe class="map-iframe"
            src=" https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.0432287217445!2d112.64295849999999!3d-7.978386699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629aefb25b6af%3A0x2e42001be9d62c6e!2sGoweslurr%20malang!5e1!3m2!1sid!2sid!4v1763054066259!5m2!1sid!2sid"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade " allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>
  </div>
</section>