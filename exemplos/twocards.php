<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title> MercadoPago - Checkout Transparente</title>
  </head>
  <body>
    
  <h3>Cartão Teste</h3>
  <p><img src="http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif" align="center" style="margin:2px;" > 4235 6477 2802 5682 </p>
  <p><img src="http://img.mlstatic.com/org-img/MP3/API/logos/master.gif" align="center" style="margin:2px;"> 5031 4332 1540 6351 </p>
  <p><img src="http://img.mlstatic.com/org-img/MP3/API/logos/amex.gif" align="center" style="margin:2px;">3753 651535 56885 </p>    
     
<form action="response_2cards.php" method="post" id="form-pagar-mp">    

<div id="form_pagar_mp_1">  
    <h4>1st Credit Cards</h4>
    <p>Número do cartão: <input  id='card1' data-checkout="cardNumber" type="text" /><span id="bandeira"></span></p>
    <p>Código de segurança: <input data-checkout="securityCode" type="text" value="123" /></p>
    <p>Mês de vencimento: <input data-checkout="cardExpirationMonth" type="text" value="05"  /></p>
    <p>Ano de vencimento: <input data-checkout="cardExpirationYear" type="text" value="2018" /></p>
    <p>Titular do cartão: <input data-checkout="cardholderName" type="text" value="APRO" /></p>
    <p>Número do documento: <input data-checkout="docNumber" type="text" value="19119119100" /></p>
    <p>Parcelas: <select id="installmentsOption" name=""></select>
    <input id="paymentMethod" data-checkout="paymentMethod" type="hidden" name="" />
    <input data-checkout="docType" type="hidden" value="CPF"/>
    <input data-checkout="siteId" type="hidden" value="MLB"/>
    <input type="hidden" name="amount" id="amount" value=""/></p>
    
</div>

<div id="form_pagar_mp_card_2" >
    <h4>2nd Credit Cards</h4>
    <p>Número do cartão: <input  id='card2' data-checkout="cardNumber" type="text" /><span id="bandeira2"></span></p>
    <p>Código de segurança: <input id='securityCode' data-checkout="securityCode" type="text" value="123" /></p>
    <p>Mês de vencimento: <input id='cardExpirationMonth' data-checkout="cardExpirationMonth" type="text" value="05"  /></p>
    <p>Ano de vencimento: <input id='cardExpirationYear' data-checkout="cardExpirationYear" type="text" value="2018" /></p>
    <p>Titular do cartão: <input id='cardholderName' data-checkout="cardholderName" type="text" value="APRO" /></p>
    <p>Número do documento: <input id='docNumber' data-checkout="docNumber" type="text" value="19119119100" /></p>
    <p>Parcelas: <select id="installmentsOption2" name=""></select>
    <input id="paymentMethod2" data-checkout="paymentMethod" type="hidden" name="" />
    <input data-checkout="docType" type="hidden" value="CPF"/>
    <input data-checkout="siteId" type="hidden" value="MLB"/>
    <input type="hidden" name="amount" id="amount2" value=""/>
    </p>
  
</div>

  <input type="submit" value="Concluir pagamento" ></p>

