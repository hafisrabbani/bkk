@extends('admin.layout.extend')
@section('title')
    Halaman Perusahaan
@endsection

@section('page-name')
    Halaman Tahun Kelulusan
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Manajemen Tahun Kelulusan</h6>
      </div>
      <div class="card-body">
        <div class="text-left mx-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert">
              <i class="fas fa-plus"></i> Tambah Data
          </button>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center text-center table-flush" id="mytbl">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['tahun'] }}</td>
                    <td>
                        {{-- Delete --}}
                          <form action="{{ route('admin.tahun.delete') }}" method="POST" id="{{ $item['id'] }}">@csrf <input type="hidden" name="id" value="{{ $item['id'] }}"></form><button class="btn btn-danger" onclick="deleteRow({{ $item['id'] }})"><i class="fas fa-trash"></i></button>
                        {{-- End Delete --}}

                        {{-- Edit --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $item['id'] }}">
                          <i class="fas fa-pen"></i>
                        </button>
                        {{-- End Edit --}}
                    </td>
                  </tr>


                  {{-- Modal Edit --}}
                    <div class="modal fade" id="edit{{ $item['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Perusahaan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                                  <div class="modal-body">
                                      <form id="editForm{{ $item['id'] }}">
                                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                                          @csrf
                                          <div class="form-group">
                                            <label>Tahun Kelulusan</label>
                                            <div class="row">
                                                <div class="col"><input type="text" name="tahun1" class="form-control" value="{{ $item['tahun1'] }}"></div>
                                                <h1>/</h1>
                                                <div class="col"><input type="text" name="tahun2" class="form-control" value="{{ $item['tahun2'] }}"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <button class="btn btn-primary" name="submit" type="submit" onclick="edit({{ $item['id'] }})">Submit</button><div class="loader" style="display: none"><img src="{{ asset('assets/load2.gif') }}" style="width: 30px; height:30px;"><small>Loading...</small></div>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Tahun Kelulusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <form id="tahun">
                            @csrf
                            <div class="form-group">
                                <label>Tahun Kelulusan</label>
                                <div class="row">
                                    <div class="col"><input type="number" name="tahun1" class="form-control"></div>
                                    <h1>/</h1>
                                    <div class="col"><input type="number" name="tahun2" class="form-control"></div>
                                </div>
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
        $('#tahun').submit(function(e){
            e.preventDefault();
            $('.err').hide();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: `{{ route('admin.tahun') }}`,
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
                  if(err.status === 502){
                    swal({
                      title: 'Gagal',
                      text: 'Data Sudah Ada',
                      icon: 'error'
                    });
                    $('.loader').hide();
                    this.reset();
                  }
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
                url: `{{ route('admin.tahun.edit') }}`,
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
                  if(err.status === 502){
                    swal({
                      title: 'Gagal',
                      text: 'Data Sudah Ada',
                      icon: 'error'
                    });
                    $('.loader').hide();
                    this.reset();
                  }
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