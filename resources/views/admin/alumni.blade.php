@extends('admin.layout.extend')
@section('title')
Halaman Alumni
@endsection

@section('page-name')
Halaman Alumni
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Manajemen Alumni</h6>
        </div>
        <div class="card-body">
            <div class="text-left mx-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                <a class="btn btn-success" href="{{ route('admin.import') }}">
                    <i class="fas fa-upload"></i> Upload Data
                </a>
            </div>
            <div class="table-responsive p-3">
                <form class="form-inline mb-3" action="{{ route('admin.alumni') }}" method="GET">
                    <label class="sr-only" for="search">Search</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="search" name="search" placeholder="Cari Nama / NIS" value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
                    @if (request()->has('search'))
                    <a href="{{ route('admin.alumni') }}" class="btn btn-secondary mb-2 ml-2"><i class="fas fa-times"></i></a>
                    @endif
                </form>
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Biodata</th>
                            <th>Lulusan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $data->firstItem() + $loop->iteration - 1 }}</td>
                            <td class="p-3 bg-light">
                                <h6 class="font-weight-bold mb-1 text-dark">{{ $item->name }}</h6>
                                <p class="m-0 text-primary">NIS: {{ $item->nis }}</p>
                                <p class="text-info m-0">Jurusan: {{ $item->jurusan }}</p>
                            </td>
                            <td>{{ $item->tahun->tahun }}</td>
                            <td class="font-weight-bold">
                                @if ($item->status == 0)
                                <span class="badge badge-secondary">Belum Bekerja / Kuliah</span>
                                @elseif ($item->status == 1)
                                <span class="badge badge-success">Bekerja</span>
                                <span class="badge badge-info">{{ $item->instansi }}</span>
                                <span class="badge badge-success">{{ $item->position }}</span>
                                @elseif ($item->status == 2)
                                <span class="badge badge-primary">Kuliah</span>
                                <span class="badge badge-info">{{ $item->instansi }}</span>
                                <span class="badge badge-success">{{ $item->position }}</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex">

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.alumni.delete') }}" method="POST" id="{{ $item->id }}">
                                        @csrf <input type="hidden" name="id" value="{{ $item->id }}"></form><button class="btn-sm btn-danger" onclick="deleteRow({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                    {{-- End Delete --}}
                                    &nbsp;
                                    {{-- Edit --}}
                                    <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#edit{{ $item->id }}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    {{-- End Edit --}}
                                </div>
                            </td>
                        </tr>


                        {{-- Modal Edit --}}
                        <div class="modal fade" id="edit{{ $item->id }}" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Patner</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm{{ $item->id }}">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group">
                                                <label>NIS</label>
                                                <input type="text" name="nis" class="form-control" value="{{ $item->nis }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select name="kelas" class="form-control">
                                                    <option value="" disabled>-- Pilih Kelas --</option>
                                                    @foreach ($kelas as $item2)
                                                    <option value="{{ $item2 }}" {{ ($item->jurusan == $item2) ?
                                                        'selected' : '' }}>{{ $item2 }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Lulusan Tahun</label>
                                                <select name="tahun" class="form-control">
                                                    <option value="" disabled>-- Pilih Lulusan --</option>
                                                    @foreach ($lulusan as $item2)
                                                    <option value="{{ $item2->id }}" {{ ($item->lulusan == $item2->id) ?
                                                        'selected' : '' }}>{{ $item2->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="" disabled>-- Pilih Status --</option>
                                                    <option value="0" {{ ($item->status == '0') ? 'selected' : ''
                                                        }}>Belum Bekerja / Kuliah</option>
                                                    <option value="1" {{ ($item->status == '1') ? 'selected' : ''
                                                        }}>Bekerja</option>
                                                    <option value="2" {{ ($item->status == '2') ? 'selected' : ''
                                                        }}>Kuliah</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Instansi</label>
                                                <div class="form-control">
                                                    <select name="instansi" class="form-control select-instansi">
                                                        <option value="" disabled {{ ($item->instansi == NULL) ?
                                                            'selected' : '' }}>-- Pilih Perusahaan --</option>
                                                        @foreach ($instansi as $item2)
                                                        <option value="{{ $item2->id }}" {{ ($item->instansi ==
                                                            $item->id) ? 'selected' : '' }}>{{ $item2->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jabatan / Jurusan</label>
                                                <input type="text" name="position" class="form-control" value="{{ $item->position }}">
                                            </div>
                                            <div class="row">
                                                <button class="btn btn-primary" name="submit" type="submit" onclick="edit({{ $item->id }})">Submit</button>
                                                <div class="loader" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Modal Edit --}}
                        @endforeach
                    </tbody>
                </table>
                {!! $data->links() !!}
            </div>
        </div>
    </div>
</div>
{{-- Modal Insert --}}
<!-- Modal -->
<div class="modal fade" id="insert" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Alumni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="alumni">
                    @csrf
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select name="kelas" class="form-control">
                            <option value="" selected disabled>-- Jurusan --</option>
                            @foreach ($kelas as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lulusan Tahun</label>
                        <select name="tahun" class="form-control">
                            <option value="" selected disabled>-- Pilih Lulusan --</option>
                            @foreach ($lulusan as $item)
                            <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="" selected disabled>-- Pilih Status --</option>
                            <option value="0">Belum Bekerja / Kuliah</option>
                            <option value="1">Bekerja</option>
                            <option value="2">Kuliah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Instansi</label>
                        <div class="form-control">
                            <select name="instansi" class="select-instansi form-control">
                                <option value="" disabled selected>-- Pilih Perusahaan --</option>
                                @foreach ($instansi as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jabatan / Jurusan</label>
                        <input type="text" name="position" class="form-control">
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                        <div class="loader" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Insert --}}
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-instansi').select2({
            theme: "bootstrap",
            width: 'auto',
            dropdownAutoWidth: true,
            allowClear: false,
            tags: true
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#alumni').submit(function(e) {
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.alumni') }}`,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $('.loader').show();
                },
                success: (data) => {
                    this.reset();
                    swal({
                        title: 'Berhasil',
                        text: 'Berhasil Menambahkan Data',
                        icon: 'success'
                    });
                    location.reload();
                },
                error: (err) => {
                    if (err.status == 422) {
                        swal({
                            title: 'Gagal',
                            text: 'Pastikan inputan anda benar',
                            icon: 'error'
                        });
                        $('.loader').hide();
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="err" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }
            });
        });
    });

    function edit(id) {
        $('#editForm' + id).submit(function(e) {
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.alumni.edit') }}`,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $('.loader').show();
                },
                success: (data) => {
                    this.reset();
                    swal({
                        title: 'Berhasil',
                        text: 'Berhasil Menambahkan Data',
                        icon: 'success'
                    });
                    location.reload();
                },
                error: (err) => {
                    if (err.status == 422) {
                        swal({
                            title: 'Gagal',
                            text: 'Pastikan inputan anda benar',
                            icon: 'error'
                        });
                        $('.loader').hide();
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="err" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }
            });
        });
    }

    function deleteRow(id) {
        swal({
            title: 'Yakin?',
            text: 'Apakah anda yakin ingin menghapus data ini?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#' + id).submit();
            }
        });
    }
</script>
@endpush