function operacion(){
    let num1, num2, tipope, operacionStr, ope;

    num1 = parseFloat(document.getElementById("num1").value);
    num2 = parseFloat(document.getElementById("num2").value);
    tipope = document.getElementById("tipo").value.toLowerCase();
    operacionStr = "";

    if (isNaN(num1) || isNaN(num2)) {
        alert("Ingrese solo numeros, por favor.");
        return;
    }

    switch(tipope) {
        case "suma":
            ope = num1 + num2;
            operacionStr = `${num1} + ${num2}`;
            break;
        case "resta":
            ope = num1 - num2;
            operacionStr = `${num1} - ${num2}`;
            break;
        case "multiplicacion":
            ope = num1 * num2;
            operacionStr = `${num1} * ${num2}`;
            break;
        case "division":
            if (num2 === 0) {
                document.getElementById("resultado").innerHTML = "<h2>No se puede dividir por 0.</h2>";
                return;
            } else {
                ope = num1 / num2;
                operacionStr = `${num1} / ${num2}`;
            }
            break;
        default:
            document.getElementById("resultado").innerHTML = "<h2>Operacion no valida.</h2>";
            return;
    }

    document.getElementById("resultado").innerHTML = `<h2>${operacionStr} = ${ope}</h2>`;
}