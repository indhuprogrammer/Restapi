<style>
select.width200px, select{
    width:170px !important;
}
#year{
    width:80px !important;
}
</style>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<table cellspacing="0" cellpadding="0" border="0" class="data-table filter-box">
    <thead>
        <tr>
            <th style="width: 5%;">Year</th>
            <th style="width: 10%;">Entity</th>
            <th style="width: 15%;">Business Unit</th>	
            <th style="width: 15%;">Department</th>								
            <th style="width: 15%;">Practice</th>	
            <th style="width: 10%;">Skill</th>	
            <th style="width: 15%;">Geography / Region</th>
            <th style="width: 15%;"></th>
        </tr>
    </thead>
    <tbody style="text-align:center;">
    <tr>
        <td>
          <select title="Select Business Unit" id="year" name="year">
            <?php $start_year = "1970"; 
            $current_year = date("Y");
            for($i=$start_year;$i<=$current_year;$i++){ 
                $selected = ($i == $current_year) ? "selected='selected'" : "";
                ?>
                <option value="<?=  $i;?>" <?=  $selected;?>><?= $i; ?></option>
            <?php }
            ?>
          </select>
        </td>
        <td >
          <select title="Select Business Unit" id="entity" name="entity[]" multiple="multiple">
            <?php if(count($entitys)>0 && !empty($entitys)) { ?>
                <?php foreach($entitys as $enty) { ?>
                    <option value="<?php echo $enty->div_id;?>"><?php echo $enty->division_name; ?></option>
                <?php } ?>
            <?php } ?>
          </select>
        </td>
        <td>
            <select title="Select Business Unit" id="business_unit_id" name="business_unit_id[]" multiple="multiple">
                <?php if(count($business_unit)>0 && !empty($business_unit)){?>
                    <?php foreach($business_unit as $bu){?>
                        <option <?php echo in_array($bu['id'],$business_unit_ids)?'selected="selected"':'';?> value="<?php echo $bu['id'];?>"><?php echo $bu['business_unit'];?></option>
                <?php } }?>
            </select>
        </td>
        <td >
          <select title="Select Department" id="department_id_fk" name="department_ids[]" multiple="multiple" >
            <?php if(count($departments)>0 && !empty($departments)){?>
                <?php foreach($departments as $depts){?>
                    <option <?php echo in_array($depts['department_id'],$department_ids)?'selected="selected"':'';?> value="<?php echo $depts['department_id'];?>"><?php echo $depts['department_name'];?></option>
            <?php } }?>
          </select>
        </td>
        <td>
            <select title="Select Practice" id="practices" name="practice_ids[]" multiple="multiple">
                <?php if(count($practice_ids_selected)>0 && !empty($practice_ids_selected)) { ?>
                    <?php foreach($practice_ids_selected as $prac) {?>
                            <option <?php echo in_array($prac['id'], $practice_ids)?'selected="selected"':'';?> value="<?php echo $prac['id'];?>"><?php echo $prac['practices'];?></option>
                    <?php } } ?>
            </select>
        </td>
        <td >
          <select title="Select Skill" id="skill_id" name="skill_ids[]" multiple="multiple">
                <?php if(count($skill_ids_selected)>0 && !empty($skill_ids_selected)) { ?>
                <?php foreach($skill_ids_selected as $skills) { ?>
                    <option <?php echo in_array($skills['id'],$skill_ids)?'selected="selected"':'';?> value="<?php echo $skills['id'];?>"><?php echo $skills['name'];?></option>
                <?php } }?>
          </select>
        </td>
        <td>
            <select title="Select Department" multiple="multiple" id="geography" name="geography[]">
                <?php if(count($geographies)>0 && !empty($geographies)) { ?>
                    <?php foreach($geographies as $geography) {?>
                        <option <?php echo in_array($geography->georegionid, $geography_ids)?'selected="selected"':'';?> value="<?php echo $geography->georegionid;?>"><?php echo $geography->georegion_name;?></option>
                <?php } } ?>
            </select>
        </td>
        <td>
         <input type="hidden" name="filter" value="1">
        <input type="reset" class="positive input-font" name="advance" id="filter_reset" value="Reset" />
        <input type="submit" class="positive input-font" name="advance" id="advance" value="Search" />
        </td>
    </tr>
</tbody>
</table>