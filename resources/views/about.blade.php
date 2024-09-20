<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre a Work Off</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #276EF1;
            --secondary-color: #F6F6F6;
            --background-color: #000000;
            --text-color: #333333;
        }

        .nav-item .active {
            font-weight: 700 !important;
        }

        .external-links .text-white:hover {
            color: var(--primary-color) !important;
        }

        body {
            margin-left: 10px;
            margin-right: 10px;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        @media(max-width:991px) {
            .container {
                padding: 15px;
            }
        }

        @media(min-width:992px) {
            .container {
                padding: 30px;
            }
        }

        h1,
        h2, h3 {
            color: var(--primary-color);
        }

        .highlight {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #nav-spacing {
            min-height: 8dvh;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .navbar-toggler:focus {
            box-shadow: unset;
        }
    </style>
</head>

<body>
    <div id="nav-spacing"></div>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid" style="max-width: 1320px;">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/images/core/logo.png') }}"
                alt="" class="img-fluid" style="max-width: 80px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item w-25">
                        <hr class="text-white my-0">
                        <span class="vr d-block mx-auto d-none d-lg-block"
                            style="width: 2px; background-color: white;"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('about') }}">Sobre</a>
                    </li>
                    <li class="nav-item w-25">
                        <hr class="text-white my-0">
                        <span class="vr d-block mx-auto d-none d-lg-block"
                            style="width: 2px; background-color: white;"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-block" style="width: 80px;"></div>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center mb-3 mb-lg-5">Sobre a Work Off</h1>

        <div class="highlight">
            <p class="lead mb-0">No <strong>Work Off</strong>, acreditamos em empoderar motoristas de aplicativo para
                que possam ter mais controle sobre suas carreiras e renda.</p>
        </div>

        <p>Nosso objetivo é facilitar a conexão direta entre motoristas e passageiros, eliminando intermediários e as
            altas taxas cobradas pelos aplicativos de transporte tradicionais.</p>

        <h2 class="mt-4">Como funciona?</h2>
        <p>Com o Work Off, você cria um site personalizado com um QR Code exclusivo, permitindo que seus passageiros
            acessem suas informações de forma rápida e prática. Seja você motorista de carro ou moto táxi, é fácil
            exibir o QR Code em locais visíveis, como no painel, banco ou capacete.</p>

        <h2 class="mt-4">O que seus clientes verão?</h2>
        <p>Através desse QR Code, seus clientes terão acesso às suas principais informações, como:</p>
        <ul>
            <li>Seu nome e uma breve descrição do seu trabalho</li>
            <li>Redes sociais (como WhatsApp e Instagram)</li>
            <li>Sua chave Pix para pagamentos rápidos e sem burocracia</li>
        </ul>

        <h2 class="mt-4">Benefícios do Work Off</h2>
        <p>Com o Work Off, você cria um site de apresentação profissional, proporcionando uma experiência mais
            personalizada e direta aos seus passageiros. Isso aumenta suas chances de fidelizar clientes regulares,
            construir uma base sólida e escapar das altas taxas cobradas pelos aplicativos de transporte.</p>

        <h2 class="mt-4">Planos Flexíveis</h2>
        <p>Oferecemos planos flexíveis para atender às suas necessidades, permitindo que você escolha entre opções
            mensais, trimestrais ou anuais, cada uma com descontos e benefícios exclusivos.</p>

        <div class="highlight mt-4">
            <h3 class="text-center">Crie conexões mais fortes e torne-se independente dos aplicativos de transporte!</h3>
        </div>
    </div>

    <footer class="text-center my-3">
        <div class="container bg-transparent">
            <div class="row justify-content-end align-items-center">
                <div class="col-12 col-lg-4 text-center">
                    <p class="mb-0 text-white">Work Off — {{ date('Y') }}.</p>
                </div>
                <div class="col-12 col-lg-4 text-center text-lg-end mt-3 mt-lg-0">
                    <div class="d-flex gap-2 justify-content-center justify-content-lg-end align-items-center">
                        <a class="external-links" href="https://www.instagram.com/workoff.com.br/" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" class="bi bi-instagram text-white" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334">
                                </path>
                            </svg>
                        </a>
                        <div class="vr text-white" style="opacity: 1;"></div>
                        <a class="external-links" href="mailto:suporte@vagasmaceio.com.br" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-envelope text-white" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
