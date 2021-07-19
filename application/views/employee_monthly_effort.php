<script type="text/javascript">
var site_base_url    = "<?php echo base_url(); ?>"; 
var csrf_token_name  = "<?php echo $this->security->get_csrf_token_name(); ?>";
var csrf_hash_token  = "<?php echo $this->security->get_csrf_hash(); ?>";
</script>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Year wise - Monthly Employee Efforts      
      </h1>      
    </section>
    <section class="content">
      <div class="row">     
        <div id="default_view">
            <!--<h4>Year wise - Monthly Employee Efforts</h4>-->
            <form action="" id="advance_filter" method="post">
                <?php echo $this->view('advance_filter'); ?>
            </form>
        </div>
		 <div id="ajax_loader" style="margin: 20px; display: none;" align="center">
            Loading Content.<br><img alt="wait" src="<?php echo base_url(); ?>/assets/images/ajax_loader.gif"><br>Thank you for your patience!
        </div>
        <div id="default_view" class="filter_result">
            <?php echo $this->view('employee_monthly_effort_result'); ?>
        </div>
        </div>     
     </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/projects/bu_changes.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>

<script>
    $("#advance_filter").submit(function(event){
        event.preventDefault();
        var form_data = $('#advance_filter').serialize();	
        $.ajax({
                url : site_base_url + 'employee_report/monthly_employee_effort',
                type: "POST",
                data:form_data,
                beforeSend: function(){
                    $(".filter_result").hide();
                    $('#ajax_loader').show();
                },
                success : function(response){
                    $('#ajax_loader').hide();
                    $(".filter_result").show();
                    $(".filter_result").html(response);
                }
        });
    });
    function report_download(){
        console.log("123");
        var url = site_base_url+'employee_report/employee_project_meter';
	var entity = $("#entity").val();
        var business_unit_id = $("#business_unit_id").val();
        var department_id_fk = $("#department_id_fk").val();
        var practices = $("#practices").val();
        var skill_id = $("#skill_id").val();
        var geography = $("#geography").val();
        var dataArray = {
            'entity' : entity,
            'business_unit_id': business_unit_id,
            'department_ids': department_id_fk,
            'practice_ids': practices,
            'skill_ids': skill_id,
            'geography': geography
        }
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="hidden"  name="export_excel" value="1" />'+
            '<input type="hidden"  name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
            '<textarea style="display:none;" name="postdata">'+JSON.stringify(dataArray)+'</textarea>'+'</form>');
        $('body').append(form);
        $(form).submit();
        return false;
    }
</script>
</body>