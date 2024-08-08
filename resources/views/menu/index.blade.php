@extends('admin.layout')

@section('content')
    <title>Data Menu</title>

    @if ($message = Session::get('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <strong><i class="fa fa-check-circle mr-2" aria-hidden="true"></i></strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="/menu/add" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah</a>
            <div>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Nama Menu</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if ($item->photo)
                                        <img src="{{ asset('storage/photo-menu/' . $item->photo) }}" alt="photo menu"
                                            width="150">
                                    @else
                                        Tidak Ada photo
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('menu.edit', $item->id) }}" type="button"
                                        class="btn btn-sm btn-warning btn-block mb-2"><i class="fas fa-pen mr-2"></i>Ubah</a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger btn-block mb-2" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $item->id }}">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('menu.delete', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Data karyawan yang dihapus <b>dapat</b> dipulihkan.
                                                        <br>Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-danger">Yakin</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
