<div class="container" style="width: 1132px">
    <div class="row">
      <!-- Effort Variation Start -->
      <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Effort Variation  <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Effort Variation" height="16" width="16" id="effort_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Actual Effort</td>
              <td>4</td>
            </tr>
            <tr>
              <td>Estimated Effort</td>
              <td>12</td>
            </tr>
            <tr class="total_bg">
              <td>Effort Variation % (Target (±) 15% )</td>
              <td class="td_bg_green">12%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Effort Variation End -->
      
      <!-- Quality of Fixes Start -->
      <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Quality of Fixes  <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Quality of Fixes" height="16" width="16" id="quality_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Total no.of Defects reported as fixed</td>
              <td><?= $resolved = isset($journaldet[3]) ? $journaldet[3]: 0 ?></td>
            </tr>
            <tr>
              <td>Total no. of reopened bugs</td>
              <td><?= $reopen = isset($journaldet[8]) ? $journaldet[8]: 0 ?></td>
            </tr>
            <tr>
              <td>Total no. of new Bugs due to fix</td>
              <td><?= $newbug = isset($issueCount[1]) ? $issueCount[1]: 0 ?></td>
            </tr>
            <tr class="total_bg">
              <td>Quality of Fixes % (Target ≥ 95% )</td>
              <?php 
                $quality = (($resolved - $reopen) / ($resolved + $newbug) * 100 ); 
                if($quality >= 95 ){
                  $cls = "td_bg_green";
                }else{
                  $cls = "td_bg_red";
                }
              ?>
              <td class="<?= $cls; ?>"><?= (number_format($quality,2).'%');  ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Quality of Fixes end -->
      
      <!-- Schedule Variation Start -->
      <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Schedule Variation  <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Schedule Variation" height="16" width="16" id="schedule_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Actual End date</td>
              <td>4</td>
            </tr>
            <tr>
              <td>Planned Start date</td>
              <td>12</td>
            </tr>
            <tr>
              <td>Planned End date</td>
              <td>12</td>
            </tr>
            <tr class="total_bg">
              <td>Schedule Variation % (Target (±) 9%)</td>
              <td class="td_bg_green">9%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Schedule Variation End -->      
      
    </div>
    <br>
    
    <div class="row">
      <!-- Load Factor Start -->
      <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Load Factor  <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Load Factor" height="16" width="16" id="load_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Actual Effort</td>
              <td>4</td>
            </tr>
            <tr>
              <td>Available Effort</td>
              <td>12</td>
            </tr>
            <tr class="total_bg">
              <td>Load Factor (Target ≥ 0.6 and ≤ 1.06 )</td>
              <td class="td_bg_red">2.50</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Load Factor End -->
      
      <!-- Requirement Stability Index Start -->
      <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Requirement Stability Index <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Requirement Stability Index" height="16" width="16" id="requirement_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Total number of Original Requirements</td>
              <td>2</td>
            </tr>
            <tr>
              <td>Cumulative number of requirements changed (till date)</td>
              <td>8</td>
            </tr>
            <tr>
              <td>Cumulative number of requirements added (till date)</td>
              <td>2</td>
            </tr>
            <tr>
              <td>Cumulative number of requirements deleted (till date)</td>
              <td>8</td>
            </tr>
            <tr class="total_bg">
              <td>Requirement Stability Index (Target ≤ 1.50 )</td>
              <td class="td_bg_green">1.25</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Requirement Stability Index End -->
      
      <!-- Rework Effort Start -->
      <!-- <div class="col-md-4">
        <table class="data-table1 table-style widadj">
          <thead>
            <tr>
              <th colspan="2">Rework Effort <span class="pull-right">
                <img src="assets/img/info.png" data-toggle="popover" title="Rework Effort" height="16" width="16" id="rework_popover"></span>
              </th>
            </tr>
            <tr class="tr_col">
              <th>Parameter</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Sum of effort spent in fixing review defects</td>
              <td>2</td>
            </tr>
            <tr>
              <td>Sum of effort spent in fixing Testing defects</td>
              <td>8</td>
            </tr>
            <tr>
              <td>UAT Defects</td>
              <td>2</td>
            </tr>
            <tr>
              <td>Total effort spent on Project</td>
              <td>8</td>
            </tr>
            <tr class="total_bg">
              <td>Rework Effort (Target ≤ 8.5%)</td>
              <td class="td_bg_green">7%</td>
            </tr>
          </tbody>
        </table>
        
      </div> -->
      <!-- Rework Effort End -->
  </div>
  <br>
  <?php /* ?>
  <div class="row">
    <!-- Defect Density & Review Efficiency Start -->
    <div class="col-md-4">
      <table class="data-table1 table-style widadj">
        <thead>
          <tr>
            <th colspan="2">Defect Density & Review Efficiency <span class="pull-right">
              <img src="assets/img/info.png" data-toggle="popover" title="Defect Density & Review Efficiency" height="16" width="16" id="density_popover"></span>
            </th>
          </tr>
          <tr class="tr_col">
            <th>Parameter</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Total number of Defects attributed to the project</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Actual Size of the project</td>
            <td>8</td>
          </tr>
          <tr>
            <td>Total Number of Review Defects</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Testing defects</td>
            <td>8</td>
          </tr>
          <tr>
            <td>Review Defects</td>
            <td>8</td>
          </tr>
          <tr>
            <td>UAT defects</td>
            <td>8</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Defect Density & Review Efficiency End -->
    
    <!-- Productivity Start -->
    <div class="col-md-4">
      <table class="data-table1 table-style widadj">
        <thead>
          <tr>
            <th colspan="2">Productivity <span class="pull-right">
              <img src="assets/img/info.png" data-toggle="popover" title="Productivity" height="16" width="16" id="productivity_popover"></span>
            </th>
          </tr>
          <tr class="tr_col">
            <th>Parameter</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Total Actual Size</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Total Actual Effort</td>
            <td>8</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Productivity End -->
    
    <!-- Defect detection efficiency Start -->
    <div class="col-md-4">
      <table class="data-table1 table-style widadj">
        <thead>
          <tr>
            <th colspan="2">Defect detection efficiency <span class="pull-right">
              <img src="assets/img/info.png" data-toggle="popover" title="Defect detection efficiency" id="detection_popover"></span>
            </th>
          </tr>
          <tr class="tr_col">
            <th>Parameter</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Detected Defects that were Injected in the same Phase</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Injected Defects</td>
            <td>8</td>
          </tr>
          <tr>
            <td>Defect detection efficiency %</td>
            <td>89</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Defect detection efficiency End -->
    </div>
    <?php */ ?>
