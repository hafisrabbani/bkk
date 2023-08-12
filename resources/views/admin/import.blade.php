@extends('admin.layout.extend')
@section('title')
Upload Data Alumni
@endsection

@section('page-name')
Upload Data Alumni
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Upload Data Alumni <span
                    class="badge badge-secondary px-4"></span>
            </h6>
            <a href="{{ route('format.download') }}" class="text-warning">Download Format</a>
        </div>
        <div class="card-body">
            @if(session()->has('failures'))
            @foreach(session()->get('failures') as $failure)
            <div class="alert alert-danger">
                {{ $failure }}
            </div>
            @endforeach
            @endif
            <div class="alert alert-danger" role="alert" id="errorsImport" style="display: none;">

            </div>
            <form id="form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Data : </label>
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-primary"><i class="fas fa-info-circle"></i> Upload File sesuai
                                    format</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pilih Angkatan</label>
                            <select name="angkatan" class="form-control">
                                <option value="" selected disabled>Pilih Angkatan</option>
                                @foreach ($angkatan as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" style="width: 100%">submit</button>
                <div class="loader text-center mt-3" style="display: none"><img src="{{ asset('assets/load2.gif') }}"
                        style="width: 30px; height:30px;"><small>Loading...</small></div>
            </form>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="text-center">
                Panduan Pengisian

            </h5>
            <div class="mt-3">
                <small>

                    <ul>
                        <li>Download format yang telah disediakan</li>
                        <li>Isi Sesuai Kolom yang tersedia</li>
                        <li>Jangan ubah format file yang telah didownload agar tidak terjadi eror</li>
                        <li>Upload file yang telah diisi</li>
                        <li>Pilih tahun angkatan</li>
                        <li>Klik Tombol submit</li>
                    </ul>

                    Tips :
                    <ul>
                        <li>Pada kolom status isi dengan
                            <br> 0 : Belum Bekerja / Kuliah
                            <br> 1 : Bekerja
                            <br> 2 : Kuliah
                        </li>
                    </ul>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('#errorsImport').hide();
        $('#form').submit(function (e) {
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.import.post') }}`,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $('.loader').show();
                    $('#errorsImport').hide();
                },
                success: (data) => {
                    this.reset();
                    swal({
                        title: 'Berhasil',
                        text: 'Berhasil Import Data',
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
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="err" style="color: red;">' + error[0] + '</span>'));
                        });
                    } else if (err.status == 500) {
                        swal({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan pada server',
                            icon: 'error'
                        });
                        $('.loader').hide();
                        $('#errorsImport').show();
                        var data = JSON.parse(err.responseText);
                        $.each(data, function (i, error) {
                            $('#errorsImport').append($(
                                '<div>Baris : ' + error['row'] + ' ' + error['errors'][0] + '</div>',
                            ));
                        });
                    }
                }
            });
        });

    });
</script>
@endpush
