<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Off - Crie seu QR Code Exclusivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        }

        h1,
        h2 {
            color: var(--primary-color);
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand,
        .nav-link,
        #preview>h4 {
            color: white !important;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        #preview {
            border-radius: 10px;
            padding: 20px;
            min-height: 250px;
            border: 1px solid var(--primary-color);
        }

        .section-title {
            color: var(--primary-color);
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a56c4;
            border-color: #1a56c4;
        }

        .plan-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .plan-card.highlight {
            border: 2px solid var(--primary-color);
            position: relative;
        }

        .highlight-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
        }

        .copy-text {
            cursor: pointer;
            color: var(--primary-color);
        }

        .copy-text:hover {
            text-decoration: underline;
        }

        #nav-spacing {
            min-height: 8vh;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 20px;
            }

            #preview {
                min-height: 300px;
            }

            h1 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.2rem;
            }

            #preview {
                padding: 10px;
            }
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .navbar-toggler:focus {
            box-shadow: unset;
        }

        #previewButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #0d963a;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            font-size: 1em;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: blink 1.5s infinite;
        }

        /* Animação de piscar */
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        /* Ajuste para dispositivos móveis */
        @media (max-width: 576px) {
            #previewButton {
                bottom: 10px;
                right: 10px;
                padding: 8px 16px;
                font-size: 0.9em;
            }
        }
    </style>
</head>

