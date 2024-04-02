import './bootstrap';
import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';

window.addEventListener('show-modal-alert' , e =>{
  const {title = 'title' , text = 'ok' , icon = 'success'} = e.__livewire.params
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showConfirmButton: false,
        timer: 1000
      });
})

window.addEventListener('focus-input' , (e) =>{
  const {focusName} = e.__livewire.params
  document.querySelector(`#${focusName}`).focus()
})