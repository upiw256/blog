<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Nama</title>
    <style>
        @page {
            size: 90mm 55mm landscape;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f5f5f5;
        }

        .business-card {
            width: 90mm;
            height: 55mm;
            background: white;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .left-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 25%;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .middle-section {
            display: flex;
            flex-direction: column;
            width: 60%;
            text-align: left;
        }

        .name {
            font-size: 1.2em;
            font-weight: bold;
            color: black;
        }

        .title {
            font-size: 0.9em;
            color: #555;
        }

        .contact {
            font-size: 0.8em;
            color: #333;
        }

        .right-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 15%;
        }

        .qrcode {
            width: 45px;
            height: 45px;
        }

        @media print {
            body {
                background: none;
            }
            .business-card {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="business-card">
        <div class="left-section">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo">
        </div>
        <div class="middle-section">
            <div class="name">{{ $record->nama }}</div>
            <div class="title">{{ $record->position }}</div>
            <div class="contact">{{ $record->alamat_jalan }}</div>
            <div class="contact">{{ $record->telepon }}</div>
            <div class="contact">{{ $record->email }}</div>
        </div>
        <div class="right-section">
            <img src="{{ $qrCode }}" alt="QR Code" class="qrcode">
        </div>
    </div>
</body>
</html>
