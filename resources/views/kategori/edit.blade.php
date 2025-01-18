@extends('layouts.template')
@section('judulh1','Admin - Kategori')

@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Kategori</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('kategori.update',$kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class=" card-body">
            <div class="form-group">
                    <label for="judul">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ old('tanggal', $kategori->name) }}">
                </div> 
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>

</div>

@endsection
