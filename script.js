document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("openForm").addEventListener("click", function() {
        var formContainer = document.getElementById("formContainer");
        formContainer.style.display = "flex";
    });
    
    const i = document.getElementById("insert");
    if (i) {
        i.addEventListener("submit", function(event) {
            event.preventDefault();
        });
    }
});