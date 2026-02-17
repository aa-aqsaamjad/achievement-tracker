const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signUpForm = document.getElementById('signup');
const signInForm = document.getElementById('signin');

signUpForm.classList.add('active');
signInForm.classList.remove('active');

signInButton.addEventListener('click', (e) => {
    e.preventDefault();
    signUpForm.classList.remove('active');
    signInForm.classList.add('active');
});

signUpButton.addEventListener('click', (e) => {
    e.preventDefault();
    signInForm.classList.remove('active');
    signUpForm.classList.add('active');
});