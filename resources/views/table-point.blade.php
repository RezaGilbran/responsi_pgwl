@extends('layouts.tamplate')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">

        <div class="card shadow-sm mb-4" style="width: 100%; max-width: 95%;"> <!-- Maksimalkan lebar card dengan max-width -->

            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Table Point</h2>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle" id="pointstable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Coordinates</th>
                                <th>Image</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1; @endphp
                            @foreach ($points as $p)
                                @php
                                    $geometry = json_decode($p->geom);
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>{{ $geometry->coordinates[1] . ',' . $geometry->coordinates[0] }}</td>

                                    {{-- Menampilkan gambar --}}
                                    <td>
                                        @if($p->image)
                                            <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="150">
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

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <style>
        /* Menggunakan Flexbox untuk memposisikan tabel di tengah halaman */
        .container {
            display: flex;
            justify-content: center; /* Mengatur tabel agar berada di tengah secara horizontal */
            align-items: center;     /* Mengatur tabel agar berada di tengah secara vertikal */
            height: 100vh;           /* Menyesuaikan tinggi halaman agar tabel berada di tengah secara vertikal */
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Membatasi lebar tabel */
        .table {
            padding: 10px;
        }

        /* Gambar dengan ukuran yang lebih kecil */
        .table td img {
            width: 150px;
            height: auto;
        }

        /* Menambahkan padding pada tabel */
        .table td, .table th {
            padding: 12px;
        }

        /* Memberikan margin pada container tabel */
        .table-responsive {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#pointstable');
    </script>
@endsection