</form>
  
  

    
    
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://secure.mlstatic.com/org-img/checkout/custom/1.0/checkout.js"></script>
  <script type="text/javascript">
   
    // ---------------------------------------------------------------------
    // Set PublicKey
   
    Checkout.setPublishableKey("83a99788-8ff1-41bf-8293-e14d5623f2be");

     // ---------------------------------------------------------------------
    // Load random amount
    
    
    $(document).ready(function() {
    $("#amount").val(Math.floor(Math.random() * 600) + 10);
    $("#amount2").val(Math.floor(Math.random() * 300) + 10);
     });     
    // ---------------------------------------------------------------------
    // Load installments combobox
    
     $("#card1").bind("keyup blur",function(){
      var bin = $(this).val().replace(/ /g, '').replace(/-/g, '').replace(/\./g, '');
      if (bin.length >= 6){
         Checkout.getPaymentMethod(bin,setPaymentMethodInfo);
      }
    });
    $("#card2").bind("keyup blur",function(){
      var bin = $(this).val().replace(/ /g, '').replace(/-/g, '').replace(/\./g, '');
      if (bin.length >= 6){
        Checkout.getPaymentMethod(bin,setPaymentMethodInfo2);

      }
    }); 
 
     function setPaymentMethodInfo(status, result){
      $.each(result, function(p, r){
	 var img = "<img src='" + r.thumbnail + "' align='center' style='margin-left:10px;' ' >";
	 $("#bandeira").empty();
	 $("#bandeira").append(img);
	 $("#paymentMethod").attr("value", r.id)
	 Checkout.getInstallments(r.id ,parseFloat($("#amount").val()), setInstallmentInfo);
          return;
	   });
    };
    
    function setPaymentMethodInfo2(status, result){
      $.each(result, function(p, r){
	 var img = "<img src='" + r.thumbnail + "' align='center' style='margin-left:10px;' ' >";
	 $("#bandeira2").empty();
	 $("#bandeira2").append(img);
	 $("#paymentMethod2").attr("value", r.id)
	 Checkout.getInstallments(r.id ,parseFloat($("#amount2").val()), setInstallmentInfo2);
          return;
	   });	
    };
       function setInstallmentInfo(status,installments){
          var html_options = "";
	  for(i=0; installments && installments[i]!= undefined &&  i<installments.length; i++){
              html_options += "<option value='"+installments[i].installments+"'>"+installments[i].installments +" de "+installments[i].share_amount+" ("+installments[i].total_amount+")</option>";
          };
          $("#installmentsOption").html(html_options);
        };
        
       function setInstallmentInfo2(status,installments){
          var html_options = "";
	  for(i=0; installments && installments[i]!= undefined &&  i<installments.length; i++){
              html_options += "<option value='"+installments[i].installments+"'>"+installments[i].installments +" de "+installments[i].share_amount+" ("+installments[i].total_amount+")</option>";
          };
          $("#installmentsOption2").html(html_options);
        };

    // ---------------------------------------------------------------------
    // Tokenization credit card
  
      $("#form-pagar-mp").submit(function(event){
      var $form = $("#form_pagar_mp_1");
      var $form_2 = $("#form_pagar_mp_2");
      Checkout.createToken($form, mpResponseHandler);
      event.preventDefault();
      return false;
      });
  
      var mpResponseHandler = function(status, response) {
	var $form = $('#form-pagar-mp');
	var $form2 = $("#form_pagar_mp_card_2");
	
	if (response.error) {
	  console.log (response);
	  alert("Ocorreu um erro:" + response.error);
	} else {
	  var card_token_id = response.id;
	  $form.append($('<input type="hidden" name="card_token_id"/>').val(card_token_id));
	  $form.append($('<input type="hidden" name="installments"/>').val($("#installmentsOption").val()));
	  $form.append($('<input type="hidden" name="paymethod"/>').val($("#paymentMethod").val()));
	  $form.append($('<input type="hidden" name="amount"/>').val($("#amount").val()));
	  Checkout.tokenId = null;
	  Checkout.createToken({}, getPixels);
             setTimeout(function() {
	     Checkout.createToken($form2, mpResponseHandler_2)
	    ;},1000);
	 
	}
      };
      
      var mpResponseHandler_2 = function(status, response) {
	var $form = $('#form-pagar-mp');
	if (response.error) {
	  console.log (response);
	  alert("Ocorreu um erro:" + response.error);
	} else {
	  var card_token_id_2 = response.id;
	  $form.append($('<input type="hidden" name="card_token_id_2"/>').val(card_token_id_2));
	  $form.append($('<input type="hidden" name="installments_2"/>').val($("#installmentsOption2").val()));
	  $form.append($('<input type="hidden" name="paymethod_2"/>').val($("#paymentMethod2").val()));
	  $form.append($('<input type="hidden" name="amount_2"/>').val($("#amount2").val()));
	  $form.get(0).submit();
	}
      };
 
    
  </script>
  </body>
</html>