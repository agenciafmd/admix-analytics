## F&MD - Analytics

![Área Administrativa](https://github.com/agenciafmd/admix-analytics/raw/master/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-analytics.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-analytics)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Dados do Google Analytics no Dashboard

## Instalação

```
composer require agenciafmd/admix-analytics:dev-master
```

## Configuração

Vá para o [Google Developers Console](https://console.developers.google.com/apis/dashboard)

Crie um projeto chamado **FMD** (este será utilizado para os próximos clientes)

![Criação do Projeto](https://github.com/agenciafmd/admix-analytics/raw/master/docs/criar-projeto.png "Criação do Projeto")

Clique em **Ativar API e Serviços** e ative o **Analytics API**

Vá em **Credenciais** » **Criar credenciais** » **Chave da conta de serviço**

![Criação da Chave de Acesso](https://github.com/agenciafmd/admix-analytics/raw/master/docs/chave-p12.png "Criação da Chave de Acesso")

Guarde o **email** criado e salve o arquivo json em (atenção para o nome do arquivo *service-account-credentials.json*)

```
storage_path('app/analytics/service-account-credentials.json')
```

Vá para o [Google Analytics](https://analytics.google.com/), escolha o cliente e vá em **Administração**

Clique em **Gerenciamento de usuários**

![Gerenciamento de Usuários](https://github.com/agenciafmd/admix-analytics/raw/master/docs/analytics01.png "Gerenciamento de Usuários")

Adicione o email gerado anteriormente e permita somente leitura e analise

![Acrescentar conta](https://github.com/agenciafmd/admix-analytics/raw/master/docs/analytics02.png "Acrescentar conta")

Clique em **Visualizar Configurações**

![Visualizar Configurações](https://github.com/agenciafmd/admix-analytics/raw/master/docs/analytics03.png "Visualizar Configurações")

Copie o **ID da Vista de Propriedade** (**view_id**)

![ID da Vista de Propriedade](https://github.com/agenciafmd/admix-analytics/raw/master/docs/analytics04.png "ID da Vista de Propriedade")

Acrescente no arquivo `.env`

```
ANALYTICS_VIEW_ID=123456
```

## Relatório Semanal

![Relatorio Semanal](https://github.com/agenciafmd/admix-analytics/raw/master/docs/relatorio.png "Relatório Semanal")

Semanalmente, enviamos um relatório para os usuários cadastrados no painel.

Não esqueça de publicar as imagens no seu projeto com o comando. 

```
php artisan vendor:publish --force --tag=admix-analytics:assets
```

## Customização

Caso seja **extremamente** necessário, é possivel a configuração do pacote no arquivo `config/analytics.php`

Para isso, publique o arquivo com o comando abaixo:

```
php artisan vendor:publish --provider="Agenciafmd\Analytics\Providers\AnalyticsServiceProvider" --tag="config"
```
