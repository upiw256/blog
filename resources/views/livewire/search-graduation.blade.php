<div>
    <input type="text" wire:model="nisn" placeholder="Enter NISN" class="form-control mb-3">
    <button wire:click="search" class="btn btn-primary mb-3">Search</button>

    @if($results)
        @if($results->isEmpty())
            <p>Data yang anda cari tidak ada.</p>
        @else
            <div class="row">
                @foreach($results as $result)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-header {{ $result->information ? 'bg-primary' : 'bg-danger' }} text-white">
                                @if($result->information)
                                    Selamat {{ $result->student->nama }}, anda dinyatakan lulus
                                @else
                                    Maaf {{ $result->student->nama }}, anda tidak lulus
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $result->student->nama }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $result->student->nama_rombel }}</h6>
                                <p class="card-text">
                                    @if($result->information)
                                        Selamat {{ $result->student->nama }}, anda dinyatakan lulus
                                        <a href="{{ route('download-certificate', ['id' => $result->student->id]) }}" class="btn btn-success">Download Surat Kelulusan</a>
                                    @else
                                        Not Passed
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
