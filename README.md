## F&MD - Analytics

![Área Administrativa](https://github.com/agenciafmd/admix-analytics/raw/v10/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-analytics.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-analytics)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Dados do Laravel Umami no Dashboard

## Instalação

```
composer require agenciafmd/admix-analytics::v10.x-dev
```

O nosso `.env` ficará assim

```
UMAMI_URL=https://{yourserver}/api
UMAMI_USERNAME=xxxxxxxx@fmd.ag
UMAMI_PASSWORD="your-password"
UMAMI_SITE_ID="XXXXXXXXXXXXXXXXXXXXXXXX"
```

## Dados no frontend

Podemos usar os componentes abaixo para instalarmos

```html
<head>
    <script async src="https://analytics.fmd.ag/script.js"
            data-website-id="{{ config('analytics.site_id') }}"></script>
</head>
<body>
     ...
</body>
```
 
## Customização

Caso seja **extremamente** necessário, é possivel a configuração do pacote no arquivo `config/analytics.php`

Para isso, publique o arquivo com o comando abaixo:

```bash
php artisan vendor:publish --tag="admix-analytics:config"
```
