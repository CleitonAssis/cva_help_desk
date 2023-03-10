const tbody = document.querySelector(".listar-usuarios");
/*const cadForm = document.getElementById("cad-usuario-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));*/

const listarUsuarios = async (pagina) => {
    const dados = await fetch("./list.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarUsuarios(1);

/*cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    document.getElementById("cad-usuario-btn").value = "Salvando...";

    if(document.getElementById("nome").value === ""){
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>";
    }else if(document.getElementById("email").value === ""){
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>";
    }else{
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
        
        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm,
        });
    
        const resposta = await dados.json();
        
        if(resposta['erro']){
            msgAlertaErroCad.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();
            cadModal.hide();
            listarUsuarios(1);
        }
    }    
    
    document.getElementById("cad-usuario-btn").value = "Cadastrar";
});*/

async function visUsuario(id){
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    }else{
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();

        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("nomeUsuario").innerHTML = resposta['dados'].nome;
        document.getElementById("emailUsuario").innerHTML = resposta['dados'].email;
    }

}