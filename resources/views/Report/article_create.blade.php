@extends('Template.template', ['title' => 'Buat Keluhan'])

@section('content-dinamis')
<link rel="stylesheet" href="{{ asset('assets/css/keluhan.css') }}">

<div class="container py-4">
    <h2 class="mb-4 text-center"><b><i>Form Pengaduan Keluhan</i></b></h2>
    <form action="{{ route('report.store') }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="province" class="form-label">Provinsi</label>
                <select name="province" id="province" class="form-select">
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="regency" class="form-label">Kota/Kabupaten</label>
                <select name="regency" id="regency" class="form-select" disabled>
                    <option value="">Pilih Kabupaten</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="subdistrict" class="form-label">Kecamatan</label>
                <select name="subdistrict" id="subdistrict" class="form-select" disabled>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="village" class="form-label">Desa</label>
                <select name="village" id="village" class="form-select" disabled>
                    <option value="">Pilih Desa</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipe Keluhan</label>
            <select name="type" id="type" class="form-select">
                <option value="" disabled selected hidden>Pilih Opsi Keluhan</option>
                <option value="kejahatan" {{ old('type') == 'kejahatan' ? 'selected' : '' }}>Kejahatan</option>
                <option value="pembangunan" {{ old('type') == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                <option value="sosial" {{ old('type') == 'sosial' ? 'selected' : '' }}>Sosial</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Tuliskan deskripsi keluhan Anda..."></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Unggah Foto</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" name="statement" id="statement" class="form-check-input">
            <label for="statement" class="form-check-label">
                Laporan yang disampaikan sesuai dengan kebenaran.
            </label>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Kirim Laporan</button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
   // Script AJAX tetap sama seperti sebelumnya
   $.ajax({
        method: "GET",
        url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
        dataType: "json",
        success: function(response) {
            response.forEach(function(province) {
                $('#province').append('<option value="' + province.id + '" data-name="' + province.name + '">' + province.name + '</option>');
            });
        },
        error: function() {
            alert("Gagal memuat data provinsi!");
        }
    });

    $('#province').on('change', function() {
        let provinceId = $(this).val();
        if (provinceId) {
            $('#regency').prop('disabled', false).html('<option>Loading...</option>');
            $.ajax({
                method: "GET",
                url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`,
                success: function(response) {
                    $('#regency').html('<option value="">Pilih Kabupaten</option>');
                    response.forEach(function(regency) {
                        $('#regency').append('<option value="' + regency.id + '">' + regency.name + '</option>');
                    });
                },
                error: function() {
                    alert("Gagal memuat data kabupaten!");
                }
            });
        }
    });

    $('#regency').on('change', function() {
        let regencyId = $(this).val();
        if (regencyId) {
            $('#subdistrict').prop('disabled', false).html('<option>Loading...</option>');
            $.ajax({
                method: "GET",
                url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`,
                success: function(response) {
                    $('#subdistrict').html('<option value="">Pilih Kecamatan</option>');
                    response.forEach(function(subdistrict) {
                        $('#subdistrict').append('<option value="' + subdistrict.id + '">' + subdistrict.name + '</option>');
                    });
                }
            });
        }
    });

    $('#subdistrict').on('change', function() {
        let subdistrictId = $(this).val();
        if (subdistrictId) {
            $('#village').prop('disabled', false).html('<option>Loading...</option>');
            $.ajax({
                method: "GET",
                url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${subdistrictId}.json`,
                success: function(response) {
                    $('#village').html('<option value="">Pilih Desa</option>');
                    response.forEach(function(village) {
                        $('#village').append('<option value="' + village.id + '">' + village.name + '</option>');
                    });
                }
            });
        }
    });
</script>
@endpush
