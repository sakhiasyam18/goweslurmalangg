{{-- Menggunakan layout admin ('layouts.app') --}}
@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-4">DATA DENDA</h4>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID Denda</th>
                        <th>ID Pemesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Waktu Selisih</th>
                        <th>Jumlah Denda</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Looping data dari DendaController@index --}}
                    @forelse($dataDenda as $denda)
                    <tr>
                        <td>{{ $denda->ID_Denda }}</td>
                        <td>{{ $denda->ID_Pemesanan }}</td>

                        <td>{{ $denda->pemesanan->pelanggan->Nama ?? 'Pelanggan Tidak Ditemukan' }}</td>

                        <td class="text-center">
                            {{ $denda->Keterangan_Selisih ?? ($denda->Jam_Selisih ? $denda->Jam_Selisih . ' Jam' : '-') }}
                        </td>
                        <td class="text-end">Rp {{ number_format($denda->Jumlah_Denda) }}</td>

                        <td>{{ \Carbon\Carbon::parse($denda->Tanggal_Denda_Dibuat)->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data denda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection