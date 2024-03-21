// Select the HTML elements to interaction

const userName = document.getElementById('userName');
const userCard = document.getElementById('userCard');
const btnGoogleProfile = document.getElementById('btnGoogleProfile');
const btnLogout = document.getElementById('btnLogout');


// Monitor if happened changes in the user authentication
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        //If logged
        showUserCard(user);
        btnGoogleProfile.addEventListener('click', viewProfile);
        btnLogout.addEventListener('click', fbLogout);
        linkToProfile.innerHTML = `
            <a href="profile.php?uid=${user.uid}">Clique aqui para ver seus comentários</a>
        `;
    } else {
        //If unloggedd
        var searchParams = new URLSearchParams(window.location.search);
        // Obtém o valor do parâmetro "ref"
        var refValue = searchParams.get('ref');
        // Redireciona para a página de origem
        location.href = refValue ? refValue : 'index.php';
        
    }
});

function showUserCard(user) {

    var createdDateBr = convertTimestampToDateFormat(user.metadata.creationTime);
    var lastSingInBr = convertTimestampToDateFormat(user.metadata.lastSignInTime);
    
    // Variável com a view do card
    var userCardData = `
    
<img src="${user.photoURL}" alt="${user.displayName}" referrerpolicy="no-referrer">
<h4> ${user.displayName}</h4>
<ul>
    <li>E-mail: ${user.email}</li>
    <li>Cadastrado em ${createdDateBr}</li>
    <li>Ultimo login em ${lastSingInBr}</li>
</ul>
    `;

    // Envia a variável para a view
    userCard.innerHTML = userCardData;

    // Exibe a view
    userCard.style.display = 'block';

};

function viewProfile() {
    window.open('https://myaccount.google.com/', '_blank');
};
function fbLogout() {
    firebase.auth().signOut()
}