</div>

<style media="screen">
  .widadj{
    width: 100%
  }
  .tr_col th{
    border-width: 1px 1px 1px 0;
    background: url("../img/toolbg.png") repeat-x scroll bottom #6A8CD2;
    color:#fff;
  }
  .popup {
    width: 700px;
    max-height: 300px;
    position: absolute;
    z-index:9999;
    left:200px;
    bottom: 180px;
    background: #fff;
    overflow: auto;
    display: none;
}
.table-style-pop th{
  border-width: 1px 1px 1px 0;
  background: url("../img/toolbg.png") repeat-x scroll bottom #e0e2f7;
  color:black;
}
.data-table1 {
  background: white;
  color: black;
}
.popover {max-width:1000px;z-index: 999999999}
/* Popover Header */
.popover-title {
    font-size: 10px;
    text-align:center;
}
/* Popover Body */
.popover-content {
    font-size: 10px;
    text-align:center;
}
.col-md-4{
  position:unset !important;
}
.total_bg{
  background-color: #ccc;
}
.td_bg_red{
  background-color: #f55;
}
.td_bg_green{
  background-color: #97ff71;
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
        placement : 'left',
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
    $('#quality_popover').popover({
        placement : 'top',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#quality_test_det').html();
        }
    });   
    $('#requirement_popover').popover({
        placement : 'top',
        trigger : 'hover',
        html: true,
        content: function() {
          return $('#requirements_det').html();
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
});
</script>


<!-- ================Static Contents to show in popup - Start ============= -->
<?php $this->load->view('projects/quality_metrics_details') ?>
<!-- ================Static Contents to show in popup - End ============= -->
