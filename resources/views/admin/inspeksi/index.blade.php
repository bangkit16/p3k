@extends('admin.layouts.app', ['page' => 'Riwayat Inspeksi', 'pageSlug' => 'riwayat_inspeksi'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Manage Inspeksi</h4>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addkondisi">
                                Add Kondisi
                            </button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('kondisi.index') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" name="search" class="form-control form-control-sm mt-1"
                                    placeholder="Cari berdasarkan nama kondisi" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="container-fluid">
                        <table class="table table-responsive-xl " id="">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">
                                        Kotak P3K
                                    </th>
                                    <th scope="col">
                                        Tanggal
                                    </th>
                                    <th scope="col">
                                        Status
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{ $d->kotakP3k->lokasi }}</td>
                                        </td>
                                        <td>{{ $d->tanggal }}</td>
                                        <td>

                                            @switch($d->status)
                                                @case('Belum Approve')
                                                    <span class="badge bg-secondary">Belum Approve</span></span>
                                                @break

                                                @case('Approve Admin')
                                                    <span class="badge bg-primary">Approve Admin</span></span>
                                                @break

                                                @case('Approve Manager')
                                                    <span class="badge bg-success">Approve Manager</span></span>
                                                @break

                                                @case('Ditolak Admin')
                                                    <span class="badge bg-warning">Ditolak Admin</span></span>
                                                @break

                                                @case('Ditolak Manager')
                                                    <span class="badge bg-warning">Ditolak Manager</span></span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    {{-- <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editkondisi" data-id="{{ $d->kondisi_id }}"
                                                        data-kondisi-nama="{{ $d->kondisi_nama }}"
                                                        data-url="{{ url('kondisi/' . $d->kondisi_id) }}">Edit</a> --}}

                                                    <a class="dropdown-item
                                                        detail-button"
                                                        data-id="{{ $d->checklist_id }}"
                                                        href="{{ route('inspeksi.show', $d->checklist_id) }}">Detail</a>
                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                                        <a class="dropdown-item
                                                    approve-button"
                                                            data-bs-toggle="modal" data-bs-target="#approveModal"
                                                            data-id="{{ $d->checklist_id }}"
                                                            data-url="{{ url('inspeksi/approve/' . $d->checklist_id) }}">Approve</a>
                                                        <a class="dropdown-item
                                                    tolak-button"
                                                            data-bs-toggle="modal" data-bs-target="#tolakModal"
                                                            data-id="{{ $d->checklist_id }}"
                                                            data-url="{{ url('inspeksi/tolak/' . $d->checklist_id) }}">Tolak</a>
                                                    @endif
                                                    {{-- <a class="dropdown-item
                                                        delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $d->kondisi_id }}"
                                                        data-url="{{ url('inspeksi/' . $d->checklist_id) }}">Delete</a> --}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data yang ditemukan</td>
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
        {{-- <div class="modal fade" id="addkondisi" tabindex="-1" aria-labelledby="addbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Kondisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('kondisi.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Name role -->
                        <div class="form-group{{ $errors->has('kondisi_nama') ? ' has-danger' : '' }}">
                            <label for="kondisi_nama" class="col-form-label">Nama Kondisi: </label>
                            <input type="text" name="kondisi_nama" id="kondisi_nama"
                                class="form-control{{ $errors->has('kondisi_nama') ? ' is-invalid' : '' }}"
                                placeholder="Nama Barang" value="{{ old('kondisi_nama') }}">
                            @if ($errors->has('kondisi_nama'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('kondisi_nama') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kondisi</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

        <!-- Modal Edit role -->
        {{-- <div class="modal fade" id="editkondisi" tabindex="-1" aria-labelledby="editbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editbarangTitle">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editkondisiForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name role -->
                        <div class="form-group{{ $errors->has('edit_kondisi_nama') ? ' has-danger' : '' }}">
                            <label for="edit-kondisi-nama" class="col-form-label">Name Barang: </label>
                            <input type="text" name="edit_kondisi_nama" id="edit-kondisi-nama"
                                class="form-control{{ $errors->has('edit_kondisi_nama') ? ' is-invalid' : '' }}"
                                placeholder="Name Barang" value="{{ old('edit_kondisi_nama') }}">
                            @if ($errors->has('edit_kondisi_nama'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_kondisi_nama') }}
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
    </div> --}}

        <!-- Modal Delete role -->
        <div class="modal fade" id="approveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Approve Checklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin approve checklist p3k ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="approveForm" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tolakModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tolak Checklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin tolak checklist p3k ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="tolakForm" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Tolak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin menghapus data kondisi?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="deleteKondisiForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
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
                {{ $errors->has('kondisi_nama') ? 'true' : 'false' }}
            ) {
                var addBarangModal = new bootstrap.Modal(document.getElementById('addkondisi'));
                addBarangModal.show();
            }

            // Check and show the editkondisi modal if there are errors for edit role
            if (
                {{ $errors->has('edit_kondisi_nama') ? 'true' : 'false' }}
                // {{ $errors->has('edit_barang_nama') ? 'true' : 'false' }}
            ) {
                var editBarangModal = new bootstrap.Modal(document.getElementById('editkondisi'));
                var url = localStorage.getItem('Url');
                editBarangModal.show();
                $('#editkondisiForm').attr('action', url);

                console.log(@json($errors->all()));
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-button');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var barangId = this.getAttribute('data-id');
                    var barangNama = this.getAttribute('data-kondisi-nama');
                    var actionUrl = this.getAttribute('data-url');
                    localStorage.setItem('Url', actionUrl);


                    $('#edit-id').val(barangId);
                    $('#edit-kondisi-nama').val(barangNama);

                    // Atur action form untuk update
                    $('#editkondisiForm').attr('action', actionUrl);
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
                    document.getElementById('deleteKondisiForm').setAttribute('action',
                        barangDeleteUrl);
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol delete diklik
            document.querySelectorAll('.approve-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var barangId = this.getAttribute('data-id');
                    var barangDeleteUrl = this.getAttribute('data-url');

                    // Atur action form untuk delete
                    document.getElementById('approveForm').setAttribute('action',
                        barangDeleteUrl);
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol delete diklik
            document.querySelectorAll('.tolak-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var barangId = this.getAttribute('data-id');
                    var barangDeleteUrl = this.getAttribute('data-url');

                    // Atur action form untuk delete
                    document.getElementById('tolakForm').setAttribute('action',
                        barangDeleteUrl);
                });
            });
        });
    </script>
