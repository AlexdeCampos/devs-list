# Projeto para cadastro de desenvolvedores

## Requisitos mínimos:
- PHP versão 7.4.0 
- Composer versão 2.0.8
- Node.js versão 10.19.0
- Npm versão 6.9.0 
- Banco de dados Mysql/MariaDb
## Instruções de uso:

- Faça o clone do repositório;
- Abra o seu terminal na raiz do projeto e execute a sequência de comandos a seguir:

## Intalação
```sh
$ composer install

$ npm install

$ npm run dev

$ php artisan serve
```
## Migração  do banco de dados
``` sh
$ php artisan migrate
```
## Testes 
``` sh
$ php artisan test
```
# Acesso a aplicação
- **[Web](http://127.0.0.1:8000/developers)**
- **[API](http://127.0.0.1:8000/api/developers)**

# Consumo das API's

## Listar desenvolvedores
Método: GET

URL : http://127.0.0.1:8000/api/developers/?p={pagina}&q={totalDeItens}

Retorno:
```json
{
  "pagination": {
    "page": 1,
    "quantity": 10,
    "pages": 4
  },
  "data": [
    {
      "id": 1,
      "nome": "Alex",
      "sexo": "M",
      "idade": 21,
      "hobby": "Tocar guitarra",
      "datanascimento": "1999-07-16"
    },
    ...
  ],
  "message": "Sucesso!!"
}
```
## Retornar desenvolvedor específico
Método: GET

URL : http://127.0.0.1:8000/api/developers/{idDesenvolvedor}
Retorno:
```json
{
  "data": {
    "id": 5,
    "nome": "Alex",
    "sexo": "M",
    "idade": 21,
    "hobby": "Tocar guitarra",
    "datanascimento": "1999-07-16"
  },
  "message": "Success!"
}
```
## Cadastrar Desenvolvedor
Método: POST

Requisição:
```json
{
	"nome": "Alex",
	"sexo": "M",
	"idade": 21,
	"hobby": "Tocar guitarra",
	"datanascimento": "1999-07-16"
}
```
Retorno: 
```json
{
  "data": {
    "nome": "Alex",
    "sexo": "M",
    "idade": 21,
    "hobby": "Tocar guitarra",
    "datanascimento": "1999-07-16",
    "id": 1
  },
  "message": "Sucesso!"
}
```

## Editar desenvolvedor
Método: PUT

URL: http://127.0.0.1:8000/api/developers/{idDesenvolvedor}

Requisição:
```json
{
	"nome": "Alex",
	"sexo": "M",
	"idade": 21,
	"hobby": "Tocar guitarra",
	"datanascimento": "1999-07-16"
}
```
Retorno: 
```json
{
  "data": {
    "nome": "Alex",
    "sexo": "M",
    "idade": 21,
    "hobby": "Tocar guitarra",
    "datanascimento": "1999-07-16",
    "id": 1
  },
  "message": "Sucesso!"
}
```

## Excluir desenvolvedor
Método: DELETE

URL : http://127.0.0.1:8000/api/developer/{idDesenvolvedor}

Retorno: 
```json
{
  "data": [],
  "message": "Desenvolvedor excluído com sucesso!!"
}
```
