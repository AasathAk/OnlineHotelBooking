let features_s_form = document.getElementById('features_s_form');
let facility_s_form = document.getElementById('facility_s_form');

features_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_feature();
});

function add_feature() {
    let data = new FormData();
    // data.append('name',feature_name_inp.value) or
    data.append('name', features_s_form.elements['feature_name'].value);

    data.append('add_feature', 'true');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);

    xhr.onload = function() {

        var myModal = document.getElementById('features-set');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();


        if (this.responseText == 1) {
            alert('success', 'New Features added!');
            features_s_form.elements['feature_name'].value = '';
            get_features();
        } else {
            alert('error', 'Server down!');
        }
    }

    xhr.send(data);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('features_data').innerHTML = this.responseText;
    }

    xhr.send('get_features');
}

function rem_features(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Fatures Removed!');
            get_features();
        } 
        else if (this.responseText == 'room_added') 
        {
            alert('error', 'Feature is added in room!');

        }
         else
          {
            alert('error', 'Server down!');
        }
    }

    xhr.send('rem_features=' + val);
}



facility_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_facility();
});

function add_facility() {
    let data = new FormData();
    data.append('name', facility_s_form.elements['facility_name'].value);
    data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
    data.append('desc', facility_s_form.elements['facility_desc'].value);
    data.append('add_facility', 'true');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    
    xhr.onload = function() {

        var myModal = document.getElementById('facility-set');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'Only SVG images are allowed!');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 1MB!');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed!');
        } else {
            alert('success', 'New Facility Added Successfully!');
            facility_s_form.reset();
            get_facility();

        }
    }

    xhr.send(data);
}

function get_facility() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('facility_data').innerHTML = this.responseText;
    }

    xhr.send('get_facility');
}

function rem_facility(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Facility Removed!');
            get_facility();

        } else if (this.responseText == 'room_added') {
            alert('error', 'Facility is added in room!');

        } else {
            alert('error', 'Server down!');
        }
    }

    xhr.send('rem_facility=' + val);
}
window.onload = function() {

    get_features();
    get_facility();
}
