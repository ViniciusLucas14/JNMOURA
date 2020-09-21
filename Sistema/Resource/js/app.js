// CODIGOS DE USUARIOS
var data_User = null
var usuarios = new Usuarios();
var loginUser = () => {
    var email = document.getElementById("email").value; //pega os dados do formulario a cada vez que executar o botao login
    var password = document.getElementById("password").value;
    usuarios.loginUser(email, password);
}

var sessionClose = () => {
    usuarios.sessionClose();
}

$(function () {
    $("#registerUser").click(function () {
        let nome = document.getElementById("nome").value; 
        let telefone = document.getElementById("telefone").value;
        let endereco = document.getElementById("endereco").value;
        if (nome != "" || telefone != "" || endereco != "") {
            usuarios.registerUser1(nome, telefone, endereco);
            return false;
        }
    });
    $("#registerClose").click(function (){
        this.Funcion = 0;
        this.idAgenda = data.idAgenda;
        var instance = M.Modal.getInstance($('#modal1'));
        instance.close();
        document.getElementById("nome").value ="";
        document.getElementById("telefone").value ="";
        document.getElementById("endereco").value ="";
        this.getUsers(null);
    });
    $("#registerClose").click(function (){
        usuarios.deleteUser(data_User);
        data_User = null;
    });
});


var getUsers = () => {
    var valor = document.getElementById("filtrarUser").value;
    usuarios.getUsers(valor);
}

var dataUser=(data)=>{
    usuarios.editUser(data);

}
var deleteUser = (data)=>{
    document.getElementById("userName").innerHTML = data.Nome;
    data_User = data;   
}
var principal = new Principal();

$().ready(() => {
    let URLatual = window.location.pathname;
    usuarios.userData(URLatual);
    principal.linkPrincipal(URLatual);
    $("#validate").validate(); 
    M.AutoInit();
    switch (URLatual) {
        case PATHNAME + "Principal/principal":

            break;
        case PATHNAME + "Usuarios/usuarios":
            getUsers();
            break;

    }
});