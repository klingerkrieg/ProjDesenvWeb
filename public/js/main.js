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


    //$(".verifyEmail").on('blur',function(a){
    $(".verifyEmail").on('keyup',function(a){
        console.log("keyup")
            //if ($(this).val().length >= 3 && $(this).val().indexOf("@") > -1){
                var re = /\S+@\S+\.\S+/;
                if (re.test($(this).val())){
                    console.log("ajax")
                    $.ajax( SITE_URL + "/verificar_email/"+$(this).val(),{
                        element:$(this),
                        success:function(res){
                            console.log("resp")
                            console.log(res)
                            if(res.exists){
                                $("#email_exists").show();
                            } else {
                                $("#email_exists").hide();
                            }

                            if (res.exists || res.valid == false){
                                this.element.addClass('is-invalid');
                                this.element.removeClass('is-valid');
                            } else {
                                this.element.removeClass('is-invalid');
                                this.element.addClass('is-valid');
                            }
                        }
                    });
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).removeClass('is-valid');
                }
            //}
        });


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
