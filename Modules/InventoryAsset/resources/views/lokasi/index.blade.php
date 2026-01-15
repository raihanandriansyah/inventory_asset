@extends('layouts.app')

@section('content')
<h2>Data Lokasi</h2>

<form method="GET" action="{{route ('lokasi') }}">
    <input
    type="text"
    name="cari"
    value="{{ $lokasi }}"
    placeholder="Cari nama / deskripsi..."
    >
    <button type="submit">Cari</button>
    @if ($lokasi)
    <a href="{{ route('lokasi') }}">Reset</a>
    @endif
</form>

<br>
    <table>
       <thead>
            <tr>
                <th>No</th>
                <th>Kode Lokasi</th>
                <th>Nama Lokasi</th>
                <th>Tipe Lokasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($nean as $ega)
            <tr>
                <td>{{ $loop->iteration + ($nean->currentPage() -1)* $nean->perPage() }}</td>
                <td>{{ $ega->kode_lokasi }}</td>
                <td>{{ $ega->nama_lokasi }}</td>
                <td>{{ $ega->tipe_lokasi }}</td>
                <td>{{ $ega->keterangan }}</td>
                <td>{{ $ega->created_at?->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" align="center">Data tidak ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>

{{ $nean->withQueryString()->links() }}
@endsection