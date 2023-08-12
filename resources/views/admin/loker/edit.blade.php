@extends('admin.layout.extend')
@section('title')
    Halaman Loker
@endsection

@section('page-name')
    Manajemen Loker
@endsection

@section('content')
<div class="col-lg-12">
<div class="alert alert-primary alert-dismissible fade show" role="alert">
      <strong>Tips Pengisian Link Pendaftaran!</strong>
      <p>
        <ul>
          <li>Gunakan awalan https://wa.me/62xxxxx untuk mendaftar lewat wa | ex : ( https://wa.me/62111111111 )</li>
          <li>Gunakan awalan mailto: untuk mendaftar lewat email | ex : ( mailto:hrd@company.com )</li>
          <li>Jika menggunakan Google Form Cukup Pastekan Saja!</li>
        </ul>
      </p>
      <hr>
      <p class="mb-0"><small>HafisRabbani</small></p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Buat Loker</h6>
      </div>
      <div class="card-body">
        <form id="form">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" name="judul" value="{{ $data->judul }}" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Link Pendaftaran</label>
                  <input type="text" name="url" class="form-control" value="{{ $data->url }}">
                  <small class="text-primary"><i class="fas fa-info-circle"></i> Dapat Berupa <strong>Google Form</strong></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Perusahaan</label>
                  <div class="form-control">
                    <select name="company" class="form-control" id="patner">
                      <option value="" disabled>-- Pilih Perusahaan --</option>
                      @foreach ($patner as $item)
                          <option value="{{ $item->id }}" {{ ($item->id == $data->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Poster : </label>
                  <div class="custom-file">
                    <input type="file" name="poster" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <small class="text-primary"><i class="fas fa-info-circle"></i> Jika tidak ingin mengubah poster tidak pelu upload ulang</small>
                    <input type="hidden" name="oldPoster" value="{{ $data->poster }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status : </label>
                  <select name="status" class="form-control">
                    <option value="1" {{ ($data->status == 1) ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ ($data->status == 0) ? 'selected' : '' }}>Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Posisi Pekerjaan : </label>
                  <input type="text" name="position" class="form-control" value="{{ $data->position }}">
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
                <textarea name="description" class="form-control" id="myckeditor">{{ $data->description }}</textarea>
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
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  <script>
      $(document).ready(function(){
        CKEDITOR.replace('myckeditor');
        $('#patner').select2({});

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
                url: `{{ route('admin.loker.edit.post') }}`,
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
