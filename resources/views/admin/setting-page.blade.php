@extends('admin.layout.extend')
@section('title')
    Pengaturan Halaman
@endsection

@section('page-name')
    Pengaturan Halaman
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan Halaman</h6>
      </div>
      <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Halaman</th>
                <th scope="col">Uri</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->header }}</td>
                        <td><span class="badge badge-secondary px-4">{{ $item->route }}</span></td>
                        <td><a href="{{ route('admin.setting.page.edit',$item->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endpush
