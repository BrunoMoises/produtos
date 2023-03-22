# Pedidos

Este projeto é um sistema de gerenciamento de pedidos que permite adicionar, editar, excluir e visualizar produtos, com inserção de imagens no produto. Além de permitir criar um pedido podendo adicionar 1 ou mais produtos no pedido, e também a possibilidade de excluir um pedido. O projeto foi desenvolvido utilizando PHP e armazena as informações em um banco de dados MySQL.
<br><br>

### Requisitos
Antes de começar a utilizar o projeto, você precisará ter o seguinte instalado em sua máquina:

<ul>
    <li>Servidor web (Recomendado Apache)</li>
    <li>PHP 7.0 ou superior</li>
    <li>Banco de dados MySQL</li>
</ul>
É recomendado a utilização do software XAMPP que já inclui todas as instalações descritas.
<br><br>

### Instalação
1. Clone o projeto do GitHub:

~~~bash
git clone https://github.com/BrunoMoises/produtos.git
~~~~

2. Crie um banco de dados MySQL e rode o script inserido no arquivo `Public/docs/criacao-banco.sql` incluído no projeto.

3. Se necessário configure as informações de acesso ao banco de dados nos arquivos dentro de `App/Model`.

4. Configure o seu servidor web para apontar para o diretório raiz do projeto.

5. Acesse o sistema no navegador usando o endereço `http://seu-dominio.com` (Se utilizado o XAMPP basta acessar `http://localhost/pedidos`).
<br><br>

### Utilização

Ao acessar o sistema, você será direcionado para a página inicial do sistema onde poderá adicionar, editar, excluir e visualizar produtos.
Tendo um menu de navegação no cabeçalho para alternar para a tela de pedidos.
<br><br>

### Conclusão
Este projeto é uma boa opção para quem precisa de um sistema de gerenciamento de produtos e pedidos rápido de configurar.

Se tiver alguma dúvida ou precisar de ajuda, por favor, não hesite em abrir uma issue no GitHub.