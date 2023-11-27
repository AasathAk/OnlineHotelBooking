<?php
require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
require_once('admin/inc/dompdf/vendor/autoload.php');
use Dompdf\Dompdf;

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
    redirect('index.php');
}


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
        header('location:index.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);
    $date = date("h:ia | d-m-Y", strtotime($data['datentime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

    $table_data = "
    <h2 style='color: #333; text-align: center;'>BOOKING RECEIPT</h2>
    <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Order ID  : $data[order_id]</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Booking Date : $date</th>
    </tr>
    <tr>
        <td>Name: $data[user_name]</td>
        <td>Email: $data[email]</td>
    </tr>
    <tr>
        <td>Phone number: $data[phonenum]</td>
        <td>Address: $data[address]</td>
    </tr>
    </table> <!-- Close the first table -->

    <h3 style='color: #333; text-align: center; margin-top: 20px;'>Additional Information</h3>
    <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Room Name</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Price</th>
    </tr>
    <tr>
        <td>$data[room_name]</td>
        <td>Rs. $data[price] per night</td>
    </tr>
    </table> <!-- Close the second table -->

    <h3 style='color: #333; text-align: center; margin-top: 20px;'>Booking Status <br><h4>$data[booking_status]</h4></h3>
    <table style='width: 100%; border-collapse: collapse; border: 1px solid #ddd;'>
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Check-in</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Check-out</th>
    </tr>
    <tr>
        <td>$checkin</td>
        <td>$checkout</td>
    </tr>
    ";

if ($data['booking_status'] == 'cancelled') {
    $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";
    $table_data .= "
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Refund</th>
    </tr>
    <tr>
        <td>$data[trans_amt]</td>
        <td>$refund</td>
    </tr>
    ";
} elseif ($data['booking_status'] == 'payment failed') {
    $table_data .= "
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Transaction Amount</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Failure Response</th>
    </tr>
    <tr>
        <td>$data[trans_amt]</td>
        <td>$data[trans_status]</td>
    </tr>
    ";
} else {
    $table_data .= "
    <tr>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Room Number</th>
        <th style='background-color: #333; color: #fff; text-align: left; padding: 10px;'>Amount Paid</th>
    </tr>
    <tr>
        <td>$data[room_no]</td>
        <td>$data[trans_amt]</td>
    </tr>
    ";
}

$table_data .= "</table>"; // Close the third table

$dompdf = new Dompdf();
$dompdf->loadHtml($table_data);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream($data['order_id'] . '.pdf', ['Attachment' => 0]);


} else {
    header('location:index.php');
}
?>
