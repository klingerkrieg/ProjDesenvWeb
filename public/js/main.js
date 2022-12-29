var pendingFormConfirmation;

function confirmDeleteModal(button){
    var confModal = new bootstrap.Modal(document.getElementById('confirm_modal'))
    confModal.show('fast');
    pendingFormConfirmation = button.parentElement;
}

function confirmButton(){
    pendingFormConfirmation.submit();
}

//Quando a página for completamente carregada
$(function(){

	$('.cep').mask('00000-000');
	
	
	$('.cep').on('keyup',function(a){
        if ($(this).val().length == 9){
            $.ajax("http://viacep.com.br/ws/"+$(this).val().replace("-","")+"/json/",{
				//Se quiser fazer via POST
				//method:'post',
				//data:{cep:'59150160'},
				//
                success:function(res){
                    $("[name=street]").val(res.logradouro);
                    $("[name=district]").val(res.bairro);
                    $("[name=city]").val(res.localidade);
                    $("[name=state]").val(res.uf);
                }
            });
        }
    });


})
