@php
// LOGIC PENGAMAN (FALLBACK DATA)
if (!isset($sepedas) || $sepedas->isEmpty()) {
try {
$sepedas = \App\Models\Sepeda::all();
} catch (\Exception $e) {
$sepedas = collect([]);
}
}
@endphp

<style>
  /* --- 1. SECTION STYLE --- */
  .catalog-section {
    padding: 60px 0;
    background-color: #ffffff;
    position: relative;
    overflow: hidden;
  }

  .catalog-title {
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 5px;
  }

  .catalog-title span {
    color: #0d6efd;
  }

  .catalog-subtitle {
    color: #6c757d;
    margin-bottom: 30px;
  }

  /* --- 2. SLIDER WRAPPER --- */
  .slider-container {
    position: relative;
    padding: 20px 0;
    /* Beri ruang atas bawah */
  }

  .catalog-scroll-wrapper {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    padding: 10px 5px 30px 5px;

    /* HAPUS 'scroll-behavior: smooth' agar reset loop tidak kelihatan mata */
    /* scroll-behavior: smooth; <--- JANGAN PAKAI INI */

    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    cursor: grab;
    /* Indikator bisa digeser */
  }

  .catalog-scroll-wrapper:active {
    cursor: grabbing;
  }

  /* Sembunyikan scrollbar Chrome */

  /* --- 3. CARD STYLE (PORTRAIT 9:16) --- */
  .bike-card {
    flex: 0 0 auto;
    width: 220px;
    /* Lebar Desktop */
    aspect-ratio: 9 / 16;
    /* Instastory Ratio */
    background-color: #f0f0f0;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
  }

  .bike-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
  }

  .bike-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .bike-card:hover .bike-img {
    transform: scale(1.05);
  }

  /* Overlay Gradient & Text */
  .card-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0) 100%);
    padding: 20px 15px 15px;
    color: white;
    pointer-events: none;
    /* Agar klik tembus ke kartu */
  }

  .bike-name {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  }

  .bike-category {
    font-size: 0.75rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 3px;
  }

  /* Status Badge */
  .status-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    z-index: 2;
    backdrop-filter: blur(4px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .status-available {
    background: rgba(25, 135, 84, 0.85);
    color: white;
  }

  .status-booked {
    background: rgba(220, 53, 69, 0.85);
    color: white;
  }

  /* --- 4. NAVIGASI (PANAH KAPSUL) --- */
  .slider-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    /* Mode Kapsul */
    height: 40px;
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid #eee;
    border-radius: 50px;
    /* Membulat penuh */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
  }

  .slider-nav-btn:hover {
    background: #0d6efd;
    color: #fff;
    width: 75px;
    /* Memanjang saat hover */
    border-color: #0d6efd;
  }

  .nav-prev {
    left: 10px;
  }

  .nav-next {
    right: 10px;
  }

  /* --- 5. MODAL POPUP --- */
  .image-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.92);
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .image-modal.show {
    display: flex;
    opacity: 1;
  }

  .modal-content-img {
    max-width: 90%;
    max-height: 85vh;
    border-radius: 8px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    animation: zoomIn 0.3s;
  }

  .close-modal {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #fff;
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    transition: 0.3s;
  }

  .close-modal:hover {
    color: #dc3545;
    transform: rotate(90deg);
  }

  @keyframes zoomIn {
    from {
      transform: scale(0.8);
      opacity: 0;
    }

    to {
      transform: scale(1);
      opacity: 1;
    }
  }

  /* --- 6. RESPONSIVE MOBILE --- */
  @media (max-width: 768px) {

    /* Panah tetap muncul di HP */
    .slider-nav-btn {
      display: flex !important;
      width: 45px;
      /* Lebih kecil dikit */
      height: 35px;
    }

    .slider-nav-btn:hover {
      width: 45px;
    }

    /* Matikan efek memanjang di HP */

    .nav-prev {
      left: 5px;
    }

    .nav-next {
      right: 5px;
    }

    /* Kartu di HP */
    .bike-card {
      width: 160px;
    }

    .bike-name {
      font-size: 0.9rem;
    }
  }
