<!-- ================Static Contents to show in popup - Start ============= -->
<div align="center" style="margin-top: -11px;">
<b><?php if($noprojects) { echo $noprojects;die;} ?></b>
</div>
<div id="quality_test_det" style="width: 80%;">
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

      <tr>
        <td>Effort Variation 
          <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" id="effort_popover">
        </td>
        <td id="effort_det" class="hide">This metric is the difference between Estimated and Actual effort as compared against the Estimated Effort</td>
        <td> (±) 15%</td>
        <?php
          $actual_hour = isset($actual_hour) && $actual_hour ? $actual_hour : 0; 
          $estimate_hour = isset($estimate_hour) && $estimate_hour ? $estimate_hour : 0; 
          $effortVariation = (($actual_hour - $estimate_hour) / $estimate_hour * 100 );
          if($effortVariation > 15){
            $efClass = "td_bg_red";
          }else{
            $efClass = "td_bg_green";
          }
        ?>
        <td class="<?= $efClass ?>"> <?= (number_format($effortVariation,2).'%'); ?> </td>
        <td>
          <p>(Actual Effort – Estimated Effort)</p>
          <hr class="hr_fix"><span class="hr_per">X 100</span>
          <p>Estimated Effort</p>
        </td>
        <td>
          <p>(<?= $actual_hour ?> - <?= $estimate_hour ?>)</p>
          <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
          <p><?= $estimate_hour ?></p>
        </td>
      </tr>
      

      <tr>
        <td>Schedule Variation 
            <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" id="schedule_popover">
        </td>
        <td id="schedule_det" class="hide">This metric is the ratio of difference between the Actual End Date and Planned End Date Vs difference between Planned End Date and Planned Start Date for the project. This metric gives the Schedule Variation % in terms of number of days slipped as against planned schedule. Schedule Variation is an important metric to determine the capability of on-time delivery. </td>
        <td> (±) 9%</td>
        <?php 
        if($scheduleVariance['result'] > 9){
            $svClass = "td_bg_red";
          }else{
            $svClass = "td_bg_green";
          }
        ?>
        <td class="<?= $svClass ?>"> <?= $scheduleVariance['result'] ?> </td>
        <td>
          <p>(Actual End date – Planned End date)</p>
          <hr class="hr_fix"><span class="hr_per">X 100</span>
          <p>(Planned End date - Planned Start date+1)</p>
        </td>
        <td>
          <p>(<?= $scheduleVariance['actual_end_date'].' - '.$scheduleVariance['planned_end_date'] ?>)</p>
          <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width">X 100</span>
          <p>(<?= $scheduleVariance['planned_end_date'].' - '.$scheduleVariance['planned_start_date'].' + 1' ?>)</p>
        </td>
      </tr>
       <tr>
        <td>Load Factor 
            <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" id="load_popover">
        </td>
        <td id="load_det" class="hide">Load Factor is computed as ratio of Actual Effort expended in the project to Total Effort available to the project in terms of number of resources allocated to the project for any given period.</td>
        <td> ≥ 0.6 and ≤ 1.06 </td>
        <?php 
          $loadFactor = ($actual_hour  / $estimate_hour);
          if($loadFactor >= 0.6 && $loadFactor <= 1.06){
            $lfClass = "td_bg_green";
          }else{
            $lfClass = "td_bg_red";
          }
        ?>
        <td class="<?= $lfClass ?>"> <?= number_format($loadFactor,2) ?></td>
        <td>
          <p>(Actual Effort )</p>
          <hr class="hr_fix"><span class="hr_per"></span>
          <p>(Available Effort)</p>
        </td>
        <td>
          <p>(<?= $actual_hour ?>)</p>
          <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width"></span>
          <p>(<?= $estimate_hour ?>)</p>
        </td>
      </tr>
      <?php /*
      <tr>
        <td>Quality of Fixes % 
            <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" id="quality_popover">
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
     */ ?>
      <?php 
      $data = [];
      $data['qualityFixes'] = $qualityFixes;
      $data['clientDefenctDensity'] = $clientDefenctDensity;
      $data['testEffectiveness'] = $testEffectiveness;
      $data['defectLeakage'] = $defectLeakage;
      $data['defectDetectEfficiency'] = $defectDetectEfficiency;
