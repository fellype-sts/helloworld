// Firebase configuration keys
const firebaseConfig = {
    apiKey: "AIzaSyACiGnqbqlzO78eTdv2zFjC_xRSyjA-15U",
    authDomain: "blog-helloword-5c270.firebaseapp.com",
    projectId: "blog-helloword-5c270",
    storageBucket: "blog-helloword-5c270.appspot.com",
    messagingSenderId: "598206520356",
    appId: "1:598206520356:web:41b62fbe1e9e21a962ccb1"
  };

 // Inicializa o Firebase
firebase.initializeApp(firebaseConfig);

// Inicializa o Firebase Authentication
const auth = firebase.auth();

// Identifica elementos do HTML para interação
const userAccess = document.getElementById('userAccess');
const userImg = document.getElementById('userImg');
const userIcon = document.getElementById('userIcon');
const userLabel = document.getElementById('userLabel');
const hearderSearch = document.getElementById('headerSearch')

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso:
        // Chama a função que trata o usuário logado
        console.log(user);
        isLogged(user);
    } else {
        // Se alguém deslogou, faça isso:
        // Chama a função que trata o usuário NÃO logado
        notLogged();
    }
});

// Função que trata o usuário logado
function isLogged(user) {
    // Altera href do link
    userAccess.href = `profile.php?uid=${user.uid}&ref=${location.href}`;
    // Altera title do link
    userAccess.title = `Ver perfil de ${user.displayName}`;
    // Oculta o ícone de login
    userIcon.style.display = 'none';
    // Define os atributos da imagem conforme dados do usuário
    userImg.src = user.photoURL;
    userImg.alt = user.displayName;
    // Mostrar a imagem do usuário
    userImg.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Perfil';
}

// Função que trata o usuário NÃO logado 
function notLogged() {
    // Altera href do link
    userAccess.href = `login.php?ref=${location.href}`;
    // Altera title do link
    userAccess.title = 'Logue-se';
    // Oculta a imagem do usuário
    userImg.style.display = 'none';
    // Mostra o ícone de login
    userIcon.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Entrar';
}

// Função que converte datas do Firebase (timestamp) para pt-BR
function convertTimestampToDateFormat(timestamp) {
    const date = new Date(timestamp);

    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    const hour = date.getHours().toString().padStart(2, '0');
    const min = date.getMinutes().toString().padStart(2, '0');

    return `${day}/${month}/${year} às ${hour}:${min}`;
}
function stripTags(htmlText) {
    let div = document.createElement('div');
    div.innerHTML = htmlText.trim().replace(/<script>.*<\/script>/, '');
    return div.textContent;
}

// Função que valida o preenchimento do formulário de busca
function searchCheck(){
    // Sanitize
    headerSearch.value = (stripTags(headerSearch.value.trim()));
    //If the field doesnt have a value, stops the form 
    if(headerSearch.value == '') return false;
}