
function get_bookings(search='') {
    console.log('Function called'); // Log to see if the function is called
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refund_bookings.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(this.responseText); // Log the response
            document.getElementById('table-data').innerHTML = this.responseText;
        } else {
            console.error('Request failed with status:', xhr.status);
        }
    }

    xhr.send('get_bookings&search'+search);
}


function refund_booking(id){

    if(confirm("Refund money for this booking?")){
        let data = new FormData();
        data.append('booking_id',id);
        data.append('refund_booking', '');  // Update to 'true'

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/refund_bookings.php", true);

        xhr.onload = function() {

            if (this.responseText == 1) {
                alert('success', 'Money Refunded!');
                get_bookings();
            }
            else{
                alert('error', 'Server down!');
            }
        }

        xhr.send(data);
    }
}

window.onload = function() {
    get_bookings();
}


