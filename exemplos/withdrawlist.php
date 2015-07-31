<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";

$mp = new MP("2526", "CX3tqGkTmUrTQAEzY903w2alP908QSss");

if (isset($_POST["find"])) {
    
   $_POST["dtini"] = $_POST["dtini"] . "T00:00:00.00Z";
   $_POST["dtfim"] = $_POST["dtfim"] . "T23:00:00.00Z" ;
    
     $filters = array(
            "range" => "date_created",
            "begin_date" => $_POST["dtini"],
            "end_date" => $_POST["dtfim"] 
        );
    
    
}else {

    $filters = array(
            "range" => "date_created",
            "begin_date" => "NOW-2MONTH",
            "end_date" => "NOW"
        );

}

$searchResult = $mp->search_withdrawals($filters);

?>   

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Search Withdrawals - EasyTaxi</title>
	
        <script src="incs/js/jquery.js"></script>
        <script src="incs/js/jquery.maskedinput.min.js"></script>
        <script src="incs/js/jquery.maskMoney.min.js"></script>
        <script src="incs/js/bootstrap.min.js"></script>
        <script src="incs/js/bootstrap-datepicker.js" charset="UTF-8" ></script>
        <script src="incs/js/combobox.js" type="text/javascript"></script>
	
    <!-- Bootstrap -->
  	<link href="incs/media/css/bootstrap.min.css" rel="stylesheet">
	<link href="incs/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="incs/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css" />
	<link href="incs/media/smoothness/jquery-ui-1.8.4.custom.css" rel="stylesheet" type="text/css" /> 
	<link href="incs/media/css/datepicker.css" rel="stylesheet">
	<link href="incs/media/css/combobox.css" rel="stylesheet">
	
	
	<style>
        .bs-example {
                margin-left: 0;
                margin-right: 0;
                background-color: #fff;
                border-width: 1px;
                border-color: #ddd;
                border-radius: 4px 4px 0 0;
                box-shadow: none;
                margin-top: 0px;
                position: relative;
                padding: 15px 15px 15px;
                margin: 10px -15px 15px;
                border-style: solid;
                box-sizing: border-box;
                }	
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body
    
    
<div style="margin: 0 auto; width: 1124px; margin-top: 10px; ">

        
        
    <div class="bs-example panel panel-primary">
	
	<div class="panel-heading">
        <h3 class="panel-title">Search Withdrawals</h3>
        </div>
      
      <div class="panel-body">
	
	<br>
            

	
	<form action="#" method="post">
	
	<label class="control-label" style="padding: 10px"  >Start</label><input type="text" name="dtini" id="calendario" /> 
	<label class="control-label" style="padding: 10px"  >End</label><input type="text" name="dtfim" id="calendario2" /> 
	<input type="submit" value="Procurar" name="find" class="btn btn-info" style="margin-left: 10px" >
	
	</form>
					
        <table id="tabela" class="tables" cellspacing="0" >
        
            <thead>
                <tr>
                    
                <th scope="col" >Id</th>
                <th scope="col" >Status</th>
                <th scope="col" >Status Detail</th>
                <th scope="col" >Amount</th>
                <th scope="col" >Fee</th>
                <th scope="col" >CPF</th>
                <th scope="col" >Name</th>
                <th scope="col" >Bank</th>
                <th scope="col" >AG</th>
                <th scope="col" >Account</th>
                <th scope="col" >Date Created</th>
                <th scope="col" >Last Modified</th>
       
                </tr>
            </thead>
            
            <tbody>
    
            <?php
                foreach ($searchResult["response"]["results"] as $payment) {
                 
                    $datecreated = new DateTime($payment["date_created"]);
                    $datelast = new DateTime($payment["last_modified"]);
                   
                      ?>
                    <tr>
                        <td><?php echo $payment["id"]; ?></td>
                        <td><?php echo $payment["status"]; ?></td>
                        <td><?php echo $payment["status_detail"]; ?></td>
                        <td><?php echo number_format($payment["amount"], 2, ',', ' '); ?></td>
                        <td><?php echo number_format($payment["fee"], 2, ',', ' '); ?></td>
                        <td><?php echo $payment["bank_account"]["identification"]["number"]; ?></td>  
                        <td><?php echo $payment["bank_account"]["holder"]; ?></td>
                        <td><?php echo $payment["bank_account"]["bank_id"]; ?></td>
                        <td><?php echo $payment["bank_account"]["branch"]; ?></td>
                        <td><?php echo $payment["bank_account"]["number"]; ?></td>
                        <td><?php echo $datecreated->format('d/m/Y'); ?></td>
                        <td><?php echo $datelast->format('d/m/Y'); ?></td>
                        
                    </tr>
                    <?php
                }
            ?>
    
            </tbody>
        
        </table>
	
	
	</div>

</div>


</div>
    <script src="incs/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
            
$(document).ready(function () {
        
        var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    
        var checkin = $('#calendario').datepicker({
	  format: 'yyyy-mm-dd',
	 
	}).on('changeDate', function(ev) {
  	    var newDate = new Date(ev.date)
	    newDate.setDate(newDate.getDate() + 1);
	    checkout.setDate(newDate);
            console.log(checkout);
            checkin.hide();
	  $('#calendario2')[0].focus();
	}).data('datepicker');
	
        var checkout = $('#calendario2').datepicker({
	  format: 'yyyy-mm-dd',
	  onRender: function(date) {
            console.log (date);
            return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  checkout.hide();
	}).data('datepicker');
    
        var table = $('#tabela').dataTable({
                         "bJQueryUI": true,
			 "sScrollY": "380px",
			 "bPaginate": false,
			 "aaSorting": [],
			  
			});
		
	
	 
	
	
      
		
    });
    	</script>
 

</body>
</html>       
        




      

