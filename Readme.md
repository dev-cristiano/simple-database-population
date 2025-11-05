## Um sistema simples para popular banco de dados, utilizando as bibliotecas.
### - Libs
1. vlucas/phpdotenv para carregar variáveis de ambiente
2. fakerphp/faker para criar os dados fakes para serem inseridos no banco

### - Estou a utilizar Repository e Services para separação de responsabilidades e ainda aproveitando as novas funcionalidades do PHP 8+

### Para popular o meu banco, entro na pasta public e no terminal
``
    php index.php
``
### Lembrando que é preciso alterar as colunas no Service e na index, pois se não vai dar o erro de indice não encontrado.