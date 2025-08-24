<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Peringatan Invois</title>
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
            margin: 20px 0;
            background-color: #3490dc;
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
            <h2>Peringatan Invois</h2>
        </div>

        <div class="content">
            <p><strong>Tuan/Puan,</strong></p>

            <p>Dengan segala hormatnya perkara di atas adalah dirujuk.</p>

            <p>Bersama-sama ini dilampirkan invois bagi bayaran fi ikhtisas berjumlah <strong>{{ $amount }}</strong>.</p>

            <p>Bayaran hendaklah dijelaskan dalam tempoh 14 hari melalui cek atau pindahan wang elektronik (EFT) atas nama <strong>Akauntan Negara Malaysia</strong>. Sekiranya bayaran dibuat secara EFT, mohon nyatakan rujukan pembayaran dengan format berikut: <strong>(Kod PTJ/{{ $invoice->invoice_number }})</strong>.</p>

            <p>Untuk makluman, laporan penilaian hanya akan dikeluarkan setelah bayaran fi ikhtisas diterima sepenuhnya. Kerjasama pihak tuan/puan dalam menjelaskan bayaran dengan segera amatlah dihargai.</p>

            <p>Sekian, terima kasih.</p>

            <div class="signature">
                “MALAYSIA MADANI”<br>
                “BERKHIDMAT UNTUK NEGARA”
            </div>

            <br>
            <a href="{{ $url }}" class="button">Lihat Invois</a>
        </div>

        <div class="footer">
            E-mel ini dijana secara automatik. Sila jangan balas e-mel ini.
        </div>
    </div>
</body>
</html>