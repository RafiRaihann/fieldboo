<?php
session_start();
require '../function.php';
if (!isset($_SESSION['login'])) {
    header('Location: ../logres/login.php');
}

$emailUser = $_SESSION["email"];

$result = mysqli_query($conn, "SELECT * FROM akun WHERE email = '$emailUser'");

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    $nama = $row['nama'];
    $email = $row['email'];
    $foto = $row['foto'];
}

if (isset($_POST["save"])) {

    if (editprofile($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href = 'Profile.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah');
                document.location.href = 'Profile.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Profile - Valorant Style</title>
</head>

<body>

    <header>
        <!-- Your header content here -->
    </header>

    <main class="profile-container">
        <section class="profile-info">
            <div class="d-flex justify-content-between mb-2">
                <h2 class="text-white">Profile Information</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">edit</button>
            </div>
            <div class="user-details">

                <p><img src="../logres/images/<?php echo $row['foto']; ?>" width="150px"></p>
                <p class="text-white">Nama Pengguna: <?php echo $row['nama']; ?></p>
                <p class=" text-white">Email: <?php echo $row['email']; ?></p>

                <!-- Add more user details as needed -->
            </div>
        </section>

        <section class=" edit-profile">
            <span>
                <a href="../landing/landing.php" style="text-decoration: none; color: white; font-size: 16px; background-color: grey; padding: 5px;">kembali</a>
            </span>
            <span style="margin-left: 5px;">
                <a href="../logout.php" style="text-decoration: none; color: white; font-size: 16px; background-color: grey; padding: 5px;">logout</a>
            </span>
            <!-- Your edit profile form goes here -->
        </section>
    </main>

    <!-- modal edit profile -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="recipient-name" value="<?php echo $row['nama'] ?>" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="message-text" value="<?php echo $row['email'] ?>" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">foto:</label>
                            <input type="file" class="form-control" id="message-text" value="<?php echo $row['foto'] ?>" name="foto">
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="save">save</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <!-- Your footer content here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>