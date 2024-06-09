// Konfigurasi Firebase
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
};

firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

// Periksa status login
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // User sudah login
        displayUserProfile(user.uid);
    } else {
        // Redirect ke halaman login jika belum login
        window.location.href = "login.html";
    }
});

// Tampilkan data profil dari Firestore
function displayUserProfile(userId) {
    const userDoc = db.collection("akun").doc(userId);

    userDoc.get().then((doc) => {
        if (doc.exists) {
            const data = doc.data();
            document.getElementById("username").innerText += data.username;
            document.getElementById("email").innerText += data.email;
        } else {
            console.log("Document not found");
        }
    });
}
