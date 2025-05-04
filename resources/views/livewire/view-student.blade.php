<div>
    {{ $this->infolist($record) }}

    @php
        $data = $record ?? [];
    @endphp

    <div style="border: 1px solid #000; padding: 20px; width: 500px; height: 200px; text-align: center; display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
        <div style="flex: 1; text-align: left;">
            <h2 style="margin: 0; font-size: 20px; font-weight: bold;">{{ strtoupper($data->nama ?? 'NAMA TIDAK TERSEDIA') }}</h2>
            <p>Jenis Kelamin: {{ $data->jenis_kelamin ?? '-' }}</p>
            <p>Tempat Lahir: {{ $data->tempat_lahir ?? '-' }}</p>
            <p>Tanggal Lahir: {{ $data->tanggal_lahir ?? '-' }}</p>
        </div>
        <div style="flex: 0 0 100px;">
            @if (!empty($data->peserta_didik_id))
                {!! QrCode::size(100)->generate($data->peserta_didik_id) !!}
            @else
                <p style="font-size: 12px; color: red;">QR Code Tidak Tersedia</p>
            @endif
        </div>
    </div>
</div>