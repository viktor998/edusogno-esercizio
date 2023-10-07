const showButton = document.getElementById('show-btn');
const modal = document.getElementById('modal-container');
const close_modal = document.getElementById('close');

showButton.addEventListener('click', function() {
    modal.classList.remove('d-none');
});

close_modal.addEventListener('click', function() {
    modal.classList.add('d-none');
})