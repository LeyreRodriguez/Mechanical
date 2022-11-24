document.getElementById("vehiculosIcon").addEventListener("click", vehiculosFun);
document.getElementById("clientesIcon").addEventListener("click", clientesFun);
document.getElementById("facturasIcon").addEventListener("click", facturasFun);
document.getElementById("vehiculosInfo").addEventListener("click", vehiculosFun);
document.getElementById("clientesInfo").addEventListener("click", clientesFun);
document.getElementById("facturasInfo").addEventListener("click", facturasFun);
document.getElementById("reparacionIcon").addEventListener("click", reparacionFun);
document.getElementById("reparacionInfo").addEventListener("click", reparacionFun);

window.addEventListener("resize", anchoPage);

var principal = document.querySelector(".principal");
var clientes = document.querySelector(".clientes");
var facturas = document.querySelector(".facturas");
var reparacion = document.querySelector(".reparacion");

function anchoPage(){

    principal.style.display = "block";
    clientes.style.display = "none";
    facturas.style.display = "none";
    reparacion.style.display = "none";
    principal.style.opacity = "1";
    clientes.style.opacity = "0";
    facturas.style.opacity = "0";
    reparacion.style.opacity = "0";
}

anchoPage();

    function vehiculosFun(){
            principal.style.display = "block";
            clientes.style.display = "none";
            facturas.style.display = "none";
            reparacion.style.display = "none";
            principal.style.opacity = "1";
            clientes.style.opacity = "0";
            facturas.style.opacity = "0";
            reparacion.style.opacity = "0";
        
    }

    function clientesFun(){
        principal.style.display = "none";
        clientes.style.display = "block";
        facturas.style.display = "none";
        reparacion.style.display = "none";
        principal.style.opacity = "0";
        clientes.style.opacity = "1";
        facturas.style.opacity = "0";
        reparacion.style.opacity = "0";
        
    }

    function facturasFun(){
        principal.style.display = "none";
        clientes.style.display = "none";
        facturas.style.display = "block";
        reparacion.style.display = "none";
        principal.style.opacity = "0";
        clientes.style.opacity = "0";
        facturas.style.opacity = "1";
        reparacion.style.opacity = "0";
        
    }

    function reparacionFun(){
        principal.style.display = "none";
        clientes.style.display = "none";
        facturas.style.display = "none";
        reparacion.style.display = "block";
        principal.style.opacity = "0";
        clientes.style.opacity = "0";
        facturas.style.opacity = "0";
        reparacion.style.opacity = "1";
        
    }