//      echo $this->load->view('projects/quality_metrics_table',$data); 
      echo $this->load->view('projects/quality_fixes', $data, true);
      echo $this->load->view('projects/additional_quality_metrics', $data, true);
      
      /* ?>
      <tr>
        <td>Requirement Stability Index 
            <img src="assets/img/info.png" data-toggle="popover" height="16" width="16" id="requirement_popover">
        </td>
        <td id="requirement_det"  class="hide">This is used to measure the changes that are coming in (compared to the original requirements decided at the start of the project) during the course of the project. This measures the dimension of changes in terms of number of requests</td>
        <td> ≤ 1.50</td>
        <td class="td_bg_green"> 1.25 </td>
        <td>
          <p>(Total number of Original Requirements + <br> 
          Cumulative number of requirements changed (till date) + <br>
          Cumulative number of requirements added (till date) + <br>
          Cumulative number of requirements deleted (till date))</p>
          <hr class="hr_fix"><span class="hr_per"></span>
          <p>Total number of Original Requirements</p>
        </td>
        <td>
          <p>(10 + 5 + 2 + 3)</p>
          <hr class="hr_fix hr_fix_width"><span class="hr_per hr_per_width"></span>
          <p>10</p>
        </td>
      </tr>
    <?php }*/ ?> 
      <!-- <tr>
        <td rowspan="2">Defect Density</td>
        <td rowspan="2"> <= </td>
        <td rowspan="2">0.33</td>
        <td rowspan="2">Defect Density can be defined as the ratio of Defects to Size or the ratio of Defects to effort (i.e - Review Defects - Requirements, Design, Coding & Testing).
                        The Unit of Measure for Size could vary as defined by the project. The total defects would include both Review (Requirements, Design, Coding) and Test defects (Application).            </td>
        <td>Total number of Defects attributed to the project </td>
        <td rowspan="2"></td>
        <td rowspan="4">End of iteration / project or end of Test Execution Phase</td>
      </tr>
      <tr>
        <td>Actual Size of the project</td>
      </tr>

      <tr>
        <td rowspan="2">Review Efficiency</td>
        <td rowspan="2"> >= </td>
        <td rowspan="2"> 60%</td>
        <td rowspan="2">Review Efficiency can be defined as the raio of defects captured in reviews and also including the defects that have come out of testing and UAT</td>
        <td>Total Number of Review Defects</td>
        <td rowspan="2">X 100</td>
      </tr>
      <tr>
        <td>Testing defects + Review Defects + UAT defects</td>
      </tr>

       <tr>
        <td rowspan="2">Rework Effort</td>
        <td rowspan="2"> <= </td>
        <td rowspan="2"> 8.5%</td>
        <td rowspan="2">Total effort spent in fixing internal review and testing defects</td>
        <td>( Sum of effort spent in fixing review defects) +  (Sum of effort spent in fixing Testing defects+UAT Defects)</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">Monthly Completed Phase</td>
      </tr>
      <tr>
        <td>Total effort spent on Project </td>
      </tr>

      <tr>
          <td rowspan="2">Productivity</td>
          <td rowspan="2"> >= </td>
          <td rowspan="2"> 2.5 ZSL Points/Person days</td>
          <td rowspan="2">Productivity is the rate at which the work output is produced in a project. It is always expressed over the entire life cycle i.e. for all the phases</td>
          <td>Total Actual Size</td>
          <td rowspan="2"></td>
          <td rowspan="2">End of Project or Iteration</td>
      </tr>
      <tr>
        <td>Total Actual Effort</td>
      </tr>

      <tr>
        <td rowspan="2">Defect detection efficiency</td>
        <td rowspan="2"> >= </td>
        <td rowspan="2"> 100%</td>
        <td rowspan="2">Defect Detection Efficiency (DDE) is the number of defects detected during a phase/stage that are injected during that same phase divided by the total number of defects injected during that phase.</td>
        <td>Detected Defects that were Injected in the same Phase</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">End of Project or Iteration</td>
      </tr>
      <tr>
        <td>Injected Defects</td>
      </tr> -->

       

    </tbody>
  </table>
</div>
<?php echo $this->load->view('projects/defect_detect_efficiency', $data, true); ?>
<style>
.td_bg_red{
  background-color: #f55;
}
.td_bg_green{
  background-color: #97ff71;
}
.hr_fix {
  width: 72%;
  display: inline-block;
  margin-right: 9px;
  vertical-align: middle;
  text-align: center;
  margin-left: 23px;
  border-color: #7f7a7a;
}
.hr_per {
  width: 13%;
  display: inline-block;
}
.hr_fix_width{
  width: 57%;
}
.hr_per_width{
  width: 20%;
}
#quality_test_det p{
  text-align: center;
}
.popover {max-width:500px;z-index: 999999999}
/* Popover Header */
.popover-title {
    font-size: 12px;
    text-align:center;
}
/* Popover Body */
.popover-content {
    font-size: 12px;
    text-align:center;
}
#quality_test_det table tr td:nth-child(4), #quality_test_det table tr td:nth-child(3) {
    text-align: center;
}
</style>

<script>
$(document).ready(function(){
    $('#effort_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#effort_det').html();
        }
    });   
    $('#schedule_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#schedule_det').html();
        }
    });   
    $('#load_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#load_det').html();
        }
    });   
    $('.quality_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#quality_det').html();
        }
    });   
    $('#requirement_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#requirement_det').html();
        }
    });   
    $('#rework_popover').popover({
        placement : 'left',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#rework_det').html();
        }
    });   
    $('#density_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#density_det').html();
        }
    });   
    $('#productivity_popover').popover({
        placement : 'top',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#productivity_det').html();
        }
    });   
    $('#detection_popover').popover({
        placement : 'left',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#detection_det').html();
        }
    });   
    $('.cdd_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#cdd_det').html();
        }
    });   
    $('.testeffective_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#testeffective_det').html();
        }
    });   
    $('.leakage_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#leakage_det').html();
        }
    });   
    $('.dde_popover').popover({
        placement : 'right',
        trigger : 'hover',
        html: true
    });  
});

</script>