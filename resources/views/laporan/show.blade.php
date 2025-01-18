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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Laporan</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Judul</th>
                    <td>:</td>
                    <td>{{ $data[0]->judul }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $data[0]->tanggal }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>:</td>
                    <td>{{ $data[0]->kategori->name }}</td>
                </tr>
                <tr>
                    <th>File</th>
                    <td>:</td>
                    <td>
                        @if ($data[0]->file)
                        <!-- Link untuk melihat file -->
                        <a href="{{ asset('storage/' . $data[0]->file) }}" target="_blank" class="btn btn-info">
                            <i class="fas fa-eye"></i> Lihat PDF
                        </a>
                        @else
                        <span class="text-danger">File tidak tersedia</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection
