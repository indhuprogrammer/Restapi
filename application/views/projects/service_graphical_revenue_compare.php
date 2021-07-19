<script>
//for practicewise invoice compare
//var default_currency_name = '<?php echo $this->default_cur_name; ?>';
var prac_inv_practic_val = <?php echo json_encode($prat_inv_compare['practic_val']); ?>;
var prac_inv_curr_yr_val = <?php echo json_encode($prat_inv_compare['curr_yr_val']); ?>;
var prac_inv_last_yr_val = <?php echo json_encode($prat_inv_compare['last_yr_val']); ?>;
var revenue_label = "<?php echo $prac_filter_by; ?>";
</script>
<h5 class="revenue_compare_head_bar">
<span class="forecast-heading">Practice Wise Revenue Comparison</span>
</h5>
<!--radio name="revenue_name" value="Practice">Practice</radio> <radio name="revenue_name" value="Geography">Geography</radio-->
<div id="revenue_practice_compare_bar" class="plot" style="position: relative; height: 320px; padding-bottom:22px;"></div>

<script type="text/javascript" src="assets/js/projects/service_graphical_revenue_practice_compare_bar.js?v1=1"></script>