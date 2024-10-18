function operacion(){
    let num1 = parseFloat(document.getElementById("num1").value);
    let num2 = parseFloat(document.getElementById("num2").value);
    let tipope = document.getElementById("tipo").value.toLowerCase();
    let operacionStr = "";
    let ope;

    if (isNaN(num1) || isNaN(num2)) {
        document.getElementById("resultado").innerHTML = "<h2>Por favor ingresa números válidos.</h2>";
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
    }

    document.getElementById("resultado").innerHTML = `<h2>${operacionStr} = ${ope}</h2>`;
}