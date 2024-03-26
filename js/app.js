document.addEventListener("DOMContentLoaded", function() {
    let imgContainer = document.querySelector(".img-container");
    if (imgContainer) { // Verifica si se encontró el contenedor
        setInterval(() => {
            if (imgContainer.children.length > 1) {
                let first = imgContainer.firstElementChild;
                
                imgContainer.removeChild(first);
                imgContainer.appendChild(first);
            }
        }, 2500);
    } else {
        console.error("No se encontró el contenedor .img-container.");
    }
});
