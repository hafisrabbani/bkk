@extends('admin.layout.extend')
@section('title')
    Halaman Postingan
@endsection

@section('page-name')
    Manajemen Postingan
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Buat Postingan</h6>
      </div>
      <div class="card-body">
        <form id="form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" name="judul" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Penulis</label>
                  <input type="text" name="penulis" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Status : </label>
                    <select name="status" class="form-control">
                      <option value="" disabled selected>-- Pilih Status --</option>
                      <option value="2">Tampil</option>
                      <option value="1">Tidak Tampil</option>
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Thumbnail : </label>
                  <div class="custom-file">
                    <input type="file" name="thumbnail" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label>Meta Deskripsi</label>
                    <textarea name="meta" class="form-control"></textarea>
                  </div>
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label>Deskripsi</label>
                  </div>
                  <div class="col">
                    <div class="text-right">
                      <small class="text-primary text-right"><i class="fas fa-info-circle"></i> Dapat diisi Tentang Keterangan / Persyaratan</strong></small>
                    </div>
                  </div>
                </div>
                <textarea name="body" class="myckeditor form-control" id="myckeditor"></textarea>
                <small class="text-primary text-right"><i class="fas fa-info-circle"></i> Tarik segitiga kanan bawah untuk menyesuaikan ukuran</strong></small>
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
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
  <script>
      $(document).ready(function(){
          CKEDITOR.replace('myckeditor', {
            filebrowserUploadUrl: "{{route('ckeditor', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form').submit(function(e){
          e.preventDefault();
          $('.err').hide();
          for ( instance in CKEDITOR.instances ) {
		        CKEDITOR.instances.myckeditor.updateElement();
	        }
          var formData = new FormData(this);

          $.ajax({
                type: 'POST',
                url: `{{ route('admin.post.create') }}`,
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
