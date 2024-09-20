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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        .cta-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Pagamento Confirmado!</h1>
    <p>Olá, {{ $name }}</p>
    <p>Estamos felizes em informar que seu plano foi renovado com sucesso! Agradecemos muito pela sua confiança em nossos serviços.</p>
    <p>Detalhes da sua assinatura:</p>
    <ul>
        <li>Data de expiração: {{ $expiresAt }}</li>
    </ul>
    <p>Sua assinatura nos motiva a continuar melhorando e oferecendo a melhor experiência possível. Valorizamos muito sua escolha em fazer parte da comunidade Work Off.</p>
    <a href="https://workoff.com.br/qr-code/{{ $userId }}?qr_code=1" class="cta-button">Baixe agora mesmo seu QR Code</a>
    <p>Se você tiver qualquer dúvida ou precisar de assistência, não hesite em entrar em contato conosco através do e-mail <a href="mailto:suporte@workoff.com.br">suporte@workoff.com.br</a>. Estamos sempre à disposição para ajudar!</p>
    <p>Mais uma vez, obrigado pela sua assinatura. Esperamos que aproveite ao máximo todos os recursos que oferecemos!</p>
    <p>Atenciosamente,<br>Equipe Work Off</p>
    <div class="footer">
        <p>Work Off 2024</p>
        <p>
            <a href="mailto:suporte@workoff.com.br">Enviar e-mail</a> | 
            <a href="https://www.instagram.com/workoff">Instagram</a>
        </p>
    </div>
</body>
</html>