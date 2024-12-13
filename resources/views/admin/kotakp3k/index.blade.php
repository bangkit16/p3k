@extends('admin.layouts.app', ['page' => 'Manage Kotak', 'pageSlug' => 'manage_kotak'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Manage Kotak P3K</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addpemakaian">
                                Add Kotak P3K
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
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
                                        Lokasi
                                    </th>
                                    <th scope="col">
                                        Barang
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($data as $key => $d)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $key }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    List Barang
                                                </a>
                                                <div class="dropdown-menu  dropdown-menu-arrow"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    @foreach ($d as $b)
                                                        <a disabled class="dropdown-item "
                                                            href="#">{{ $b->barang->barang_nama }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>

                                        <td class="">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editkotak"
                                                        data-id="{{ $b->kotakP3k->kotak_p3k_id }}"
                                                        data-kotak-lokasi="{{ $key }}"
                                                        data-pecah="{{ $d }}"
                                                        data-url="{{ url('kotak/' . $b->kotakP3k->kotak_p3k_id) }}">Edit</a>
                                                    {{-- <a class="dropdown-item
                                                        detail-button"
                                                        data-id="{{ $d->pemakaian_id }}"
                                                        href="{{ route('pemakaian.show', $d->checklist_id) }}">Detail</a> --}}
                                                    <a class="dropdown-item
                                                        delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $key }}"
                                                        data-url="{{ url('pemakaian/' . $key) }}">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Kotak P3K</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" onsubmit="return validateForm()"
                        action="{{ route('kotak.store') }}" enctype="multipart/form-data">

                        @csrf
                        <!-- Name role -->
                        <div class="form-group @error('lokasi') has-danger @enderror">
                            <label for="lokasi" class="col-form-label">Lokasi Kotak </label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="form-control @error('lokasi') is-invalid @enderror" placeholder="Nama Pemakai"
                                value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('lokasi') }}
                                </span>
                            @enderror
                        </div>

                        <div id="barang_container">
                            @if (old('barang_id'))
                                @foreach (old('barang_id') as $index => $barangId)
                                    <div class="form-group row mt-2 align-items-center"
                                        id="barang_group_{{ $index }}">
                                        <!-- Dropdown Barang -->
                                        <div class="col-md-6">
                                            <label for="barang_id_{{ $index }}" class="col-form-label">Jenis
                                                Barang</label>
                                            <select name="barang_id[]" id="barang_id_{{ $index }}"
                                                class="form-select @error("barang_id.$index") is-invalid @enderror"
                                                onchange="toggleJumlahDropdown({{ $index }})">
                                                <option value="">--Pilih--</option>
                                                @foreach ($barang as $b)
                                                    <option value="{{ $b->barang_id }}" data-tipe="{{ $b->tipe }}"
                                                        {{ $barangId == $b->barang_id ? 'selected' : '' }}>
                                                        {{ $b->barang_nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("barang_id.$index")
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Dynamic Input Jumlah -->
                                        <div class="col-md-4" id="jumlah_container_{{ $index }}">
                                            @php
                                                $tipe = $barang->firstWhere('barang_id', $barangId)?->tipe ?? 'number';
                                            @endphp

                                            @if ($tipe === 'select')
                                                <label for="jumlah_{{ $index }}"
                                                    class="col-form-label">Jumlah</label>
                                                <select name="jumlah[]" id="jumlah_{{ $index }}"
                                                    class="form-select @error("jumlah.$index") is-invalid @enderror">
                                                    <option value="">--Pilih--</option>
                                                    <option value="sedikit"
                                                        {{ old("jumlah.$index") == 'sedikit' ? 'selected' : '' }}>Sedikit
                                                    </option>
                                                    <option value="hampir habis"
                                                        {{ old("jumlah.$index") == 'hampir habis' ? 'selected' : '' }}>
                                                        Hampir Habis</option>
                                                    <option value="habis"
                                                        {{ old("jumlah.$index") == 'habis' ? 'selected' : '' }}>Habis
                                                    </option>
                                                </select>
                                            @else
                                                <label for="jumlah_{{ $index }}"
                                                    class="col-form-label">Jumlah</label>
                                                <input type="number" name="jumlah[]" id="jumlah_{{ $index }}"
                                                    class="form-control @error("jumlah.$index") is-invalid @enderror"
                                                    value="{{ old("jumlah.$index") }}" placeholder="Masukkan jumlah">
                                            @endif

                                            @error("jumlah.$index")
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default jika tidak ada input sebelumnya -->
                                <div class="form-group row mt-2 align-items-center" id="barang_group_0">
                                    <!-- Dropdown Barang -->
                                    <div class="col-md-6">
                                        <label for="barang_id_0" class="col-form-label">Jenis Barang</label>
                                        <select name="barang_id[]" id="barang_id_0" class="form-select"
                                            onchange="toggleJumlahDropdown(0)">
                                            <option value="">--Pilih--</option>
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->barang_id }}" data-tipe="{{ $b->tipe }}">
                                                    {{ $b->barang_nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dynamic Input Jumlah -->
                                    <div class="col-md-4" id="jumlah_container_0">
                                        <label for="jumlah_0" class="col-form-label">Jumlah</label>
                                        <input type="number" name="jumlah[]" id="jumlah_0" class="form-control"
                                            placeholder="Masukkan jumlah">
                                    </div>
                                </div>
                            @endif
                        </div>



                        <div class="mb-2">
                            <button type="button" class="btn btn-success" onclick="addBarang()">Add Barang</button>
                            <button type="button" class="btn btn-danger" onclick="removeBarang()">Remove Barang</button>
                        </div>



                        <div id="error_message" style="color: red; margin-top: 10px;"></div>
                        {{-- <div class="mb-2">
                            <button type="button" class="btn btn-success" onclick="addBarang()">Add Barang</button>
                            <button type="button" class="btn btn-danger" onclick="removeBarang()">Remove
                                Barang</button>
                        </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kotak P3K</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit role -->
    <div class="modal fade" id="editkotak" tabindex="-1" aria-labelledby="editbarangTitle" aria-hidden="true">
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
                        <div class="form-group @error('edit_lokasi') has-danger @enderror">
                            <label for="edit_lokasi" class="col-form-label">Lokasi Kotak </label>
                            <input type="text" name="edit_lokasi" id="edit_lokasi"
                                class="form-control @error('edit_lokasi') is-invalid @enderror" placeholder="Nama Pemakai"
                                value="{{ old('edit_lokasi') }}">
                            @error('edit_lokasi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_lokasi') }}
                                </span>
                            @enderror
                        </div>

                        <label class="col-form-label">Jenis Barang</label>
                        <div id="barang_edit_container">
                        </div>
                        <button type="button" id="tambah_barang" class="btn btn-success">Tambah Barang</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-white btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="text-white btn btn-primary">Update Barang</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="editkotak" tabindex="-1" aria-labelledby="editbarangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editbarangTitle">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editkondisiForm" method="POST" action="{{ route('kotak.update', $kotak->id ?? '') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <!-- Lokasi Kotak -->
                        <div class="form-group">
                            <label for="edit_lokasi" class="col-form-label">Lokasi Kotak</label>
                            <input type="text" name="edit_lokasi" id="edit_lokasi" class="form-control @error('edit_lokasi') is-invalid @enderror" placeholder="Lokasi Kotak" value="{{ old('edit_lokasi', $kotak->lokasi ?? '') }}">
                            @error('edit_lokasi')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Barang Dinamis -->
                        <div id="barang_edit_container">
                            <label class="col-form-label">Jenis Barang</label>
                            <!-- Elemen Barang akan ditambahkan secara dinamis oleh JavaScript -->
                            @if (old('barang_id'))
                            @foreach (old('barang_id') as $index => $barangId)
                            <div class="form-group row mt-2 align-items-center" id="barang_group_{{ $index }}">
                                <div class="col-md-5">
                                    <select name="barang_id[]" id="barang_id_{{ $index }}" class="form-select @error('barang_id.' . $index) is-invalid @enderror">
                                        <option value="">--Pilih--</option>
                                        @foreach ($barang as $b)
                                        <option value="{{ $b->barang_id }}" {{ $barangId == $b->barang_id ? 'selected' : '' }}>
                                            {{ $b->barang_nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error("barang_id.{$index}")
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="jumlah[]" id="jumlah_{{ $index }}" class="form-control @error('jumlah.' . $index) is-invalid @enderror" value="{{ old('jumlah')[$index] ?? '' }}" placeholder="Jumlah">
                                    @error("jumlah.{$index}")
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusField('{{ $index }}')">Hapus</button>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="form-group row mt-2 align-items-center" id="barang_group_0">
                                <div class="col-md-5">
                                    <select name="barang_id[]" id="barang_id_0" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($barang as $b)
                                        <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="jumlah[]" id="jumlah_0" class="form-control" placeholder="Jumlah">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusField('0')">Hapus</button>
                                </div>
                            </div>
                            @endif
                            <button type="button" id="tambah_barang" class="btn btn-success">Tambah Barang</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                </div>
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
    let barangCount = {{ old('barang_id') ? count(old('barang_id')) : 1 }};

    function toggleJumlahDropdown(index) {
        const barangSelect = document.getElementById(`barang_id_${index}`);
        const jumlahContainer = document.getElementById(`jumlah_container_${index}`);
        const selectedOption = barangSelect.options[barangSelect.selectedIndex];
        const tipe = selectedOption.getAttribute("data-tipe");

        // Clear jumlahContainer
        jumlahContainer.innerHTML = '';

        // Tambahkan inputan sesuai tipe
        if (tipe === 'select') {
            jumlahContainer.innerHTML = `
            <label for="jumlah_${index}" class="col-form-label">Jumlah</label>
            <select name="jumlah[]" id="jumlah_${index}" class="form-select">
                <option value="">--Pilih--</option>
                <option value="sedikit">Sedikit</option>
                <option value="hampir habis">Hampir Habis</option>
                <option value="habis">Habis</option>
            </select>
        `;
        } else {
            jumlahContainer.innerHTML = `
            <label for="jumlah_${index}" class="col-form-label">Jumlah</label>
            <input type="number" name="jumlah[]" id="jumlah_${index}" class="form-control"
                placeholder="Masukkan jumlah">
        `;
        }
    }

    function addBarang() {
        const container = document.getElementById('barang_container');
        const index = container.children.length;
        const newBarang = document.createElement('div');
        newBarang.className = 'form-group row mt-2 align-items-center';
        newBarang.id = `barang_group_${index}`;
        newBarang.innerHTML = `
        <div class="col-md-6">
            <label for="barang_id_${index}" class="col-form-label">Jenis Barang</label>
            <select name="barang_id[]" id="barang_id_${index}" class="form-select" onchange="toggleJumlahDropdown(${index})">
                <option value="">--Pilih--</option>
                @foreach ($barang as $b)
                    <option value="{{ $b->barang_id }}" data-tipe="{{ $b->tipe }}">
                        {{ $b->barang_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4" id="jumlah_container_${index}">
            <label for="jumlah_${index}" class="col-form-label">Jumlah</label>
            <input type="number" name="jumlah[]" id="jumlah_${index}" class="form-control" placeholder="Masukkan jumlah">
        </div>
    `;
        container.appendChild(newBarang);
    }

    function removeBarang() {
        const container = document.getElementById('barang_container');
        if (container.children.length > 1) {
            container.removeChild(container.lastChild);
        } else {
            alert('Minimal satu barang harus ada.');
        }
    }



    function validateBarang() {
        const selectedValues = new Set(); // Untuk menyimpan barang yang dipilih
        const dropdowns = document.querySelectorAll('[name="barang_id[]"]'); // Semua dropdown
        let errorMessage = ''; // Pesan error

        // Periksa setiap dropdown
        dropdowns.forEach((dropdown) => {
            const value = dropdown.value;
            if (value && selectedValues.has(value)) {
                // Jika barang sudah dipilih, tampilkan error
                errorMessage = 'Barang tidak boleh sama!';
                dropdown.classList.add('is-invalid');
            } else {
                // Jika valid, hapus error
                dropdown.classList.remove('is-invalid');
                if (value) selectedValues.add(value);
            }
        });

        // Tampilkan atau hapus pesan error
        const errorContainer = document.getElementById('error_message');
        errorContainer.textContent = errorMessage;
    }

    function validateForm() {
        // Panggil validasi barang
        validateBarang();

        const errorContainer = document.getElementById('error_message');
        if (errorContainer.textContent) {
            // Jika ada error, jangan submit form
            return false;
        }

        return true;
    }


    function updatePaginationLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Tambahkan atau update parameter 'limit'
        window.location.href = url.toString(); // Redirect ke URL baru
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //     // Modal Add - Jika ada error di lokasi, barang_id, atau jumlah
    //     if (
    //         {{ $errors->has('lokasi') || $errors->has('barang_id.*') || $errors->has('jumlah.*') ? 'true' : 'false' }}
    //     ) {
    //         var addBarangModal = new bootstrap.Modal(document.getElementById('addpemakaian'));
    //         addBarangModal.show();
    //     }

    //     // Modal Edit - Jika ada error di edit_lokasi, edit_barang_id, atau edit_jumlah
    //     if (
    //         {{ $errors->has('edit_lokasi') || $errors->has('edit_barang_id.*') || $errors->has('edit_jumlah.*') ? 'true' : 'false' }}
    //     ) {
    //         var editBarangModal = new bootstrap.Modal(document.getElementById('editkotak'));
    //         var url = localStorage.getItem('Url');
    //         editBarangModal.show();
    //         $('#editkondisiForm').attr('action', url);

    //         // Ambil nilai inputan sebelumnya untuk ditampilkan di modal
    //         $('#edit_lokasi').val(@json(old('edit_lokasi')));

    //         // Clear container terlebih dahulu
    //         $('#barang_edit_container').empty();

    //         // Loop melalui barang_id dan jumlah
    //         const editBarangIds = @json(old('edit_barang_id', []));
    //         const editJumlahs = @json(old('edit_jumlah', []));

    //         editBarangIds.forEach((barangId, index) => {
    //             const jumlah = editJumlahs[index] || '';

    //             // Tambahkan field barang dan jumlah ke dalam modal
    //             $('#barang_edit_container').append(`
    //             <div class="form-group row mt-2 align-items-center" id="barang_group_${index}">
    //                 <div class="col-md-6">
    //                     <label for="edit_barang_id_${index}" class="col-form-label">Jenis Barang</label>
    //                     <select name="edit_barang_id[]" id="edit_barang_id_${index}" class="form-select">
    //                         <option value="">--Pilih--</option>
    //                         @foreach ($barang as $b)
    //                             <option value="{{ $b->barang_id }}" ${barangId == {{ $b->barang_id }} ? 'selected' : ''}>
    //                                 {{ $b->barang_nama }}
    //                             </option>
    //                         @endforeach
    //                     </select>
    //                 </div>
    //                 <div class="col-md-4">
    //                     <label for="edit_jumlah_${index}" class="col-form-label">Jumlah</label>
    //                     <input type="number" name="edit_jumlah[]" id="edit_jumlah_${index}" class="form-control" value="${jumlah}" placeholder="Masukkan jumlah">
    //                 </div>
    //             </div>
    //         `);
    //         });

    //         console.log(@json($errors->all())); // Debugging
    //     }
    // });

    document.addEventListener('DOMContentLoaded', function() {
        // Modal Add - Jika ada error di lokasi, barang_id, atau jumlah
        if (
            {{ $errors->has('lokasi') || $errors->has('barang_id.*') || $errors->has('jumlah.*') ? 'true' : 'false' }}
        ) {
            var addBarangModal = new bootstrap.Modal(document.getElementById('addpemakaian'));
            addBarangModal.show();
        }

        // Modal Edit - Jika ada error di edit_lokasi, edit_barang_id, atau edit_jumlah
        if (
            {{ $errors->has('edit_lokasi') || $errors->has('edit_barang_id.*') || $errors->has('edit_jumlah.*') ? 'true' : 'false' }}
        ) {
            var editBarangModal = new bootstrap.Modal(document.getElementById('editkotak'));
            var url = localStorage.getItem('Url');
            editBarangModal.show();
            $('#editkondisiForm').attr('action', url);

            // Ambil nilai inputan sebelumnya untuk ditampilkan di modal
            $('#edit_lokasi').val(@json(old('edit_lokasi')));

            // Clear container terlebih dahulu
            $('#barang_edit_container').empty();

            // Loop melalui barang_id dan jumlah
            const editBarangIds = @json(old('edit_barang_id', []));
            const editJumlahs = @json(old('edit_jumlah', []));
            const errorsBarang = @json($errors->get('edit_barang_id.*'));
            const errorsJumlah = @json($errors->get('edit_jumlah.*'));

            editBarangIds.forEach((barangId, index) => {
                const jumlah = editJumlahs[index] || '';
                const errorBarang = errorsBarang[`edit_barang_id.${index}`] || '';
                const errorJumlah = errorsJumlah[`edit_jumlah.${index}`] || '';

                // Tambahkan field barang dan jumlah ke dalam modal
                $('#barang_edit_container').append(`
                <div class="form-group row mt-2 align-items-center" id="barang_group_${index}">
                    <div class="col-md-5">
                        <label class="col-form-label">Jenis Barang</label>
                        <select name="edit_barang_id[]" id="edit_barang_id_${index}" class="form-select ${errorBarang ? 'is-invalid' : ''}">
                            <option value="">--Pilih--</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}" ${barangId == {{ $b->barang_id }} ? 'selected' : ''}>
                                    {{ $b->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        ${errorBarang ? `<div class="invalid-feedback">${errorBarang[0]}</div>` : ''}
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label">Jumlah</label>
                        <input type="number" name="edit_jumlah[]" id="edit_jumlah_${index}" class="form-control ${errorJumlah ? 'is-invalid' : ''}" value="${jumlah}" placeholder="Masukkan jumlah">
                        ${errorJumlah ? `<div class="invalid-feedback">${errorJumlah[0]}</div>` : ''}
                    </div>
                    <div class="col-md-3 text-center">
                        <button type="button" class="btn btn-danger mt-4 remove-field" data-index="${index}">Hapus</button>
                    </div>
                </div>
            `);
            });

            // Fungsi hapus field barang
            $('#barang_edit_container').on('click', '.remove-field', function() {
                const index = $(this).data('index');
                $(`#barang_group_${index}`).remove();
            });

            console.log(@json($errors->all())); // Debugging
        }

        // Validasi barang tidak boleh sama
        $('#editkondisiForm').on('submit', function(e) {
            const barangIds = [];
            let hasDuplicate = false;

            $('select[name="edit_barang_id[]"]').each(function() {
                const val = $(this).val();
                if (barangIds.includes(val)) {
                    hasDuplicate = true;
                } else {
                    barangIds.push(val);
                }
            });

            if (hasDuplicate) {
                alert('Barang tidak boleh duplikat.');
                e.preventDefault();
            }
        });
    });




    // document.addEventListener('DOMContentLoaded', function() {
    //     var editButtons = document.querySelectorAll('.edit-button');

    //     editButtons.forEach(function(button) {
    //         button.addEventListener('click', function() {
    //             var kotakId = this.getAttribute('data-id');
    //             var kotakLokasi = this.getAttribute('data-kotak-lokasi');
    //             var kotakpecah = this.getAttribute('data-pecah');
    //             var actionUrl = this.getAttribute('data-url');
    //             localStorage.setItem('Url', actionUrl);
    //             var pecah = JSON.parse(kotakpecah);


    //             console.log(pecah)

    //             $('#edit-id').val(kotakId);
    //             $('#edit_lokasi').val(kotakLokasi);

    //             // Atur action form untuk update
    //             $('#editkondisiForm').attr('action', actionUrl);

    //             // Kosongkan container sebelum menambahkan elemen baru
    //             var barangContainer = document.getElementById('barang_edit_container');
    //             barangContainer.innerHTML = '';

    //             // Loop untuk menambahkan elemen barang berdasarkan data JSON
    //             pecah.forEach((item, index) => {
    //                 var groupDiv = document.createElement('div');
    //                 groupDiv.className = 'form-group row mt-2 align-items-center';
    //                 groupDiv.id = `barang_group_${index}`;

    //                 groupDiv.innerHTML = `
    //                 <div class="col-md-6">
    //                     <label for="barang_id_${index}" class="col-form-label">Jenis Barang</label>
    //                     <select name="barang_id[]" id="barang_id_${index}" class="form-select">
    //                         <option value="">--Pilih--</option>
    //                         ${generateBarangOptions(item.barang_id)}
    //                     </select>
    //                 </div>
    //                 <div class="col-md-4">
    //                     <label for="jumlah_${index}" class="col-form-label">Jumlah</label>
    //                     <input type="number" name="jumlah[]" id="jumlah_${index}" class="form-control" value="${item.jumlah}">
    //                 </div>
    //             `;
    //                 barangContainer.appendChild(groupDiv);
    //             });
    //         });
    //     });
    //     function generateBarangOptions(selectedId) {
    //         let barang = @json($barang); // Pastikan data barang dikirim dari controller
    //         let options = '';
    //         barang.forEach((b) => {
    //             options +=
    //                 `<option value="${b.barang_id}" ${b.barang_id == selectedId ? 'selected' : ''}>${b.barang_nama}</option>`;
    //         });
    //         return options;
    //     }
    // });
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var barangContainer = document.getElementById('barang_edit_container');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var kotakId = this.getAttribute('data-id');
                var kotakLokasi = this.getAttribute('data-kotak-lokasi');
                var kotakpecah = this.getAttribute('data-pecah');
                var actionUrl = this.getAttribute('data-url');

                // Parsing data JSON dari atribut data-pecah
                var pecah = JSON.parse(kotakpecah);

                // Set nilai pada input lokasi
                document.getElementById('edit_lokasi').value = kotakLokasi;

                // Set action pada form
                document.getElementById('editkondisiForm').action = actionUrl;

                // Kosongkan container sebelum menambahkan elemen baru
                barangContainer.innerHTML = '';

                // Loop untuk menambahkan elemen barang berdasarkan data JSON
                pecah.forEach((item, index) => {
                    tambahFieldBarang(index, item.barang_id, item.jumlah);
                });
            });
        });

        // Fungsi untuk menambahkan field barang
        function tambahFieldBarang(index, barangId = '', jumlah = '') {
            var groupDiv = document.createElement('div');
            groupDiv.className = 'form-group row mt-2 align-items-center';
            groupDiv.id = `barang_group_${index}`;

            groupDiv.innerHTML = `
            <div class="col-md-5">
                <select name="edit_barang_id[]" id="barang_id_${index}" class="form-select">
                    <option value="">--Pilih--</option>
                    ${generateBarangOptions(barangId)}
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="edit_jumlah[]" id="jumlah_${index}" class="form-control" value="${jumlah}" placeholder="Jumlah">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusField('${index}')">Hapus</button>
            </div>
        `;
            barangContainer.appendChild(groupDiv);
        }

        // Fungsi untuk menghapus field barang
        window.hapusField = function(index) {
            var fieldGroup = document.getElementById(`barang_group_${index}`);
            if (fieldGroup) {
                barangContainer.removeChild(fieldGroup);
            }
        };

        // Tombol Tambah Barang
        document.getElementById('tambah_barang').addEventListener('click', function() {
            var newIndex = barangContainer.children.length;
            tambahFieldBarang(newIndex);
        });

        // Fungsi untuk membuat opsi dropdown barang
        function generateBarangOptions(selectedId) {
            let barang = @json($barang); // Pastikan data barang dikirim dari controller
            let options = '';
            barang.forEach((b) => {
                options +=
                    `<option value="${b.barang_id}" ${b.barang_id == selectedId ? 'selected' : ''}>${b.barang_nama}</option>`;
            });
            return options;
        }
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
