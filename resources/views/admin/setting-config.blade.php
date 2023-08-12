@extends('admin.layout.extend')
@section('title')
Edit Config Website
@endsection

@section('page-name')
Edit Config Website
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Config Website <span
                    class="badge badge-secondary px-4"></span>
            </h6>
        </div>
        <div class="card-body">
            <form id="form">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Website</label>
                            <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Logo : </label>
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-primary"><i class="fas fa-info-circle"></i> Jika tidak ingin mengubah
                                    gambar tidak perlu upluoad ulang</small>
                                <input type="hidden" name="oldLogo" value="{{ $data->logo }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Favicon : </label>
                            <div class="custom-file">
                                <input type="file" name="favicon" class="custom-file-input">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-primary"><i class="fas fa-info-circle"></i> Jika tidak ingin mengubah
                                    gambar tidak perlu upluoad ulang</small>
                                <input type="hidden" name="oldFavicon" value="{{ $data->favicon }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>description</label>
                            <textarea name="description" rows="8"
                                class="form-control">{{ $data->description }}</textarea>
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
                url: `{{ route('admin.baseconfig') }}`,
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
                        text: 'Berhasil Mengubah Data',
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
