// Mostrar mensaje de éxito si se registró un gasto
if (localStorage.getItem("success") === "1") {
    const mensaje = document.getElementById("mensaje");
    mensaje.style.display = "block";

    setTimeout(() => {
        mensaje.style.display = "none";
        localStorage.removeItem("success");
    }, 3000);
}

// Validación adicional del formulario
document.getElementById("formGasto").addEventListener("submit", function(e) {
    const monto = document.querySelector("input[name='monto']").value;

    if (monto <= 0) {
        alert("El monto debe ser mayor que 0.");
        e.preventDefault();
        return;
    }
});