@extends('admin.layouts.app', ['page' => 'Riwayat Inspeksi', 'pageSlug' => 'riwayat_inspeksi'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title h4">Manage Inspeksi</h4>
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
                    {{-- <div class="container-fluid">
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
                    </div> --}}

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Lokasi P3K</strong></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">{{ $data->kotakP3k->lokasi }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Status</strong></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">
                                    @switch($data->status)
                                        @case('belum_diseleksi')
                                            <span class="badge bg-info">Belum Diseleksi</span></span>
                                        @break

                                        @case('seleksi')
                                            <span class="badge bg-success">Approve Semua</span></span>
                                        @break

                                        @case('revisi')
                                            <span class="badge bg-warning">Revisi</span></span>
                                        @break

                                        @default
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Tanggal</strong></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">{{ $data->tanggal }}</div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-2"><strong>Inspektor</strong></div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">{{ $data->user->name }}</div>
                            </div>
                        </div>
                        <span><strong>Detail Inspeksi</strong></span>
                        <table class="table table-responsive-xl table-bordered" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="" scope="col">Isi Kotak Obat P3K</th>
                                    <th class="text-center" scope="col">Jumlah Standar</th>
                                    <th class="text-center" scope="col">Jumlah Aktual</th>
                                    <th class="text-center" scope="col">Tanggal Kadaluarsa</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    // dd($data);
                                @endphp
                                @foreach ($data->inputChecklists as $kiy => $b)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $b->barang->barang_nama }}</td>
                                        <td class="text-center">{{ $b->barang->jumlah_standar }}</td>
                                        <td>{{ $b->jumlah_aktual }}</td>
                                        <td>{{ $b->tanggal_kadaluwarsa }}</td>
                                        <td>{{ $b->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span><strong>Kondisi Kotak P3K</strong></span>
                        <table class="table table-responsive-xl table-bordered" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="" scope="col">Item Check</th>
                                    <th class="text-center" scope="col">Status</th>
                                    {{-- <th class="text-center" scope="col">Tidak Sesuai</th> --}}
                                    <th class="text-center" scope="col">Tindakan Perbaikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    // dd($data);
                                @endphp
                                @foreach ($data->kondisiInputs as $key => $k)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $k->kondisi->kondisi_nama }}</td>
                                        <td>{{ $k->status }}</td>
                                        <td>{{ $k->tindakan_perbaikan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <a href="{{ route('inspeksi.index') }}" class="btn btn-secondary">Kembali</a>
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
</script>
