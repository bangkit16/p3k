@extends('admin.layouts.app', ['page' => 'Manage Barang', 'pageSlug' => 'manage_barang'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Barang</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addbarang">
                                <div class="text-wrap">Add Barang</div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('barang.index') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" name="search" class="form-control form-control-sm mt-1"
                                    placeholder="Cari berdasarkan nama barang" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="">
                        <table class="table table-responsive-xl " id="">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'barang_nama', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Nama Barang
                                            @if ($sortBy === 'barang_nama')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'jumlah_standar', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Jumlah Standar
                                            @if ($sortBy === 'jumlah_standar')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'tipe', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tipe
                                            @if ($sortBy === 'tipe')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tanggal Dibuat
                                            @if ($sortBy === 'created_at')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{ $d->barang_nama }}</td>
                                        </td>
                                        <td>{{ $d->jumlah_standar }}</td>
                                        <td>{{ $d->tipe }}</td>
                                        </td>
                                        <td>{{ $d->created_at }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editbarang" data-id="{{ $d->barang_id }}"
                                                        data-barang-nama="{{ $d->barang_nama }}"
                                                        data-jumlah-standar="{{ $d->jumlah_standar }}"
                                                        data-tipe="{{ $d->tipe }}"
                                                        data-url="{{ url('barang/' . $d->barang_id) }}">Edit</a>
                                                    <a class="dropdown-item
                                                        delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $d->barang_id }}"
                                                        data-url="{{ url('barang/' . $d->barang_id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada uraian yang ditemukan</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <nav class="d-flex justify-content-between align-items-center" aria-label="...">
                        <div class="form-group">
                            <select id="paginationLimit" class="form-control" onchange="updatePaginationLimit(this.value)"
                                style="font-size: 12px">
                                <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                <option value="all" {{ request('limit') == 'all' ? 'selected' : '' }}>All</option>
                            </select>
                        </div>

                        {{-- Tampilkan pagination hanya jika tidak memilih 'all' --}}
                        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $data->links('vendor.pagination.bootstrap-5') }}
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add role-->
    <div class="modal fade" id="addbarang" tabindex="-1" aria-labelledby="addbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('barang.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Name role -->
                        <div class="form-group">
                            <label for="barang_nama" class="col-form-label">Name Barang: </label>
                            <input type="text" name="barang_nama" id="barang_nama"
                                class="form-control{{ $errors->has('barang_nama') ? ' is-invalid' : '' }}"
                                placeholder="Nama Barang" value="{{ old('barang_nama') }}">
                            @if ($errors->has('barang_nama'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('barang_nama') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jumlah_standar" class="col-form-label">Jumlah Standar: </label>
                            <input type="number" name="jumlah_standar" id="jumlah_standar"
                                class="form-control{{ $errors->has('jumlah_standar') ? ' is-invalid' : '' }}"
                                placeholder="Nama Barang" value="{{ old('jumlah_standar') }}">
                            @if ($errors->has('jumlah_standar'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('jumlah_standar') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tipe" class="col-form-label">Tipe: </label>
                            <select name="tipe" id="tipe"
                                class="form-select{{ $errors->has('tipe') ? ' is-invalid' : '' }}" placeholder="tip">
                                <option value="">-- Pilih --</option>
                                <option @if (old('tipe') == 'number') selected @endif value="number">Number</option>
                                <option @if (old('tipe') == 'select') selected @endif value="select">Select</option>
                            </select>


                            @if ($errors->has('tipe'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('tipe') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit role -->
    <div class="modal fade" id="editbarang" tabindex="-1" aria-labelledby="editbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editbarangTitle">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editbarangForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name role -->
                        <div class="form-group">
                            <label for="edit-barang-nama" class="col-form-label">Name Barang: </label>
                            <input type="text" name="edit_barang_nama" id="edit-barang-nama"
                                class="form-control{{ $errors->has('edit_barang_nama') ? ' is-invalid' : '' }}"
                                placeholder="Name Barang" value="{{ old('edit_barang_nama') }}">
                            @if ($errors->has('edit_barang_nama'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_barang_nama') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="edit-jumlah-standar" class="col-form-label">Jumlah Standar: </label>
                            <input type="text" name="edit_jumlah_standar" id="edit-jumlah-standar"
                                class="form-control{{ $errors->has('edit_jumlah_standar') ? ' is-invalid' : '' }}"
                                placeholder="Jumlah Standar" value="{{ old('edit_jumlah_standar') }}">
                            @if ($errors->has('edit_jumlah_standar'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_jumlah_standar') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="edit_tipe" class="col-form-label">Tipe: </label>
                            <select name="edit_tipe" id="edit_tipe"
                                class="form-select{{ $errors->has('edit_tipe') ? ' is-invalid' : '' }}"
                                placeholder="tip">
                                <option value="">-- Pilih --</option>
                                <option @if (old('edit_tipe') == 'number') selected @endif value="number">Number</option>
                                <option @if (old('edit_tipe') == 'select') selected @endif value="select">Select</option>

                            </select>


                            @if ($errors->has('edit_tipe'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_tipe') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-white btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="text-white btn btn-primary">Update Barang</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete role -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin menghapus data barang?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteBarangForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@stack('js')
<script>
    function updatePaginationLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Tambahkan atau update parameter 'limit'
        window.location.href = url.toString(); // Redirect ke URL baru
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (
            {{ $errors->has('barang_nama') || $errors->has('jumlah_standar') || $errors->has('tipe') ? 'true' : 'false' }}
        ) {
            var addBarangModal = new bootstrap.Modal(document.getElementById('addbarang'));
            addBarangModal.show();
        }

        // Check and show the editbarang modal if there are errors for edit role
        if (
            {{ $errors->has('edit_barang_nama') || $errors->has('edit_jumlah_standar') || $errors->has('edit_tipe') ? 'true' : 'false' }}
            // {{ $errors->has('edit_barang_nama') ? 'true' : 'false' }}
        ) {
            var editBarangModal = new bootstrap.Modal(document.getElementById('editbarang'));
            var url = localStorage.getItem('Url');
            editBarangModal.show();
            $('#editbarangForm').attr('action', url);

            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var barangId = this.getAttribute('data-id');
                var barangNama = this.getAttribute('data-barang-nama');
                var barangJumlahStandar = this.getAttribute('data-jumlah-standar');
                var barangTipe = this.getAttribute('data-tipe');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                console.log(actionUrl, barangId, barangNama, barangJumlahStandar);

                $('#edit-id').val(barangId);
                $('#edit-barang-nama').val(barangNama);
                $('#edit-jumlah-standar').val(barangJumlahStandar);
                // $('#edit-tipe').val(tipe);
                const tipe = this.dataset.tipe; // Ambil nilai data-tipe
                document.querySelector('#edit_tipe').value = tipe;

                // Atur action form untuk update
                $('#editbarangForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var barangId = this.getAttribute('data-id');
                var barangDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteBarangForm').setAttribute('action',
                    barangDeleteUrl);
            });
        });
    });
</script>
