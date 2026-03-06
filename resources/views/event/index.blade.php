@extends('layouts.app')

@section('title', 'Data Event')

@push('styles')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Event</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Event
    </button>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Event</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_event }}</td>
                        <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>
                            @if($item->status == 'Aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-secondary">Selesai</span>
                            @endif  
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-edit"
                                data-id="{{ $item->id }}"
                                data-nama_event="{{ $item->nama_event }}"
                                data-deskripsi="{{ $item->deskripsi }}"
                                data-tanggal="{{ $item->tanggal }}"
                                data-lokasi="{{ $item->lokasi }}"
                                data-status="{{ $item->status }}"
                                data-toggle="modal"
                                data-target="#modalEdit">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger btn-hapus"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_event }}"
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

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus mr-2"></i>Tambah Event</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('event.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" placeholder="Masukkan nama event...">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="form-control" placeholder="Masukkan deskripsi..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi...">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
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

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Event</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEdit" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Event</label>
                        <input type="text" name="nama_event" id="editNamaEvent" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="editDeskripsi" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="editTanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" id="editLokasi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="editStatus" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
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

{{-- MODAL HAPUS --}}
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash mr-2"></i>Hapus Event</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus event <strong id="hapusNama"></strong>?</p>
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
    const id         = $(this).data('id');
    const nama_event = $(this).data('nama_event');
    const deskripsi  = $(this).data('deskripsi');
    const tanggal    = $(this).data('tanggal');
    const lokasi     = $(this).data('lokasi');
    const status     = $(this).data('status');

    $('#formEdit').attr('action', '/event/' + id);
    $('#editNamaEvent').val(nama_event);
    $('#editDeskripsi').val(deskripsi);
    $('#editTanggal').val(tanggal);
    $('#editLokasi').val(lokasi);
    $('#editStatus option').prop('selected', false);
    $('#editStatus option[value="' + status + '"]').prop('selected', true);
    });

    $(document).on('click', '.btn-hapus', function () {
        const id   = $(this).data('id');
        const nama = $(this).data('nama');

        $('#formHapus').attr('action', '/event/' + id);
        $('#hapusNama').text(nama);
    });
</script>
@endpush