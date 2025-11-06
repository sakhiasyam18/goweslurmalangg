@extends('layout.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-green-500 py-6 px-4 text-center">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-green-500 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Pesanan Berhasil</h1>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-4">
            <p class="text-gray-600 text-center text-sm">
                Konfirmasi ke Whatsapp untuk lebih lanjut
            </p>

            <!-- WhatsApp Button -->
            <button 
                onclick="openWhatsApp()"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2"
            >
                <i class="fab fa-whatsapp text-lg"></i>
                <span>Lanjut ke Whatsapp</span>
            </button>

            <!-- Download WhatsApp Button -->
            <button 
                onclick="downloadWhatsApp()"
                class="w-full border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2"
            >
                <i class="fas fa-download text-lg"></i>
                <span>Unduh Whatsapp</span>
            </button>
        </div>
    </div>

    <script>
        function openWhatsApp() {
            // Ganti dengan nomor WhatsApp yang diinginkan
            const phoneNumber = '6281234567890';
            const message = 'Halo, saya ingin konfirmasi pesanan saya';
            const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            
            window.open(url, '_blank');
        }

        function downloadWhatsApp() {
            // Redirect ke halaman download WhatsApp
            window.open('https://www.whatsapp.com/download', '_blank');
        }

        // Optional: Auto redirect setelah beberapa detik
        setTimeout(() => {
            // Uncomment baris berikut untuk auto redirect ke WhatsApp
            // openWhatsApp();
        }, 5000);
    </script>
</body>
</html>
@endsection
