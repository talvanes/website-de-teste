/* 
 * Validação dos campos de formulário
 */
function validarFormulario(){
  // validar email (cortesia da Edounix Learning Solutions)
  var email = document.getElementById("contato").value;
  var at = email.indexOf('@');
  var ponto = email.lastIndexOf('.');
  if(at < 1 || ponto < at+2 || ponto+2 >= email.length){
    alert('Verifique o email digitado.');
    return false;
  }
}


