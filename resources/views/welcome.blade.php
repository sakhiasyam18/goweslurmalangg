<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GowesLurr - Sewa Sepeda Malang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>

    @include('partials.header')

    @include('partials.hero')

    @include('partials.how-to-order')

    @include('partials.catalog-slider')

    @include('partials.paket-sewa')

    @include('partials.maps')

    @include('partials.footer')


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Inisialisasi Feather Icons
    feather.replace();

    // Script untuk slider katalog statis (di partials/catalog-slider.blade.php)
    const slider = document.getElementById('catalogSlider');
    if (slider) {
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
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Kecepatan scroll
            slider.scrollLeft = scrollLeft - walk;
        });
    }

    // Script untuk tombol "Pesan Sekarang" (di partials/paket-sewa.blade.php)
    document.querySelectorAll('.btn-pesan').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil ID kategori dari tombol (misal: 'sepeda-premium')
            const kategori = this.getAttribute('data-kategori');

            const sepedaSelect = document.getElementById(`sepeda-${kategori}`);
            const durasiSelect = document.getElementById(`durasi-${kategori}`);

            if (sepedaSelect && durasiSelect) {
                const idSepeda = sepedaSelect.value;
                const idPaket = durasiSelect.value;

                // Validasi jika tidak ada sepeda/paket tersedia
                if (!idSepeda || !idPaket) {
                    alert('Gagal memesan. Pastikan sepeda dan durasi tersedia.');
                    return;
                }

                // Buat URL dengan query parameter ID
                const url = "{{ route('pembayaran.create') }}" +
                    "?id_sepeda=" + encodeURIComponent(idSepeda) +
                    "&id_paket=" + encodeURIComponent(idPaket);

                // Arahkan ke halaman formulir pembayaran
                window.location.href = url;
            } else {
                console.error('Elemen select tidak ditemukan untuk kategori: ' + kategori);
            }
        });
    });
    </script>

</body>

</html>