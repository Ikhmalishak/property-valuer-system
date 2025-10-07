<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 650px;
            margin: auto;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .header {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px 0;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .link-button {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px 0;
            background-color: #10b981;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .signature {
            margin-top: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>{{ $emailTitle }}</h2>
        </div>
        <div class="content">
            <p><strong>Kepada Pelanggan Yang Dihormati,</strong></p>
            <p>Dengan segala hormatnya, perkara di atas adalah dirujuk.</p>
            
            @if ($reminderType === 'first')
                <p>Bersama-sama ini kami lampirkan invois bagi bayaran berjumlah <strong>{{ $amount }}</strong> sebagai <strong>peringatan pertama</strong>.</p>
            @elseif ($reminderType === 'second')
                <p>Bersama-sama ini kami lampirkan invois bagi bayaran berjumlah <strong>{{ $amount }}</strong> sebagai <strong>peringatan kedua</strong>.</p>
            @else
                <p>Bersama-sama ini kami lampirkan invois bagi bayaran berjumlah <strong>{{ $amount }}</strong>.</p>
            @endif

            <p>Sila jelaskan pembayaran bil invois ini dengan segera bagi mengelakkan sebarang kelewatan dalam proses seterusnya.</p>

            <div class="signature">
                "MALAYSIA MADANI"<br>
                "BERKHIDMAT UNTUK NEGARA"<br><br>
                <strong>Unit Kewangan<br>
                Jabatan Penilaian dan Perkhidmatan Harta Teluk Intan</strong>
            </div>

            <!-- Button to view invoice -->
            <a href="{{ $url }}" class="button" target="_blank">Lihat Invois</a>

            <!-- New: Button to visit website in new tab -->
            <a href="https://enotisjpph.xyz/" class="link-button" target="_blank">Pergi ke Portal e-Notis JPPH</a>
        </div>

        <div class="footer">
            E-mel ini dijana secara automatik. Sila jangan balas e-mel ini.
        </div>
    </div>
</body>
</html>