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
        <h6 class="m-0 font-weight-bold text-primary">Manajemen Postingan</h6>
      </div>
      <div class="card-body">
        <div class="text-left mx-3">
            <a href="{{ route('admin.post.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive p-3">
          <table class="text-center table align-items-center table-flush" id="mytbl">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($data as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{!! ($item->thumbnail == NULL) ? '<h3><i class="fas fa-image"></i></h3><br><small>Gambar Tidak Tersedia</small>' : '<img src="'.asset('storage/blog/thumbnail/'.$item->thumbnail).'" style="height: 75px;width:75px;">' !!}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{!! ($item->status == 1) ? '<span class="text-danger">Tidak Tampil</span>' : '<span class="text-success">Tampil</span>' !!}</td>
                    <td>
                      {{-- Delete --}}
                      <form action="{{ route('admin.post.delete') }}" method="POST" id="{{ $item->id }}">@csrf <input type="hidden" name="id" value="{{ $item->id }}"></form><button class="btn btn-danger" onclick="deleteRow({{ $item->id }})"><i class="fas fa-trash"></i></button>
                      {{-- End Delete --}}

                      {{-- Edit --}}
                        <a href="{{ route('admin.post.edit',$item->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                      {{-- End Edit --}}
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('#mytbl').DataTable();
    });

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