@extends('admin.layouts.app', ['page' => 'Input Inspeksi', 'pageSlug' => 'input_inspeksi'])

@section('content')
    <h4 class="card-title mb-3 fw-light">Input Inspeksi</h4>
    <div class="card p-3">

        <div class=" row ">
            {{-- <div class="card row"> --}}

            <label for="staticEmail" class="col-sm-2 col-form-label col-4"><span>Pilih Kotak P3K</span></label>
            <div class="col-sm-4 col-8 d-inline-block">
                <form action="{{ route('inspeksi.create') }}" id="formpilihkotak">

                    <select name="idkotak" id="pilihp3k" class="form-select" onchange="this.form.submit()">
                        <option value="">--Pilih--</option>
                        @foreach ($kotak as $k)
                            <option @if ($idkotak == $k['kotak_p3k_id']) selected @endif value="{{ $k['kotak_p3k_id'] }}">
                                {{ $k['lokasi'] }}</option>
                        @endforeach
                    </select>

                </form>
                @if (empty($idkotak))
                    <small class="text-danger">*Pilih kotak terlebih dahulu"</small>
                @endif
            </div>
            {{-- </div> --}}
        </div>
    </div>
    @if (!empty($idkotak))
        <form action="{{ route('inspeksi.store') }}" method="post">
            @csrf
            <input type="hidden" name="idkotak" value="{{ $idkotak }}">


            <div class="row gx-md-1">
                <div class="col-md-10">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Manage Kotak</h4>
                            {{-- <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addkondisi">
                                Add Kondisi
                            </button>
                        </div>
                    </div> --}}
                        </div>
                        <div class="card-body">


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
                                    {{-- @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif --}}

                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($barang as $kiy => $b)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $b->barang->barang_nama }}</td>
                                            <td class="text-center">{{ $b->barang->jumlah_standar }}</td>
                                            <td>
                                                @if ($b->barang->tipe == 'select')
                                                    <select
                                                        class="form-select @error('jumlah_aktual.' . $b->barang->barang_id)
                                            is-invalid
                                            @enderror"
                                                        name="jumlah_aktual[{{ $b->barang->barang_id }}]">
                                                        <option value="">--Pilih--</option>
                                                        <option @if (old('jumlah_aktual.' . $b->barang->barang_id) == 'sedikit') selected @endif
                                                            value="sedikit">
                                                            Sedikit</option>
                                                        <option @if (old('jumlah_aktual.' . $b->barang->barang_id) == 'hampir habis') selected @endif
                                                            value="hampir habis">Hampir Habis</option>
                                                        <option @if (old('jumlah_aktual.' . $b->barang->barang_id) == 'habis') selected @endif
                                                            value="habis">
                                                            Sedikit</option>
                                                    </select>
                                                    @error('jumlah_aktual.' . $b->barang->barang_id)
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror
                                                @endif
                                                @if ($b->barang->tipe == 'number')
                                                    <input type="number" name="jumlah_aktual[{{ $b->barang->barang_id }}]"
                                                        value="{{ old('jumlah_aktual.' . $b->barang->barang_id) }}"
                                                        class="form-control @error('jumlah_aktual.' . $b->barang->barang_id)
                                                is-invalid
                                            @enderror">

                                                    @error('jumlah_aktual.' . $b->barang->barang_id)
                                                        <small class="text-danger"> {{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </td>
                                            <td>
                                                <input type="date"
                                                    name="tanggal_kadaluarsa[{{ $b->barang->barang_id }}]"
                                                    value="{{ old('tanggal_kadaluarsa.' . $b->barang->barang_id) }}"
                                                    class="form-control @error('tanggal_kadaluarsa.' . $b->barang->barang_id)
                                                is-invalid
                                            @enderror">
                                                @error('tanggal_kadaluarsa.' . $b->barang->barang_id)
                                                    <small class="text-danger "> {{ $message }}</small>
                                                @enderror
                                            </td>
                                            <td><input type="text" name="keterangan[{{ $b->barang->barang_id }}]"
                                                    class="form-control"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    console.log(@json($errors->all()));
                                })
                            </script>

                        </div>
                        <div class="card-footer ">
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="card sticky-top top-3">
                        <div class="card-header">
                            <h4 class="card-title">Kondisi Kotak</h4>
                        </div>
                        <div class="card-body">
                            @if (!empty($idkotak))
                                <table class="table table-responsive-xl table-bordered" id="">
                                    <thead class="text-primary">
                                        <tr>
                                            <th class="" scope="col">Item check</th>
                                            <th class="text-center" scope="col">Status</th>
                                            <th class="text-center" scope="col">Tindakan Perbaikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kondisi as $key => $k)
                                            <tr>
                                                <td>{{ $k->kondisi_nama }}</td>
                                                <td>
                                                    <select id="pilihp3k" name="status[{{ $k->kondisi_id }}]"
                                                        class="form-select">
                                                        <option value="">--Pilih--</option>
                                                        <option value="sesuai">Sesuai</option>
                                                        <option value="tidak_sesuai">Tidak Sesuai</option>
                                                    </select>
                                                </td>
                                                <td class="text-center"><input type="text"
                                                        name="tindakan[{{ $k->kondisi_id }}]" class=" form-control"
                                                        id=""></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </form>

    @endif
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
