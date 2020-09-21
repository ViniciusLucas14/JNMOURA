class Usuarios {
    constructor() {
        this.Funcion = 0;
        this.idAgenda = 0;
    }
    loginUser(email, password) { //ENVIA OS DADOS PARA O SERVIDOR
        if (email == "") {
            document.getElementById("email").focus();
            M.toast({ html: 'Insira um email', classes: 'rounded' });
        } else {
            if (password == "") {
                document.getElementById("password").focus();
                M.toast({ html: 'Insira uma senha', classes: 'rounded' });
            } else {
                if (validarEmail(email)) {
                    if (4 <= password.length) {
                        $.post(
                            "Index/loginUser",
                            { email, password },
                            (response) => {
                                console.log(response);
                                try {
                                    var item = JSON.parse(response);
                                    if (0 < item.idUsuario) {
                                        localStorage.setItem("user", response)//localStorage=objeto que permite invocar o método setItem que permitirá criar elementos que ficará armazenado no servidor
                                        window.location.href = URL + "Principal/principal";
                                    } else {
                                        document.getElementById("indexMessage").innerHTML = "Email ou senha incorretos";
                                    }
                                } catch (error) {
                                    document.getElementById("indexMessage").innerHTML = response;
                                }
                            }
                        );
                    } else {
                        document.getElementById("password").focus();
                        M.toast({ html: 'Insira uma senha com pelo menos 4 caracteres', classes: 'rounded' });
                    }

                } else {
                    document.getElementById("email").focus();
                    M.toast({ html: 'Insira um email válido', classes: 'rounded' });
                }

            }
        }
    }
 
    //AGENDA
    registerUser1(nome, telefone, endereco) {
        if (1 <= nome.length) {
            var data = new FormData(); 
            var url = this.Funcion == 0 ? "Usuarios/registerUser1" : "Usuarios/editUser"; //todo valor ao lado de ? recebe o valor que lhe sucede
            data.append('idAgenda', this.idAgenda);
            data.append('nome', nome);
            data.append('telefone', telefone);
            data.append('endereco', endereco);
            $.ajax({
                url: URL + url,
                data: data, //contem toda a informação da coleção de dados do usuario, 
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: (response) => {
                    if (response){
                        this.Funcion = 0;
                        this.idAgenda = data.idAgenda;
                        var instance = M.Modal.getInstance($('#modal1'));
                        instance.close();
                        document.getElementById("nome").value =""; //let é variavel local
                        document.getElementById("telefone").value ="";
                        document.getElementById("endereco").value ="";
                        this.getUsers(null);
                    }
                    document.getElementById("registerMessage").innerHTML = response;
                }
            });

        } else {
            document.getElementById("nome").focus();
            document.getElementById("registerMessage").innerHTML = "Insira um nome com mais de 1 caractere";
        }

    }
    userData(URLatual) {
        if (PATHNAME == URLatual) {
            localStorage.removeItem("user");
            document.getElementById('menuNavbar1').style.display = 'none';
            document.getElementById('menuNavbar2').style.display = 'none';
        } else {
            if (null != localStorage.getItem("user")) {
                let user = JSON.parse(localStorage.getItem("user"));
                if (0 < user.idUsuario) {
                    document.getElementById('menuNavbar1').style.display = 'block';
                    document.getElementById('menuNavbar2').style.display = 'block';
                    document.getElementById('name1').innerHTML = user.Nome;
                    document.getElementById('name2').innerHTML = user.Nome;
                }
            }
        }
    }
    getUsers(valor){
        var valor = valor != null ? valor : "";
        $.post(
            URL + "Usuarios/getUsers",  
            {
                filter: valor
            },
            (response) =>{  
                $("#resultUser").html(response);
            });
            
    }
    deleteUser(data){
        $.post(
            URL + "Usuarios/deleteUser",
            {
                idAgenda: data.idAgenda
            },
            (response) => {
                if (response == 0){
                    this.Funcion = 0;
                    this.idAgenda = data.idAgenda;
                    var instance = M.Modal.getInstance($('#modal1'));
                    var instance = M.Modal.getInstance($('#modal2'));
                    instance.close();
                    document.getElementById("nome").value =""; 
                    document.getElementById("telefone").value ="";
                    document.getElementById("endereco").value ="";
                    this.getUsers(null);
                }else{
                    document.getElementById("deteUserMessage").innerHTML = response;
                }
                console.log(response);
            });
    }
    editUser(data){
        this.Funcion = 1;
        this.idAgenda = data.idAgenda;
        document.getElementById("nome").value = data.Nome; 
        document.getElementById("telefone").value = data.Telefone;
        document.getElementById("endereco").value = data.Endereco;
    }
    
    sessionClose() {
        localStorage.removeItem("user");
        document.getElementById('menuNavbar1').style.display = 'none';
        document.getElementById('menuNavbar2').style.display = 'none';
    }
}