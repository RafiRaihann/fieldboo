<?php
$mysqli = new mysqli('localhost', 'root', '', 'fieldboo');

// Inisialisasi $bookings sebagai array kosong
$bookings = array();

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $stmt = $mysqli->prepare('select * from bookings where date = ?');
    $stmt->bind_param('s', $date);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
            $stmt->close();
        }
    }
}



if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $instansi = $_POST['instansi'];
    $desc = $_POST['desc'];
    $timeslot = $_POST['timeslot'];
    $status;
    $stmt = $mysqli->prepare('select * from bookings where date = ? AND time = ?');
    $stmt->bind_param('ss', $date, $timeslot);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
        } else {
            $status = "Booked";
            $stmtInsert = $mysqli->prepare("INSERT INTO bookings (name, instansi, deskripsi, date, time, status) VALUES (?,?,?,?,?,?)");
            $stmtInsert->bind_param('ssssss', $name, $instansi, $desc, $date, $timeslot, $status);
            $stmtInsert->execute();
            $msg = "<div class='alert alert-success'>Booking Successful</div>";
            $stmtInsert->close();

            // Setelah insert berhasil, tandai tombol yang dipilih
            $selectedTimeslot = $timeslot;
        }
    }

    $stmt->close();
}

$duration = 60;
$cleanup = 0;
$start = "07:00";
$end = "22:00";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = clone $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);

        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="jadwal.css">
</head>

<body>
<style>
        .booked-button {
            background-color: #dc3545; /* Warna untuk tombol yang sudah dipesan */
            color: #ffffff;
            border: 1px solid #dc3545;
        }

        .booked-button:hover {
            background-color: #c82333; /* Warna saat hover untuk tombol yang sudah dipesan */
        }
    </style>

<header> 
      <div class="container flex-row">
        <div class="header__logo">
          <h1>FieldBoo</h1>
        </div>
        <nav>
          <ul class="header__menu flex-row">
            <li>
              <a href="#hero">Home</a>
            </li>
            <li>
              <a href="#about">About Us</a>
            </li>
            <li>
              <a href="#service">Service</a>
            </li>
            <li>
              <a href="#lapang">Informasi Lapang</a>
            </li>
            <li>
              <a href="#team">Team</a>
            </li>
            <li>
              <a href="#contact">Contact</a>
            </li>
          </ul>
        </nav>
        <div class="right flex-center">
          <a href="#hero" class="btn btn-secondary">Booking</a>
          <div class="menu-btn">
            <i class="fas fa-bars"></i>
          </div>
        </div>
      </div>
    </header>

    <div class="container" style="margin-top: 150px;">
    <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php echo (isset($msg)) ? $msg : ""; ?>
        </div>
        <?php
        $timeslots = timeslots($duration, $cleanup, $start, $end);
        foreach ($timeslots as $ts) {
            $isBooked = false;
            foreach ($bookings as $booking) {
                if ($booking['time'] == $ts) {
                    $isBooked = true;
                    break;
                }
            }

            // Format waktu untuk membuat id yang valid
            $formattedTime = str_replace(":", "", $ts);
            $buttonId = "button-" . $formattedTime;
            $buttonClass = $isBooked ? 'booked-button' : ''; // Menentukan kelas tambahan untuk tombol yang sudah dipesan
        ?>
            <div class="col-md-2 mb-5">
                <div class="form-group">
                    <?php $booked = mysqli_query($mysqli, "SELECT * FROM bookings where status = 'Booked' AND time = '$ts' AND date = '$date'") ?>
                    <?php if (mysqli_num_rows($booked) > 0) { ?>
                        <button id="<?php echo $buttonId; ?>" class="btn btn-danger <?php echo $buttonClass; ?>"><?php echo $ts; ?></button>
                    <?php } else { ?>
                        <button id="<?php echo $buttonId; ?>" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo date('m/d/Y'); ?>" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container">
    <a href="../jadwallapang/jadwal.php"><button class="btn btn-primary">Back</button></a>
</div>


    <div class="modal fade" style="margin-top:120px;" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Booking:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-2">
                    <form action="" method="post" id="bookingForm">
                        <div class="form-group mb-2">
                            <label for="">Timeslot</label>
                            <input required type="text" readonly name="timeslot" id="timeslot" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Name</label>
                            <input required type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Instansi</label>
                            <input required type="text" name="instansi" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Deskripsi Kegiatan</label>
                            <input required type="textarea" name="desc" class="form-control">
                        </div>
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-success mt-5" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const date = button.getAttribute('data-bs-whatever')
                const time = button.getAttribute('data-timeslot')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('.modal-body input')

                modalTitle.textContent = `Booking ${date}`
                modalBodyInput.value = time
            })
        }

        function submitForm() {
            document.getElementById('bookingForm').submit();
        }
    </script>
</body>

</html>