<body>
    <div id="nav-spacing"></div>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid" style="max-width: 1320px;">
            <a class="navbar-brand" href="#"><img src="{{ asset('/images/core/logo.png') }}"
                    alt="" class="img-fluid" style="max-width: 80px;"></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item w-25">
                        <hr class="text-white my-0">
                        <span class="vr d-block mx-auto d-none d-lg-block"
                            style="width: 2px; background-color: white;"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Sobre</a>
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
        <h1 class="text-center mb-3 mb-lg-5">Work Off — Fuja das taxas!</h1>

        <div class="row">
            <div class="col-lg-7 col-md-7">
                <p class="text-center text-lg-start">Com o Work Off, você aumenta suas chances de conseguir mais
                    corridas particulares, conectando-se diretamente com seus passageiros de forma prática e
                    personalizada. <br><strong>Em menos de dois minutos.</strong></p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" id="qrCodeForm" action="{{ route('new-user') }}" enctype="multipart/form-data">
                    @csrf
                    <h2 class="section-title">Informações Pessoais</h2>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
                        <input type="text" class="form-control border-dark" id="nome" name="name"
                            placeholder="O nome que aparecerá para seu cliente" value="{{ old('name') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="dataNascimento" class="form-label">Data de Nascimento<span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control border-dark" id="dataNascimento" name="birthdate"
                                value="{{ old('birthdate') }}" required>
                        </div>
                        <div class="col-md mb-3">
                            <label for="email" class="form-label">E-mail (apenas para cadastro)<span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control border-dark" id="email" name="email"
                                placeholder="Utilizado para mantermos o contato" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição sobre o que faz<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control border-dark" id="descricao" name="message" rows="4"
                            placeholder="Sua descrição deve cativar seu passageiro, então capricha. 😉" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto de Perfil</label>
                        <input type="file" class="form-control border-dark" id="foto" name="image"
                            accept="image/*">
                    </div>

                    <h2 class="section-title">Redes Sociais e Contato</h2>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input border-dark" id="exibir-instagram"
                            {{ old('instagram') ? 'checked' : '' }}>
                        <label class="form-check-label" for="exibir-instagram">Deseja exibir seu Instagram?
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                class="bi bi-instagram ms-1" viewBox="0 0 16 16">
                                <defs>
                                    <linearGradient id="instagramGradient" x1="0%" y1="0%"
                                        x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#f09433; stop-opacity:1" />
                                        <stop offset="25%" style="stop-color:#e6683c; stop-opacity:1" />
                                        <stop offset="50%" style="stop-color:#dc2743; stop-opacity:1" />
                                        <stop offset="75%" style="stop-color:#cc2366; stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#bc1888; stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#instagramGradient)"
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg>
                        </label>
                    </div>
                    <div class="mb-3" id="instagramInput" style="{{ old('instagram') ? '' : 'display: none;' }}">
                        <label for="instagram" class="form-label">Perfil do Instagram<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control border-dark" id="instagram" name="instagram"
                            placeholder="Digite seu usuário no Instagram sem @" value="{{ old('instagram') }}">
                    </div>
                    <div class="mb-3">
                        <label for="first_phone" class="form-label">Telefone 1<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control border-dark telefone" id="first_phone"
                                name="first_phone" value="{{ old('first_phone') }}" required>
                            <select class="form-select border-dark" id="first_phone_type" name="first_phone_type">
                                <option value="0" {{ old('first_phone_type') == '0' ? 'selected' : '' }}>Apenas
                                    chamadas</option>
                                <option value="1" {{ old('first_phone_type') == '1' ? 'selected' : '' }}>Também é
                                    WhatsApp</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="seccond_phone" class="form-label">Telefone 2 (opcional)</label>
                        <div class="input-group">
                            <input type="text" class="form-control border-dark telefone" id="seccond_phone"
                                name="seccond_phone" value="{{ old('seccond_phone') }}">
                            <select class="form-select border-dark" id="seccond_phone_type"
                                name="seccond_phone_type">
                                <option value="0" {{ old('seccond_phone_type') == '0' ? 'selected' : '' }}>Apenas
                                    chamadas</option>
                                <option value="1" {{ old('seccond_phone_type') == '1' ? 'selected' : '' }}>Também
                                    é WhatsApp</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input border-dark" id="exibir-pix"
                            name="exibir-pix" {{ old('pix') ? 'checked' : '' }}>
                        <label class="form-check-label" for="exibir-pix">Deseja exibir chave Pix?</label>
                        <img class="ms-1" src="{{ asset('images/pix.png') }}" alt="Deseja exibir chave pix?"
                            style="max-width: 30px;">
                    </div>
                    <div class="mb-3" id="pix" style="{{ old('pix') ? '' : 'display: none;' }}">
                        <label for="chavePix" class="form-label">Chave Pix</label>
                        <input type="text" class="form-control border-dark" id="chavePix" name="pix"
                            value="{{ old('pix') }}">
                    </div>

                    <h2 class="section-title">Escolha seu plano</h2>
                    <p>Invista em sua presença digital com nossos planos exclusivos. Cada plano inclui seu QR Code
                        personalizado!</p>
                    <div class="plan-card">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="radio" name="plan"
                                id="planoMensal" value="1" {{ old('plan') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="planoMensal">
                                <strong>Plano Mensal:</strong> R$19,99/mês
                            </label>
                        </div>
                        <p class="mt-2 mb-0">Perfeito para quem quer experimentar nosso serviço!</p>
                    </div>
                    <div class="plan-card highlight position-relative">
                        <span class="highlight-badge">Mais Popular</span>
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="radio" name="plan"
                                id="planoTrimestral" value="2" {{ old('plan', '2') == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="planoTrimestral">
                                <strong>Plano Trimestral:</strong> R$16,99/mês <strong class="text-success">(economia
                                    de R$ 9,00)</strong>
                            </label>
                        </div>
                        <p class="mt-2 mb-0">Ótimo custo-benefício! Economize 15% em relação ao plano mensal.</p>
                    </div>
                    <div class="plan-card">
                        <div class="form-check">
                            <input class="form-check-input border-dark" type="radio" name="plan"
                                id="planoAnual" value="3" {{ old('plan') == '3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="planoAnual">
                                <strong>Plano Anual:</strong> R$14,99/mês <strong class="text-success">(economia de
                                    R$
                                    59,97)</strong>
                            </label>
                        </div>
                        <p class="mt-2 mb-0">Melhor valor! Economize 25% em relação ao plano mensal.</p>
                    </div>
                    <button type="submit" class="btn btn-success mt-4 w-100 py-3"><strong>Confirmar e evitar
                            taxas!</strong></button>
                    <div class="text-center">
                        <small class="text-center lh-1 mt-1">Ao confirmar, você concorda com o acesso de seus
                            passageiros aos dados fornecidos.</small>
                    </div>
                </form>
            </div>
            <div class="col-md-5 mt-5 mt-md-0 text-center">
                <!-- Trecho relevante da Welcome view ajustado -->

                <div id="preview" class="profile-container p-0">
                    <div class="profile-header bg-primary text-white p-3" style="border-radius: 8px 8px 0px 0px;">
                        <img src="{{ asset('/images/core/avatar.png') }}" id="previewImage"
                            alt="Foto do Motorista" class="profile-img rounded-circle" style="max-width: 100px;">
                        <h1 class="profile-name text-white h2 mt-1" id="previewNome"></h1>
                        <h4 id="ageDisplay"></h4>
                        <hr class="w-25 mx-auto mb-2" style="opacity: 1;">
                        <i class="profile-description mb-0 h6" id="previewDescricao"></i>
                    </div>
                    <div class="profile-body p-3" style="background-color: #8080800d;">
                        <div class="row gap-3 gap-lg-4">
                            <div class="col-12 bg-white" id="phoneSection" style="display: none;">
                                <div class="info-card rounded-3 shadow h-100 p-3 text-center">
                                    <div class="info-icon mb-1"><i
                                            class="fas fa-mobile-alt text-primary fa-2xl mb-3 text-primary"
                                            style="width: 26px;"></i></div>
                                    <div class="mb-2"><span class="text-black fw-medium h6">Contato(s):</span></div>
                                    <div class="info-content phone-1">
                                        <div
                                            class="info-content d-flex justify-content-center gap-2 align-items-center">
                                            <div>
                                                <span id="previewTelefone1" class="me-2"></span>
                                            </div>
                                            <div id="phone1Icons">
                                                <a href="tel:" title="Ligar" type="button"
                                                    class="btn btn-sm btn-primary px-2">
                                                    <i class="fas fa-phone-volume"></i>
                                                </a>
                                                <span id="waIcon1" style="display:none;">
                                                    |
                                                    <a href="https://wa.me/" target="_blank" title="WhatsApp"
                                                        type="button" class="btn btn-sm btn-success px-2">
                                                        <i class="fab fa-whatsapp fa-lg"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-content phone-2 mt-1">
                                        <div
                                            class="info-content d-flex justify-content-center gap-2 mt-2 mt-lg-3 align-items-center">
                                            <div>
                                                <span id="previewTelefone2" class="me-2"></span>
                                            </div>
                                            <div id="phone2Icons">
                                                <a href="tel:" title="Ligar" type="button"
                                                    class="btn btn-sm btn-primary px-2">
                                                    <i class="fas fa-phone-volume"></i>
                                                </a>
                                                <span id="waIcon2" style="display:none;">
                                                    |
                                                    <a href="https://wa.me/" target="_blank" title="WhatsApp"
                                                        type="button" class="btn btn-sm btn-success px-2">
                                                        <i class="fab fa-whatsapp fa-lg"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white mt-3 mt-lg-0 text-center" id="pixSection"
                                style="display: none;">
                                <div class="info-card rounded-3 shadow h-100 p-3">
                                    <div class="info-icon mb-1"><i
                                            class="fas fa-money-bill-wave fa-2xl mb-3 text-primary"></i></div>
                                    <div class="mb-2"><span class="text-black fw-medium">Chave Pix</span></div>
                                    <div class="info-content">
                                        <span id="previewChavePix" class="copy-text"
                                            title="Clique para copiar"></span>
                                        <br><i>Clique na chave para copiar</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white mt-3 mt-lg-0 text-center text-lg-start" id="instagramSection"
                                style="display: none;">
                                <div class="info-card rounded-3 shadow h-100 p-3 text-center">
                                    <div class="info-icon mb-1"><i
                                            class="fab fa-instagram fa-2xl mb-3 text-primary"></i></div>
                                    <div class="mb-2"><span class="text-black fw-medium">Instagram:</span></div>
                                    <div class="info-content">
                                        <span id="previewInstagram"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <a href="#preview" id="previewButton" class="fw-normal rounded-pill me-3 mb-5 d-lg-none"
        style="font-size: 12px; display: none;">Veja como <br>tá ficando!</a>

    <script>
        function updatePhonePreview(phone, phoneType, previewSelector, waIconSelector) {
            if (phoneType === '1') { // WhatsApp
                $(waIconSelector).show();
            } else {
                $(waIconSelector).hide();
            }

            $(previewSelector).text(phone);

            if (phone) {
                $(previewSelector).parent().parent().show(); // Mostra a linha correspondente
            } else {
                $(previewSelector).parent().parent().hide(); // Esconde a linha correspondente se não houver telefone
            }
        }

        let previewCanShow = 0;

        function updatePreview() {
            if(previewCanShow === 1) {
                $('#previewButton').show()
            }

            previewCanShow = 1;
            $('#previewNome').text(formData['name'] || '');
            $('#previewDescricao').text(formData['message'] || '');

            if (formData['instagram']) {
                $('#previewInstagram').html(
                    `<a href="https://instagram.com/${formData['instagram']}" target="_blank" rel="noopener noreferrer">@${formData['instagram']}</a>`
                );
                $('#instagramSection').show();
            } else {
                $('#instagramSection').hide();
            }

            if (formData['phone1']) {
                updatePhonePreview(formData['phone1'], formData['phone1_type'], '#previewTelefone1', '#waIcon1');
                $('#phoneSection').show();
            } else {
                $('#phoneSection').hide();
            }

            if (formData['phone2']) {
                updatePhonePreview(formData['phone2'], formData['phone2_type'], '#previewTelefone2', '#waIcon2');
                $('#previewTelefone2').show();
                $('.phone-2').show();
            } else {
                $('#previewTelefone2').hide();
                $('.phone-2').hide();
            }

            if (formData['pix_key']) {
                $('#previewChavePix').text(formData['pix_key']);
                $('#pixSection').show();
            } else {
                $('#pixSection').hide();
            }
        }

        // Chamar updatePreview() após mudanças nos inputs para atualizar a preview.
        function calculateAge(birthdate) {
            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }

        function updateAgeDisplay() {
            const birthdate = $('#dataNascimento').val();
            if (birthdate) {
                const age = calculateAge(birthdate);
                $('#ageDisplay').text(age + ' anos');
            } else {
                $('#ageDisplay').text('');
            }
        }

        let formData = {};

        function updateFormData(key, value) {
            formData[key] = value;
        }

        function highlightSelectedPlan() {
            $('.plan-card').removeClass('highlight position-relative');
            $('.plan-card .highlight-badge').remove();

            $('.plan-card').each(function() {
                if ($(this).find('.form-check-input').is(':checked')) {
                    $(this).addClass('highlight position-relative');
                    $(this).prepend('<span class="highlight-badge">Selecionado</span>');
                }
            });
        }

        // Adiciona o destaque ao plano selecionado inicialmente (se houver um old)
        
        $(document).ready(function() {
            $('#first_phone, #first_phone_type').on('input change', function() {
                updateFormData('phone1', $('#first_phone').val());
                updateFormData('phone1_type', $('#first_phone_type').val());
                updatePreview();
            });
            
            $('#seccond_phone, #seccond_phone_type').on('input change', function() {
                updateFormData('phone2', $('#seccond_phone').val());
                updateFormData('phone2_type', $('#seccond_phone_type').val());
                updatePreview();
            });
            
            $('#dataNascimento').on('change', function() {
                updateAgeDisplay();
            });
            
            updateAgeDisplay();
            
            $('.telefone').mask('00 0 0000-0000');
            
            $('#exibir-instagram').change(function() {
                $('#instagramInput').toggle(this.checked);
                
                if (this.checked) {
                    updateFormData('instagram', $('#instagram').val());
                    $('#instagramSection').show();
                } else {
                    updateFormData('instagram', '');
                    $('#instagramSection').hide();
                }
                updatePreview();
            });
            
            $('#exibir-pix').change(function() {
                $('#pix').toggle(this.checked);
                
                if (this.checked) {
                    updateFormData('pix_key', $('#chavePix').val());
                    $('#pixSection').show();
                } else {
                    updateFormData('pix_key', '');
                    $('#pixSection').hide();
                }
                updatePreview();
            });
            
            $('#nome').on('input', function() {
                updateFormData('name', $(this).val());
                updatePreview();
            });
            
            $('#dataNascimento').on('change', function() {
                updateFormData('birthdate', $(this).val());
                updatePreview();
            });
            
            $('#email').on('input', function() {
                updateFormData('email', $(this).val());
            });
            
            $('#descricao').on('input', function() {
                updateFormData('message', $(this).val());
                updatePreview();
            });
            
            $('#foto').on('change', function() {
                if (this.files && this.files[0]) {
                    updateFormData('image', this.files[0]);
                    $('#previewImage').attr('src', URL.createObjectURL(this.files[0]));
                }
            });
            
            $('#first_phone').on('input', function() {
                updateFormData('phone1', $(this).val());
                updatePreview();
            });
            
            $('#first_phone_type').on('change', function() {
                updateFormData('phone1_type', $(this).val());
                updatePreview();
            });
            
            $('#seccond_phone').on('input', function() {
                updateFormData('phone2', $(this).val());
                updatePreview();
            });
            
            $('#seccond_phone_type').on('change', function() {
                updateFormData('phone2_type', $(this).val());
                updatePreview();
            });
            
            $('#instagram').on('input', function() {
                if ($('#exibir-instagram').is(':checked')) {
                    updateFormData('instagram', $(this).val());
                    $('#instagramSection').show();
                } else {
                    updateFormData('instagram', '');
                    $('#instagramSection').hide();
                }
                updatePreview();
            });
            
            $('#chavePix').on('input', function() {
                if ($('#exibir-pix').is(':checked')) {
                    updateFormData('pix_key', $(this).val());
                    $('#pixSection').show();
                } else {
                    updateFormData('pix_key', '');
                    $('#pixSection').hide();
                }
                updatePreview();
            });
            
            $('input[name="plano"]').on('change', function() {
                updateFormData('plan', $(this).val());
            });
            
            $('.plan-card').on('click', function() {
                $('.plan-card').removeClass('highlight position-relative');
                $('.plan-card .highlight-badge').remove();
                
                $(this).addClass('highlight position-relative');
                $(this).prepend('<span class="highlight-badge">Selecionado</span>');
                
                $(this).find('.form-check-input').prop('checked', true).trigger('change');
            });
            
            $('#previewChavePix').on('click', function() {
                const pixKey = $(this).text();
                navigator.clipboard.writeText(pixKey).then(function() {
                    alert('Chave Pix copiada para o clipboard!');
                }, function(err) {
                    console.error('Erro ao copiar para o clipboard: ', err);
                });
            });
            
            updateFormData('name', $('#nome').val());
            updateFormData('birthdate', $('#dataNascimento').val());
            updateFormData('email', $('#email').val());
            updateFormData('message', $('#descricao').val());
            updateFormData('phone1', $('#first_phone').val());
            updateFormData('phone1_type', $('#first_phone_type').val());
            updateFormData('phone2', $('#seccond_phone').val());
            updateFormData('phone2_type', $('#seccond_phone_type').val());
            updateFormData('instagram', $('#instagram').val());
            updateFormData('pix_key', $('#chavePix').val());
            
            if (formData['image']) {
                $('#previewImage').attr('src', URL.createObjectURL(formData['image']));
            }
            
            updatePreview();
            highlightSelectedPlan();
        });
        </script>
</body>

</html>
