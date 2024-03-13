// Firebase configuration keys
const firebaseConfig = {
    apiKey: "AIzaSyACiGnqbqlzO78eTdv2zFjC_xRSyjA-15U",
    authDomain: "blog-helloword-5c270.firebaseapp.com",
    projectId: "blog-helloword-5c270",
    storageBucket: "blog-helloword-5c270.appspot.com",
    messagingSenderId: "598206520356",
    appId: "1:598206520356:web:41b62fbe1e9e21a962ccb1"
  };

  // Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Initialize Firebase Authentication and get a reference to the service
const auth = firebase.auth();

//Identify HTML elements to interaction
const userAccess = document.getElementById('userAccess');
const userImg = document.getElementById('userImg');
const userIcon = document.getElementById('userIcon');
const userLabel = document.getElementById('userLabel');
//Watch if happened changes in user authentication
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      // User is signed in
      // Call a function to set the logged user
      isLogged(user);
    } else {
      // User is signed out
      // Call a function to set the UNLOGGED 
      notLogged();
    }
  });


  function isLogged(user) {
    // Altera href do link
    userAccess.href = `profile.phpref=${location.href}`;
    // Altera title do link
    userAccess.title = `Ver perfil de ${user.displayName}`;  
    // Oculta o ícone de login
    userIcon.style.display = 'none';
    // Create image atributes based on user data 
    userImg.src = user.photoURL;
    userImg.alt = user.displayName;
    // Mostrar a imagem do usuário
    userImg.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Perfil';
  }

  function notLogged(){
    // Change link href
    userAccess.href = `login.php?ref=${location.href}`;
    // Change link title
    userAccess.title = 'Logue-se';
    // Change user image
    userImg.style.display = 'none';
    // Show login icon 
    userIcon.style.display = 'inline';
    // Change label to go in
    userLabel.innerHTML = 'Entrar';
 }
