<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
include "header.php";
require_once "lib/mercadopago.php";
        
$clientid = $_SESSION['user'];
$clientsecret = $_SESSION['pass'];

?>
  


<div class="navbar-default navbar-fixed-top" role="navigation">
    <div class="container" style="width: auto;">    
        <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav">
		<li> <img src="https://a248.e.akamai.net/secure.mlstatic.com/components/resources/mp/css/assets/desktop-logo-mercadopago.png" style='width: 110px;padding-top: 10px;padding-right: 14px;'> </li>
		<li> <img src="assets/logo.png" style='width: 110px;padding-top: 10px;padding-right: 14px;'> </li>
		    <li class=""><a href="search.php">Search Payment - Collections</a></li>
                    <li class="active"><a href="movements.php">Movements account</a></li>
            </ul>
	    <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="destroy.php">Logoff</a></li>
          </ul>
        </div> 
    </div>
</div>	
		
        <div class="ch-box">
		
		
	  
		<h2>Search Movements</h2>
		<form action="#" class="class="ch-form" method="POST">
			<fieldset>
			    
			    <p class="ch-form-row ch-form-required">
					<label for="input_button">Start Date:</label>
					<input type="date" name="date1" id="date1" required="required">
    
					    
			    </p>
                            
			    <p class="ch-form-row ch-form-required">
					<label for="input_button">End Date:</label>
					<input type="date" name="date2" id="date2" required="required">
			    </p>
                            
                         				
			<p class="ch-form-actions">
				<input type="submit" name="_eventId_confirmation" value="Search" class="ch-btn">
				<input type="reset" value="Reset" class="ch-btn ch-btn-small">
			</p>
                        
                         </fieldset>
		</form>
		
		<h2>Balance</h2>
                    
		    <br>

		    <?php
			$mp = new MP($clientid ,$clientsecret); 
			$balance = $mp->get_balance();
			/*echo "<pre>";
			print_r($balance);
			echo "</pre>";*/
			$detail_balance= $balance["response"]["unavailable_balance_by_reason"];
		
		    ?>
			    
			<p class="alert alert-success" style="width: 50%;padding: 5px;" role="alert"> Total : <b> R$ <? echo($balance["response"]["total_amount"]); ?></b></p>
			<p class="alert alert-info" style="width: 50%;padding: 5px;" role="alert"> Available : <b> R$  <? echo($balance["response"]["available_balance"]); ?></b></p>
			<p class="alert alert-warning" style="width: 50%;padding: 5px;" role="alert"> Unavailable : <b> R$ <? echo($balance["response"]["unavailable_balance"]); ?></b></p>
<?


			foreach($detail_balance as $resp){
			    
			    switch($resp["reason"]){
				
				case "chargeback":
				    
				echo '<p class="alert alert-warning" style="width: 50%;padding: 3px;MARGIN-LEFT: 30PX" role="alert"> Chargeback : <b> R$ ' . $resp["amount"] . '</b></p>';
				    
				break;
			    
				case "dispute":
				    
				echo '<p class="alert alert-warning" style="width: 50%;padding: 3px;MARGIN-LEFT: 30PX" role="alert"> In mediation : <b> R$ ' . $resp["amount"] . '</b></p>';
				    
				break;
			
				case "fraud":
				    
				echo '<p class="alert alert-warning" style="width: 50%;padding: 3px;MARGIN-LEFT: 30PX" role="alert"> Risk : <b> R$ ' . $resp["amount"] . '</b></p>';
				    
				break;
			    
				case "time_period":
				    
				echo '<p class="alert alert-warning" style="width: 50%;padding: 3px;MARGIN-LEFT: 30PX" role="alert"> Unavailable (D+2) : <b> R$ ' . $resp["amount"] . '</b></p>';
				    
				break;
			    
				case "restriction":
				    
				echo '<p class="alert alert-warning" style="width: 50%;padding: 3px;MARGIN-LEFT: 30PX" role="alert"> Restriction: <b> R$ ' . $resp["amount"] . '</b></p>';
				    
				break;
				
				
			    }
			    
			    
			    
			    
			    
			}


?>			
			
            
	</div>
        
	<div id="load">
	    
	    <?php  include "movements_search.php"  ?>
	    
	</div>
	
                   
<script src="js/jquery.js"></script>
<script src="js/chico-min-0.12.2.js"></script> 
<script>
$(document).ready(function() {
  
  $("#date1").datePicker({
    "format": "DD/MM/YYYY",
    "monthsNames": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    "weekdays": ["Su", "Mo", "Tu", "We", "Thu", "Fr", "Sa"]
    });
 $("#date2").datePicker({
    "format": "DD/MM/YYYY",
    "monthsNames": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    "weekdays": ["Su", "Mo", "Tu", "We", "Thu", "Fr", "Sa"]
    });
     

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '";"',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#table_collections'), 'movements.csv']);

        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
        
</script>        
	
<?php include "footer.php"; ?>