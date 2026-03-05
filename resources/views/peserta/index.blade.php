@extends('layouts.app')

@section('title', 'Data Peserta')

@push('styles')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Peserta</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Peserta
    </button>
</div>

{{-- Alert Success --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Peserta</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peserta as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            @if($item->jk == 'L')
                                <span class="badge badge-primary">Laki-laki</span>
                            @else
                                <span class="badge badge-danger">Perempuan</span>
                            @endif
                        </td>
                        <td>
                            {{-- Tombol Edit --}}
                            <button class="btn btn-sm btn-warning btn-edit"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-alamat="{{ $item->alamat }}"
                                data-jk="{{ $item->jk }}"
                                data-toggle="modal"
                                data-target="#modalEdit">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            {{-- Tombol Hapus --}}
                            <button class="btn btn-sm btn-danger btn-hapus"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-toggle="modal"
                                data-target="#modalHapus">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- ===================== MODAL TAMBAH ===================== --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus mr-2"></i>Tambah Peserta</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('peserta.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}" placeholder="Masukkan nama...">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukkan alamat...">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control @error('jk') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ===================== MODAL EDIT ===================== --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Peserta</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formEdit" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="editNama" class="form-control" placeholder="Masukkan nama...">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="editAlamat" rows="3" class="form-control" placeholder="Masukkan alamat..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk" id="editJk" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save mr-1"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ===================== MODAL HAPUS ===================== --}}
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash mr-2"></i>Hapus Peserta</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus peserta <strong id="hapusNama"></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="formHapus" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<script>
    $(document).on('click', '.btn-edit', function () {
        const id     = $(this).data('id');
        const nama   = $(this).data('nama');
        const alamat = $(this).data('alamat');
        const jk     = $(this).data('jk');

        $('#formEdit').attr('action', '/peserta/' + id);
        $('#editNama').val(nama);
        $('#editAlamat').val(alamat);
        $('#editJk').val(jk);
    });

    $(document).on('click', '.btn-hapus', function () {
        const id   = $(this).data('id');
        const nama = $(this).data('nama');

        $('#formHapus').attr('action', '/peserta/' + id);
        $('#hapusNama').text(nama);
    });
</script>
@endpush