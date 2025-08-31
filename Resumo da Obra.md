Bem, adicionando alguns comentários extras:


Foi minha primeira vez utilizando laravel, redis, ambientação Linux (Utilizei WSL 2 com Ubuntu por conta do tempo, conheço um pouco de Linux mas nunca fui adepto por alguns motivos a parte) Do prazo passei metade mais estudando, lendo sobre e testando algumas coisas envolvendo cada um. O único requisito que eu conhecia era o S3 da Amazon.

Tentei criar uma conta nova gratuita para utilizar mas tive problemas em relaçao a forma de pagamento, tentei com S3 da Amazon, CLoudFlare R2, BackBlaze, mas nenhum deu certo, de alternativo eu fui por um método mais prático e menos doloroso para adicionar a função de imagem dos livros, via URL.

Tive bastantes conflitos com pdf envolvendo composer mas acredito ter resolvido no final (se gerou um pdf eu considerei que ele funcionou depois de horas da madrugada tentando entender porquê uma biblioteca fazia o resto parar de funcionar).

O banco MySQL eu fiz no próprio WSL usando localhost, não tinha um requisito técnico envolvendo banco em nuvem ou hospedado em algum local.

Caminho do projeto também está como localhost pelo mesmo motivo.

Tive bastante conflitos envolvendo nomes (tentei usar nomes em português mas depois de pesquisa entendi que o laravel utiliza muito de sintaxe para automatizar as coisas e refiz banco e controllers e models algumas vezes até aceitar isso).

Adicionei algumas coias a mais no projeto por achar que faria sentido no escopo como:

Dashboard para User e Admin, assim como alguém vai emprestar livros da biblioteca, alguém via administrar tudo, adicionar livros, editar ou excluir usuários que não fazem mais parte, gerar os relatórios sobre quantidade de livros e etc. 

Com isso acabei perdendo mais uns dias aprendendo sobre laravel breeze que autoamtiza a autenticação de usuários.

Tenho outro projeto que inicei por conta do que diz no desafio, inciei o projeto de biblioteca com php puro, tentei aplicar redis mas tive alguns problemas (esse projeto puro eu fiz no notebook do trabalho e não conseguia iniciar o serviço por bloqueio), deixei o que algumas tentativas em comentário.

Não sei se funcionam em si mas foi uma tentativa, por último no projeto sem o laravel tem mais a minha lógica de programação que foi solicitado no teste, como eu pensei em montar o projeto (faltou as views porquê achei bom tentar fazer e focar no projeto usando laravel já que era requisito), acabei não fazendo as views mas acredito que a parte do back end (espero) esteja
funcional ou pelo menos com uma lógica aceitável.
