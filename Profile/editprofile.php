<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <h1>Edit Profil</h1>
    <form id="editProfileForm">
        <label for="newUsername">Username:</label>
        <input type="text" id="newUsername" required><br>
        <label for="newEmail">Email:</label>
        <input type="email" id="newEmail" required><br>
        <button type="submit">Simpan Perubahan</button>
    </form>

    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
    <script src="edit_profile.js"></script>
</body>
</html>
