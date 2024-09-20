<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Work Off</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #276EF1;
            --secondary-color: #6C757D;
            --accent-color: #FFC107;
            --background-color: #000000;
            --text-color: #333333;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @media(max-width:991px) {
            .profile-container {
                margin: 10px;
            }

            .profile-header {
                padding: 15px;
            }

            .profile-body {
                padding: 15px;
            }
        }

        @media(min-width:992px) {
            .profile-container {
                margin: 50px auto;
            }

            .profile-header {
                padding: 30px;
            }

            .profile-body {
                padding: 30px;
            }
        }

        .profile-container {
            max-width: 800px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), #1a56c4);
            color: white;
            text-align: center;
            position: relative;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .profile-name {
            font-size: 2.5em;
            margin-top: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-description {
            font-style: italic;
            margin-top: 10px;
            font-size: 1.2em;
        }

        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .info-icon {
            font-size: 2em;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .info-title {
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .info-content {
            font-size: 1.1em;
        }

        .social-links {
            margin-top: 30px;
            text-align: center;
        }

        .social-icon {
            font-size: 1.5em;
            color: var(--primary-color);
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            color: var(--accent-color);
            transform: scale(1.2);
        }

        .qr-code {
            text-align: center;
            margin-top: 30px;
        }

        .qr-code img {
            max-width: 200px;
            border: 5px solid var(--primary-color);
            border-radius: 10px;
        }

        .copy-pix-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 0.9em;
            cursor: pointer;
            margin-left: 10px;
        }

        .copy-pix-btn:hover {
            background-color: #1a56c4;
        }

        @media (max-width: 768px) {
            .profile-img {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>
    @if (isset(request()->query()['qr_code']))
        <div class="my-3 my-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        
                        <span class="text-white"><a id="downloadLink" class="d-inline">Clique aqui</a> para baixar o QR Code e começar a <strong class="text-success">ganhar mais dinheiro</strong>!</span>
                        <div class="rounded-3 p-3 bg-white mt-3 mx-auto" style="width: fit-content;">
                            <div id="qrcode"></div>
                        </div>
                        <br><span class="text-white">Caso tenha alguma dúvida, envie um e-mail para <a href="mailto:suporte@workoff.com.br">suporte@workoff.com.br</a></span>
                        <br><small class="text-white">**QR code visível apenas por {{ $user->name }}.</small>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="profile-container">
        <div class="profile-header">
            <img src="{{ asset('images/' . ($user->image ? $user->image : 'core/avatar.png')) }}"
                alt="Foto do Motorista" class="profile-img">
            <h1 class="profile-name">{{ $user->name }}</h1>
            <h4>{{ \Carbon\Carbon::parse($user->birthdate)->age }} anos</h4>
            <hr class="w-25 mx-auto mb-1">
            <p class="profile-description mb-0">{{ $user->message }}</p>
        </div>
        <div class="profile-body">
            <div class="row">
                @if ($user->phones)
                    <div class="col-12 col-lg text-center text-lg-start">
                        <div class="info-card shadow h-100">
                            <div class="info-icon mb-1"><i class="fas fa-mobile-alt"></i></div>
                            <div class="mb-2"><span class="text-black fw-medium">Contato(s):</span></div>
                            @foreach ($user->phones as $phone)
                                <div
                                    class="info-content d-flex justify-content-center justify-content-lg-start gap-2 @if (!$loop->last) mb-3 mb-lg-2 @endif">
                                    <div>
                                        <span class="me-2">{{ $phone->phone }}</span>
                                    </div>
                                    @if ($phone->is_whatsapp === 0)
                                        <div class="col-lg">
                                            <button title="Ligar" type="button" class="btn btn-sm btn-primary px-2">
                                                <i class="fas fa-phone-volume"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div>
                                            <a href="tel:{{ $phone->phone }}" title="Ligar" type="button"
                                                class="btn btn-sm btn-primary px-2">
                                                <i class="fas fa-phone-volume"></i>
                                            </a>
                                            |
                                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $phone->phone) }}"
                                                target="_blank" title="WhatsApp" type="button"
                                                class="btn btn-sm btn-success px-2">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($user->pix)
                    <div class="col-12 col-lg mt-3 mt-lg-0 text-center text-lg-start">
                        <div class="info-card shadow h-100">
                            <div class="info-icon mb-1"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="mb-2"><span class="text-black fw-medium">Chave Pix</span></div>
                            <div class="info-content">
                                <button class="btn btn-outline-primary ms-0" onclick="copyPix()">Copiar chave
                                    Pix</button>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($user->instagram)
                    <div class="col-12 col-lg mt-3 mt-lg-0 text-center text-lg-start">
                        <div class="info-card shadow h-100">
                            <div class="info-icon mb-1"><i class="fab fa-instagram"></i></div>
                            <div class="mb-2"><span class="text-black fw-medium">Instagram:</span></div>
                            <div class="info-content">
                                <a href="https://instagram.com/{{ $user->instagram->username }}" target="_blank"
                                    rel="noopener noreferrer">
                                    {{ '@' . $user->instagram->username }} <svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor"
                                        class="bi bi-box-arrow-up-right ms-2 mb-1" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5" />
                                        <path fill-rule="evenodd"
                                            d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function copyPix() {
            const pixKey = '{{ $user->pix->key }}';
            navigator.clipboard.writeText(pixKey).then(function() {
                alert('Chave Pix copiada!');
            }, function(err) {
                console.error('Erro ao copiar: ', err);
            });
        }
    </script>
    <script>
        const qrCodeElement = document.getElementById("qrcode");
        const qrCode = new QRCode(qrCodeElement, {
            text: "{{ route('user', $user->id) }}",
            width: 350,
            height: 350,
            correctLevel: QRCode.CorrectLevel.H,
            render: "canvas"
        });

        qrCodeElement.querySelector('canvas').toBlob(function(blob) {
            const downloadLink = document.getElementById('downloadLink');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = 'qrcode.png';
            downloadLink.style.display = 'block';
        });
    </script>
</body>

</html>
