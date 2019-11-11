# ESTE PROJETO ESTÁ USANDO DOCKER

Antes de prosseguir, instale o docker e o docker-compose.

Segue abaixo informações para rodar o projeto:

Depois de clonar este repositório para sua máquina em uma pasta de sua escolha, rode os seguintes comandos:

Entre na pasta escolhida

```
cd <nome-da-pasta-escolhida>
```

Rodamos o comando abaixo para montar o container

```
docker-compose up -d
```

Acessamos o container:

```
docker container exec -it apiphpcontelemelhorrota_conteleapp_1 bash
```

Rodamos os comando para a instalação da pasta vendor

```
composer install
```

Fazemos a cópia do .env.example para o .env

```
cp .env.example .env
```

Damos permissão de escrita na pasta storage

```
chown 755 -R storage/
```

## Testando a API

Escolha um programa para testar a API, pode-se usar o Postman ou Insomnia.

Crie um requisição do tipo GET para o seguinte endereço:

```
http://localhost:8001/api/v1/
```

Passando os seguintes parâmetros após a barra:

```
Source: uma letra entre A e E
Target: uma letra entre A e E
Autonomia: valor inteiro de quilometros por litro
Valor do combustível: valor float do valor do combustível
```

Ex:

```
http://localhost:8001/api/v1/A/D/10/2.5
```

Retorno:

{
"error": false,
"message": "A melhor rota é: A, B, D com custo de R\$ 6.25"
}
