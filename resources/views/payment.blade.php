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
    <script src="https://sdk.mercadopago.com/js/v2"></script>
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
            background-color: #96d65a;
            color: #000000;
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
            <a class="navbar-brand" href="#"><img src="{{ asset('/storage/images/core/logo.png') }}"
                    alt="" class="img-fluid" style="max-width: 80px;"></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
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
        <h1 class="text-center mb-3">Work Off — Fuja das taxas!</h1>
        <h6 class="text-center text-success mb-3 mb-lg-3"><i class="fas fa-lock"></i> Conclua seu pagamento e receba seu
            QR Code + link.</h6>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-7 text-center">
                <div id="paymentBrick_container"></div>

                <div id="statusScreenBrick_container"></div>
            </div>
        </div>
    </div>

    <footer class="text-center my-3">
        <div class="container bg-transparent">
            <div class="row justify-content-end align-items-center">
                <div class="col-12 col-lg-4 text-center">
                    <p class="mb-0 text-white">Work Off — 2024.</p>
                </div>
                <div class="col-12 col-lg-4 text-center text-lg-end mt-3 mt-lg-0">
                    <div class="d-flex gap-2 justify-content-center justify-content-lg-end align-items-center">
                        <a class="external-links" href="http://" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-instagram text-white" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334">
                                </path>
                            </svg>
                        </a>
                        <div class="vr text-white" style="opacity: 1;"></div>
                        <a class="external-links" href="http://" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-envelope text-white" viewBox="0 0 16 16">
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
    <script>
        const mp = new MercadoPago('{{ $public_key }}', {
            locale: 'pt'
        });
        const bricksBuilder = mp.bricks();
        const renderPaymentBrick = async (bricksBuilder) => {
            const settings = {
                initialization: {
                    /*
                      "amount" é a quantia total a pagar por todos os meios de pagamento com exceção da Conta Mercado Pago e Parcelas sem cartão de crédito, que têm seus valores de processamento determinados no backend através do "preferenceId"
                    */
                    amount: {{ $price }},
                    preferenceId: "{{ $preference->id }}",
                },
                customization: {
                    visual: {
                        style: {
                            theme: "default",
                        },
                    },
                    paymentMethods: {
                        creditCard: "all",
                        debitCard: "all",
                        ticket: "all",
                        bankTransfer: "all",
                        atm: "all",
                        onboarding_credits: "all",
                        wallet_purchase: "all",
                        maxInstallments: 3
                    },
                },
                callbacks: {
                    onReady: () => {
                        /*
                         Callback chamado quando o Brick está pronto.
                         Aqui, você pode ocultar seu site, por exemplo.
                        */
                    },
                    onSubmit: ({
                        selectedPaymentMethod,
                        formData
                    }) => {
                        // callback chamado quando há click no botão de envio de dados
                        return new Promise((resolve, reject) => {
                            fetch("/api/processar-pagamento/{{ $user_id }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    body: JSON.stringify(formData),
                                })
                                .then((response) => response.json())
                                .then((response) => {
                                    const renderStatusScreenBrick = async (bricksBuilder) => {
                                        const settings = {
                                            initialization: {
                                                paymentId: response
                                                    .id,
                                            },
                                            customization: {
                                                visual: {
                                                    hideStatusDetails: false,
                                                    hideTransactionDate: false,
                                                    style: {
                                                        theme: 'default',
                                                    },
                                                    texts: {
                                                        ctaReturnLabel: "Baixar meu QR Code",
                                                    },
                                                },
                                                backUrls: {
                                                    'error': "{{ route('home') }}",
                                                    'return': "{{ route('user', ['user_id' => $user_id, 'qr_code' => true]) }}"
                                                }
                                            },
                                            callbacks: {
                                                onReady: () => {
                                                    let statusBrick = document
                                                        .getElementById(
                                                            'statusScreenBrick_container'
                                                        );

                                                    statusBrick.scrollIntoView({
                                                        behavior: 'smooth'
                                                    });
                                                    setTimeout(() => {
                                                        alert('Você será redirecionado para seu QR Code.')
                                                        setTimeout(() => {
                                                            window.location.href = "{{ route('user', ['user_id' => $user_id, 'qr_code' => true]) }}";
                                                        }, 1000);                              
                                                    }, 1000);
                                                },
                                                onError: (error) => {},
                                            },
                                        };
                                        window.statusScreenBrickController =
                                            await bricksBuilder.create(
                                                'statusScreen',
                                                'statusScreenBrick_container',
                                                settings,
                                            );
                                    };
                                    renderStatusScreenBrick(bricksBuilder);
                                    resolve();
                                })
                                .catch((error) => {
                                    console.log(error)
                                    // manejar a resposta de erro ao tentar criar um pagamento
                                    reject();
                                });
                        });
                    },
                    onError: (error) => {
                        // callback chamado para todos os casos de erro do Brick
                        console.error(error);
                    },
                },
            };
            window.paymentBrickController = await bricksBuilder.create(
                "payment",
                "paymentBrick_container",
                settings
            );
        };
        renderPaymentBrick(bricksBuilder);
    </script>
</body>
