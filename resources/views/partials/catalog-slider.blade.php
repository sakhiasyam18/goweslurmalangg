<section class="catalog-section container-fluid py-5">
  <div class="catalog-header px-4">
    <div class="line"></div>
    <h5>Explore Sepeda Favoritmu!</h5>
  </div>

  <div class="catalog-slider" id="catalogSlider">
    <!-- @foreach ($sepedas as $sepeda) -->
      <div class="bike-card">
        <img src="{{ asset('storage/sepeda/' . $loop->iteration . '.jpg') }}" alt="{{ $sepeda->Nama_Sepeda }}">
        <div class="bike-info">
          <h6>{{ $sepeda->Nama_Sepeda }}</h6>
          <span class="{{ $sepeda->Status_Sepeda == 'Tersedia' ? 'text-success' : 'text-danger' }}">
            {{ strtolower($sepeda->Status_Sepeda) }}
          </span>
        </div>
      </div>
    <!-- @endforeach -->
  </div>
</section>
