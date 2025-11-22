const unidades = ["", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
const decenas = ["", "diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
const especiales = ["diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve"];
const centenas = ["", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];
const miles = ["", "mil", "dos mil", "tres mil", "cuatro mil", "cinco mil", "seis mil", "siete mil", "ocho mil", "nueve mil"];

function convertirNumero() {
    console.log("Función convertirNumero llamada");
    let numero = parseInt(document.getElementById('numero').value);
    if (isNaN(numero) || numero < 1 || numero > 99999) {
        document.getElementById('resultado').textContent = "Por favor, ingrese un número válido entre 1 y 99999.";
        return;
    }
    let letras = convertirALetras(numero);
    document.getElementById('resultado').textContent = letras.charAt(0).toUpperCase() + letras.slice(1);
}

function convertirALetras(numero) {
    if (numero === 100000) return "cien mil";
    
    let resultado = "";
    let milesTexto = Math.floor(numero / 1000);
    let centenasTexto = Math.floor((numero % 1000) / 100);
    let decenasTexto = Math.floor((numero % 100) / 10);
    let unidadesTexto = numero % 10;

    if (milesTexto > 0) {
        resultado += miles[milesTexto] + " ";
    }

    if (centenasTexto > 0) {
        if (centenasTexto === 1 && (numero % 1000) === 0) {
            resultado += "cien ";
        } else {
            resultado += centenas[centenasTexto] + " ";
        }
    }

    if (decenasTexto === 1 && unidadesTexto !== 0) {
        resultado += especiales[unidadesTexto] + " ";
    } else if (decenasTexto > 0) {
        resultado += decenas[decenasTexto] + " ";
    }

    if (unidadesTexto > 0) {
        resultado += unidades[unidadesTexto];
    }

    return resultado.trim();
}
