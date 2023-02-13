//Função transformar letras em maiúsculas em tempo real no input
  function maiuscula(string){
    res = string.value.toUpperCase();
    string.value = res;
  }

//Desabilita o input categoria
  document.getElementById("btnCategoria").addEventListener("click", function(){
    document.getElementById("categoria").removeAttribute("disabled");
    document.getElementById("divCategoria").hidden= true;
    document.getElementById("categoria").value = "Selecione a categoria";
    
    document.getElementById("inputCategoria").removeAttribute("required");
    document.getElementById("inputCategoria").value = "";
  })

//Desabilita input setor
  document.getElementById("btnSetor").addEventListener("click", function(){
    document.getElementById("setor").removeAttribute("disabled");
    document.getElementById("divSetor").hidden = true;
    document.getElementById("setor").value = "Selecione o setor";

    document.getElementById("inputSetor").removeAttribute("required");
    document.getElementById("inputSetor").value = "";
  })


//Limpa input imagem
  document.getElementById("btnImg").addEventListener("click", function(){
    document.getElementById("imgUp").removeAttribute("src");
    document.getElementById("inputImg").value = "";
    document.getElementById("btnImg").hidden = true;
  })


//Remove botão fechar img
  function removerBtn() { 
    let valorBtn = document.getElementById("inputImg").value;
         
    if (valorBtn == ""){
      document.getElementById("btnImg").hidden = true;
    }else {
      document.getElementById("btnImg").hidden = false;
    }
  }


//Remove atributos e faz reset do formulário
  document.getElementById("btn-reset").addEventListener("click", function(){
    document.getElementById("categoria").removeAttribute("disabled");
    document.getElementById("divCategoria").hidden = true;

    document.getElementById("setor").removeAttribute("disabled");
    document.getElementById("divSetor").hidden = true;

    document.getElementById("btnImg").hidden = true;
    document.getElementById("imgUp").removeAttribute("src");
  })


//Desabilita o select e habilita o input categoria
  function validarForm() { 
    let optionSelect = document.getElementById("categoria").value;
         
    if (optionSelect == "" || optionSelect != "OUTRO"){
      //document.getElementById("inputCategoria").hidden = true;
      document.getElementById("inputCategoria").removeAttribute("name");
    }else if (optionSelect == "OUTRO") {
      document.getElementById("divCategoria").hidden = false;
      document.getElementById("inputCategoria").setAttribute("name", "categoria");
      
      document.querySelector("#categoria");
      categoria.setAttribute("disabled", "disabled");

      document.querySelector("#inputCategoria");
      inputCategoria.setAttribute("required", "required");
    }
  }


//Desabilita o select e habilita o input setor
  function validarForm2() { 
    let optionSelect = document.getElementById("setor").value;
         
    if (optionSelect == "" || optionSelect != "OUTRO"){
      //document.getElementById("inputSetor").hidden = true;
      document.getElementById("inputSetor").removeAttribute("name");
    }else if (optionSelect == "OUTRO") {
      document.getElementById("divSetor").hidden = false;
      document.getElementById("inputSetor").setAttribute("name", "setor");
      
      document.querySelector("#setor");
      setor.setAttribute("disabled", "disabled");

      document.querySelector("#inputSetor");
      inputSetor.setAttribute("required", "required");
    }
  }
