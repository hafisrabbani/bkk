@extends('admin.layout.extend')
@section('title')
    Halaman Perusahaan
@endsection

@section('page-name')
    Halaman Perusahaan
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Manajemen Perusahaan</h6>
      </div>
      <div class="card-body">
        <div class="text-left mx-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert">
              <i class="fas fa-plus"></i> Tambah Data
          </button>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="mytbl">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! ($item->logo == NULL) ? '<h3><i class="fas fa-image"></i></h3><br><small>Gambar Tidak Tersedia</small>' : '<img src="'.asset('storage/company/logo/'.$item->logo).'" style="height: 75px;width:75px;">' !!}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ ($item->type == 0) ? 'Perusahaan' : 'Universitas' }}</td>
                    <td>
                        {{-- Delete --}}
                          <form action="{{ route('admin.patner.del') }}" method="POST" id="{{ $item->id }}">@csrf <input type="hidden" name="id" value="{{ $item->id }}"></form><button class="btn btn-danger" onclick="deleteRow({{ $item->id }})"><i class="fas fa-trash"></i></button>
                        {{-- End Delete --}}

                        {{-- Edit --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $item->id }}">
                          <i class="fas fa-pen"></i>
                        </button>
                        {{-- End Edit --}}
                    </td>
                  </tr>


                  {{-- Modal Edit --}}
                    <div class="modal fade" id="edit{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Patner</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                                  <div class="modal-body">
                                      <form enctype="multipart/form-data" method="POST" id="editForm{{ $item->id }}">
                                          @csrf
                                          <input type="hidden" name="oldLogo" value="{{ $item->logo }}">
                                          <input type="hidden" name="id" value="{{ $item->id }}">
                                          <div class="form-group">
                                              <label for="kaategori">Nama Perusahaan</label>
                                              <input type="text" class="form-control" name="company" value="{{ $item->name }}">
                                          </div>
                                          <div class="form-group">
                                              <label for="kaategori">Jenis</label>
                                              <select name="type" class="form-control">
                                                <option value="0" {{ ($item->type == 0) ? 'selected' : '' }}>Perusahaan</option>
                                                <option value="1" {{ ($item->type == 1) ? 'selected' : '' }}>Universitas / Politeknik</option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                              <label for="kaategori">Alamat</label>
                                              <input type="text" class="form-control" name="alamat" value="{{ $item->address }}">
                                          </div>
                                          <div class="form-group">
                                              <label for="kaategori">Logo</label>
                                              <input type="file" class="form-control" name="logo">
                                              <small class="text-warning">Jika tidak ingin mengubah logo. tidak perlu upload logo</small>
                                          </div>
                                          <div class="row">
                                            <button class="btn btn-primary" name="submit" type="submit" onclick="edit({{ $item->id }})">Submit</button><div class="loader" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small></div>
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
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Insert --}}
  <!-- Modal -->
    <div class="modal fade" id="insert" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Patner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="POST" id="company">
                            @csrf
                            <div class="form-group">
                                <label for="kaategori">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="company">
                            </div>
                            <div class="form-group">
                              <label for="kaategori">Jenis</label>
                              <select name="type" class="form-control">
                                <option value="" selected disabled>-- Pilih Jenis --</option>
                                <option value="0">Perusahaan</option>
                                <option value="1">Universitas / Politeknik</option>
                              </select>
                          </div>
                            <div class="form-group">
                                <label for="kaategori">Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="kaategori">Logo</label>
                                <input type="file" class="form-control" name="logo">
                            </div>
                            <div class="row">
                              <button class="btn btn-primary" name="submit" type="submit">Submit</button><div class="loader" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small></div>
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
  <script>
    $(document).ready(function () {
      $('#mytbl').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#company').submit(function(e){
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.patner') }}`,
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

    function edit(id)
    {
      $('#editForm'+id).submit(function(e){
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.patner.edit') }}`,
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
    }

    function deleteRow(id)
    {
      swal({
        title: 'Yakin?',
        text: 'Apakah anda yakin ingin menghapus data ini?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      }).then((willDelete)=>{
        if(willDelete){
          $('#'+id).submit();
        }
      });
    }
  </script>
@endpush