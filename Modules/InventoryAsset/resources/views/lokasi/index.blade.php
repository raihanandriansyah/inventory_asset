@extends('layouts.app')

@section('title', 'Data Lokasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Data Lokasi</h3>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                        + Tambah Lokasi
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Kode Lokasi</th>
                                <th>Nama Lokasi</th>
                                <th>Tipe</th>
                                <th>Keterangan</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lokasi as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_lokasi }}</td>
                                    <td>{{ $item->nama_lokasi }}</td>
                                    <td class="text-center">{{ ucfirst($item->tipe_lokasi) }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEdit{{ $item->id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('lokasi.destroy', $item->id) }}"
                                              method="POST"
                                              style="display:inline-block"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="modalEdit{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('lokasi.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Lokasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        &times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Kode Lokasi</label>
                                                        <input type="text" name="kode_lokasi"
                                                            value="{{ $item->kode_lokasi }}"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Lokasi</label>
                                                        <input type="text" name="nama_lokasi"
                                                            value="{{ $item->nama_lokasi }}"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tipe Lokasi</label>
                                                        <select name="tipe_lokasi" class="form-control" required>
                                                            @foreach (['gudang','rak','toko','cabang','etalase'] as $tipe)
                                                                <option value="{{ $tipe }}"
                                                                    {{ $item->tipe_lokasi == $tipe ? 'selected' : '' }}>
                                                                    {{ ucfirst($tipe) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Lokasi</label>
                        <input type="text" name="kode_lokasi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Lokasi</label>
                        <input type="text" name="nama_lokasi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tipe Lokasi</label>
                        <select name="tipe_lokasi" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="gudang">Gudang</option>
                            <option value="rak">Rak</option>
                            <option value="toko">Toko</option>
                            <option value="cabang">Cabang</option>
                            <option value="etalase">Etalase</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
