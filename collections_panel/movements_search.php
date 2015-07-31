<?php
 if (isset($_POST["_eventId_confirmation"])) { 
       
       
       
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
        $searchResult = $mp->get_movements($filters,0,50);
       // print_r($searchResult);
       // exit();
       $interacao = $searchResult;
       $rowslimit = (int)$searchResult["response"]["paging"]["total"];
       echo "<h5> Total - rows: " . $rowslimit . " </h5><br><br>" ;
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
                                
                <td scope="col">id </td>
                <td scope="col">type</td>
                <td scope="col">detail</td>
                <td scope="col">amount</td>
                <td scope="col">reference_id</td>
                <td scope="col">financial_entity</td>
                <td scope="col">status</td>
                <td scope="col">date_created</td>
                <td scope="col">date_released</td>
                <td scope="col">balanced_amount</td>
            </tr>
            <?php
       $offset = 0;
 
       while ($rowslimit>=$offset){
               
              //echo '<script type="text/javascript">alert("'. $interacao["response"]["paging"]["total"] . '");</script>';
               echo '<script type="text/javascript">alert("'. $offset . '");</script>';
              
              $interacao = $mp->get_movements($filters,$offset,50);     
              
                     foreach ($interacao["response"]["results"] as $payment) {     
                      ?>
                      <tr>
                          
                          <td><?php echo $payment["id"]; ?></td>
                          <td><?php echo $payment["type"]; ?></td>
                          <td><?php echo $payment["detail"]; ?></td>
                          <td><?php echo str_replace(".",",",$payment["amount"]); ?></td>
                          <td><?php echo $payment["reference_id"]; ?></td>
                          <td><?php echo $payment["financial_entity"]; ?></td>
                          <td><?php echo $payment["status"]; ?></td>                    
                          <td><?php echo formatdataout($payment["date_created"]); ?></td>
                          <td><?php echo formatdataout($payment["date_released"]); ?></td>
                          <td><?php echo str_replace(".",",",$payment["balanced_amount"]); ?></td>
                          
                      </tr>
                      <?php
                     }
              $offset+=50;
              $interacao =0;              

            
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
       
 
