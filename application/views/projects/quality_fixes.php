<?php
if(isset($sub_project)){
?>
<div id="quality_test_det" style="width: 80%;">
    <h4><?= $sub_project ?></h4>
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th style="width:14%">Objective / Metric</th>
        <th class="hide">Measures to be collected</th>
        <th style="width: 10%;" >Target</th>
        <th style="width: 6%;">Actual</th>
        <th style="width: 26%;">Method of computation</th>
        <th style="width: 15%;">Values</th>
      </tr>
    </thead>
    <tbody>
<?php } ?>
<tr>
        <td>Quality of Fixes % 
            <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" class="quality_popover">
        </td>
        <td id="quality_det" class="hide">To determine the quality of fix done by development team. <br>This will also show how often previously working <br>functionality was adversely affected by software fixes.</td>
        <td> ≥ 95%</td>
        <?php 
          
          if($qualityFixes['result'] >= 95 ){
            $qfcls = "td_bg_green";
          }else{
            $qfcls = "td_bg_red";
          }
          ?>
        <td class="<?= $qfcls; ?>"> <?= (number_format($qualityFixes['result'],2).'%');  ?> </td>
        <td>
          <p>Total no.of Defects reported as fixed - <br>Total no. of rightly reopened bugs</p>
          <hr class="hr_fix"><span class="hr_per">X 100</span>
          <p>Total no.of Defects reported as fixed  + <br>Total no. of new Bugs due to fix</p>
        </td>
        <td>
          <p>(<?= $qualityFixes['resolved'] ?> - <?= $qualityFixes['reopen'] ?> )</p>
          <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
          <p>(<?= $qualityFixes['resolved'] ?> + <?= $qualityFixes['newbug'] ?>)</p>
        </td>
      </tr>
