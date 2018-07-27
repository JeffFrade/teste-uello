# Teste Uello

Pré requisitos:
- 
- PHP >= 7.1.3
- MySQL >= 5.7

Rodar aplicação
-

- Instalar dependências do composer:
```bash
> composer install
```

- Copiar o `.env.example` para `.env`
- Gerar a chave da aplicação:
```bash
> php artisan key:generate
```

- Prenncher os dados do banco de dados no `.env`
- Colocar a key da API do Google `.env`

- Rodar as migrations e seeds:
```bash
> php artisan migrate:fresh --seed
```

- Rodar a aplicação:
```bash
> php artisan serve
```

Login
-
- E-mail: `admin@mail.com`
- Senha: `123`