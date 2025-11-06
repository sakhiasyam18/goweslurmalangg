<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GowesLurr - Sewa Sepeda Malang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  <header>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container py-2">
        <!-- Logo Gambar -->
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{{ asset('images/logo.png') }}" 
          alt="Logo GowesLurr" class= "logo-img me-2">
        </a>
        <!-- Tombol Toggle (Mobile) -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav fw-semibold ms-auto">
            <li class="nav-item"><a class="nav-link text-dark px-3" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link text-dark px-3" href="#sewa">Sewa</a></li>
            <li class="nav-item"><a class="nav-link text-dark px-3" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link text-dark px-3" href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    
    </nav>
  </header>
  <!-- HERO SECTION -->
  <section id="home" class="hero-section py-5">
    <div class="container d-flex align-items-center flex-wrap">
      <!-- Bagian kiri (teks) -->
      <div class="col-md-6 mb-4">
        <h3 class="fw-normal mb-3">
          Nikmati Malang <br>
          dengan Gowesan <br>Seru Bareng <br> <span class="fw-semibold">goweslurr</span>. <br> 
          Gowes Santai, Harga Bersahabat!
        </h3>
        <button class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
          Sewa Sekarang →
        </button>
      </div>
      <!-- Bagian kanan (gambar) -->
      <div class="col-md-6 text-center position-relative">
        <div class="hero-decor"></div>
        <img src="{{ asset('images/hero.png') }}" alt="Gowes Bareng"
        class="img-fluid hero-image shadow-lg">
      </div>
    </div>
  </section>

  <!-- how to order section -->
  <section id="home" class="order-section py-5">
    <div class="container">
      <!-- Folder Frame -->
      <div class="folder-frame">
        <div class="folder-tab"></div>
          <div class="folder-body">
            <h5 class="text-center fw-semibold mb-4 text-white">
              Bagaimana Cara Pemesanannya
            </h5>
          <div class="row text-center justify-content-center gy-4">
            <div class="col-6 col-md-3">
              <div class="order-icon mx-auto mb-3">
                <i class="bi bi-bicycle fs-1 text-dark"></i>
              </div>
              <p class="fw-medium mb-0">Pilih Paket Sepeda</p>
            </div>
            <div class="col-6 col-md-3">
              <div class="order-icon mx-auto mb-3">
                <i class="bi bi-file-earmark-text fs-1 text-dark"></i>
              </div>
              <p class="fw-medium mb-0">Isi Formulir</p>
            </div>
            <div class="col-6 col-md-3">
              <div class="order-icon mx-auto mb-3">
                <i class="bi bi-wallet2 fs-1 text-dark"></i>
              </div>
              <p class="fw-medium mb-0">Bayar</p>
            </div>
            <div class="col-6 col-md-3">
              <div class="order-icon mx-auto mb-3">
                <i class="bi bi-camera fs-1 text-dark"></i>
              </div>
              <p class="fw-medium mb-0">Screenshot Bukti</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Font Awesome (ikon) -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <section class="catalog-section container">
    <div class="catalog-header">
      <div class="line"></div>
      <h5>Explore Sepeda Favoritmu!</h5>
    </div>

    <div class="catalog-slider" id="catalogSlider">
      <div class="bike-card">
        <img src="{{ asset('images/sepeda_s3.jpg') }}" alt="Stratos S3">
        <div class="bike-info">
          <h6>Stratos S3</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/stratos_s2.jpg') }}" alt="Stratos S2">
        <div class="bike-info">
          <h6>Stratos S2</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/rugen.jpg') }}" alt="Rugen">
        <div class="bike-info">
          <h6>Rugen</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/EVERGREEN.jpg') }}" alt="Evergreen">
        <div class="bike-info">
          <h6>Evergreen</h6>
          <span class ="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/polygon_lovina.jpg') }}" alt="Polygon">
        <div class="bike-info">
          <h6>Polygon</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/RUBIC.jpg') }}" alt="Rubic">
        <div class="bike-info">
          <h6>Rubic MTB</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/monarch_mrj.jpg') }}" alt="Monarch MRJ">
        <div class="bike-info">
          <h6>Monarch MRJ</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/exotic.jpg') }}" alt="Exotic">
        <div class="bike-info">
          <h6>Exotic</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/JIEYANG1.jpg') }}" alt="Jieyang">
        <div class="bike-info">
          <h6>Jieyang</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/Veloce_6.0.jpeg') }}" alt="Veloce">
        <div class="bike-info">
          <h6>Veloce 6.0</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

      <div class="bike-card">
        <img src="{{ asset('images/sepeda_lipat.jpg') }}" alt="Lipat">
        <div class="bike-info">
          <h6>Lipat</h6>
          <span class="text-success">tersedia</span>
        </div>
      </div>

    </div>
  </section>

  <script>
    const slider = document.getElementById('catalogSlider');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
      isDown = true;
      slider.classList.add('active');
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', (e) => {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 2; // kecepatan drag
      slider.scrollLeft = scrollLeft - walk;
    });
  </script>

  <section id="sewa" class="paket-section py-5 text-center">
    <div class="container">
      <!-- Judul -->
      <div class="judul-wrapper">
      <div class="judul-box">Temukan Paket Sepeda Favoritmu!</div>
      <div class="dots">•••</div>
      <div class="line"></div>
    </div>

    <p>
      Tentukan Pilihanmu: Sepeda Reguler atau Premium.<br>
      Nikmati kebebasan bersepeda dengan paket terbaik!<br>
      Siap gowes? Pilih paketmu sekarang!
    </p>
    <!-- Kartu Paket -->
      <div class="row justify-content-center g-4">
        <!-- Sepeda Premium -->
        <div class="col-md-5">
          <div class="paket-card shadow-lg rounded-4 bg-white position-relative">
            <div class="paket-header rounded-top-4 text-white py-3">
              <i class="bi bi-bicycle display-6 text-dark"></i>
              <h5 class="mt-2 fw-bold text-dark">Sepeda Premium</h5>
            </div>
            <div class="p-4">
              <div class="mb-3">
                <label class="fw-semibold mb-2">Pilih Sepeda:</label>
                <select class="form-select rounded-pill shadow-sm">
                  <option>Stratos S2</option>
                  <option>Stratos S3</option>
                  <option>Rugen</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="fw-semibold mb-2">Pilih Durasi:</label>
                <select class="form-select rounded-pill shadow-sm">
                  <option>1 Jam</option>
                  <option>3 Jam</option>
                  <option>1 Hari</option>
                </select>
              </div>
              <button class="btn btn-primary rounded-pill px-4 shadow-sm">
                Pesan Sekarang
              </button>
            </div>
          </div>
        </div>
        <!-- Sepeda Reguler -->
        <div class="col-md-5">
          <div class="paket-card shadow-lg rounded-4 bg-white position-relative">
            <div class="paket-header rounded-top-4 text-white py-3">
              <i class="bi bi-bicycle display-6 text-dark"></i>
              <h5 class="mt-2 fw-bold text-dark">Sepeda Reguler</h5>
            </div>
            <div class="p-4">
              <div class="mb-3">
                <label class="fw-semibold mb-2">Pilih Sepeda:</label>
                <select class="form-select rounded-pill shadow-sm">
                  <option>Evergreen</option>
                  <option>Stratos S1</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="fw-semibold mb-2">Pilih Durasi:</label>
                <select class="form-select rounded-pill shadow-sm">
                  <option>1 Jam</option>
                  <option>2 Jam</option>
                  <option>Setengah Hari</option>
                </select>
              </div>
              <button class="btn btn-primary rounded-pill px-4 shadow-sm">
                Pesan Sekarang
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- MAP SECTION -->
  <section id="about" class="map-section">
    <div class="circle-decor circle-top-left"></div>
    <div class="circle-decor circle-bottom-left"></div>
    <div class="circle-decor circle-bottom-right"></div>
    <div class="container">
      <div class="row align-items-center g-4">
        <!-- Map -->
        <div class="col-md-6">
          <div class="ratio ratio-4x3 shadow rounded-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.198864465045!2d112.64038357500694!3d-7.978386692046785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629aefb25b6af%3A0x2e42001be9d62c6e!2sGoweslurr%20malang!5e0!3m2!1sen!2sid!4v1761926482491!5m2!1sen!2sid" 
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
        <!-- Text -->
        <div class="col-md-6">
          <h2 class="fw-bold mb-3">Temukan lokasi persewaan sepeda mitra GowesLurr Malang</h2>
          <p class="text-secondary mb-4">
            Kami menyediakan berbagai lokasi persewaan sepeda di Malang yang mudah dijangkau. 
            Pilih lokasi terdekat dan nikmati pengalaman bersepeda santai bersama teman dan keluarga.
          </p>
          <a href="https://maps.app.goo.gl/MxVghgNBaHZaJ7TXA"
            target="_blank"
            class="btn btn-map px-4 py-2">Lihat Lokasi di Peta
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- FOOTER -->
  <footer id= "contact" class="footer mt-5 text-light py-5">
    <div class="container">
      <div class="row gy-4">
        <!-- Logo & Info -->
        <div class="col-md-4">
          <img src="{{ asset('images/logo-footer.png') }}" 
            alt="GowesLurr Logo" class="footer-logo mb-3" style="width:150px;"
          >
          <div class="d-flex align-items-start mb-2">
            <i data-feather="map-pin" class="me-2" style="width:18px;height:18px;"></i>
            <p class="small mb-0">
            Jl. Terusan Kesatrian No. Dalam, Kesatrian, Kec. Blimbing,<br>
            Kota Malang, Jawa Timur 65126
            </p>
          </div>

          <div class="d-flex align-items-center">
            <i data-feather="instagram" class="me-2" style="width:18px;height:18px;"></i>
            <p class="small mb-0">@goweslurr_malang</p>
          </div>
        </div>

        <!-- MENU -->
        <div class="col-md-4">
          <h5 class="fw-semibold mb-3">Navigation</h5>
          <ul class="list-unstyled">
            <li class="mb-1"><a href="#" class="text-light text-decoration-none">Home</a></li>
            <li class="mb-1"><a href="#" class="text-light text-decoration-none">Sewa Sepeda</a></li>
            <li class="mb-1"><a href="#" class="text-light text-decoration-none">Tentang Kami</a></li>
            <li><a href="#" class="text-light text-decoration-none">Kontak</a></li>
          </ul>
        </div>

        <!-- Kontak -->
        <div class="col-md-4">
          <h5 class="fw-semibold mb-3">Hubungi Kami</h5>
          <ul class="list-unstyled small mb-0">
            <li class="mb-1">📍 Malang, Jawa Timur</li>
            <li class="mb-1">📞 +62 812-3456-7890</li>
            <li>✉️ goweslurr@gmail.com</li>
          </ul>
        </div>
      </div>

      <hr class="border-light mt-4">
      <div class="text-center small">
        © 2025 <strong>GowesLurr</strong>. All rights reserved.
      </div>
    </div>
  </footer>
  <!-- Floating Contact Buttons -->
<div id ="contact" class="floating-contact">
  <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success shadow-lg d-flex align-items-center mb-2">
    <i class="bi bi-whatsapp me-2" class="me-2"></i> Kontak
  </a>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    feather.replace();
  </script>
</body>
</html>
