// fonction qui permet de naviguer entre les différentes catégories dans Carte.php
function loadCategory(category) {
    let iframe = document.getElementById('menu-iframe');
    iframe.src = 'Menu.php?category=' + category;
}