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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Kategori</h3>
        </div>
        <!-- /.card-header -->

        <div class=" card-body">
            <table>
                <tr>
                    <th>Name</th>
                    <td>:</td>
                    <td>{{ $data[0]->name }}</td>
                </tr>
                 
            </table>
        </div>
        <!-- /.card-body -->

    </div>
</div>
@endsection