</style>

<section id="catalog" class="catalog-section">
  <div class="container">

    <div class="mb-2">
      <h2 class="catalog-title display-6">Galeri <span>Unit</span></h2>
      <p class="catalog-subtitle mb-0">Klik gambar untuk melihat detail penuh.</p>
    </div>

    <div class="slider-container">
      <button class="slider-nav-btn nav-prev" id="scrollLeftBtn"><i class="fas fa-chevron-left"></i></button>

      <div class="catalog-scroll-wrapper" id="catalogWrapper">
        @forelse($sepedas as $sepeda)
        @php
        $isAvailable = strtolower($sepeda->Status_Sepeda) == 'tersedia';
        $statusClass = $isAvailable ? 'status-available' : 'status-booked';
        $imgSrc = ($sepeda->Gambar_Sepeda && file_exists(public_path('storage/'.$sepeda->Gambar_Sepeda)))
        ? asset('storage/' . $sepeda->Gambar_Sepeda)
        : asset('images/slider/1.jpg');
        @endphp

        <div class="bike-card" onclick="openModal('{{ $imgSrc }}')">
          <div class="status-badge {{ $statusClass }}">{{ $sepeda->Status_Sepeda }}</div>
          <img src="{{ $imgSrc }}" alt="{{ $sepeda->Nama_Sepeda }}" class="bike-img">
          <div class="card-overlay">
            <div class="bike-category">{{ $sepeda->Kategori_Sepeda ?? 'Gowes' }}</div>
            <h5 class="bike-name">{{ $sepeda->Nama_Sepeda }}</h5>
          </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center w-100">
          <p class="text-muted">Belum ada data sepeda.</p>
        </div>
        @endforelse
      </div>

      <button class="slider-nav-btn nav-next" id="scrollRightBtn"><i class="fas fa-chevron-right"></i></button>
    </div>

  </div>
</section>

<div id="imgModal" class="image-modal">
  <span class="close-modal" onclick="closeModal()">&times;</span>
  <img class="modal-content-img" id="img01">
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.getElementById('catalogWrapper');
    const leftBtn = document.getElementById('scrollLeftBtn');
    const rightBtn = document.getElementById('scrollRightBtn');

    if (scrollContainer && leftBtn && rightBtn) {

      // 1. LOGIC INFINITE LOOP (Duplikasi Item)
      // Clone items agar saat discroll mentok, visualnya nyambung lagi
      const items = Array.from(scrollContainer.children);
      if (items.length > 0) {
        items.forEach(item => {
          const clone = item.cloneNode(true);
          scrollContainer.appendChild(clone);
        });
      }

      // 2. NAVIGASI SCROLL
      const scrollAmount = 240; // Jarak geser
      leftBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({
          left: -scrollAmount,
          behavior: 'smooth'
        });
      });
      rightBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({
          left: scrollAmount,
          behavior: 'smooth'
        });
      });

      // 3. LOGIC RESET LOOP
      // Jika scroll lewat setengah (masuk area clone), balikin ke awal instan
      scrollContainer.addEventListener('scroll', () => {
        if (scrollContainer.scrollLeft >= (scrollContainer.scrollWidth / 2)) {
          scrollContainer.scrollLeft = 0;
        }
      });
    }
  });

  // MODAL LOGIC
  function openModal(src) {
    var modal = document.getElementById("imgModal");
    var modalImg = document.getElementById("img01");
    modal.style.display = "flex";
    setTimeout(() => {
      modal.classList.add('show');
    }, 10);
    modalImg.src = src;
  }

  function closeModal() {
    var modal = document.getElementById("imgModal");
    modal.classList.remove('show');
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }
  document.getElementById('imgModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
</script>