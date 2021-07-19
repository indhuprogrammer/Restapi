<?php
$cdd_target = 25;
$testEffective_target = 75;
$defectLeak_target = 25;
if($metrics_show_hide['clientDefenctDensity']){
?>
<tr>
    <td>Client Defect Density % 
        <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" class="cdd_popover">
    </td>
    <td id="cdd_det" class="hide">Measure of defects identified by the client vs defects identified <br>by project team before releasing to client.  <br>Lesser the value more is the quality of software. <br></td>
    <td> ≤ <?= $cdd_target; ?>%</td>
     <?php if($clientDefenctDensity['result'] <= $cdd_target ){
            $qfcls = "td_bg_green";
          }else{
            $qfcls = "td_bg_red";
          } ?>
    <td class="<?= $qfcls; ?>"> <?= $clientDefenctDensity['result'].'%';  ?> </td>
    <td>
        <p>Total number of client defects</p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p>Total Number of Defects</p>
    </td>
    <td>
        <p><?= $clientDefenctDensity['client_tickets'] ?></p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p><?= $clientDefenctDensity['total_tickets'] ?></p>
    </td>
</tr>
<?php } 
if($metrics_show_hide['testEffectiveness']){
    ?>
<tr>
    <td>
        Test Effectiveness<img src="assets/img/info.png" data-toggle="popover" height="16" width="16" class="testeffective_popover">
    </td>
    <td id="testeffective_det" class="hide">Measure of how many critical defects have been identified <br> in internal QA, to avoid those in client environment.<br> Greater the value, better is the QA efficiency.</td>
    <td> ≥ <?= $testEffective_target; ?>%</td>
    <?php if($testEffectiveness['result'] >= $testEffective_target ){
            $qfcls = "td_bg_green";
          }else{
            $qfcls = "td_bg_red";
          } ?>
    <td class="<?= $qfcls; ?>"> <?= $testEffectiveness['result'].'%';  ?> </td>
    <td>
        <p>Sum of Blocker and Critical defects identified by QC</p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p>Total blocker & critical defects(QC + UAT)</p>
    </td>
    <td>
        <p><?= $testEffectiveness['tickets_byQC'] ?></p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p><?= $testEffectiveness['total_tickets'] ?></p>
    </td>
</tr>
<?php } 
if($metrics_show_hide['defectLeakage']){
?>
<tr>
    <td>Defect Leakage % 
        <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" class="leakage_popover">
    </td>
    <td id="leakage_det" class="hide">Helps in identifying how many less defects are leaked to the client <br>from the internal Quality team. Lesser the value, <br>better is the internal QC. </td>
    <td> ≤ <?= $defectLeak_target; ?>%</td>
    <?php if($defectLeakage['result'] <= $defectLeak_target ){
            $qfcls = "td_bg_green";
          }else{
            $qfcls = "td_bg_red";
          } ?>
    <td class="<?= $qfcls; ?>"> <?= $defectLeakage['result'].'%';  ?> </td>
    <td>
        <p>Total no of defects attributed to Testing Phase but found in UAT</p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p>Total Number of Defects in Testing phase + Defects attributed to testing but found in UAT</p>
    </td>
    <td>
        <p><?= $defectLeakage['UAT_detect_tickets'] ?></p>
        <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
        <p><?= $defectLeakage['total_tickets'] ?></p>
    </td>
</tr>
<?php }
if(isset($sub_project)){ ?>
      </tbody>
  </table>
</div>
<?php } ?>
