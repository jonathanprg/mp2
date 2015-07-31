<?php
       if (isset($_POST["_eventId_confirmation"])) { 
        
        require_once "lib/mercadopago.php";
    
        $clientid = $_SESSION['user'];
        $clientsecret = $_SESSION['pass'];
    
        $mp = new MP($clientid ,$clientsecret);
       
       $date1=implode("-",array_reverse(explode("/",$_POST['date1'])));;
       $date2=implode("-",array_reverse(explode("/",$_POST['date2'])));;
        
        $filters = array(
            "range" => "date_created",  
            "begin_date" => $date1 . "T00:00:00.00Z",
            "end_date" => $date2."T23:59:00.00Z",
            "sort"=>"date_created",
            "criteria"=>"desc"
        );
       
        
        // Search payment data according to filters
       $searchResult = $mp->search_payment($filters,0,10); 
       $rowslimit = (int)$searchResult["response"]["paging"]["total"];
       echo "<h5> Total - rows: " . $rowslimit . " </h5><br><br>" ;
        /*
        echo "<pre>";
        print_r($searchResult);
        echo "</pre>"; 
        exit(0);
       */
        // Show payment information
        ?>   
       
       <a href="#" class="export">Export Table</a>                
       <table class="ch-datagrid-controls" id="table_collections" >
            <tr style="background-color: lightgrey;" >
            
              <td scope="col">Payment Id</td>
              <td scope="col">Order</td>
              <td scope="col">Date created</td>
              <td scope="col">Date approved</td>
              <td scope="col">Money release date</td>
              <td scope="col">Money release date 2</td>
              <td scope="col">Payer email</td>
              <td scope="col">Transaction amount</td>
              <td scope="col">Total paid amount</td>
              <td scope="col">Coupon amount</td>
              <td scope="col">Mercadopago fee</td>
              <td scope="col">Finance fee</td>
              <td scope="col">Net received amount</td>
              <td scope="col">Status</td>
              <td scope="col">Status detail</td>
              <td scope="col">Cardholder - name</td>
              <td scope="col">Last four digits</td>
              <td scope="col">Payment metdod</td>
              <td scope="col">Installments</td>

              
            
            </tr>
            <?php
            
            $offset = 0;
 
            while ($rowslimit>=$offset){
               
              // echo '<script type="text/javascript">alert("'. $offset . '");</script>';
               
               $interacao = $mp->search_payment($filters,$offset,1000);              
               
               foreach ($interacao["response"]["results"] as $payment) {
                ?>
                <tr>
                    <td><?php echo $payment["collection"]["id"]; ?></td>
                    <td><?php echo $payment["collection"]["external_reference"]; ?></td>
                    <td><?php echo formatdataout($payment["collection"]["date_created"]); ?></td>
                    <td><?php echo formatdataout($payment["collection"]["date_approved"]); ?></td>
                    <td><?php echo formatdataout($payment["collection"]["money_release_date"]); ?></td>
                    <td><?php echo formatdataout2($payment["collection"]["money_release_date"]); ?></td>
                    <td><?php echo $payment["collection"]["payer"]["email"]; ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["transaction_amount"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["total_paid_amount"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["coupon_amount"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["mercadopago_fee"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["finance_fee"]); ?></td>
                    <td><?php echo str_replace(".",",",$payment["collection"]["net_received_amount"]); ?></td>
                    <td><?php echo $payment["collection"]["status"]; ?></td>
                    <td><?php echo $payment["collection"]["status_detail"]; ?></td>
                    <td><?php echo $payment["collection"]["cardholder"]["name"]; ?></td>

                    <td><?php echo $payment["collection"]["last_four_digits"]; ?></td>
                    <td><?php echo $payment["collection"]["payment_method_id"]; ?></td>
                    <td><?php echo $payment["collection"]["installments"]; ?></td>

                    
                </tr>
                <?php
              }
            
              $offset+=1000;
              $interacao = 0;
            
            }
            
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
