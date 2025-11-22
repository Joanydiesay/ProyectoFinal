document.getElementById("convertBtn").addEventListener("click", function () {
    const cantidad = parseFloat(document.getElementById("amount").value);
    const monedaDesde = document.getElementById("from").value;
    const monedaHacia = document.getElementById("to").value;

    const tasaCambio = {
        usd: { sol: 3.75, mxn: 18.8, cad: 1.26 },
        sol: { usd: 0.27, mxn: 5.02, cad: 0.34 },
        mxn: { usd: 0.053, sol: 0.20, cad: 0.067 },
        cad: { usd: 0.79, sol: 2.94, mxn: 14.9 },
    };

    const montoConvertido = cantidad * tasaCambio[monedaDesde][monedaHacia];

    document.getElementById("result").innerHTML = `${cantidad.toFixed(2)} ${monedaDesde.toUpperCase()} = ${montoConvertido.toFixed(2)} ${monedaHacia.toUpperCase()}`;
});
