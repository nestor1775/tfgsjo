
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script principal cargado correctamente');

});


function showAlert(message, type = 'info') {

    alert(message);
}


function validateForm(formId) {

    const form = document.getElementById(formId);
    if (!form) return false;
    

    return true;
} 