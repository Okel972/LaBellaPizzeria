const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active-wrapper');
})

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active-wrapper');
})