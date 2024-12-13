@extends('admin.layouts.app', ['page' => 'Riwayat Pemakaian', 'pageSlug' => 'riwayat_pemakaian'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Riwayat Pemakaian</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addpemakaian">
                                Add Pemakaian
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    @if ( auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        
                    <div class="container-fluid">
                        <a class="btn btn-success mb-3" href="{{ route('laporan.pemakaian.pdf') }}">Cetak PDF</a>
                        <a class="btn btn-success mb-3" href="{{ route('laporan.pemakaian.excel') }}">Cetak Excel</a>
                        <a class="btn btn-success mb-3" href="{{ route('laporan.pemakaian.print') }}">Print</a>
                    </div>
                    @endif
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('pemakaian.index') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" name="search" class="form-control form-control-sm mt-1"
                                    placeholder="Cari berdasarkan nama pemakaian" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="container-fluid">
                        <table class="table table-responsive-xl table-bordered" id="">
                            <thead class="text-primary ">
                                <tr>
                                    <th class="text-center" scope="col">
                                        No
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'nama_pemakai', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Nama Pemakai Obat P3K
                                            @if ($sortBy === 'nama_pemakai')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'divisi', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Divisi
                                            @if ($sortBy === 'divisi')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'tanggal', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tanggal Pemakaian
                                            @if ($sortBy === 'tanggal')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'jam_pemakaian', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Jam Pemakaian
                                            @if ($sortBy === 'jam_pemakaian')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        Jenis Obat P3K
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'jumlah_pemakaian', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Jumlah Pemakaian
                                            @if ($sortBy === 'jumlah_pemakaian')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        Alasan Pemakaian
                                    </th>
                                    <th scope="col">
                                        Kotak P3K
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($data as $d)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $d->nama_pemakai }}</td>
                                        <td>{{ $d->divisi }}</td>
                                        <td class="text-center">{{ $d->tanggal }}</td>
                                        <td class="text-center">{{ $d->jam_pemakaian }}</td>
                                        <td>{{ $d->barang->barang_nama }}</td>
                                        <td class="text-center">{{ $d->jumlah_pemakaian }}</td>
                                        <td>{{ $d->alasan_pemakaian }}</td>
                                        <td>{{ $d->kotakP3k->lokasi }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editpemakaian" data-id="{{ $d->kondisi_id }}"
                                                        data-kondisi-nama="{{ $d->nama_pemakai }}"
                                                        data-url="{{ url('kondisi/' . $d->kondisi_id) }}">Edit</a>
                                                    {{-- <a class="dropdown-item
                                                        detail-button"
                                                        data-id="{{ $d->pemakaian_id }}"
                                                        href="{{ route('pemakaian.show', $d->checklist_id) }}">Detail</a> --}}
                                                    <a class="dropdown-item
                                                        delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $d->pemakaian_id }}"
                                                        data-url="{{ url('pemakaian/' . $d->checklist_id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada Kondisi yang ditemukan</td>
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
    <div class="modal fade" id="addpemakaian" tabindex="-1" aria-labelledby="addbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Kondisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('pemakaian.store') }}"
                        enctype="multipart/form-data">
                        
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <!-- Name role -->
                        <div class="form-group @error('nama_pemakai') has-danger @enderror">
                            <label for="nama_pemakai" class="col-form-label">Nama Pemakai Obat P3K </label>
                            <input type="text" name="nama_pemakai" id="nama_pemakai"
                                class="form-control @error('nama_pemakai') is-invalid @enderror"
                                placeholder="Nama Pemakai" value="{{ old('nama_pemakai') }}">
                            @error('nama_pemakai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('nama_pemakai') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('divisi') has-danger @enderror">
                            <label for="divisi" class="col-form-label">Divisi</label>
                            <input type="text" name="divisi" id="divisi"
                                class="form-control @error('divisi') is-invalid @enderror"
                                placeholder="Divisi" value="{{ old('divisi') }}">
                            @error('divisi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('divisi') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('tanggal') has-danger @enderror">
                            <label for="tanggal" class="col-form-label">Tanggal </label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                placeholder="Tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('tanggal') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('jam_pemakaian') has-danger @enderror">
                            <label for="jam_pemakaian" class="col-form-label">Jam Pemakaian </label>
                            <input type="time" name="jam_pemakaian" id="jam_pemakaian"
                                class="form-control @error('jam_pemakaian') is-invalid @enderror"
                                placeholder="Tanggal" value="{{ old('jam_pemakaian') }}">
                            @error('jam_pemakaian')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('jam_pemakaian') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('barang_id') has-danger @enderror">
                            <label for="barang_id" class="col-form-label">Jenis Barang </label>
                                <select name="barang_id" id="" class="form-select  @error('barang_id') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    @foreach ($barang as $b)    
                                        <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                                    @endforeach
                                </select>
                            @error('barang_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('barang_id') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('jumlah_pemakaian') has-danger @enderror">
                            <label for="jumlah_pemakaian" class="col-form-label">Jumlah Pemakaian </label>
                            <input type="number" name="jumlah_pemakaian" id="jumlah_pemakaian"
                                class="form-control @error('jumlah_pemakaian') is-invalid @enderror"
                                placeholder="Jumlah Pemakaian" value="{{ old('jumlah_pemakaian') }}">
                            @error('jumlah_pemakaian')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('jumlah_pemakaian') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('alasan_pemakaian') has-danger @enderror">
                            <label for="alasan_pemakaian" class="col-form-label">Alasan Pemakaian </label>
                            <input type="text" name="alasan_pemakaian" id="alasan_pemakaian"
                                class="form-control @error('alasan_pemakaian') is-invalid @enderror"
                                placeholder="Alasan Pemakaian" value="{{ old('alasan_pemakaian') }}">
                            @error('alasan_pemakaian')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('alasan_pemakaian') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('kotak_p3k_id') has-danger @enderror">
                            <label for="kotak_p3k_id" class="col-form-label">Kotak </label>
                                <select name="kotak_p3k_id" id="" class="form-select  @error('kotak_p3k_id') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    @foreach ($kotak as $k)    
                                        <option value="{{ $k->kotak_p3k_id }}">{{ $k->lokasi }}</option>
                                    @endforeach
                                </select>
                            @error('kotak_p3k_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('kotak_p3k_id') }}
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kondisi</button>
                </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit role -->
        {{-- <div class="modal fade" id="editpemakaian" tabindex="-1" aria-labelledby="editbarangTitle" aria-hidden="true">
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
                {{ $errors->has('nama_pemakai') ||  $errors->has('divisi') ||  $errors->has('tanggal') ||  $errors->has('barang_id') ||  $errors->has('jumlah_pemakaian') ||  $errors->has('alasan_pemakaian') ||  $errors->has('kotak_p3k_id') || $errors->has('jam_pemakaian') ? 'true' : 'false' }}
            ) {
                var addBarangModal = new bootstrap.Modal(document.getElementById('addpemakaian'));
                addBarangModal.show();
            }

            // Check and show the editpemakaian modal if there are errors for edit role
            if (
                {{ $errors->has('edit_kondisi_nama') ? 'true' : 'false' }}
                // {{ $errors->has('edit_barang_nama') ? 'true' : 'false' }}
            ) {
                var editBarangModal = new bootstrap.Modal(document.getElementById('editpemakaian'));
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
                    var pemakaianId = this.getAttribute('data-id');
                    var pemakaianNama = this.getAttribute('data-kondisi-nama');
                    var pemakaianactionUrl = this.getAttribute('data-url');
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
