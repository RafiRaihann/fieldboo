// Konfigurasi Firebase (sama seperti di profile.js)

firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

// Periksa status login
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // User sudah login
        document.getElementById("editProfileForm").addEventListener("submit", (event) => {
            event.preventDefault();
            editUserProfile(user.uid);
        });
    } else {
        // Redirect ke halaman login jika belum login
        window.location.href = "login.html";
    }
});

// Edit data profil di Firestore
function editUserProfile(userId) {
    const userDoc = db.collection("akun").doc(userId);

    const newUsername = document.getElementById("newUsername").value;
    const newEmail = document.getElementById("newEmail").value;

    // Update data di Firestore
    userDoc.update({
        username: newUsername,
        email: newEmail
    })
    .then(() => {
        console.log("Document successfully updated!");
        // Redirect ke halaman profil setelah berhasil update
        window.location.href = "profile.html";
    })
    .catch((error) => {
        console.error("Error updating document: ", error);
    });
}
