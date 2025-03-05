@props([
    'record' => null,
    'state' => null
])

@php
    $qrCodeValue = $record->peserta_didik_id ?? '';
@endphp

@if (!empty($qrCodeValue))
    {!! QrCode::size(100)->generate((string)$qrCodeValue) !!}
@else
    <p style="font-size: 12px; color: red;">QR Code Tidak Tersedia</p>
@endif