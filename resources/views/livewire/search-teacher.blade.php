<div>
    <div>
        <input type="text" wire:model.live="search" class="form-control" placeholder="Cari nama...">
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">nama</th>
                        <th scope="col">mapel</th>
                        <th scope="col">tempat lahir</th>
                        <th scope="col">tanggal lahir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->nama }}</td>
                        <td>{{ $teacher->bidang_studi_terakhir }}</td>
                        <td>{{ $teacher->tempat_lahir }}</td>
                        <td>{{ $teacher->tanggal_lahir }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $teachers->links() }}
    </div>
    
