<style>
.popover-content{
    color: #000;
}
</style>
<?php
$defectDetect_target = 80;
if($metrics_show_hide['defectDetectEfficiency']){
?>
<div id="quality_test_det">
    <table class="data-table1 table-style-pop">
        <thead>
            <tr><th style="text-align:center" colspan="6">Defect Detect Efficiency (>= <?= $defectDetect_target; ?>%)
                <img src="assets/img/info.png" data-placement="top" data-toggle="popover" data-content="Measure of identifying the defects early within the same phase. Greater the value, better the detection efficiency." height="16" width="16" class="dde_popover">
                </th>
            </tr>
            <tr><th style="text-align:center" colspan="6">
                (No of defects detected during a phase that were Injected in the same Phase) <br>* 100/Total no of defect Injected during that phase
                </th>
            </tr>
          <tr style="text-align:center">
            <th>Phase</th>
            <th>Stage of injection</th>
            <th>Stage of detection</th>
            <th>Matches count</th>
            <th>Result(%)</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($defectDetectEfficiency['phases'] as $key => $value){ 
                $result = !empty($defectDetectEfficiency['result'][$value]) ? $defectDetectEfficiency['result'][$value] : 0;
                if($result >= $defectDetect_target ){
                    $qfcls = "td_bg_green";
                }else{
                    $qfcls = "td_bg_red";
                }
            ?>
            <tr>
                <td><?= $value ?></td>
                <td><?= $defectDetectEfficiency['stage_of_injection'][$value] ?></td>
                <td><?= $defectDetectEfficiency['stage_of_detection'][$value] ?></td>
                <td><?= $defectDetectEfficiency['same_stage_count'][$value] ?></td>
                <td class="<?= $qfcls; ?>" ><?php echo number_format($result,2,".","."); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>