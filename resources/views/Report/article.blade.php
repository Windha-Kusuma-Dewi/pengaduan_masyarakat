@extends('Template.template', ['title' => 'article'])

@section('content-dinamis')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <form action="{{ route('report.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label class="input-group-text" for="search">Pilih Provinsi</label>
                        <select name="search" id="search" class="form-select">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                </form>
            </div>

            <div id="reports-list" class="col-lg-8">
                @foreach ($reports as $report)
                    <div class="card mb-3 shadow-sm">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid rounded-start" alt="Report Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('report.show', $report->id) }}" class="text-decoration-none text-dark">{{ $report->description }}</a>
                                    </h5>
                                    <p class="card-text text-muted small">{{ $report->created_at->diffForHumans() }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-eye"></i> {{ $report->viewers ?? 0 }} views
                                            <button class="btn btn-sm voting-btn" data-id="{{ $report->id }}" data-voted="{{ $report->voting ? 'true' : 'false' }}">
                                                <i class="bi bi-heart-fill {{ $report->voting ? 'text-danger' : '' }}"></i>
                                                <small class="text-muted">{{ $report->voting ?? 0 }} votes</small>
                                            </button>
                                        </div>
                                        <span class="badge bg-primary">{{ $report->type ?? 'General' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="card-header bg-warning text-dark text-center rounded">
                        <h5><i class="bi bi-info-circle"></i> Informasi Pengaduan</h5>
                    </div>
                    <div class="card-body">
                        <ol class="ps-3">
                            <li>Pengaduan hanya dapat dibuat jika Anda memiliki akun.</li>
                            <li>Data pengaduan harus BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                            <li>Seluruh bagian data wajib diisi.</li>
                            <li>Pengaduan akan ditanggapi dalam 2x24 Jam.</li>
                            <li>Periksa tanggapan pada Dashboard setelah Anda <strong>Login</strong>.</li>
                            <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: 
                                <a href="{{ route('report.create') }}" class="text-decoration-none">Ikuti Tautan</a>.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                method: "GET",
                url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                dataType: "json",
                success: function(response) {
                    response.forEach(function(province) {
                        $('#search').append(`<option value="${province.id}">${province.name}</option>`);
                    });
                },
                error: function() {
                    alert("Gagal memuat data provinsi. Coba lagi nanti!");
                }
            });

            $('#search').on('change', function() {
                let provinceId = $(this).val();
                if (!provinceId) return;

                $('#reports-list').empty();

                $.ajax({
                    url: "{{ route('report.search') }}",
                    type: "GET",
                    data: { search: provinceId },
                    success: function(reports) {
                        reports.forEach(function(report) {
                            $('#reports-list').append(`
                                <div class="card mb-3 shadow-sm">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage') }}/${report.image}" class="img-fluid rounded-start" alt="Report Image">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="/report/show/${report.id}" class="text-decoration-none text-dark">${report.description.substring(0, 40)}...</a>
                                                </h5>
                                                <p class="text-muted small">${report.description.substring(0, 150)}...</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="bi bi-eye"></i> ${report.viewers ?? 0} views
                                                        <button class="btn btn-sm voting-btn" data-id="${report.id}" data-voted="${report.voting ? 'true' : 'false'}">
                                                            <i class="bi bi-heart-fill ${report.voting ? 'text-danger' : ''}"></i>
                                                            <small>${report.voting?.length ?? 0} votes</small>
                                                        </button>
                                                    </div>
                                                    <span class="badge bg-primary">${report.type || 'General'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    },
                    error: function() {
                        alert("Gagal memuat laporan. Coba lagi nanti!");
                    }
                });
            });
        });
    </script>
@endpush
