<?php
       if (isset($_POST["_eventId_confirmation"])) { 
        
        require_once "lib/mercadopago.php";
    
        $clientid = $_SESSION['user'];
        $clientsecret = $_SESSION['pass'];
    
        $mp = new MP($clientid ,$clientsecret);

        // Sets the filters you want
        $filters = array(
            "site_id" => "MLB", // Argentina: MLA; Brasil: MLB
            "external_reference" => $_REQUEST['pedido']
        );

        // Search payment data according to filters
        $searchResult = $mp->search_payment($filters);

        // Show payment information
        ?>
              
         <div class="ch-box">
        <table class="ch-datagrid-controls" >
            <tr><th scope="col">Id</th><th scope="col">External_reference / Order</th><th scope="col">Status</th><th scope="col">Status Detail</th><th scope="col">Action</th></tr>
            <?php
            foreach ($searchResult["response"]["results"] as $payment) {
                ?>
                <tr>
                    <td><?php echo $payment["collection"]["id"]; ?></td>
                    <td><?php echo $payment["collection"]["external_reference"]; ?></td>
                    <td><?php echo $payment["collection"]["status"]; ?></td>
                    <td><?php echo $payment["collection"]["status_detail"]; ?></td>
                    <td>
                        <?php                        
                        if ($payment["collection"]["status"]=="approved"){
                            
                            $textbtn = $payment["collection"]["id"];
                            $valor = "Refund";
                            
                        }else{
                            
                            $textbtn = $payment["collection"]["id"];
                            $valor = "Cancel";
                        }                        
                        ?>
                        <form action="refund.php" method="POST" onsubmit="return confirm('Voce confirma Cancelamento/Devolução da operação ? ');" >
                        <input type="hidden" id="idmp" name="idmp" value="<?php echo $textbtn ?>">
                        <input type="submit" class="ch-btn-skin ch-btn-small" name="refund" value="<?php echo $valor; ?>">
                        </form>    
                    </td>
                </tr>
                <?php
            }
            
            
       }    
            ?>
    
            
        </table>
         </div>