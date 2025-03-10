<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Kelulusan</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: serif;
            padding: 40px;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            flex: 1;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 70px;
            float: left;
        }
        .header h2, .header h3, .header p {
            margin: 5px 0;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        td {
            padding: 5px;
        }
        .footer {
            text-align: right;
            margin-top: 30px;
        }
        .footer p {
            margin: 5px 0;
        }
        .signature {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <div class="header">
                <img src="{{ public_path('assets/img/jabar.png') }}" alt="Logo Jawa Barat">
                <div style="float: left; width: calc(100% - 140px); text-align: center;">
                    <h2>Pemerintah Provinsi Jawa Barat</h2>
                    <h3>Dinas Pendidikan</h3>
                    <h3>SMA Negeri 1 Margaasih</h3>
                    <p>Jl. Contoh No. 123, Margaasih, Kab. Bandung, Jawa Barat</p>
                </div>
                <img src="{{ public_path('assets/img/logo.png') }}" alt="Logo Jawa Barat" style="float: right;">
                <div style="clear: both;"></div>
                <hr>
            </div>
            
            <div class="title">SURAT KELULUSAN</div>
            
            <p>Nomor: 421/XXX/SMAN1-MGA/2025</p>
            
            <p>Yang bertanda tangan di bawah ini, Kepala SMA Negeri 1 Margaasih, menerangkan bahwa:</p>
            
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: <strong>{{ $student->nama }}</strong></td>
                </tr>
                <tr>
                    <td>Nomor Induk Siswa</td>
                    <td>: {{ $student->nipd }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: {{ $student->nama_rombel }}</td>
                </tr>
            </table>
            
            <p>Telah memenuhi seluruh persyaratan akademik dan administratif serta dinyatakan <strong>LULUS</strong> dari SMA Negeri 1 Margaasih Tahun Pelajaran 2024/2025.</p>
            
            <p>Demikian surat kelulusan ini dibuat untuk digunakan sebagaimana mestinya.</p>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="footer">
            <p>Margaasih, {{ now()->format('d F Y') }}</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p class="signature">[Nama Kepala Sekolah]</p>
            <p>NIP. [Nomor Induk Pegawai]</p>
        </div>
    </div>
</body>
</html>
