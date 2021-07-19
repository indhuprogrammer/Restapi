<?php if(!empty($emp_engaged)){ ?>
<div class="section-right">
    <div class="buttons  export-to-excel">
        <button onclick="report_download();" id="export_excel" type="button" class="positive">  
        Export List
        </button>
    </div>
</div>
<?php } ?>
<table id="example" cellspacing="0" cellpadding="0" border="0" class="data-table drill-data">
    <thead>
        <tr>
            <th>Employee Name</th>
            <?php
            if(!empty($calendar)){
                foreach($calendar as $year => $month){
                    foreach($month as $monthKey => $days){ ?>
                        <th><?php 
                        $dateObj   = DateTime::createFromFormat('!m', $monthKey);
                        $monthName = $dateObj->format('F'); // March
                        echo $monthName; ?></th>
                    <?php }
                }
            }
            ?>
        </tr>
    </thead>
    <tbody style="text-align:center;">
        <?php
            if(!empty($emp_engaged)){
                foreach($emp_engaged as $emp_name => $yearData){ ?>
                <tr>
                    <td><?php echo $emp_name; ?></td>
                    <?php
                    foreach($calendar as $year => $month){
                        $months = array_keys($month);
                        $emp_last_key = 0;
                        if(isset($yearData[$year]) && !empty($yearData[$year])){
                            $emp_last_key = end(array_keys($yearData[$year]));
                        }
                        foreach($months as $monthKey){
                            $cell_color = "White";
                            if(isset($yearData[$year][$monthKey])){ 
                                $array_sum = array_sum($yearData[$year][$monthKey]);
                                if($array_sum > 0){
                                    $cell_color = ($monthKey == $emp_last_key) ? "Yellow" : "green";
                                }
                                ?>
                                <td bgcolor="<?php echo $cell_color ?>"></td>
                            <?php }else{ ?>
                                <td bgcolor="<?php echo $cell_color ?>"></td>
                            <?php }                                                
                        }
                    }
                    echo "</tr>";
                }
            }else{ ?>
                <tr>
                    <td colspan="13">No result found</td>
                </tr>
            <?php }
            ?>
    </tbody>
</table>
<script src="<?php echo base_url(); ?>/assets/js/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>