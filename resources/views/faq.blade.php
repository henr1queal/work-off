<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Work Off</title>
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
            padding: 30px;
            margin-top: 20px;
        }

        h1,
        h2 {
            color: var(--primary-color);
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: white;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(39, 110, 241, 0.25);
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
                        <a class="nav-link" href="{{ route('about') }}">Sobre</a>
                    </li>
                    <li class="nav-item w-25">
                        <hr class="text-white my-0">
                        <span class="vr d-block mx-auto d-none d-lg-block"
                            style="width: 2px; background-color: white;"></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-block" style="width: 80px;"></div>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center mb-3 mb-lg-5">Perguntas Frequentes - Work Off</h1>

        <p class="lead mb-4">Bem-vindo à nossa seção de Perguntas Frequentes. Aqui, você encontrará respostas para as
            dúvidas mais comuns sobre o Work Off, nossa plataforma que empodera motoristas de aplicativo. Se você não
            encontrar a resposta que procura, não hesite em nos contatar diretamente.</p>

        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1. O que é o Work Off?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        O Work Off é uma plataforma inovadora que empodera motoristas de aplicativo, dando a você mais
                        controle sobre sua carreira e renda. Com o Work Off, você cria um QR Code personalizado que
                        conecta você diretamente aos seus passageiros, eliminando intermediários e as altas taxas
                        cobradas pelos aplicativos de transporte tradicionais.
                        <br>Seu perfil ficará disponíveis 24h por dia, 7 dias por semana.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2. Como funciona o QR Code personalizado?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        O QR Code personalizado gerado pelo Work Off facilita o acesso dos passageiros às suas
                        informações. Ao escanear o código, eles são direcionados ao seu site pessoal, onde podem
                        visualizar seu nome, uma breve descrição do seu serviço, links para suas redes sociais e opções
                        de contato direto.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3. Onde posso usar o QR Code?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Você pode exibir o QR Code em locais estratégicos e visíveis, como no painel do carro, no banco,
                        no capacete ou na porta. Isso permite que seus passageiros acessem suas informações de maneira
                        rápida e conveniente.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        4. Quais informações os passageiros podem acessar pelo QR Code?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ao escanear o QR Code, os passageiros podem acessar suas principais informações, incluindo:
                        <ul>
                            <li>Nome e uma breve descrição do seu trabalho</li>
                            <li>Redes sociais, como Instagram</li>
                            <li>Opções de contato direto, como telefone ou WhatsApp</li>
                            <li>Sua chave Pix para pagamentos rápidos e sem burocracia (opcional)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        5. Como o Work Off pode me ajudar a fidelizar clientes?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Com o Work Off, você cria um site de apresentação profissional, oferecendo uma experiência mais
                        personalizada e direta aos seus passageiros. Isso aumenta suas chances de fidelizar clientes,
                        construir uma base sólida de passageiros regulares e fortalecer sua reputação no mercado.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        6. Quais são os planos disponíveis no Work Off?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Disponibilizamos planos flexíveis que se adaptam às suas necessidades: mensal, trimestral e
                        anual. Cada opção oferece descontos e benefícios exclusivos, permitindo que você escolha a
                        melhor opção para o seu negócio.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        7. É seguro efetuar o pagamento pelo Work Off?
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sim, todas as transações são processadas pelo Mercado Pago, uma plataforma de pagamentos segura
                        e confiável pertencente ao Mercado Livre. Sua segurança é nossa prioridade.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        8. Posso editar as informações do meu site após o pagamento?
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sim, você pode atualizar as informações do seu site sempre que desejar. Basta enviar um e-mail
                        para suporte@workoff.com.br com o nome completo, e-mail cadastrado e data de nascimento.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        9. Posso cancelar meu site?
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sim, você tem até 7 dias após o pagamento para experimentar nosso serviço. Se não estiver
                        satisfeito, pode solicitar o cancelamento sem nenhum custo adicional. Seu estorno será efetuado em até 3 dias úteis.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        10. Não consigo utilizar o QR Code, posso usar o link do site em outros lugares?
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Claro! Se você não puder utilizar o QR Code, pode compartilhar o link do seu site em outros
                        lugares, como na bio do Instagram, no status do WhatsApp ou em qualquer outra plataforma. Assim,
                        seus clientes acessam suas informações com a mesma facilidade.
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
</body>

</html>
