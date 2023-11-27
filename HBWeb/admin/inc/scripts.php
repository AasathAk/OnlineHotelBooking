<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

// function alert(type, msg) {
//     const bsClass = (type === 'success') ? 'success' : 'danger';
//     const timestamp = new Date().getTime();
//     const element = document.createElement('div');
//     element.innerHTML = `
//         <div class="alert alert-${bsClass} alert-dismissible fade show custom-alert" id="custom-alert-${timestamp}" role="alert">
//             <strong class="me-3">${msg}</strong>
//             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//         </div>
//     `;
//     document.body.appendChild(element);
//     setTimeout(() => element.remove(), 4000);
// }

function alert(type,msg,position='body')
  {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if(position=='body'){
      document.body.append(element);
      element.classList.add('custom-alert');
    }
    else{
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 2000);
  }

  function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
  }



function setActive() {
    let navbar = document.getElementById('dashboard-menu');
    let a_tags = navbar.getElementsByTagName('a');
    let currentPageUrl = window.location.href.split('?')[0]; // Remove query parameters

    for (let i = 0; i < a_tags.length; i++) {
        let file = a_tags[i].href.split('/').pop();
        let file_name = file.split('.')[0];

        if (currentPageUrl.indexOf(file_name) >= 0) {
            a_tags[i].classList.add('active');
        }
    }
}

// Call setActive when the DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    setActive();
});

</script>