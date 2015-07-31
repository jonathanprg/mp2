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
                <li class="active"><a href="menu.php">Gerar Pagamentos</a></li>
                <li><a href="search.php">Buscar Pagamentos</a></li>
            </ul>
	    <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="destroy.php">Logoff</a></li>
          </ul>
        </div> 
    </div>
</div>	
		
        <div class="ch-box">
		<h2>Pagamento</h2>
		<form action="#" class="ch-form myForm" method="POST">
			<fieldset>
                            
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Pedido:</label>
					<input type="text" name="pedido"  size="30" placeholder="" required="required">
			    </p>
                            
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Titulo do produto/serviço:</label>
					<input type="text" name="curso"  size="30" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Descrição:</label>
					<input type="text" name="desc"  size="80" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row ch-form-required">
				<label for="select6">Categoria:</label>
					
                                    <select name="category" multiple="multiple" size="5" class="ch-form-select-multiple" value="learnings">

<?php
                                    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.mercadolibre.com/item_categories");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    
    $output=json_decode($output);
    
    foreach ($output as $key => $value)
    {
        if ($value->id=="learnings"){
        
            echo "<option value='$value->id' selected> $value->id  </option>";
            
        }else{
          
          echo "<option value='$value->id'> $value->id  </option>";   
        }
    }
    

                                    
?>		        
                                </select>
				</p>
                            
                            <p class="ch-form-row ch-form-required">
					<label for="price">
						Preço Total:
						
					</label>
					<input type="text" name="price" id="price" required="required" placeholder="1349.43">
					<span class="ch-form-hint">Somente numeros</span>
			    </p>
                             <p class="ch-form-row ch-form-required">
					<label for="input_button">Nome:</label>
					<input type="text" name="nome"  size="80" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Sobrenome:</label>
					<input type="text" name="sobrenome"  size="80" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="email">
						E-mail:
						
					</label>
					<input type="email" name="email" name="email" required="required" size="35" placeholder="comprador@email.com.br">
					<span class="ch-form-hint">Email do Comprador</span>
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Telefone:</label>
                                        <input type="text" name="ddd"  size="2" placeholder="11" required="required">
					<input type="text" name="telefone"  size="15" placeholder="1234-5678" required="required">
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="number">
						CPF/CNPJ:
					</label>
                                        
                                        <select name="docto" >

                                            <option value='CPF'> CPF  </option>
                                            <option value='CNPJ' > CNPJ</option>
                                            
                                        </select>
                                        
					<input type="number" name="cpf" name="number" size="20" placeholder="00000000" required="required">
                                        <span class="ch-form-hint">Somente numeros</span>
			    </p>
                            <p class="ch-form-row ch-form-required">
					<label for="input_button">Endereço:</label>
					<input type="text" name="endereco"  size="80" placeholder="" required="required">
                                        <label for="number">Numero:</label>
					<input type="number" name="nro" name="number" size="8" placeholder="1234" required="required">
			    </p>
                            
                            <p class="ch-form-row ch-form-required">
					<label for="number">
						CEP:
					</label>
					<input type="number" name="cep" name="number" size="20" placeholder="01234-100" required="required">
			    </p>
                            
                         				
			<p class="ch-form-actions">
				<input type="submit" name="_eventId_confirmation" value="Gerar Pagamento" class="ch-btn">
				<input type="reset" value="Reset" class="ch-btn ch-btn-small">
			</p>
                        
                        <div id="load">
                            
                            <?php  include "preference.php"  ?>
                            
                        </div>
                        
                    </fieldset>
		</form>
                
                
	</div>
        
<img src="http://imgmp.mlstatic.com/org-img/MLB/MP/BANNERS/tipo2_468X60.jpg" alt="MercadoPago - Meios de pagamento" title="MercadoPago - Meios de pagamento" width="468" height="60"/>
   <script src="js/jquery.js"></script>
    <script src="js/chico-min-0.12.2.js"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
   
    

<script type="text/javascript">
$(function(){
$("#price").maskMoney({symbol:"R$", 
showSymbol:false, thousands:"", decimal:".", symbolStay: true});
 })
</script>

    
    
    
<?php include "footer.php"; ?>