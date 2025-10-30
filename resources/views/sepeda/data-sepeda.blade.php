@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">DATA SEPEDA</h3>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Status</th>
                <th style="width: 100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sepeda as $item)
            <tr>
                <td>{{ $item->ID_Sepeda }}</td>
                <td>{{ $item->Nama_Sepeda }}</td>
                <td>{{ $item->Kategori_Sepeda }}</td>
                <td>{{ $item->Status_Sepeda }}</td>
                <td>
                    <a href="{{ route('sepeda.edit', $item->ID_Sepeda) }}" 
                       class="btn btn-warning btn-sm">
                       <i class="bi bi-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('sepeda.create') }}" 
           class="btn btn-primary"
           style="background: linear-gradient(90deg,#667eea,#764ba2); border:none;">
           + Tambah Sepeda
        </a>
    </div>
</div>
@endsection
