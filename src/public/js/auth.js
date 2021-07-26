

const admin = require("firebase-admin");


admin.initializeApp({
    credential: admin.credential.applicationDefault(),
});

const googleButton = document.querySelector('#googleLogin');
googleButton.addEventListener('click', e => {
    e.preventDefault();
    const provider = new admin.auth.GoogleAuthProvider();
    auth().signInWithRedirect(provider)
    .then(result => {
        console.log('Sign in');
    })
    .catch(err =>{
        console.log(err);
    })
})