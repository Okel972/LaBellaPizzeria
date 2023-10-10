// const currentLocation = location.href;
// const menuItem = document.querySelectorAll('.nav__link');
// const menuLength = menuItem.menuLength
// for (let i = 0; i < menuLength; i++) {
//     if(menuItem[i].href === currentLocation) {
//         menuItem[i].className = "active"
//     }
// }





const hamburgerButton = document.querySelector(".nav-toggler")
const navigation = document.querySelector("nav")

hamburgerButton.addEventListener("click", toggleNav)

function toggleNav() {
    hamburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}