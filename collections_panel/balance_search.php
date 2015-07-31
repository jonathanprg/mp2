<?php


    
       $mp = new MP($clientid ,$clientsecret); 
      
        // Search payment data according to filters
        $searchResult = $mp->get_balance_history();
        /*
         echo "<pre>";
        print_r($searchResult);
        echo "</pre>"; 
        */
        // Show payment information
        ?>   
       
       <a href="#" class="export">Export Table</a>                
       <table class="ch-datagrid-controls" id="table_collections" >
            <tr style="background-color: lightgrey;" >
            
              <td scope="col">Id</td>              
              <td scope="col">Payment Id</td>              
              <td scope="col">Type</td>   
              <td scope="col">Order</td>
              <td scope="col">Date created</td>
              
              <td scope="col">Available</td>
              <td scope="col">Amount</td>
              <td scope="col">Net</td>
              <td scope="col">Fee</td>
              <td scope="col">Total balance</td>
              <td scope="col">Financing fee</td>
              <td scope="col">MercadoPago Fee</td>
              
              
            
            </tr>
            <?php
            foreach ($searchResult["response"]["results"] as $payment) {
                ?>
                <tr>
                    
                    <td><?php echo $payment["id"]; ?></td>
                    <td><?php echo $payment["source"]["id"]; ?></td>
                    <td><?php echo $payment["source"]["type"]; ?></td>
                    <td><?php echo $payment["external_reference"]; ?></td>
                    <td><?php echo formatdataout($payment["date_created"]); ?></td>
                    <td><?php echo ($payment["available"]==1?'Available':'Unavailable'); ?></td>
                    <td><?php echo str_replace(".",",",$payment["amount"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["net"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["fee"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["total_balance"]); ?></td>
                    
                    <?php
                    
                    if (isset($payment["fee_details"])){
                   
                        foreach ($payment["fee_details"] as $detail) {
                        
                       echo ($detail["type"]=="financing_fee")?'<td>'.$detail["amount"].'</td>':'';  
                       echo ($detail["type"]=="mercadopago_fee")?'<td>'.$detail["amount"].'</td>':'';
                        
                     }
                    
                    
                        
                    } else {
                        
                       echo '<td></td>';
                       echo '<td></td>'; 
                    }
                    
     
                    ?>
                    
                   
                    
                </tr>
                <?php
            }
            
            

       
       
       function formatdataout($data){
              
             $time = substr($data,strrpos($data,"T"),strlen($data));
             $time = str_replace ("T", " ", $time);
             $time = substr($time,0,strrpos($time,"."));
             $data2= substr($data,0,strrpos($data,"T"));
             $data_teste = strtotime($data2 . " " . $time ) + 7200;
             return date('d/m/Y H:i',$data_teste) ;
              
       }
       
        function formatdataout2($data){
              
             $time = substr($data,strrpos($data,"T"),strlen($data));
             $time = str_replace ("T", " ", $time);
             $time = substr($time,0,strrpos($time,"."));
             $data2= substr($data,0,strrpos($data,"T"));
             $data_teste = strtotime($data2 . " " . $time ) + 7200;
             return date('d/m/Y',$data_teste) ;
              
       }
       
       
       
       
       
       
            ?>
    
            
        </table>
