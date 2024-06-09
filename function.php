<?php

$conn = mysqli_connect("localhost", "root", "", "fieldboo") or die("koneksi ggl");

function query($query)
{
    global $conn;
    $rows = array();

    $result = mysqli_query($conn, $query);
    $row = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function register($data)
{
    global $conn;

    $nama = $data["name"];
    $email = $data["email"];
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $foto = uploadfoto();

    $cekEmail = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_num_rows(mysqli_query($conn, $cekEmail));
    if ($result == 1) {
        echo  "<script>
                    alert('Email sudah terdaftar');
                    window.location.href = 'login.php';
                </script>
            ";
        exit;
    }

    if (empty($foto)) {
        return false;
    }

    $user = "INSERT INTO akun (id, nama, email, password, foto) VALUES ('', '$nama', '$email', '$password', '$foto')";

    mysqli_query($conn, $user);
    return mysqli_affected_rows($conn);
}

function editprofile($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $foto = editfoto();

    $query = "UPDATE akun 
                SET    
                nama = '$nama',
                email = '$email',
                foto = '$foto'
                WHERE email='$email';
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editfoto()
{
    $namaFile = $_FILES['foto']['name']; // RAKAWIBOWO.png
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo  "<script>
                    alert('Pilih gambar terlebih dahulu');
                </script>
            ";
        return false;
    }
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // raka.png

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo  "<script>
                    alert('yang anda upload bukan gambar!');
               </script>
        ";
        return false;
    }
    if ($ukuranFile > 1000000) {
        echo  "<script>
                    alert('ukuran gambar terlalu besar');
               </script>
        ";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.'; // asd1231233123.
    $namaFileBaru .= $ekstensiGambar; // 12312dasdasd123.png
    move_uploaded_file($tmpName, '../logres/images/' . $namaFileBaru);
    return $namaFileBaru;
}
function uploadfoto()
{
    $namaFile = $_FILES['foto']['name']; // RAKAWIBOWO.png
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo  "<script>
                    alert('Pilih gambar terlebih dahulu');
                </script>
            ";
        return false;
    }
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // raka.png

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo  "<script>
                    alert('yang anda upload bukan gambar!');
               </script>
        ";
        return false;
    }
    if ($ukuranFile > 1000000) {
        echo  "<script>
                    alert('ukuran gambar terlalu besar');
               </script>
        ";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.'; // asd1231233123.
    $namaFileBaru .= $ekstensiGambar; // 12312dasdasd123.png
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
    return $namaFileBaru;
}
