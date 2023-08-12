@extends('admin.layout.extend')
@section('title')
Edit Halaman
@endsection

@section('page-name')
Edit Halaman
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Halaman <span class="badge badge-secondary px-4">{{
                    $data->route }}</span></h6>
        </div>
        <div class="card-body">
            <form id="form">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>URI</label>
                            <input type="text" class="form-control" value="{{ $data->route }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Header</label>
                            <input type="text" name="header" class="form-control" value="{{ $data->header }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" rows="5" class="form-control">{{ $data->content }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Content Extra</label>
                            <textarea name="content_extra" rows="5"
                                class="form-control">{{ $data->content_extra }}</textarea>
                            <small class="text-danger">Perhatikan Setiap Halaman Ada Atau Tidak Content Kedua</small>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Poster : </label>
                            <div class="custom-file">
                                <input type="file" name="poster" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-primary"><i class="fas fa-info-circle"></i> Jika tidak ingin mengubah
                                    gambar tidak perlu upluoad ulang</small>
                                <input type="hidden" name="oldPoster" value="{{ $data->image }}">
                            </div>
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
        $('#form').submit(function (e) {
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: `{{ route('admin.setting.page.post') }}`,
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
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="err" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }
            });
        });

    });
</script>
@endpush
