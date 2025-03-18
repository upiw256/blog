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
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            flex: 1;
            padding: 20px 60px; /* Padding XY: 20px for top/bottom, 40px for left/right */
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
            /* margin-top: 30px; */
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
                    <p>Jl. Terusan Taman Kopo Indah III No 2 Desa Mekarrahayu Kec. Margaasih Kab. Bandung</p>
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
                    <td style="padding: 2px;">Nama</td>
                    <td style="padding: 2px;">: <strong>{{ $student->nama }}</strong></td>
                </tr>
                <tr>
                    <td style="padding: 2px;">Nomor Induk Siswa</td>
                    <td style="padding: 2px;">: {{ $student->nipd }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px;">Tempat, Tanggal Lahir</td>
                    <td style="padding: 2px;">: {{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td style="padding: 2px;">Kelas</td>
                    <td style="padding: 2px;">: {{ $student->nama_rombel }}</td>
                </tr>
            </table>
            <p>Telah memenuhi seluruh persyaratan akademik dan administratif serta dinyatakan:</p>
            <p style="text-align: center; font-size: 20px; font-weight: bold;">LULUS</p>
            <p style="text-indent: 40px;">dari seluruh mata pelajaran di SMA Negeri 1 Margaasih Tahun Pelajaran 2024/2025.
            Surat kelulusan ini dibuat untuk dipergunakan sebagaimana mestinya, dengan rincian nilai sebagai berikut:</p>
        </div>
        <div>
            <table border="1" style="border-collapse: collapse; width: 70%; margin: 0 auto; text-align: left; font-size: 12px;">
            <thead>
            <tr>
            <th style="padding: 4px;">No</th>
            <th style="padding: 4px;">Mata Pelajaran</th>
            <th style="padding: 4px; text-align: center;">Nilai Rata-rata</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td style="padding: 4px;">1</td>
            <td style="padding: 4px;">PAI</td>
            <td style="padding: 4px; text-align: center;">85</td>
            </tr>
            <tr>
            <td style="padding: 4px;">2</td>
            <td style="padding: 4px;">Informatika</td>
            <td style="padding: 4px; text-align: center;">88</td>
            </tr>
            <tr>
            <td style="padding: 4px;">3</td>
            <td style="padding: 4px;">PJOK</td>
            <td style="padding: 4px; text-align: center;">90</td>
            </tr>
            <tr>
            <td style="padding: 4px;">4</td>
            <td style="padding: 4px;">Sejarah Indonesia</td>
            <td style="padding: 4px; text-align: center;">82</td>
            </tr>
            <tr>
            <td style="padding: 4px;">5</td>
            <td style="padding: 4px;">Bahasa Sunda</td>
            <td style="padding: 4px; text-align: center;">87</td>
            </tr>
            <tr>
            <td style="padding: 4px;">6</td>
            <td style="padding: 4px;">PKWU</td>
            <td style="padding: 4px; text-align: center;">84</td>
            </tr>
            <tr>
            <td style="padding: 4px;">7</td>
            <td style="padding: 4px;">Bahasa Indonesia</td>
            <td style="padding: 4px; text-align: center;">88</td>
            </tr>
            <tr>
            <td style="padding: 4px;">8</td>
            <td style="padding: 4px;">Pend. Kewarganegaraan</td>
            <td style="padding: 4px; text-align: center;">86</td>
            </tr>
            <tr>
            <td style="padding: 4px;">9</td>
            <td style="padding: 4px;">Seni Budaya</td>
            <td style="padding: 4px; text-align: center;">89</td>
            </tr>
            <tr>
            <td style="padding: 4px;">10</td>
            <td style="padding: 4px;">Kimia/Sosiologi</td>
            <td style="padding: 4px; text-align: center;">87</td>
            </tr>
            <tr>
            <td style="padding: 4px;">11</td>
            <td style="padding: 4px;">Biologi/Geografi</td>
            <td style="padding: 4px; text-align: center;">85</td>
            </tr>
            <tr>
            <td style="padding: 4px;">12</td>
            <td style="padding: 4px;">Matematika/Sejarah</td>
            <td style="padding: 4px; text-align: center;">88</td>
            </tr>
            <tr>
            <td style="padding: 4px;">13</td>
            <td style="padding: 4px;">Matematika Wajib</td>
            <td style="padding: 4px; text-align: center;">90</td>
            </tr>
            <tr>
            <td style="padding: 4px;">14</td>
            <td style="padding: 4px;">Bahasa Inggris</td>
            <td style="padding: 4px; text-align: center;">92</td>
            </tr>
            </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Margaasih, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Kepala Sekolah</p>
            <br><br><br><br>
            <p class="signature">[Nama Kepala Sekolah]</p>
            <p>NIP. [Nomor Induk Pegawai]</p>
        </div>
    </div>
</body>
</html>
