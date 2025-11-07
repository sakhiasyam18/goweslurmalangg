@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="success-box">
    <div class="checkmark"></div>
    <p><strong>Pesanan Berhasil</strong><br>Konfirmasi ke Whatsapp untuk lebih lanjut</p>

    <a href="https://wa.me/6289504986360" class="btn btn-wa">Lanjut ke WhatsApp</a>
    <a href="https://www.whatsapp.com/download" class="btn btn-download">Unduh WhatsApp</a>
</div>
@endsection