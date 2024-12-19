@extends('Template.template', ['title' => 'comment'])

@section('content-dinamis')
    <div class="container">

        {{-- Gambar dan Deskripsi --}}
        <div class="mb-3">
            <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid mb-3" alt="Report Image">
            <h4>{{ $report->description }}</h4>
        </div>

        {{-- Waktu dan Tempat --}}
        <div class="mb-3">
            <small><strong>{{ $report->created_at->format('d M Y H:i') }}</strong></small> |
            <small>
                {{ optional(json_decode($report->province))->name ?? 'N/A' }},
            </small>
            <small>
                {{ optional(json_decode($report->regency))->name ?? 'N/A' }},
            </small>
            <small>
                {{ optional(json_decode($report->subdistrict))->name ?? 'N/A' }},
            </small>
            <small>
                {{ optional(json_decode($report->village))->name ?? 'N/A' }}
            </small>
            
        </div>

        {{-- Jenis Laporan --}}
        <div class="mb-3">
            <button class="btn btn-sm btn-primary">{{ $report->type }}</button>
        </div>

        {{-- Voting dan Views --}}
        <div class="d-flex align-items-center mb-4">
            {{-- Voting Button --}}
            <button class="btn voting-btn me-3" data-id="{{ $report->id }}" 
                data-voted="{{ auth()->id() == $report->voting ? 'true' : 'false' }}">
                <i class="bi bi-heart-fill {{ $report->voting && auth()->id() ? 'text-danger' : '' }}"></i>
                <small id="vote-count" class="text-muted">{{ $report->voting }} votes</small>
            </button>

            {{-- Views --}}
            <button class="btn btn-light">
                <i class="bi bi-eye"></i>
                <small class="text-muted">{{ $report->viewers }} views</small>
            </button>
        </div>

        {{-- Komentar Section --}}
        <div class="mt-4">
            <h5>Komentar</h5>
            @if ($comments->isEmpty())
                <p class="text-muted">Tidak ada komentar.</p>
            @else
                <ul class="list-unstyled">
                    @foreach ($comments as $comment)
                        <li class="mb-3">
                            <strong>{{ $comment->user->email }}</strong> <br> {{-- Mengambil email dari relasi user --}}
                            <span>{{ $comment->comment }}</span>
                            <p class="text-muted mb-0"><small>Dibuat {{ $comment->created_at->diffForHumans() }}</small></p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Form Tambah Komentar --}}
        <div class="mt-4">
            <form action="{{ route('comment.store', $report->id) }}" method="POST" class="form">
                @csrf
                <label for="comment" class="form-label">Tambah Komentar:</label>
                <textarea class="form-control" name="comment" id="comment" cols="30" rows="4" placeholder="Tulis komentar Anda..."></textarea>
                <button type="submit" class="btn btn-success mt-3">Kirim</button>
            </form>
        </div>
    </div>
@endsection
