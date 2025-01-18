@extends('layouts.template')
@section('judulh1','Admin - Laporan')

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
            <h3 class="card-title">Ubah Data Laporan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('laporan.update',$laporan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class=" card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="" value="{{ old('judul', $laporan->judul) }}">
                </div>  
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" value="{{ old('tanggal', $laporan->tanggal) }}">
                </div>  
                <div class="form-group">
                            <label>Kategori </label>
                            <select class="form-control" name="kategori_id">
                                @foreach($kategori as $dt)
                                <option value="{{ $dt->id }}" {{ $laporan->kategori_id == $dt->id ? 'selected' : '' }}>{{ $dt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                <div class="form-group">
                  <label for="File">File input</label>
                  <input type="file" id="File" name="file" value="{{ old('file', $laporan->file) }}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>

</div>

@endsection
