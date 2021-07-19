<div class="table-responsive border-bottom">
<table id="example" cellspacing="0" cellpadding="0" border="0" class="data-table drill-data" style="width:100%">
    <thead>
        <?php 
        // Table Headers - Year, Month and Resource type
        if(isset($monthly_efforts['year_months']) && !empty($monthly_efforts['year_months'])){
            $year_months = $monthly_efforts['year_months'];
            unset($monthly_efforts['year_months']);
            echo "<tr>";
            echo "<tr><th rowspan='2'>Employee Name</th>";
            foreach($year_months as $year => $months){
                sort($months);
                foreach($months as $monthKey){
                    $dateObj   = DateTime::createFromFormat('!m', $monthKey);
                    $monthName = $dateObj->format('F');
                ?>
                <th colspan="3"><?= $year." - ".$monthName ?> (Hours)</th>
                <?php }
            }
            echo "</tr>";
            echo "<tr>";
            foreach($year_months as $year => $months){
                sort($months);
                foreach($months as $monthKey){
                ?>
                    <th>Billable</th>
                    <th>Non-Billable</th>
                    <th>Internal</th>
                <?php }
            }
            echo "</tr>";
        }
        ?>
    </thead>
    <tbody>
        <?php if(isset($monthly_efforts) && !empty($monthly_efforts)){
            foreach($monthly_efforts as $empname => $effort_data){
                echo "<tr><td>$empname</td>";
                foreach($year_months as $year => $months){
                    sort($months);
                    foreach($months as $monthKey){ 
                        $billable = isset($effort_data[$year][$monthKey]['Billable']) ? $effort_data[$year][$monthKey]['Billable'] : 0;
                        $non_billable = isset($effort_data[$year][$monthKey]['Non-Billable']) ? $effort_data[$year][$monthKey]['Non-Billable'] : 0;
                        $internal = isset($effort_data[$year][$monthKey]['Internal']) ? $effort_data[$year][$monthKey]['Internal'] : 0;
                        ?>
                        <td><?= $billable ?></td>
                        <td><?= $non_billable ?></td>
                        <td><?= $internal ?></td>
                    <?php }
                }
                echo "</tr>";
            }
        } else{ ?>
                <tr>
                    <td colspan="13">No result found</td>
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
<script src="<?php echo base_url(); ?>/assets/js/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>