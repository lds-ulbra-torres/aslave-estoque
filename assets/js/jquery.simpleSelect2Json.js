(function ($) {
	/* simpleSelect2Json 0.1 16/09/2016

		Plugin jquery para simplificar o uso do plugin Select2(http://select2.github.io/) para utilização nos
		projetos do LDS(Laboratório de Desenvolvimeto de Sistemas) do Curso Superior de Análise e Desenv. de Sistemas
		da ULBRA Torres.

		@author Antoni Sganzerla (github: https://github.com/antonisganzerla )
		@author Heitor Gianastasio (github: https://github.com/heitor-gia )
	*/


	/*
	@param src 	: Uma string contendo o array JSON ou uma url para requisições GET que retornem um array JSON
	@param key 	: O nome do atributo do objeto JSON que será utilizada como chave na propiety "value" na tag HTML "option"
	@param text : O nome do atributo do objeto JSON que será utilizado como opção dentro da tag HTML "select"
	*/
	$.fn.simpleSelect2Json = function (src,key,text) {

		//Armazena-se a referencia do objeto em uma variavel para poder utilizar de dentro da função de requisição AJAX
		var obj = this;
		//Expressão Regular para URLs 
		var URLPattern = /((\w+:\/\/)[-a-zA-Z0-9:@;?&=\/%\+\.\*!'\(\),\$_\{\}\^~\[\]`#|]+)/g;
		//Idioma padrão
		var lang = "pt-BR"

		//Seleciona-se o esquema padrão de traduções da lib Select2
		$.fn.select2.defaults.set('amdBase', 'select2/');
		$.fn.select2.defaults.set('amdLanguageBase', 'select2/i18n/');


		//Teste para verficar se a fonto é uma URL ou outro tipo de string
		if(URLPattern.test(src)){
		
			//Inicializa-se o componente <select> 
			this.select2({
				//Idioma das mensagens do Select2, caso o arquivo de tradução brasileiro(pt-BR) esteja carregado,
				//as mensagens aparecerão em português brasileiro.
				language: lang,

				//Placeholder padrão, que desaparecerá assim que a lista for carregada
				placeholder:"Buscando..."
			});

			//Desativa-se o select enquanto é esperada a resposta da requisição
			this.prop('disabled',true);

			//Requisição para feita à URL passada no parametro src
			$.get(src, function( data ) {
				
				//Adiciona-se ao objeto <select> o resultado da função renderOptionList()
				obj.append(renderOptionList(data,key,text));

				//Reativa-se o objeto
				obj.prop('disabled',false);

			});

		} else {
			//Mesmo processo da linha 36, com excessão do place holder que não se torna necessário aqui
			this.select2({
				language : lang
			});
			//Desativa-se o objeto
			this.prop('disabled',true);

			try {
				//Transforma-se a string 'src' passada em uma lista de objetos. 
				//Caso a string contenha JSON inválido, o bloco 'catch' será chamado e o algoritmo interrompido
				var list = $.parseJSON(src);

				//Mesmo processo da linha 52
				obj.append(renderOptionList(list,key,text));
				//Reativa-se o objeto
				this.prop('disabled',false); 

			} catch(e) {

				//Mensagem de erro caso o JSON seja inválido
				console.error('Invalid JSON object!!');
			}

		}

		/*
		**@function renderOptionList
		**@description Transforma uma lista de objetos em uma string contendo
		**componentes <option> referentes a lista.
		**
		**@param list : Contém a lista de objetos que será renderizada.
		**@param key  : O nome do atributo do objeto JSON que será utilizada como chave na propiety "value" na tag HTML "option"
		**@param text : O nome do atributo do objeto JSON que será utilizado como opção dentro da tag HTML "select"
		**
		**
		**@return Retorna a string resultante da operação de renderização
		*/
		function renderOptionList (list,key,text) {
			//Inicializa-se a variável de resultado
			var result = "";
			
			//Verifica-se se o objeto 'list' é um Array
			if(list instanceof Array){
				//Caso seja, é feito um loop que concatena as strings com as tags <option> na string 'result'
				list.forEach(function(currentValue, index,arr){
					//Verifica-se se objeto atual possui as propriedades passadas em 'key' e 'text'
					//Caso não sejam encontradas o objeto não é renderizado
					if(key in currentValue && text in currentValue){
						//Concatena à 'result' a renderização do objeto
						result = result.concat("<option value='"+currentValue[key]+"'>"+currentValue[text]+'</option>');
					} else {
						//Mensagem de erro caso não sejam encontradas as propriedades
						console.error('The JSON object has not that propeties!');
					}
				});

			}else{
				//Mensagem de erro caso objeto não seja um array
				console.error('JSON object is not an Array!');
			}
			return result;
		}
	}
}(jQuery));
