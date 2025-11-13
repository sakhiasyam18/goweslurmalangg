<style>
  .order-section {
    padding: 60px 0;
    background-color: #ffffff;
  }

  /* Kotak Utama dengan Gradient Biru Segar */
  .process-card {
    background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    /* Warna Premium */
    border-radius: 25px;
    padding: 50px 30px;
    box-shadow: 0 20px 40px rgba(13, 110, 253, 0.15);
    position: relative;
    overflow: hidden;
  }

  /* Dekorasi Lingkaran Transparan (Pemanis) */
  .process-card::before,
  .process-card::after {
    content: '';
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
  }

  .process-card::before {
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
  }

  .process-card::after {
    bottom: -30px;
    left: -30px;
    width: 100px;
    height: 100px;
  }

  /* Judul */
  .process-title {
    color: #ffffff;
    font-weight: 800;
    margin-bottom: 40px;
    position: relative;
    z-index: 2;
    letter-spacing: 0.5px;
  }

  /* Item Langkah */
  .step-item {
    position: relative;
    z-index: 2;
    transition: transform 0.3s ease;
  }

  .step-item:hover {
    transform: translateY(-5px);
  }

  /* Ikon Bulat Putih */
  .icon-circle {
    width: 80px;
    height: 80px;
    background-color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px auto;
    font-size: 2rem;
    color: #0d6efd;
    /* Warna ikon biru agar kontras */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  /* Teks Label */
  .step-label {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.95;
  }
</style>

<section id="how-to-order" class="order-section d-flex align-items-center">
  <div class="container">

    <div class="process-card text-center">

      <h4 class="process-title display-6">
        Bagaimana Cara Pemesanannya
      </h4>

      <div class="row justify-content-center gy-5">

        <div class="col-6 col-md-3 step-item">
          <div class="icon-circle">
            <i class="bi bi-bicycle"></i>
          </div>
          <p class="step-label">Pilih Paket Sepeda</p>
        </div>

        <div class="col-6 col-md-3 step-item">
          <div class="icon-circle">
            <i class="bi bi-file-earmark-text"></i>
          </div>
          <p class="step-label">Isi Formulir</p>
        </div>

        <div class="col-6 col-md-3 step-item">
          <div class="icon-circle">
            <i class="bi bi-wallet2"></i>
          </div>
          <p class="step-label">Bayar</p>
        </div>

        <div class="col-6 col-md-3 step-item">
          <div class="icon-circle">
            <i class="bi bi-camera"></i>
          </div>
          <p class="step-label">Screenshot Bukti</p>
        </div>

      </div>
    </div>

  </div>
</section>