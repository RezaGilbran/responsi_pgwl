@extends('layouts.tamplate')

@section('content')
    <div class="container d-flex justify-content-center" style="height: 50vh; padding-left: 20px; padding-right: 20px;"> <!-- Set height untuk menempatkan tabel di atas tengah -->

        <div class="card shadow-sm mb-4" style="width: 100%; max-width: 95%;"> <!-- Maksimalkan lebar card dengan max-width -->

            <div class="card-header bg-danger text-white">
                <h2 class="h5 mb-0">Data Polylines</h2>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="example">
                        <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($polylines as $p)
                            @php
                                $geometry = json_decode($p->geom);
                            @endphp

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>

                                {{-- Menampilkan gambar --}}
                                <td>
                                    @if($p->image)
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="200">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>

                                <td>{{ date_format($p->created_at, 'D, d M Y, H:i:s') }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('script')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
