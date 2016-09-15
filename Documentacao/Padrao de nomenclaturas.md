#Padrão de nomenclatura (english only!)

##Nomes de arquivos
* utiliza notação camelCase
* nome do arquivo deve ser igual ao nome do Model, Controller e conter letra maiuscula no começo.
* nome do model sempre deve ser NomeModel. Ex. UserModel. (singular)
* nome do controller sempre deve ser NomeController. Ex. UsersController (plural)

* Evitar acentos, mesmo que o contexto permita como em nomes de arquivos. 

* Evitar espaços, mesmo que o contexto permita
* Evite abreviar a não ser em casos já conhecidos. ex. CPF, UF.
* Preposições devem normalmente ser omitidas.
* Comentar código quando necessário!

##Variáveis
* Nome da variável deve dizer claramente o que a variável é e faz
* Variáveis do tipo boolean devem receber nomes que impliquem verdadeiro ou falso acabou, ok, feito, sucesso
* Não utilizar nomes temporários ou nomes que não guardam significado temp1, temp2, var1, var2, xx4.
* Passar dados de formularios com array dentro de array ex: $data['tipoConteudo']

##Classes e objetos
* Nome de objeto, singular. Listas, plural. Ex: Objeto obj, List<Objeto> objs.
* Nome de classes, letra inicial maiúscula e nomeclatura CamelCase.

##Funções
* Nome do método não deve conter o nome da classe na qual ele se aplica
* Receber paremetro da rota pelo metodo do controller ex: function buscaCep($param) {}

##JS
* Reutilizar o maximo de funções possiveis
* Criar arquivos externos
* Não usar PHP no JS
* Dividir arquivos por modulos do sistema

##CSS
* Não alterar códigos do Framework
* Utilizar CSS sempre em arquivos externos

##Outros
* Comentar códigos. Formato: data, autor e comentario
* Estilo de comentário: 
* /**
*  * Gabriel - 10-10-2016 - Validação de Cep
*  * @param cpf - O cpf que será validado
*  * @return - se o cpf é válido ou não
*  */
*  function validaCep($cep) {}

##Controller
<code>
index(){ }

New(){ }

Create(){ }

Edit(){ }

Update(){ }

Delete(){ }


</code>








