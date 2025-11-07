@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-4">DATA SEPEDA</h4>

<table class="table table-bordered text-center align-middle" style="width: 100%;">
    <thead class="table-light">
        <tr>
            <th>Id Sepeda</th>
            <th>Nama Sepeda</th>
            <th>Kategori Sepeda</th>
            <th>Status Sepeda</th>
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
                <a href="{{ route('admin.sepeda.edit', $item->ID_Sepeda) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    <a href="{{ route('admin.sepeda.create') }}" class="btn btn-success" style="background-color:#00b050; border:none;">
        + TAMBAH
    </a>
</div>
@endsection