
function get_bookings(search='') {
    console.log('Function called'); // Log to see if the function is called
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);
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


let assign_room_form = document.getElementById('assign_room_form');

function assign_room(id){
    assign_room_form.elements['booking_id'].value=id
}

assign_room_form.addEventListener('submit', function(e){
e.preventDefault();
let data = new FormData();
data.append('room_no', assign_room_form.elements['room_no'].value);
data.append('booking_id', assign_room_form.elements['booking_id'].value);
data.append('assign_room','');

let xhr = new XMLHttpRequest(); 
xhr.open("POST", "ajax/new_bookings.php", true);
xhr.onload = function(){
    var myModal = document.getElementById('assign_room');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if(this.responseText==1){
        alert('success','Room Number Alloted! Booking Finalized' );
        assign_room_form.reset();
        get_bookings();
    }
    else{
        alert('error','Server Down');
    }
}
xhr.send(data);
});

function cancel_booking(id){

    if(confirm("Are you sure , you want to Cancel this booking?")){
        let data = new FormData();
        data.append('booking_id',id);
        data.append('cancel_booking', '');  // Update to 'true'

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);

        xhr.onload = function() {

            if (this.responseText == 1) {
                alert('success', 'Booking Cancel!');
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


