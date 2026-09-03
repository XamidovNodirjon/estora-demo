<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektron pochtani tasdiqlash</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #F4F8FC;
            margin: 0;
            padding: 30px 15px;
            color: #1E293B;
        }
        .container {
            max-width: 520px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 20px;
            padding: 35px 30px;
            box-shadow: 0 10px 25px rgba(0, 102, 255, 0.08);
            border: 1px solid #E2E8F0;
        }
        .logo-box {
            text-align: center;
            margin-bottom: 25px;
        }
        .brand-title {
            font-size: 24px;
            font-weight: 900;
            color: #0F172A;
            letter-spacing: -0.5px;
        }
        .brand-accent {
            color: #0077FE;
        }
        .badge {
            display: inline-block;
            background-color: #EBF4FF;
            color: #0077FE;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 12px;
            border-radius: 50px;
            margin-bottom: 12px;
        }
        .title {
            font-size: 20px;
            font-weight: 800;
            color: #0F172A;
            margin: 0 0 10px 0;
            text-align: center;
        }
        .desc {
            font-size: 13px;
            color: #64748B;
            line-height: 1.6;
            margin: 0 0 25px 0;
            text-align: center;
        }
        .code-box {
            background: linear-gradient(135deg, #0077FE 0%, #0056D2 100%);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            margin: 0 0 25px 0;
            box-shadow: 0 8px 20px rgba(0, 119, 254, 0.25);
        }
        .code {
            font-family: 'Courier New', Courier, monospace;
            font-size: 34px;
            font-weight: 900;
            letter-spacing: 8px;
            color: #FFFFFF;
            margin: 0;
        }
        .info-card {
            background-color: #F8FAFC;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 12px;
            color: #475569;
            border: 1px solid #E2E8F0;
            line-height: 1.5;
            margin-bottom: 25px;
        }
        .footer {
            text-align: center;
            font-size: 11px;
            color: #94A3B8;
            border-top: 1px solid #F1F5F9;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo-box">
            <div class="brand-title">
                ESTORA<span class="brand-accent">.UZ</span>
            </div>
        </div>

        <div style="text-align: center;">
            <span class="badge">Elektron pochtani tasdiqlash</span>
        </div>

        <h1 class="title">Hurmatli {{ $userName }},</h1>
        <p class="desc">
            Estora platformasida e'lonlar joylashtirish va profilingizni to'liq faollashtirish uchun quyidagi 6 xonali tasdiqlash kodidan foydalaning:
        </p>

        <!-- 6-digit Code Box -->
        <div class="code-box">
            <div class="code">{{ $code }}</div>
        </div>

        <div class="info-card">
            <strong>Eslatma:</strong> Ushbu tasdiqlash kodi <strong>15 daqiqa</strong> davomida amal qiladi. Kodni begonalarga oshkor qilmang.
        </div>

        <div class="footer">
            Ushbu xat <strong>notifications@estora.uz</strong> orqali avtomatik yuborildi.<br>
            &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
        </div>
    </div>
</body>
</html>
