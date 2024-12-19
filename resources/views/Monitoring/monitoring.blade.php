@extends('Template.template', ['title' => 'monitoring'])

@section('content-dinamis')
<link rel="stylesheet" href="{{ asset('assets/css/monitoring.css') }}">
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pengaduan 17 Desember 2024</h5>
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#pengaduan-1" aria-expanded="false" aria-controls="pengaduan-1">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
            <div id="pengaduan-1" class="collapse">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Tipe :</strong> PEMBANGUNAN</li>
                        <li><strong>Lokasi :</strong> CISARUA, CISARUA, KABUPATEN BOGOR, JAWA BARAT</li>
                        <li>
                            <strong>Deskripsi :</strong> Jimmy menuturkan ruas Jalan Sedayu tergolong krusial. Ini karena menghubungkan wilayah Sleman dengan Bantul. Tepatnya yang melaju dari arah Jalan Bibis dan Jalan Godean Sleman menuju Jalan Wates Bantul. Terkait ruas jalan, Jimmy menuturkan perbaikan menyasar aspal sepanjang 290 meter. Kerusakan aspal terlebih dahulu ditambal, sebelum akhirnya dilapisi lapisan aspal baru.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card lainnya -->
        <div class="card">
            <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pengaduan 18 Desember 2024</h5>
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#pengaduan-2" aria-expanded="false" aria-controls="pengaduan-2">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
            <div id="pengaduan-2" class="collapse">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Tipe :</strong> PEMBANGUNAN</li>
                        <li><strong>Lokasi :</strong> Detail lokasi lainnya di sini</li>
                        <li>
                            <strong>Deskripsi :</strong> Masukkan deskripsi terkait pengaduan berikutnya di sini.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection