// References of HTML elements 
const btnLogin = document.getElementById('btnLogin');
const loginError = document.getElementById('loginError');


firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      // User is signed in
      // Get page link parameters 
      var searchParams = new URLSearchParams(window.location.search);
      // Get href value 
      var refValue = searchParams.get('ref');
      //Redirect 
      location.href = refValue ? refValue : 'index.php';
    } else {
      // User is signed out
      // Monitor if someone clicked the login button
      btnLogin.addEventListener('click', login);
    }
  });

// Monitor click in login button
btnLogin.addEventListener('click', login);

// Functions to make login 
function login() {

    // Refence to login provider
    const provider = new firebase.auth.GoogleAuthProvider();

    firebase.auth()
    .signInWithPopup(provider)
    .then((userData) => {
        // Se deu certo...
        console.log(userData);
    })
    .catch((error) => {
        // Se algo der errado...
        // Exibe mensagem de alerta para o usuário
        loginError.innerHTML = "Oooops! Algo deu errado. Por favor, tente mais tarde.";
        loginError.style.display = 'block';
        // Exibe o erro técnico no console do JavaScript
        console.error(error);
    });
}
