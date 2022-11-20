<?php
include('includes/dbh.inc.php');

/*function get_graph_data($key) {

    switch ($key) {
        case "revenue":
          return get_payments();
          break;
        case "clients":
          return get_clients($key);
          break;

        default:
          return "Sorry, couldn't find that data!";
      }

}*/

function get_payments($key) {
    global $conn;
    $curr_week = get_curr_week();

    $sql = "SELECT DATE_FORMAT(time_created, '%Y-%m-%d') AS day, 
            SUM(payment_amount) AS revenue, COUNT(payment_id) AS 'total-orders'  
            FROM payments 
            WHERE time_created BETWEEN date_sub(now(),INTERVAL 6 DAY) AND now()
            GROUP BY DATE_FORMAT(time_created, '%Y-%m-%d')
            ORDER BY time_created DESC;";

    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
      $curr_week[$row['day']]['revenue'] = $row['revenue'];
      $curr_week[$row['day']]['total-orders'] = $row['total-orders'];
      $curr_week[$row['day']]['order-average'] = number_format($row['revenue'] / $row['total-orders'], 2);
    }

    mysqli_close($conn);
    return $curr_week;
}

function get_clients($key) {
    global $conn;



}

function get_curr_week() {

  $day_count = 7;
  $week = array(  );

  for($i = 0; $i < $day_count; $i++) {

      $day = array();
      $date = date('Y-m-d', strtotime('-6 hour, ' . '-' . $i . ' day'));//day names starting one week ago
      $day['revenue'] = 0;
      $day['total-orders'] = 0;
      $day['order-average'] = 0;

      $week[$date] = $day;

  }

  return $week;
}


if(isset($_GET['data']) && !empty($_GET['data'])) {

    $data = get_payments($_GET['data']);

    echo json_encode($data);

    //echo '<pre>';
    //  var_dump(array_map(function ($a, $i) { return array( $i = $a ); }, $revenue));
    //echo '</pre>';
}
