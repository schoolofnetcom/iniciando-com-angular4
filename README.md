# CakePHP Quasar

## Instalação

1. Baixe [Composer](http://getcomposer.org/doc/00-intro.md) ou atualize `composer self-update`.
2. Baixe ou clone este repositório.

Instale as dependências rodando o seguinte comando dentro do diretório raíz do projeto

```bash
composer install
```

Configure o banco de dados editando o arquivo `config/app.php` a partir da linha 220 e rode (a partir da raiz do projeto) os arquivos de migration do banco`(vai criar o banco de dados):


```bash
bin/cake migrations migrate
```

Rode o servidor PHP Built-In server ou com apache, nginx ou servidor de sua preferência. Aqui para usar o servidor embutido:

```bash
bin/cake serve
```

Acesse `http://localhost:8765/products` para testar.

## Requisitos

Para ver os requisitos do CakePHP 3: [https://book.cakephp.org/3.0/en/installation.html](https://book.cakephp.org/3.0/en/installation.html)

## Observação

Você também pode usar seu próprio servidor RESTful, faça as alterações devidas durante o curso.