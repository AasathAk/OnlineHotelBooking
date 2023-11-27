
// function get_bookings(search = '', page = 1) {
//     console.log('Function called');
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/booking_records.php", true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             console.log(this.responseText);
//             let data = JSON.parse(this.responseText);
//             document.getElementById('table-data').innerHTML = data.table_data;
//             document.getElementById('table-pagination').innerHTML = data.pagination;
//         } else {
//             console.error('Request failed with status:', xhr.status);
//         }
//     }

//     let formData = new FormData();
// formData.append('get_bookings', 1); // Make sure this key exists in your PHP code
// formData.append('search', search);
// formData.append('page', page);
// xhr.send(formData);


// }



// function change_page(page){
//     get_bookings(document.getElementById('search_input').value,page);
// }
// function change_page(page) {
//     document.getElementById('search_input').addEventListener('input', function() {
//         get_bookings(this.value);
//     });
    
// }

// function download(id){
//     window.location.href = 'generate_pdf.php?gen_pdf&id='+id;

// }

// window.onload = function() {
//     get_bookings();
// }

function get_bookings(search='',page=1)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/booking_records.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    let data = JSON.parse(this.responseText);
    document.getElementById('table-data').innerHTML = data.table_data;
    document.getElementById('table-pagination').innerHTML = data.pagination;

  }

  xhr.send('get_bookings&search='+search+'&page='+page);
}

function change_page(page){
  get_bookings(document.getElementById('search_input').value,page);
}

function download(id){
  window.location.href = 'generate_pdf.php?gen_pdf&id='+id;
}


window.onload = function(){
  get_bookings();
}





