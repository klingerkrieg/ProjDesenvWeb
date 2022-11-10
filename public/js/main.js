var pendingFormConfirmation;

function confirmDeleteModal(button){
    var confModal = new bootstrap.Modal(document.getElementById('confirm_modal'))
    confModal.show('fast');
    pendingFormConfirmation = button.parentElement;
}

function confirmButton(){
    pendingFormConfirmation.submit();
}
