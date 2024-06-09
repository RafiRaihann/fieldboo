<?php
function build_calendar($month, $year){

    $mysqli = new mysqli('localhost','root','','fieldboo');
    $stmt = $mysqli -> prepare('select * from bookings where MONTH(date) = ? AND YEAR(date) = ?');
    $stmt->bind_param('ss',$month, $year);
    $bookings = array();
    if($stmt->execute()){
      $result = $stmt->get_result();
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          $bookings[] = $row['date'];
        }
        $stmt->close();
      }
    }

    $daysOfWeek = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday', 'Sunday');
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    $numberDays = date('t',$firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday']; // Changed the loop variable name
    if($dayOfWeek==0){
      $dayOfWeek = 6;
    } else{
      $dayOfWeek = $dayOfWeek-1;
    }
    $dateToday = date('Y-m-d');

    $prev_month = date('m',mktime(0,0,0,$month-1,1,$year));
    $prev_year = date('Y',mktime(0,0,0,$month-1,1,$year));
    $next_month = date('m',mktime(0,0,0,$month+1,1,$year));
    $next_year = date('Y',mktime(0,0,0,$month+1,1,$year));

    $calendar = "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='?month=".$prev_month."&year=".$prev_year."'>Prev Month</a>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='?month=".date('m')."&year=".date('Y')."'>Current Day</a>";
    $calendar .= "<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=".$next_year."'>Next Month</a></center>";
    $calendar .= "<br><table class='table table-bordered'>";
    $calendar .= "<tr>";

    // Generate the table headers (days of the week)
    foreach($daysOfWeek as $day){
      $calendar .= "<th class='header'>$day</th>";
    }
    $calendar .= "</tr><tr>";

    // Fill in the days of the month
    $currentDay = 1;
    if($dayOfWeek > 0){
      for($k = 0;$k < $dayOfWeek;$k++){
        $calendar .= "<td class='empty'></td>";
      }
    }

    $month = str_pad($month,2,"0", STR_PAD_LEFT);
    while($currentDay <= $numberDays){
      if($dayOfWeek == 7){
        $dayOfWeek = 0;
        $calendar .= "</tr><tr>";
      }
      $currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
      $date = "$year-$month-$currentDayRel";
      $dayName = strtolower(date("I",strtotime($date)));
      $today = $date == date('Y-m-d') ? 'today' : '';
       if($date<date('Y-m-d')){
        $calendar .= "<td class='$today'><h4>$currentDayRel</h4><a class = 'btn btn-danger btn-xs'>N/A</a></td>";
      }else{
        $calendar .= "<td class='$today'><h4>$currentDayRel</h4><a href='book.php?date=".$date."' class = 'btn btn-success btn-xs'>Book</a></td>";
      }

      
      $currentDay++;
      $dayOfWeek++;
    }

    if($dayOfWeek < 7){
      $remainingdays = 7 - $dayOfWeek;
      for($i=0;$i < $remainingdays;$i++){
        $calendar .= "<td class='empty'></td>";
      }
    }

    $calendar .= "</tr></table>";

    return $calendar;
}
?>

<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="jadwal.css">
  </head>

  <body>

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

  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $dateComponents = getdate();
            if (isset($_GET['month']) && isset($_GET['year'])) {
                $month = $_GET['month'];  // Removed $ sign from '$_GET['$month']'
                $year = $_GET['year'];    // Removed $ sign from '$_GET['$year']'
            } else {
                $month = $dateComponents['mon'];
                $year = $dateComponents['year'];
            }

            echo build_calendar($month, $year);
            ?>
        </div>
    </div>
</div>

<div class="container">
    <a href="../landing/index.html"><button class="btn btn-primary">Back</button></a>
</div>
  </body>
</html>