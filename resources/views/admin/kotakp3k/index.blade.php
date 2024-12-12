@extends('admin.layouts.app', ['page' => 'Riwayat Inspeksi', 'pageSlug' => 'riwayat'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Manage Kotak</h4>
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
                                                <div class="dropdown-menu  dropdown-menu-arrow">
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
                                                    {{-- <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editpemakaian" data-id="{{ $d->kondisi_id }}"
                                                        data-kondisi-nama="{{ $d->nama_pemakai }}"
                                                        data-url="{{ url('kondisi/' . $d->kondisi_id) }}">Edit</a> --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Kondisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('kotak.store') }}" enctype="multipart/form-data">

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

                            <div class="form-group" id="barang_group_0">
                                <label for="barang_id_0" class="col-form-label">Jenis Barang</label>
                                <select name="barang_id[]" id="barang_id_0" class="form-select">
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

                        </div>
                        <div id="error_message" style="color: red; margin-top: 10px;"></div>
                        <div class="mb-2">
                            <button type="button" class="btn btn-success" onclick="addBarang()">Add Barang</button>
                            <button type="button" class="btn btn-danger" onclick="removeBarang()">Remove
                                Barang</button>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kondisi</button>
                </div>
                </form>
            </div>
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
    </div>

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
    // document.addEventListener('DOMContentLoaded', function() {
    //     const barangContainer = document.getElementById('barang-container');
    //     const addBarangButton = document.getElementById('add-barang');

    //     addBarangButton.addEventListener('click', function() {
    //         const newSelect = document.createElement('div');
    //         newSelect.classList.add('form-group', 'mb-3');

    //         newSelect.innerHTML = `
    //             <label for="barang_id" class="col-form-label">Jenis Barang</label>
    //             <div class="d-flex align-items-center">
    //                 <select name="barang_id[]" class="form-select">
    //                     <option value="">--Pilih--</option>
    //                     @foreach ($barang as $b)
    //                         <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
    //                     @endforeach
    //                 </select>
    //                 <button type="button" class="btn btn-danger btn-sm ms-2 remove-barang">Hapus</button>
    //             </div>
    //         `;

    //         barangContainer.appendChild(newSelect);

    //         // Add event listener to remove button
    //         newSelect.querySelector('.remove-barang').addEventListener('click', function() {
    //             barangContainer.removeChild(newSelect);
    //         });
    //     });
    // });

    let barangCount = 1; // Awal jumlah dropdown

    function addBarang() {
        const container = document.getElementById('barang_container'); // Container utama

        // Membuat elemen baru
        const newGroup = document.createElement('div');
        newGroup.classList.add('form-group', 'mt-2');
        newGroup.id = `barang_group_${barangCount}`;

        // Template dropdown baru
        newGroup.innerHTML = `
        <label for="barang_id_${barangCount}" class="col-form-label">Jenis Barang</label>
        <select name="barang_id[]" id="barang_id_${barangCount}" class="form-select" onchange="validateBarang()">
            <option value="">--Pilih--</option>
            @foreach ($barang as $b)
                <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
            @endforeach
        </select>
    `;

        // Tambahkan elemen baru ke dalam container
        container.appendChild(newGroup);
        barangCount++; // Tambah jumlah dropdown
    }

    function removeBarang() {
        const container = document.getElementById('barang_container'); // Container utama

        // Hanya hapus jika ada lebih dari satu elemen
        if (barangCount > 1) {
            barangCount--; // Kurangi jumlah dropdown
            const lastGroup = document.getElementById(`barang_group_${barangCount}`); // Ambil elemen terakhir
            container.removeChild(lastGroup); // Hapus elemen terakhir
            validateBarang(); // Validasi ulang setelah penghapusan
        } else {
            alert("Minimal satu dropdown harus ada."); // Beri peringatan
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


    // let barangCount = 1; // Hitung jumlah dropdown yang ada

    // // let barangCount = 1; // Hitung jumlah dropdown yang ada

    // function addBarang() {
    //     const container = document.getElementById('barang_container');

    //     // Buat elemen baru untuk dropdown
    //     const newInputGroup = document.createElement('div');
    //     newInputGroup.classList.add('form-group', 'mt-2');
    //     newInputGroup.id = `barang_group_${barangCount}`;
    //     newInputGroup.innerHTML = `
    //     <select name="barang_id[]" id="barang_id_${barangCount}" class="form-select">
    //         <option value="">--Pilih--</option>
    //         @foreach ($barang as $b)
    //             <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
    //         @endforeach
    //     </select>
    // `;

    //     // Tambahkan elemen ke dalam container
    //     container.appendChild(newInputGroup);
    //     barangCount++; // Increment jumlah dropdown
    //     console.log("Barang ditambahkan:", barangCount);
    // }

    // function removeBarang() {
    //     const container = document.getElementById('barang_container');

    //     // Hapus dropdown terakhir jika lebih dari satu
    //     if (barangCount > 1) {
    //         barangCount--; // Decrement jumlah dropdown
    //         const lastInputGroup = document.getElementById(`barang_group_${barangCount}`);
    //         container.removeChild(lastInputGroup);
    //     } else {
    //         alert("Minimal satu dropdown harus ada.");
    //     }
    // }


    // function addSubUraian() {
    //     const container = document.getElementById('barang_container');
    //     const newInputGroup = document.createElement('div');
    //     newInputGroup.classList.add('form-group');
    //     newInputGroup.innerHTML = `
    //     <label for="sub_uraian_nama_${subUraianCount}" class="col-form-label">Name Sub Uraian: </label>
    //     <input type="text" name="sub_uraian_nama[]" id="sub_uraian_nama_${subUraianCount}" class="form-control" placeholder="Name Sub Uraian">
    // `;
    //     container.appendChild(newInputGroup);
    //     subUraianCount++;
    // }

    // function removeSubUraian() {
    //     const container = document.getElementById('barang_container');
    //     if (subUraianCount > 1) {
    //         container.removeChild(container.lastElementChild);
    //         subUraianCount--;
    //     } else {
    //         alert("Minimal satu input harus ada.");
    //     }
    // }

    function updatePaginationLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Tambahkan atau update parameter 'limit'
        window.location.href = url.toString(); // Redirect ke URL baru
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (
            {{ $errors->has('nama_pemakai') || $errors->has('divisi') || $errors->has('tanggal') || $errors->has('barang_id') || $errors->has('jumlah_pemakaian') || $errors->has('alasan_pemakaian') || $errors->has('kotak_p3k_id') || $errors->has('jam_pemakaian') ? 'true' : 'false' }}
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
