<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano Pago - Work Off</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 20px;
        }
        .section {
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .cta-button {
            display: inline-block;
            background-color: #2ecc71;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9em;
        }
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pagamento Confirmado!</h1>
        </div>
        
        <div class="content" style="text-align: center;">
            <div class="section">
                <p>Olá, {{ $name }}</p>
                <p>Estamos felizes em informar que seu plano foi renovado com sucesso! Agradecemos muito pela sua confiança em nossos serviços.</p>
            </div>

            <div class="section">
                <h2>Detalhes da sua assinatura:</h2>
                <ul>
                    <li>Data de expiração: {{ $expiresAt }}</li>
                </ul>
            </div>

            <div class="section">
                <p>Sua assinatura nos motiva a continuar melhorando e oferecendo a melhor experiência possível. Valorizamos muito sua escolha em fazer parte da comunidade Work Off.</p>
                <a href="https://workoff.com.br/qr-code/{{ $userId }}?qr_code=1" class="cta-button" target="_blank">Baixe agora mesmo seu QR Code</a>
            </div>

            <div class="section">
                <p>Se você tiver qualquer dúvida ou precisar de assistência, não hesite em entrar em contato conosco através do e-mail <a href="mailto:suporte@workoff.com.br">suporte@workoff.com.br</a>. Estamos sempre à disposição para ajudar!</p>
                <p>Mais uma vez, obrigado pela sua assinatura. Esperamos que aproveite ao máximo todos os recursos que oferecemos!</p>
            </div>

            <p>Atenciosamente,<br>Equipe Work Off</p>
        </div>

        <div class="footer">
            <p>Work Off 2024</p>
            <p>
                <a href="mailto:suporte@workoff.com.br">Enviar e-mail</a> | 
                <a href="https://www.instagram.com/workoff">Instagram</a>
            </p>
        </div>
    </div>
</body>
</html>