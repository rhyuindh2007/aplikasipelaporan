@extends('layouts.template')
@section('tambahanCSS')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@endsection

@section('judulh1','Admin - Laporan')

@section('konten')


<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h2 class="card-title">Data Laporan</h2>
            <a type="button" class="btn btn-success float-right" href="{{ route('laporan.create') }}">
                <i class=" fas fa-plus"></i> Tambah Laporan
            </a>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->judul }}</td>
                        <td>{{ $dt->tanggal }}</td>
                        <td>{{ $dt->kategori->name }}</td>
                        <td>{{ $dt->file }}</td>
                        <td>
                           
                        
                            
                            @if($dt->pdf)
                            <!-- Link untuk melihat file -->
                            <a href="{{ route('laporan.view', ['filename' => basename($dt->pdf)]) }}" target="_blank" class="btn-info">
                                <i class="fas fa eye"></i>
                            </a>

                            <!-- Link untuk mengunduh file -->
                            <a href="{{ route('laporan.download', ['filename' => basename($dt->pdf)]) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa download"></i>
                            </a>
                            @else
                            <div class="btn-group">
                                <form action="{{ route('laporan.destroy',$dt->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class=" fas fa-trash "> </i>
                                    </button>

                                </form>
                                <a type="button" class="btn btn-warning" href="{{ route('laporan.edit',$dt->id) }}">
                                    <i class=" fas fa-edit "> </i>
                                </a>
                                <a type="button" class="btn btn-success" href="{{ route('laporan.show',$dt->id) }}">
                                    <i class=" fas fa-eye "> </i>
                                </a>
                            </div>
                            @if($dt->file)
                            <!-- Link untuk melihat file -->
                            <a href="{{ route('laporan.view', ['filename' => basename($dt->file)]) }}" target="_blank" class="btn btn-info">
                                <i class="fas fa-file-pdf"></i> 
                            </a>

                            <!-- Link untuk mengunduh file -->
                            <a href="{{ route('laporan.download', ['filename' => basename($dt->file)]) }}" class="btn btn-primary">
                                <i class="fas fa-download"></i> 
                            </a>
                            @else
                            <span class="text-danger">File tidak tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @endif
                    </td>
                    <td>


                        </tr>

                        @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
@endsection

@section('tambahanJS')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection

@section('tambahScript')
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "responsive": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    @if($message = Session::get('success'))
    toastr.success("{{ $message}}");
    @elseif($message = Session::get('updated'))
    toastr.warning("{{ $message}}");
    @elseif($message = Session::get('deleted'))
    toastr.error("{{ $message}}");
    @endif
</script>
@endsection