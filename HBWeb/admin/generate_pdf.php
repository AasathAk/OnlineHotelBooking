<?php
require('inc/essentials.php');
require('inc/db_config.php');
require_once('inc/dompdf/vendor/autoload.php');
use Dompdf\Dompdf;

adminLogin();

if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filteration($_GET);
    $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` bo
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                INNER JOIN `user_cred` uc ON bo.user_id = uc.id
                WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1)
                OR (bo.booking_status = 'cancelled' AND bo.refund = 1)
                OR (bo.booking_status = 'payment failed'))
                AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($res);

    if ($total_rows == 0) {
        header('location:dashboard.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);
    $date = date("h:ia | d-m-Y", strtotime($data['datentime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

//     $table_data = "
//     <h2 style='color: #333; text-align: center;'>BOOKING RECEIPT</h2>
//     <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Order ID  : $data[order_id]</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Booking Date : $date</th>
//     </tr>
//     <tr>
//         <td>Name: $data[user_name]</td>
//         <td>Email: $data[email]</td>
//     </tr>
//     <tr>
//         <td>Phone number: $data[phonenum]</td>
//         <td>Address: $data[address]</td>
//     </tr>
//     </table> <!-- Close the first table -->

//     <h3 style='color: #333; text-align: center; margin-top: 20px;'>Additional Information</h3>
//     <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Room Name</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Price</th>
//     </tr>
//     <tr>
//         <td>$data[room_name]</td>
//         <td>Rs. $data[price] per night</td>
//     </tr>
//     </table> <!-- Close the second table -->

//     <h3 style='color: #333; text-align: center; margin-top: 20px;'>Booking Status <br><h4>$data[booking_status]</h4></h3>
//     <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Check-in</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Check-out</th>
//     </tr>
//     <tr>
//         <td>$checkin</td>
//         <td>$checkout</td>
//     </tr>
//     ";

// if ($data['booking_status'] == 'cancelled') {
//     $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";
//     $table_data .= "
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Refund</th>
//     </tr>
//     <tr>
//         <td>$data[trans_amt]</td>
//         <td>$refund</td>
//     </tr>
//     ";
// } elseif ($data['booking_status'] == 'payment failed') {
//     $table_data .= "
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Transaction Amount</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Failure Response</th>
//     </tr>
//     <tr>
//         <td>$data[trans_amt]</td>
//         <td>$data[trans_resp_msg]</td>
//     </tr>
//     ";
// } else {
//     $table_data .= "
//     <tr>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Room Number</th>
//         <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</th>
//     </tr>
//     <tr>
//         <td>$data[room_no]</td>
//         <td>$data[trans_amt]</td>
//     </tr>
//     ";
// }

// $table_data .= "</table>"; // Close the third table

$html = "
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0' name='viewport'>
  <title>
SEA BREEZE HOTEL
</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
<style>
/* Custom Styles */
.invoice {
  background-color: #f9f9f9;
  border: 1px solid #ccc;
  margin: 20px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.invoice h2 {
  color: #333;
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}
.invoice p {
  margin: 0;
}
.invoice strong {
  font-weight: 600;
}
.text-primary {
  color: #007bff !important;
}
.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
.table th, .table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
}
</style>
</head>

<body>
<div class='bg-white min-h-screen p-4'>
<div class='container'>
  <div class='invoice'>
    <h2>Booking Receipt</h2>
    <h3 class='text-lg text-gray-600'>
      Thank you, $data[user_name]! Your booking is $data[booking_status].
    </h3>
    <div class='table-responsive'>
    <table class='table'>
        <tr>
            <th>Order ID</th>
            <td>$data[order_id]</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>$date</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>$data[user_name]</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>$data[email]</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>$data[phonenum]</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>$data[address]</td>
        </tr>
    </table>
    </div>

    
    <div class='border p-4 rounded-lg'>
      <h3 class='text-primary'>Additional Information</h3>
      <div class='table-responsive'>
      <table class='table'>
        <tr>
          <th>Room Name</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>$data[room_name]</td>
          <td>Rs. $data[price] per night</td>
        </tr>
      </table>
      </div>
      <h3 class='text-primary mt-3'>Booking Status</h3>
      <div class='table-responsive'>
      <table class='table'>
        <tr>
          <th>Description</th>
          <th>Value</th>
        </tr>
        <tr>
          <td>Check-in</td>
          <td>$checkin</td>
        </tr>
        <tr>
          <td>Check-out</td>
          <td>$checkout</td>
        </tr>";

        if ($data['booking_status'] == 'cancelled') {
          $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";
          $html .= "
          <tr>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</td>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Refund</td>
          </tr>
          <tr>
              <td>$data[trans_amt]</td>
              <td>$refund</td>
          </tr>
          ";
      } elseif ($data['booking_status'] == 'payment failed') {
          $html .= "
          <tr>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Transaction Amount</td>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Failure Response</td>
          </tr>
          <tr>
              <td>$data[trans_amt]</td>
              <td>$data[trans_status]</td>
          </tr>
          ";
      } else {
          $html .= "
          <tr>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Room Number</td>
              <td style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</td>
          </tr>
          <tr>
              <td>$data[room_no]</td>
              <td>$data[trans_amt]</td>
          </tr>
          ";
      }

$html .= "
    </table>
    </div>
  </div>
</div>
</div>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
</body>

</html>
";



$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream($data['order_id'] . '.pdf', ['Attachment' => 0]);


} else {
    header('location:dashboard.php');
}
?>
