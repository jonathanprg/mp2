<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
include "header.php";

    
  ?>
  


<div class="navbar-default navbar-fixed-top" role="navigation">
    <div class="container" style="width: auto;">    
        <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav">
               <li> <img src="https://a248.e.akamai.net/secure.mlstatic.com/components/resources/mp/css/assets/desktop-logo-mercadopago.png" style='width: 110px;padding-top: 10px;padding-right: 14px;'> </li>
                <li><a href="menu.php">Gerar Pagamentos</a></li>
                <li class="active"><a href="search.php">Buscar Pagamentos</a></li>
            </ul>
	    <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="destroy.php">Logoff</a></li>
          </ul>
        </div> 
    </div>
</div>	
		
        <div class="ch-box">
		<h2>Buscar pagamentos</h2>
		<form action="#" class="ch-form myForm" method="POST">
			<fieldset>
                            
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Pedido:</label>
					<input type="text" name="pedido"  size="30" placeholder="" required="required">
			    </p>
                            
                           
                            
                         				
			<p class="ch-form-actions">
				<input type="submit" name="_eventId_confirmation" value="Pesquisar" class="ch-btn">
				<input type="reset" value="Reset" class="ch-btn ch-btn-small">
			</p>
                        
                         </fieldset>
		</form>
                
                
	</div>
                        
                        <div id="load">
                            
                            <?php  include "search_payment.php"  ?>
                            
                        </div>
                        
                   
<script src="js/jquery.js"></script>
<script src="js/chico-min-0.12.2.js"></script> 
<script>
    
 /* 

    var	date1 = $("#date1").datePicker({
			"to": "today",
                        "monthsNames": ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
			"weekdays": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]});
    		
    var	date2 = $("#date2").datePicker({
			
                        "to": "today",
                        "monthsNames": ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
			"weekdays": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]});
		
  
    
  */  
        
</script>        
	
<?php include "footer.php"; ?>