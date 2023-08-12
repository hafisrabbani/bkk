@extends('admin.layout.extend')
@section('title')
    Pengaturan
@endsection

@section('page-name')
    Pengaturan
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
      </div>
      <div class="card-body">
        <form id="form">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $data->username }}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <small class="text-primary">Jika tidak ingin mengubah password tidak perlu diisi</small>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="form-control">
                <br>
                <small class="text-primary">Jika tidak ingin mengubah password tidak perlu diisi</small>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" style="width: 100%">submit</button>
            <div class="loader text-center mt-3" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small></div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  <script>
      $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form').submit(function(e){
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.setting') }}`,
                data: formData,
                cache:false,
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
                          var el = $(document).find('[name="'+i+'"]');
                          el.after($('<span class="err" style="color: red;">'+error[0]+'</span>'));
                      });
                  }
                }
            });
        });
    });
  </script>
@endpush
