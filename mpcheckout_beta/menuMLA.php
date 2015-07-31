<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
ob_start();  
session_start();
   if(!isset($_SESSION['user']) && !isset($_SESSION['pass']))
   {
   
     header("Location: indexMLA.php" );
   
   }
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 ie6" lang="pt-br"> <![endif]-->
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="pt-br"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="pt-br"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="pt-br"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<html>
<head>	
<title>Mercadopago</title>
<link rel="shortcut icon" href="https://a248.e.akamai.net/secure.mlstatic.com/components/resources/mp/images/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/navbar-fixed-top.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/customMLA.css" rel="stylesheet">
<link rel="stylesheet" href="css/chico-min-0.12.2.css">
</head>
<body>
<div id="tudo">  
    <div id="conteudo">	
		
        <div class="ch-box ch-form-box">
		<h1>Tomar datos del comprador</h1>
		<p>Datos obligatorios *</p>
		<form action="#" class="ch-form myForm ch-form-box" method="POST">
			<fieldset>
                            
                            <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Código de referencia:*</label>
					<input type="text" name="pedido"  size="30" placeholder="" required="required">
			    </p>
                            
                            <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Título del producto:*</label>
					<input type="text" name="curso"  size="30" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row-big ch-form-required">
				<label for="select6">Categoría:*</label>
					
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
                            
                            <p class="ch-form-row-big ch-form-required">
					<label for="price">
						Valor:*
						
					</label>
					<input type="text" name="price" id="price" required="required" placeholder="1349.43">
					<span class="ch-form-hint-big">Solamente Números</span>
			    </p>
                             <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Nombre:*</label>
					<input type="text" name="nome"  size="80" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Apellido:*</label>
					<input type="text" name="sobrenome"  size="80" placeholder="" required="required">
			    </p>
                            <p class="ch-form-row-big ch-form-required">
					<label for="email">
						E-mail:*
						
					</label>
					<input type="email" name="email" name="email" required="required" size="35" placeholder="comprador@email.com.br">
					<span class="ch-form-hint-big">Email del comprador</span>
			    </p>
                            <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Teléfono:*</label>
                                        <input type="text" name="ddd"  size="2" placeholder="11" required="required">
					<input type="text" name="telefone"  size="15" placeholder="1234-5678" required="required">
			    </p>
                            <p class="ch-form-row-big ch-form-required">
					<label for="number">
						Documento:*
					</label>
                                        
                                        <select name="docto" >

                                             <option value="DNI">DNI</option>
                                             <option value="CI">Cédula</option>
                                             <option value="LC">L.C.</option>
                                             <option value="LE">L.E.</option>
                                             <option value="Otro">Otro</option>
                                            
                                        </select>
                                        
					<input type="number" name="cpf" name="number" size="20" placeholder="00000000" required="required">
                                        <span class="ch-form-hint-big">Solamente números</span>
			    </p>
                    <p class="ch-form-row-big ch-form-required">
					<label for="input_button">Domicilio:*</label>
					<input type="text" name="endereco"  size="80" placeholder="" required="required">
                    <p class="ch-form-row-big ch-form-required">
                    <label for="number">Número:*</label>
					<input type="number" name="nro" name="number" size="8" placeholder="1234" required="required">
			    </p>
                            
                            <p class="ch-form-row-big ch-form-required">
					<label for="number">
						Código Postal:*
					</label>
					<input type="number" name="cep" name="number" size="20" placeholder="100" required="required">
			    </p>
                            
            <br>          				
			<p class="ch-form-actions-big">
				<input type="submit" name="_eventId_confirmation" value="Confirmar" class="ch-btn">
				<input type="reset" value="Limpiar" class="input_link">
			</p>
                        
                        <div id="load">
                            
                            <?php  include "preferenceMLA.php"  ?>
                            
                        </div>
                        
                    </fieldset>
		</form>
                
                
	</div>
   <script src="js/jquery.js"></script>
    <script src="js/chico-min-0.12.2.js"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
   
<script type="text/javascript">
$(function(){
$("#price").maskMoney({symbol:"R$", 
showSymbol:false, thousands:"", decimal:".", symbolStay: true});
 })
</script>
</body>
</html>