class Principal {
    constructor() {

    }
    linkPrincipal(link) {
        switch (link) {
            case PATHNAME + "Principal/principal":
                document.getElementById("enlace1").classList.add('active');
                break;
                case PATHNAME+"Usuarios/usuarios":
                    document.getElementById("enlace2").classList.add('active');
                    
                 break;

        }
    }
}