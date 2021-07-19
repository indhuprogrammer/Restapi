<!-- ================Static Contents to show in popup - Start ============= -->
<div style="display:none" id="quality_test_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Quality of Fixes %</td>
        <td rowspan="2"> ≥ 95%</td>
        <td rowspan="2">To determine the quality of fix done by development team. <br>This will also show how often previously working <br>functionality was adversely affected by software fixes.</td>
        <td>Total no.of Defects reported as fixed - <br>Total no. of reopened bugs</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">>Monthly from Project kick off</td>
      </tr>
      <tr>
        <td>Total no.of Defects reported as fixed  + <br>Total no. of new Bugs due to fix</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="requirements_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Requirement Stability Index</td>
        <td rowspan="2"> <= 1.50</td>
        <td rowspan="2">This is used to measure the changes that are coming in (compared to the original requirements decided at the start of the project) during the course of the project. This measures the dimension of changes in terms of number of requests</td>
        <td>(Total number of Original Requirements + Cumulative number of requirements changed (till date) + Cumulative number of requirements added (till date) + Cumulative number of requirements deleted (till date))</td>
        <td rowspan="2"></td>
        <td rowspan="2">Monthly Completed Phase</td>
      </tr>
      <tr>
        <td>Total number of Original Requirements</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="density_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Defect Density</td>
        <td rowspan="2"> <= 0.33</td>
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
        <td rowspan="2"> >= 60%</td>
        <td rowspan="2">Review Efficiency can be defined as the raio of defects captured in reviews and also including the defects that have come out of testing and UAT</td>
        <td>Total Number of Review Defects</td>
        <td rowspan="2">X 100</td>
      </tr>
      <tr>
        <td>Testing defects + Review Defects + UAT defects</td>
      </tr>
  
    </tbody>
  </table>
</div>

<div style="display:none" id="rework_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Rework Effort</td>
        <td rowspan="2"> <= 8.5%</td>
        <td rowspan="2">Total effort spent in fixing internal review and testing defects</td>
        <td>( Sum of effort spent in fixing review defects) +  (Sum of effort spent in fixing Testing defects+UAT Defects)</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">Monthly Completed Phase</td>
      </tr>
      <tr>
        <td>Total effort spent on Project </td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="productivity_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Productivity</td>
        <td rowspan="2"> >= 2.5 ZSL Points/Person days</td>
        <td rowspan="2">Productivity is the rate at which the work output is produced in a project. It is always expressed over the entire life cycle i.e. for all the phases</td>
        <td>Total Actual Size</td>
        <td rowspan="2"></td>
        <td rowspan="2">End of Project or Iteration</td>
      </tr>
      <tr>
        <td>Total Actual Effort</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="detection_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Defect detection efficiency</td>
        <td rowspan="2"> >= 100%</td>
        <td rowspan="2">Defect Detection Efficiency (DDE) is the number of defects detected during a phase/stage that are injected during that same phase divided by the total number of defects injected during that phase.</td>
        <td>Detected Defects that were Injected in the same Phase</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">End of Project or Iteration</td>
      </tr>
      <tr>
        <td>Injected Defects</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="effort_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Effort Variation</td>
        <td rowspan="2"> (±) 15%</td>
        <td rowspan="2">This metric is the difference between Estimated and Actual effort as compared against the Estimated Effort</td>
        <td>(Actual Effort – Estimated Effort)</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">Monthly from Project kick off</td>
      </tr>
      <tr>
        <td>Estimated Effort</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="schedule_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Schedule Variation</td>
        <td rowspan="2"> (±) 9%</td>
        <td rowspan="2">This metric is the ratio of difference between the Actual End Date and Planned End Date Vs difference between Planned End Date and Planned Start Date for the project. This metric gives the Schedule Variation % in terms of number of days slipped as against planned schedule. Schedule Variation is an important metric to determine the capability of on-time delivery. </td>
        <td>(Actual End date – Planned End date)</td>
        <td rowspan="2">X 100</td>
        <td rowspan="2">Monthly Completed Phase</td>
      </tr>
      <tr>
        <td>(Planned End date - Planned Start date+1)</td>
      </tr>
  
    </tbody>
  </table>
</div>
<div style="display:none" id="load_det">
  <table class="data-table1 table-style-pop">
    <thead>
      <tr>
        <th>Objective / Metric</th>
        <th>Target</th>
        <th>Measures to be collected</th>
        <th>Method of computation</th>
        <th></th>
        <th>Metrics Collection Freq</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2">Load Factor</td>
        <td rowspan="2"> ≥ 0.6 and ≤ 1.06 </td>
        <td rowspan="2">Load Factor is computed as ratio of Actual Effort expended in the project to Total Effort available to the project in terms of number of resources allocated to the project for any given period.</td>
        <td>(Actual Effort )</td>
        <td rowspan="2"></td>
        <td rowspan="2">Monthly Completed Phase</td>
      </tr>
      <tr>
        <td>(Available Effort)</td>
      </tr>
  
    </tbody>
  </table>
</div>

<!-- ================Static Contents to show in popup - End ============= -->
