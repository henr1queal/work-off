# Work Off

Micro SaaS para motoristas de aplicativo (Uber, 99, etc.) gerarem um **QR Code** e uma **página pública de contato**. Passageiros escaneiam o código e veem telefone, WhatsApp, Pix, Instagram e uma mensagem personalizada — facilitando corridas particulares fora das plataformas.

Site em produção: [workoff.com.br](https://workoff.com.br)

---

## O que o produto faz

1. O motorista preenche um cadastro na landing page (foto, contatos, mensagem).
2. Escolhe um plano de assinatura (mensal, trimestral ou anual).
3. Paga via **Mercado Pago** (Pix, cartão ou boleto).
4. Após confirmação do pagamento, a página fica ativa em `/qr-code/{id}`.
5. O motorista baixa o QR Code e exibe no carro, capacete ou cartão.
6. Passageiros escaneiam e acessam os dados de contato do motorista.

Sem plano ativo, a página mostra apenas o nome — os contatos ficam ocultos.

---

## Fluxo técnico (resumido)

```
Landing page → Cadastro (POST /new-user) → Checkout Mercado Pago
     → Webhook confirma pagamento → Plano ativado → Página pública + QR Code
```

| Etapa | Rota / componente |
|-------|-------------------|
| Landing page | `GET /` |
| Cadastro do motorista | `POST /new-user` → `UserController@store` |
| Checkout | `GET /efetuar-pagamento/{user_id}` → `MercadoPagoController@checkout` |
| Processamento do pagamento | `POST /api/processar-pagamento/{user_id}` |
| Webhook Mercado Pago | `POST /api/mercado-pago-webhook` |
| Página pública do motorista | `GET /qr-code/{user_id}` |
| Download do QR Code | `GET /qr-code/{user_id}?qr_code=1` |

---

## Stack

| Camada | Tecnologia |
|--------|------------|
| Backend | PHP 8.1+, Laravel 10 |
| Banco de dados | MySQL |
| Frontend | Blade, Bootstrap 5, jQuery |
| Pagamentos | Mercado Pago SDK (`mercadopago/dx-php`) |
| E-mail / leads | Brevo (API de contatos) |
| QR Code | [qrcodejs](https://github.com/davidshimjs/qrcodejs) (gerado no browser) |

---

## Modelo de dados

- **users** — perfil do motorista (nome, e-mail, foto, data de nascimento, mensagem)
- **phones** — até 2 telefones, com flag de WhatsApp
- **pix** — chave Pix
- **instagrams** — @ do Instagram
- **plans** — planos com preço e duração
- **plan_user** — assinatura do motorista (expiração + referência do pagamento no Mercado Pago)

---

## Como rodar

### Pré-requisitos

- PHP >= 8.1 (extensões: `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- Composer
- MySQL

### Passo a passo

```bash
# 1. Instalar dependências PHP
composer install

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 3. Editar .env com credenciais do banco e integrações (ver seção abaixo)

# 4. Criar banco e popular planos
php artisan migrate --seed

# 5. Link simbólico para upload de fotos
php artisan storage:link

# 6. Subir o servidor
php artisan serve
```

Acesse `http://localhost:8000`.

### Variáveis de ambiente

Além das configs padrão do Laravel (banco, mail), o projeto usa:

```env
# Mercado Pago
MP_ACCESS_TOKEN=
MP_PUBLIC_KEY=
MP_SECRET=

# Brevo (cadastro de leads)
BREVO_API_KEY=
```

> Para testar pagamentos localmente, é necessário expor o webhook (ex.: ngrok) apontando para `/api/mercado-pago-webhook`.

---

## Estrutura principal

```
app/
├── Http/Controllers/
│   ├── UserController.php        # Cadastro e página pública
│   └── MercadoPagoController.php # Checkout, pagamento e webhook
├── Models/                       # User, Phone, Pix, Instagram, Plan
└── Services/MercadoPagoService.php

resources/views/
├── lp.blade.php                  # Landing page + formulário de cadastro
├── user.blade.php                # Página pública + geração do QR Code
├── payment.blade.php             # Checkout Mercado Pago
├── faq.blade.php
└── about.blade.php

routes/
├── web.php                       # Rotas públicas
└── api.php                       # Pagamento e webhook
```

---

## Planos

| ID | Plano | Cobrança |
|----|-------|----------|
| 1 | Mensal | R$ 19,99 |
| 2 | Trimestral | R$ 16,99/mês (R$ 50,97 total) |
| 3 | Anual | R$ 14,99/mês (R$ 179,88 total) |

---

## Observações

- Projeto intencionalmente simples — MVP funcional, sem painel administrativo ou autenticação de motorista.
- Identificadores de usuário são UUIDs.
- O QR Code é gerado no client-side e aponta para a URL pública do perfil.
