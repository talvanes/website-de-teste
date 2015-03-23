// Criar um elemento em cada página que mostrará a data no cabeçalho da página
MESES = ["janeiro",
    "fevereiro",
    "março",
    "abril",
    "maio",
    "junho",
    "julho",
    "agosto",
    "setembro",
    "outubro",
    "novembro",
    "dezembro"
];
DIAS_SEMANA = ["Domingo",
    "Segunda-feira",
    "Terça-feira",
    "Quarta-feira",
    "Quinta-feira",
    "Sexta-feira",
    "Sábado"
];

function criarElementoData() {
  // criar um <p> dentro de <header>
  var conteinerDeData = document.createElement("p");
  // algumas propriedades...
  conteinerDeData.className = "data round-border n3-back-color n3-fore-color";
  // data de hoje
  var hoje = new Date();
  var formato = "<strong class='main-back-color main-fore-color round-border'>" + DIAS_SEMANA[hoje.getDay()] + 
          "</strong> " + hoje.getDate() + 
          " de " + MESES[hoje.getMonth()] + 
          " de " + hoje.getFullYear();
  conteinerDeData.innerHTML = formato;
  // incluir no header
  document.querySelector("header").appendChild(conteinerDeData);
}
function acompanharDataDeHoje() {
  // criando o elemento
  criarElementoData();
  // atualizar a no painel data todo segundo
  setInterval(function(){
    // data de hoje
    var hoje = new Date();
    var formato = "<strong class='main-back-color main-fore-color round-border'>" + DIAS_SEMANA[hoje.getDay()] + 
            "</strong> " + hoje.getDate() + 
            " de " + MESES[hoje.getMonth()] + 
            " de " + hoje.getFullYear();
    document.querySelector("header p").innerHTML = formato;
  }, 1000);
}

/*
	LocalStorage: armazenamento local, melhor do que cookies!
*/
function salvarNome(){
	var usuario = document.getElementById("username");
	localStorage["nome"] = usuario.value;
}

function exibirNome(){
        var userForm = document.getElementById("user-form");
	var welcomeMsg = document.getElementById("welcome-user");
	if (localStorage["nome"] !== null && localStorage["nome"] !== undefined){
                userForm.style.display = "none";
		welcomeMsg.style.display = "block";
		welcomeMsg.querySelector("p").innerHTML = "Bem-vindo(a) de volta, <strong>" + localStorage["nome"] + "</strong>";
		criarLinkLimpar(welcomeMsg.querySelector("p"));
	} else {
		userForm.style.display = "block";
                welcomeMsg.style.display = "none";
	}
}

function criarCaixaUsuario(){
        // capturar user-form
        var userForm = document.getElementById("user-form");
	// capturar componente welcome-user (mensagem de boas-vindas)
	var welcomeMsg = document.getElementById("welcome-user");
	// criar o texto da mensagem
	var msgUsuario = welcomeMsg.querySelector("p");
	
	if (typeof(Storage) !== "undefined") {
		/* o recurso é suportado */
		if(document.getElementById("username").value !== "" && localStorage["nome"] !== null){
                        // esconder o formulário user-form
                        userForm.style.display = "none";
			// mostrar mensagem de boas-vindas
			welcomeMsg.style.display = "block";
			// salvar o nome do usuário...
			salvarNome();
			// .. e exibir abaixo:
			msgUsuario.innerHTML = "Bem-vindo(a) de volta, <strong>" + localStorage["nome"] + "</strong>";
			criarLinkLimpar(msgUsuario);
		} else {
			welcomeMsg.style.display = "none";
		}
	} else {
		msgUsuario.innerHTML = "Recurso não suportado...";
	}
}

function carregarDadosDeUsuario(){
	// para carregar os dados de usuário
	exibirNome();
}

function criarLinkLimpar(elemento){
	/* agora, vamos criar um link com evento embutido */
	var linkLimparUsuario = document.createElement("a");
	// algumas propriedades
	linkLimparUsuario.className = "main-fore-color";
	linkLimparUsuario.style.marginLeft = "0.5em";
	linkLimparUsuario.href = "#";
	linkLimparUsuario.innerHTML = "Não é você?";
	// evento limpar usuário
	linkLimparUsuario.onclick = limparTudo;
	elemento.appendChild(linkLimparUsuario);
}

function limparTudo() {
        document.getElementById("welcome-user").style.display = "none";
        document.getElementById("user-form").style.display = "block";
	localStorage.clear();
	window.location.reload();
}