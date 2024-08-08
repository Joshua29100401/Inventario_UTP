document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dataForm').addEventListener('submit', agregar);
});

function agregar(event) {
    event.preventDefault();

    var id = document.getElementById('validationCustom01').value;
    var usuario = document.getElementById('validationCustom02').value;

    if (!id || !usuario) {
        alert('Todos los campos son obligatorios.');
        return;
    }

    document.getElementById('dataForm').reset();
}
