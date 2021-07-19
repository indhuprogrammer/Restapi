$(document).ready(function() {
    $("#add_rca").validate({
        rules:
        {
            rca_label:
            {
                required: true,
            },
            rca_slug: 
            {
                required: true,
                remote:
                {
                    url: site_base_url+'compliance_config/checkDuplicateRca',
                    type: "post",
                    data:
                    {
                        rca_id: function()
                        {
                                return $( "#rca_id" ).val();
                        },
                        'ci_csrf_token': csrf_hash_token,
                    },
                },
            }
        },
        messages:
        {
            rca_label:
            {
                required: "RCA Label field is Required",
            },
            rca_slug:
            {
                required: "RCA Slug field is Required",
                remote: "Given RCA already existing"
            }
        }
    });
    
    $("#rca_label").on("keyup",function(){
        console.log(this.value); 
        var slug = convertToSlug(this.value);
        $("#rca_slug").val(slug);
        $('#rca_slug').blur();
    });
});

// Delete the Function head
function deleteRca(id) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+id+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(id) {
    window.location.href = site_base_url+'compliance_config/delete_rca/'+id;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'_')
        .replace(/[^\w-]+/g,'')
        ;
}

