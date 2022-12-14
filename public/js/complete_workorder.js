$(function () {
    $(".modalbox").fancybox({'openEffect': 'none', fitToView: true});

    $("#tabs").tabs();
    $("#tabs").show();
   /* $("#date_cp_in","#date_cp_out").datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true
    });*/
     /*$("#date_cp_out").datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true
    }); */
    
    ///
    
     var dateFormat = "mm/dd/yy",
      from = $( "#date_cp_in" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
          $( "#date_cp_out" ).val($("#date_cp_in").val());
        }),
      to = $( "#date_cp_out" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        minDate: new Date($("#date_cp_in").val()),
      })
      .on( "change", function() {
        //from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      console.log(element.value);
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    } 
    
    //////// Bettween two date //////

});

function showTenantUser(tId) {
    resetUserInfo();
    if (tId != '') {
        $.ajax({
            url: baseUrl + "complete/showtuser",
            type: "post",
            datatype: 'json',
            data: {tId: tId},
            success: function (data) {
                $('.loader').hide();
                $('#create_user_dropdown').html(data);
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }

        });
    }
}


function showUserInfo(tuid) {
    if (tuid != '') {
        $.ajax({
            url: baseUrl + "complete/tuserinfo",
            type: "post",
            datatype: 'json',
            data: {tuid: tuid},
            success: function (data) {
                $('.loader').hide();
                rspData = $.parseJSON(data);
                if (rspData.message == 'success') {
                    userData = rspData.userData;
                    $('#suite').val(userData.suite);
                    $('#email').val(userData.email);
                    $('#phone_number').val(userData.phone);
                }
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }

        });
    }
}

function resetUserInfo() {
    $('select[name^="create_user"] option[value=""]').attr("selected", "selected");
    $('#suite').val('');
    $('#email').val('');
    $('#phone_number').val('');
}

function showWorkOrder(bId) {
    var wnum = $('#work_order').val();
    if (wnum == '') {
        $('#wd_err').html('Please enter work order number');
        return false;
    } else {
        $('#wd_err').html('');
        window.location.href = baseUrl + 'complete/workorder/bid/' + bId + '/wnum/' + wnum;
    }
}
/***********reload page *********/
function reloadPage(page) {

    if (page != 'undefined' && page != '') {
        window.location.hash = page;
    } else {
        window.location.hash = 'note_tab';
    }
    location.reload(true);
}

/***************Work order option Js code ****************/
function showEditForm(woId) {
    var tempForm = $("#tempForm").val();
    if (tempForm == undefined) {
        if (woId != '') {
            $('.loader').show();
            $.ajax({
                url: baseUrl + "complete/showeditwo",
                type: "post",
                datatype: 'json',
                data: {woId: woId},
                success: function (data) {
                    $('.loader').hide();
                    //$('#edit_wo_form').show();
                    $('#edit_wo_form').html(data);
                    $('#edit_wo_form_href').trigger('click');
                    $("#tempForm").val("tempform");
                    //$('.fade_edit_wo').show();
                },
                error: function () {
                    $('.loader').hide();
                    setInterval(function () {
                        alert('There was an error');
                    }, 1000);

                }

            });
        }
    } else {
        var tenant = $('#tenant').val();
        var date_received = $('#date_received').val();
        var time_received = $('#time_received').val();
        var create_user = $('#create_user').val();
        var status = $('#wo_status').val();
        var category = $('#category').val();
        var wo_request = $('#work_order_request').val();
        var curr_cat = $('#curr_cat').val();
        $('#edit_wo_form_href').trigger('click');
        $('#tenant').val(tenant);
        $('#time_received').val(time_received);
        $('#create_user').val(create_user);
        $('#status').val(status);
        $('#category').val(category);
        $('#wo_request').val(wo_request);
        $('#curr_cat').val(curr_cat);
    }

}

function cancelWo() {

    var set_phoneNumber = $('#phone_number').val();
    var set_categoryName = $('#category').val();
    var set_create_user = $("#create_user option:selected").text();
    var set_tenantName = $("#tenant option:selected").text();
    var date_received = $('#date_received').val();
    var time_received = $('#time_received').val();
    var wo_request = $('#work_order_request').val();
    var set_email = $('.set_email').val();
    $('#set_tenantName').html(set_tenantName);
    $('#set_date_requested').html(date_received);
    $('#set_time_requested').html(time_received);
    $('#set_name').html(set_create_user);
    $('#set_work_order_request').html(wo_request);
    $('#set_email').html(set_email);
    $('#set_phoneNumber').html(set_phoneNumber);
    $('#set_categoryName').html(set_categoryName);


    $("div.fancybox-close").trigger("click");
    //$('#edit_wo_form').hide();
    $('#edit_wo_form').html('');
    $('.fade_edit_wo').hide();
}

function updateWO(woId) {
    var tenant = $('#tenant').val();
    var date_received = $('#date_received').val();
    var time_received = $('#time_received').val();
    var create_user = $('#create_user').val();
    var status = $('#wo_status').val();
    var category = $('#category').val();
    var wo_request = $('#work_order_request').val();
    var curr_cat = $('#curr_cat').val();
    var submit_flag = true;

    /**********Check form validation *******/
    if (tenant == '') {
        $('#tenant_error').html("Select Tenant");
        submit_flag = false;
    } else {
        $('#tenant_error').html("");
    }

    if (date_received == '') {
        $('#date_error').html("Select Date");
        submit_flag = false;
    } else {
        $('#date_error').html("");
    }

    if (time_received == '') {
        $('#time_error').html("Enter The Time");
        submit_flag = false;
    } else {
        $('#time_error').html("");
    }

    if (time_received != '') {
        var regex = /^([0]\d|[1][0-2]):([0-5]\d):([0-5]\d)\s?(?:AM|PM)$/i;
        if (!regex.test(time_received)) {
            $('#time_error').html("Enter The Time in Valid Format XX:XX AM|PM");
            submit_flag = false;
        } else {
            $('#time_error').html("");
        }
    }

    if (create_user == '') {
        $('#create_user_error').html("Select Request By");
        submit_flag = false;
    } else {
        $('#create_user_error').html("");
    }

    if (category == '') {
        $('#category_error').html("Select Category");
        submit_flag = false;
    } else {
        $('#category_error').html("");
    }

    if (wo_request == '') {
        $('#worequest_error').html("Work order request can't be blank");
        submit_flag = false;
    } else {
        $('#worequest_error').html("");
    }

    if (submit_flag) {
        if (woId != '') {
            //$('.loader').show();
            $.ajax({
                url: baseUrl + "complete/updatewoinfo",
                type: "post",
                datatype: 'json',
                data: {woId: woId, tenant: tenant, date_received: date_received,
                    time_received: time_received, create_user: create_user, status: status,
                    category: category, wo_request: wo_request, curr_cat: curr_cat},
                success: function (data) {
                    //$('.loader').hide();
                    //$('#edit_wo_form').show();
                    //$('#edit_wo_form').html(data);
                    $('#fdw').addClass('fade_edit_wo');
                    if (data == 'success') {
                        $("div.fancybox-close").trigger("click");
                        //setInterval(function(){ reloadPage(); }, 1000);
                        //reloadPage();
                    } else {
                        alert('Error occurred');
                    }
                },
                error: function () {
                    // $('.loader').hide();
                    alert('There was an error');
                }

            });
        }

    } else
        return false;
}
function updateWOTemp(woId) {

    var tenant = $('#tenant').val();
    var date_received = $('#date_received').val();
    var time_received = $('#time_received').val();
    var create_user = $('#create_user').val();
    var status = $('#wo_status').val();
    var category = $('#category').val();
    var wo_request = $('#work_order_request').val();
    var curr_cat = $('#curr_cat').val();
    var submit_flag = true;

    /**********Check form validation *******/
    if (tenant == '') {
        $('#tenant_error').html("Select Tenant");
        submit_flag = false;
    } else {
        $('#tenant_error').html("");
    }

    if (date_received == '') {
        $('#date_error').html("Select Date");
        submit_flag = false;
    } else {
        $('#date_error').html("");
    }

    if (time_received == '') {
        $('#time_error').html("Enter The Time");
        submit_flag = false;
    } else {
        $('#time_error').html("");
    }

    if (time_received != '') {
        var regex = /^([0]\d|[1][0-2]):([0-5]\d):([0-5]\d)\s?(?:AM|PM)$/i;
        if (!regex.test(time_received)) {
            $('#time_error').html("Enter The Time in Valid Format XX:XX AM|PM");
            submit_flag = false;
        } else {
            $('#time_error').html("");
        }
    }

    if (create_user == '') {
        $('#create_user_error').html("Select Request By");
        submit_flag = false;
    } else {
        $('#create_user_error').html("");
    }

    if (category == '') {
        $('#category_error').html("Select Category");
        submit_flag = false;
    } else {
        $('#category_error').html("");
    }

    if (wo_request == '') {
        $('#worequest_error').html("Work order request can't be blank");
        submit_flag = false;
    } else {
        $('#worequest_error').html("");
    }

    if (submit_flag) {
        if (woId != '') {
            var set_email = $('.set_email').val();
            var edit_wo_form = $('#edit_wo_form').html();
            $("div.fancybox-close").trigger("click");
            $('#edit_wo_form').html(edit_wo_form);
            $('#tenant').val(tenant);
            $('#date_received').val(date_received);
            $('#time_received').val(time_received);
            $('#create_user').val(create_user);
            $('#wo_status').val(status);
            $('#category').val(category);
            $('#work_order_request').val(wo_request);
            $('#curr_cat').val(curr_cat);
            var set_phoneNumber = $('#phone_number').val();
            var set_categoryName = $('#category option:selected').text();
            var set_create_user = $("#create_user option:selected").text();
            var set_tenantName = $("#tenant option:selected").text();
            $('#set_tenantName').html(set_tenantName);
            $('#set_date_requested').html(date_received);
            $('#set_time_requested').html(time_received);
            $('#set_name').html(set_create_user);
            $('#set_work_order_request').html(wo_request);
            $('#set_email').html(set_email);
            $('#set_phoneNumber').html(set_phoneNumber);
            $('#set_categoryName').html(set_categoryName);
            if (set_change_priority != 'NotChanged') {
                $('#set_change_priority').html(set_change_priority);
            }
            $('.showmodel').hide();
            $('.hidemodel').show();
        }
    }
}

function showParameter(bId) {
    //$('.loader').show();
    $.ajax({
        url: baseUrl + "complete/woparameter",
        type: "post",
        datatype: 'json',
        data: {bId: bId},
        success: function (data) {
            // $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#bd_dft_fm').html(data);
            $('#bd_dft_fm_href').trigger('click');
            //$('#bd_dft_fm').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            // $('.loader').hide();
            alert('There was an error');
        }

    });
}

function cancelWoParam() {
    //$('#edit_wo_form').hide();

    $("div.fancybox-close").trigger("click");
    $('#bd_dft_fm').html('');
    $('#bd_dft_fm').hide();
    $('.fade_default_opt').hide();
}

function updateBuildOpt(bId) {
    if (bId != '') {
        var status_closed = ($('#status_closed').prop('checked')) ? '1' : '0';
        var billable = ($('#billable').prop('checked')) ? '1' : '0';
        var inc_tnt_rqt = ($('#inc_tnt_rqt').prop('checked')) ? '1' : '0';
        var email_tenant = ($('#email_tenant').prop('checked')) ? '1' : '0';
        var sale_tax = $('#sale_tax').val();
        var auto_charge = $('#auto_charge').val();
        var dft_markup = $('#dft_markup').val();
        var override_markup = $('#override_markup').val();
        var time_in_start = $('#time_in_start').val();
        var time_in_incmt = $('#time_in_incmt').val();
        var time_min_charge = $('#time_min_charge').val();
        $.ajax({
            url: baseUrl + "complete/updateparameter",
            type: "post",
            datatype: 'json',
            data: {status_closed: status_closed, billable: billable, inc_tnt_rqt: inc_tnt_rqt,
                email_tenant: email_tenant, sale_tax: sale_tax, auto_charge: auto_charge,
                dft_markup: dft_markup, override_markup: override_markup, time_in_start: time_in_start,
                time_in_incmt: time_in_incmt, time_min_charge: time_min_charge, building: bId},
            success: function (data) {
                $('.loader').hide();
                //alert(data);
                //$('#edit_wo_form').show();
                //$('#edit_wo_form').html(data);
                //$('#fdw').addClass('fade_edit_wo');
                if (data == 'success') {
                    reloadPage();
                } else {
                    alert('Error occurred');
                }
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }

        });

    }
}

/*************** Description Js code *****************/
function showDescription(woId) {
    //$("#wo_desc").fancybox.hideActivity();
    var desc = $('#work_description').val();
    if (desc == undefined) {
        $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/showdesc",
            type: "post",
            datatype: 'json',
            data: {woId: woId},
            success: function (data) {
                $('.loader').hide();
                //$('#edit_wo_form').show();
                //$('a#wo_desc').attr("href","#wo_desc");
                $('#wo_desc').html(data);
                //$('a#a_wo_desc').addClass("modalbox");
                //$("#wo_desc").fancybox().click();
                //$('#wo_desc').trigger("click");
                //$('#wo_desc').show();
                //$('.fade_default_opt').show();
                //$('a#a_wo_desc').removeClass("modalbox");
                //$('#wo_desc').fancybox().click(function(){ return false; });
                //$("#wo_desc").fancybox.showActivity();
                $('#wo_desc_href').trigger('click');

            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }

        });
    } else {
        var wo_desc = $("#wo_desc").html();
        $("#wo_desc").html(wo_desc);
        $('#wo_desc_href').trigger('click');
        $("#work_description").val(desc);
    }
}

function cancelWoDesc() {
    $("div.fancybox-close").trigger("click");
    //$('#edit_wo_form').hide();
    $('#wo_desc').html('');
    $('#wo_desc').hide();
    $('.fade_default_opt').hide();
}

function setNote(obj) {
    $('#work_description').val(obj.value);
}


function saveDescription(woId) {
    var desc = $('#work_description').val();
    if (desc == '') {
        $('#desc_error').html("Please enter work description");
        return false;
    } else {
        //$('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savedescription",
            type: "post",
            datatype: 'json',
            data: {woId: woId, description: desc},
            success: function (data) {
               $('.loader').hide();
                if (data == 'success') {
                    //location.reload();
                    // reloadPage('#desc_tab');
                } else {
                    alert('Error occurred');
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }
}

function saveDescriptionTemp(woId) {
    //$('#save').attr('disabled','disabled');
    var desc = $('#work_description').val();
    if (desc == '') {
        $('#desc_error').html("Please enter work description");
        return false;
    }
    var wo_desc = $('#wo_desc').html();
    $("div.fancybox-close").trigger("click");
    $('#wo_desc').html(wo_desc);
    $('#addtempdecs').val('addtempdecs');
    $('#work_description').val(desc);
    $('#desc_tab_inner').html('<p >' + desc + '</p>');
    $('.showmodel').hide();
    $('.hidemodel').show();

}

/*************** Labor charge Js Code *****************/
function showLaborForm(bId, woId) {
    $('.loader').show();
    var emp_id = $('#emp_id').val();
    var tin = $('#time_in').val();
    var tout = $('#time_out').val();
    var dateIn = $('#date_cp_in').val();
    var dateOut = $('#date_cp_out').val();
    $.ajax({
        url: baseUrl + "complete/laborform",
        type: "post",
        datatype: 'json',
        data: {bId: bId, woId: woId,time_in:tin,time_out:tout,date_in:dateIn,date_out:dateOut},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#labor_form').html(data);
            $('#labor_form_href').trigger('click');

            //$('#labor_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}

function cancelLaborForm() {
    $("div.fancybox-close").trigger("click");
    $('#labor_form').html('');
    $('#labor_form').hide();
    $('.loader').hide();
    $('.fade_default_opt').hide();
    //deleteTempLabor();

}

function cancelLaborFormEdit() {

    var emp_id = $('#emp_id').val();
    var charge_hour = $('#charge_hour').val();
    var labor_charge = $('#labor_charge').val();
    var rate_charge = $('#rate_charge').val();
    var job_time = $('#job_time').val();
    var lbdata = $('#labor_form').html();

    $("div.fancybox-close").trigger("click");
    $('#labor_form').html(lbdata);
    $('#addtemplabor').val('addtemplabor');
    $('#emp_id').val(emp_id);
    $('#charge_hour').val(charge_hour);
    $('#labor_charge').val(labor_charge);
    $('#rate_charge').val(rate_charge);
    $('#job_time').val(job_time);

}

function setCharge(uId) {
    var labor_id = labor_user[uId];
    if (labor_id != '' && labor_id != undefined) {
        setLaborSelected(labor_id);
    } else {
        var dft_lab_id = default_lcharge['dft_labor'];
        setLaborSelected(dft_lab_id);
    }
}

function setLaborSelected(labor_id) {
    $('select[name^="labor_charge"] option:selected').attr("selected", null);
    $('select[name^="labor_charge"] option[value="' + labor_id + '"]').attr("selected", "selected");
    setLaborCharge(labor_id);
}

function setLaborCharge(blid) {
    //alert(blid);
    var charge = labor_charge[blid];
    $('#charge_hour').val(charge);
    $('#edit_charge_hour').val(charge)
}


function saveLaborData(details) {
    //$('#save_labor').attr('disabled','disabled');
    var emp_id = details.emp_id;
    var charge_hour = details.charge_hour;
    var labor_charge = details.labor_charge;
    var rate_charge = details.rate_charge;
    var job_time = details.job_time;
    var submit_flag = true;

    if (emp_id == '') {
        $('#cwerr_emp').html('Please select the employee.');
        submit_flag = false;
    } else {
        $('#cwerr_emp').html('');
    }

    if (labor_charge == '') {
        $('#cwerr_charge').html('Please select the labor charge.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (charge_hour == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (rate_charge == '') {
        $('#cwerr_rate').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_rate').html('');
    }

    if (job_time == '') {
        $('#cwerr_job').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_job').html('');
    }

    if (submit_flag == false) {
        $('#save_labor').attr('disabled', false);
        return false;
    } else {
        //$('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savelabor",
            type: "post",
            datatype: 'json',
            data: {
                emp_id: emp_id, charge_hour: charge_hour, bl_id: labor_charge,
                rate_charge: rate_charge, job_time: job_time, woId: details.woId
            },
            async: false,
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    // reloadPage('#lab_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_labor').attr('disabled', false);
                }
            },
            error: function () {
                //$('.loader').hide();
                alert('There was an error');
            }

        });
    }

}
var savelaborArray = {};
var savelabor = 0;
function saveLaborDataTemp(woId) {
    $('#save_labor').attr('disabled', 'disabled');
    var emp_id = $('#emp_id').val();
    var charge_hour = $('#charge_hour').val();
    var labor_charge = $('#labor_charge').val();
    var rate_charge = $('#rate_charge').val();
    var job_time = $('#job_time').val();
    var bId = $('#building_id').val();
    var submit_flag = true;

    if (emp_id == '') {
        $('#cwerr_emp').html('Please select the employee.');
        submit_flag = false;
    } else {
        $('#cwerr_emp').html('');
    }

    if (labor_charge == '') {
        $('#cwerr_charge1').html('Please select the labor charge.');
        submit_flag = false;
    } else {
        $('#cwerr_charge1').html('');
    }

    if (charge_hour == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (rate_charge == '') {
        $('#cwerr_rate').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_rate').html('');
    }

    if (job_time == '') {
        $('#cwerr_job').html('Job time can not be blank.');
        submit_flag = false;
    } else {
        var job_time_split = job_time.split(":");
        if (job_time_split.length == 2) {
            if (job_time_split[1].length == 2 && job_time_split[0].length <= 2) {
                if (parseInt(job_time_split[1]) < 60) {
                    $('#cwerr_job').html('');
                } else {
                    $('#cwerr_job').html('Please enter job time in correct format.');
                    submit_flag = false;
                }

            } else {
                $('#cwerr_job').html('Please enter job time in correct format.');
                submit_flag = false;
            }

        } else {
            $('#cwerr_job').html('Please enter job time in correct format.');
            submit_flag = false;
        }
    }
    if (submit_flag == false) {
        $('#save_labor').attr('disabled', false);
        return false;
    } else {


        savelaborArray[savelabor] = {emp_id: emp_id, charge_hour: charge_hour, labor_charge: labor_charge, rate_charge: rate_charge, job_time: job_time, woId: woId, bId: bId};
        console.log(savelaborArray);
        var emp_id_set = $("#emp_id option:selected").text();
        emp_id_set = emp_id_set.split(",");
        var rate_charge_set = $("#rate_charge option:selected").text();
        $('#labor_tab_table').append('<tr id="labor_tab_table_' + savelabor + '"><td>' + emp_id_set[1].trim() + ', ' + emp_id_set[0].trim() + '</td><td>' + charge_hour + '</td><td>' + rate_charge_set + '</td><td>' + job_time + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditLaborTemp(' + savelabor + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempLabor(' + savelabor + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td></tr>');
        $('.loader').hide();
        savelabor++;
        $("div.fancybox-close").trigger("click");
        $("#labor_form").html('');
        $('.showmodel').hide();
        $('.hidemodel').show();
    }

}

function deleteTempLabor(index) {
    $('#labor_tab_table_' + index).empty();
    //$('#labor_form').empty();
    delete savelaborArray[index];

}


function showEditLabor(lid, bId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editlabor",
        type: "post",
        datatype: 'json',
        data: {bId: bId, lid: lid},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_labor_form').html(data);
            $('#edit_labor_form_href').trigger('click');
            //$('#labor_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function showEditLaborTemp(indexNumber) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editlabortemp",
        type: "post",
        datatype: 'json',
        data: {indexNumber: indexNumber, savelaborArray: savelaborArray},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_labor_form').html(data);
            $('#edit_labor_form_href').trigger('click');
            //$('#labor_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function updateLaborData(details) {
    $('#save_labor').attr('disabled', 'disabled');
    var emp_id = details.emp_id;
    var charge_hour = details.charge_hour;
    var labor_charge = details.bl_id;
    var rate_charge = details.rate_charge;
    var job_time = details.job_time;
    var historywoId = details.woId;
    var submit_flag = true;

    if (emp_id == '') {
        $('#cwerr_emp').html('Please select the employee.');
        submit_flag = false;
    } else {
        $('#cwerr_emp').html('');
    }

    if (labor_charge == '') {
        $('#cwerr_charge').html('Please select the labor charge.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (charge_hour == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (rate_charge == '') {
        $('#cwerr_rate').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_rate').html('');
    }

    if (job_time == '') {
        $('#cwerr_job').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_job').html('');
    }

    if (submit_flag == false) {
        $('#save_labor').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savelabor",
            type: "post",
            datatype: 'json',
            data: {
                emp_id: emp_id, charge_hour: charge_hour, bl_id: labor_charge,
                rate_charge: rate_charge, job_time: job_time, lid: details.lid, woId: details.woId
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    // reloadPage('#lab_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_labor').attr('disabled', false);
                }
            },
            error: function () {
                //$('.loader').hide();
                alert('There was an error');
            }

        });
    }

}
var lidArray = {};
function updateLaborDataTemp(lid) {
    $('#save_labor').attr('disabled', 'disabled');
    var emp_id = $('#edit_emp_id').val();
    var charge_hour = $('#edit_charge_hour').val();
    var labor_charge = $('#edit_labor_charge').val();
    var rate_charge = $('#edit_rate_charge').val();
    var job_time = $('#edit_job_time').val();
    var historywoId = $('#edit_historywoId').val();
    var building_id = $('#building_id').val();
    var submit_flag = true;

    if (emp_id == '') {
        $('#cwerr_emp').html('Please select the employee.');
        submit_flag = false;
    } else {
        $('#cwerr_emp').html('');
    }

    if (labor_charge == '') {
        $('#cwerr_charge1').html('Please select the labor charge.');
        submit_flag = false;
    } else {
        $('#cwerr_charge1').html('');
    }

    if (charge_hour == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (rate_charge == '') {
        $('#cwerr_rate').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_rate').html('');
    }

    if (job_time == '') {
        $('#cwerr_job').html('Job time can not be blank.');
        submit_flag = false;
    } else {
        var job_time_split = job_time.split(":");
        if (job_time_split.length == 2) {
            if (job_time_split[1].length <= 2 && job_time_split[0].length <= 2) {
                if (parseInt(job_time_split[1]) < 60) {
                    $('#cwerr_job').html('');
                } else {
                    $('#cwerr_job').html('Please enter job time in correct format.');
                    submit_flag = false;
                }

            } else {
                $('#cwerr_job').html('Please enter job time in correct format.');
                submit_flag = false;
            }

        } else {
            $('#cwerr_job').html('Please enter job time in correct format.');
            submit_flag = false;
        }
    }

    if (submit_flag == false) {
        $('#save_labor').attr('disabled', false);
        return false;
    } else {
        lidArray[lid] = {emp_id: emp_id, charge_hour: charge_hour, bl_id: labor_charge, rate_charge: rate_charge, job_time: job_time, lid: lid, woId: historywoId};
        console.log(lidArray);


        var emp_id_set = $("#edit_emp_id option:selected").text();
        emp_id_set = emp_id_set.split(",");
        var rate_charge_set = $("#edit_rate_charge option:selected").text();
        $('#labor_tab_table_' + lid).html('<td>' + emp_id_set[1].trim() + ', ' + emp_id_set[0].trim() + '</td><td>$' + charge_hour + '</td><td>' + rate_charge_set + '</td><td>' + job_time + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditLabor(' + lid + ',' + building_id + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteLaborCharge(' + lid + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $("div.fancybox-close").trigger("click");
        $('#edit_labor_form').html('');
        $('.showmodel').hide();
        $('.hidemodel').show();

    }
}


function updateLaborDataTemp2(lid) {
    $('#save_labor').attr('disabled', 'disabled');
    var emp_id = $('#edit_emp_id').val();
    var charge_hour = $('#edit_charge_hour').val();
    var labor_charge = $('#edit_labor_charge').val();
    var rate_charge = $('#edit_rate_charge').val();
    var job_time = $('#edit_job_time').val();
    var historywoId = $('#edit_historywoId').val();
    var building_id = $('#building_id').val();
    var submit_flag = true;

    if (emp_id == '') {
        $('#cwerr_emp').html('Please select the employee.');
        submit_flag = false;
    } else {
        $('#cwerr_emp').html('');
    }

    if (labor_charge == '') {
        $('#cwerr_charge1').html('Please select the labor charge.');
        submit_flag = false;
    } else {
        $('#cwerr_charge1').html('');
    }

    if (charge_hour == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (rate_charge == '') {
        $('#cwerr_rate').html('Please select the rate charge.');
        submit_flag = false;
    } else {
        $('#cwerr_rate').html('');
    }

    if (job_time == '') {
        $('#cwerr_job').html('Job time can not be blank.');
        submit_flag = false;
    } else {
        var job_time_split = job_time.split(":");
        if (job_time_split.length == 2) {
            if (job_time_split[1].length <= 2 && job_time_split[0].length <= 2) {
                if (parseInt(job_time_split[1]) < 60) {
                    $('#cwerr_job').html('');
                } else {
                    $('#cwerr_job').html('Please enter job time in correct format.');
                    submit_flag = false;
                }

            } else {
                $('#cwerr_job').html('Please enter job time in correct format.');
                submit_flag = false;
            }

        } else {
            $('#cwerr_job').html('Please enter job time in correct format.');
            submit_flag = false;
        }
    }

    if (submit_flag == false) {
        $('#save_labor').attr('disabled', false);
        return false;
    } else {
        savelaborArray[lid] = {emp_id: emp_id, charge_hour: charge_hour, labor_charge: labor_charge, rate_charge: rate_charge, job_time: job_time, lid: lid, woId: historywoId, bId: building_id};
        console.log(savelaborArray);
        $('#edittemplabor').val('edittemplabor');

        var emp_id_set = $("#edit_emp_id option:selected").text();
        emp_id_set = emp_id_set.split(",");
        var rate_charge_set = $("#edit_rate_charge option:selected").text();
        $('#labor_tab_table_' + lid).html('<td>' + emp_id_set[1].trim() + ', ' + emp_id_set[0].trim() + '</td><td>$' + charge_hour + '</td><td>' + rate_charge_set + '</td><td>' + job_time + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditLaborTemp(' + lid + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempLabor(' + lid + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $("div.fancybox-close").trigger("click");
        $('#edit_labor_form').html('');

    }
}


var deleteLaborArray = {};
function deleteLaborChargeTemp(lid) {

    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting Labor Charge, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                $('.loader').show();

                deleteLaborArray[lid] = lid;
                $('#labor_tab_table_' + lid).empty();
                console.log(deleteLaborArray);
                $('.loader').hide();
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });
}


function deleteLaborCharge(lid) {
    var workOrder_id = $("#workOrder_id").val();
    $('.loader').show();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deletelabor",
        dataType: 'json',
        data: {
            lid: lid,
            woId: workOrder_id
        },
        success: function (msg) {
            $('.loader').hide();
            if (msg == true) {
                // $('#cw_success').html('Labor Charge has been deleted successfully.');
                //location.reload();
                // reloadPage();
            } else {
                $('#cw_error').html('Error Occurred during deletion of labor charge.');
            }
        }

    });

}


function isNumber(evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (
            (charCode != 46 || $(element).val().indexOf('.') != -1) && // ???.??? CHECK DOT, AND ONLY ONE.
            (charCode != 8 || $(element).val().indexOf('.') != -1) && // ???.??? CHECK backspace, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
        return false;

    return true;
}


function isTime(evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (
            (charCode != 58 || $(element).val().indexOf('.') != -1) && // ???.??? CHECK DOT, AND ONLY ONE.
            (charCode != 8 || $(element).val().indexOf('.') != -1) && // ???.??? CHECK backspace, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
        return false;

    return true;
}

/*************Building Service Charge Js Code ***************/
function showBServiceForm(bId, woId) {
    var service = $('#service').val();
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/addbservice",
        type: "post",
        datatype: 'json',
        data: {bId: bId, woId: woId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#bservice_form').html(data);
            $('#bservice_form_href').trigger('click');
            //$('#bservice_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });


}

function cancelBService() {
    $("div.fancybox-close").trigger("click");
    $('#bservice_form').html('');
    $('#bservice_form').hide();
    $('.fade_default_opt').hide();
}

function cancelBServiceEdit() {
    var service = $('#service').val();
    var charge = $('#charge').val();
    var amount_requested = $('#amount_requested').val();
    var comment = $('#comment').val();


    var bservice_form = $('#bservice_form').html();

    $("div.fancybox-close").trigger("click");
    $('#bservice_form').html(bservice_form);
    $('#service').val(service);
    $('#charge').val(charge);
    $('#amount_requested').val(amount_requested);
    $('#comment').val(comment);
    $('#addtempbservice').val('addtempbservice');

    $('#bservice_form').hide();
    $('.fade_default_opt').hide();
}


function setBServCharge(bsid) {
    var charge = bs_charge[bsid];
    var minimum = bs_minimum[bsid];
    $('#charge').val(charge);
    $('#amount_requested').val(minimum);
    $('#edit_charge').val(charge);
    $('#edit_amount_requested').val(minimum);
}


function saveBServiceData(details) {
    var service = details.service;
    var charge = details.charge;
    var amount_requested = details.amount_requested;
    var comment = details.comment;
    var submit_flag = true;

    if (service == '') {
        $('#cwerr_service').html('Please select the service.');
        submit_flag = false;
    } else {
        $('#cwerr_service').html('');
    }

    if (charge == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (amount_requested == '') {
        $('#cwerr_amount').html('Please enter the requested amount.');
        submit_flag = false;
    } else {
        $('#cwerr_amount').html('');
    }


    if (submit_flag == false) {
        $('#save_bdservice').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savebuildingservice",
            type: "post",
            datatype: 'json',
            data: {
                service: service, charge: charge, amount_requested: amount_requested,
                comment: comment, woId: details.woId
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#bs_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_bdservice').attr('disabled', false);
                }
            },
            error: function () {
                //$('.loader').hide();
                alert('There was an error');
            }

        });
    }

}
var saveBServiceDataArray = {};
var saveBService = 0;
function saveBServiceDataTemp(woId) {

    $('#save_bdservice').attr('disabled', 'disabled');
    var service = $('#service').val();
    var charge = $('#charge').val();
    var amount_requested = $('#amount_requested').val();
    var comment = $('#comment').val();
    var bId = $('building_id').val();
    var submit_flag = true;

    if (service == '') {
        $('#cwerr_service').html('Please select the service.');
        submit_flag = false;
    } else {
        $('#cwerr_service').html('');
    }

    if (charge == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (amount_requested == '') {
        $('#cwerr_amount').html('Please enter the requested amount.');
        submit_flag = false;
    } else {
        $('#cwerr_amount').html('');
    }
    if (submit_flag == false) {
        $('#save_bdservice').attr('disabled', false);
        return false;
    } else {
        saveBServiceDataArray[saveBService] = {service: service, charge: charge, amount_requested: amount_requested, comment: comment, woId: woId};
        console.log(saveBServiceDataArray);
        var service_set = $("#service option:selected").text();
        var unit_measure = $("#service option:selected").attr('flag_id');
        $('#service_tab_table').append('<tr id="service_tab_table_' + saveBService + '"><td>' + service_set + '</td><td>$' + charge + '</td><td>' + unit_measure + '</td><td>' + amount_requested + '</td><td>' + comment + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditBServiceTemp(' + saveBService + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempBservice(' + saveBService + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td></tr>');
        saveBService++;
        $("div.fancybox-close").trigger("click");
        $("#bservice_form").html('');
        $('.showmodel').hide();
        $('.hidemodel').show();


    }
}

function deleteTempBservice(index) {
    $('#service_tab_table_' + index).empty();
    delete saveBServiceDataArray[index];

}

function showEditBService(bsId, bId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editbservice",
        type: "post",
        datatype: 'json',
        data: {bId: bId, bsId: bsId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_bservice_form').html(data);
            $('#edit_bservice_form_href').trigger('click');
            //$('#bservice_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function showEditBServiceTemp(index) {
    $('.loader').show();
    var bId = $("#building_id").val();
    $.ajax({
        url: baseUrl + "complete/editbservicetemp",
        type: "post",
        datatype: 'json',
        data: {index: index, saveBServiceDataArray: saveBServiceDataArray, bId: bId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_bservice_form').html(data);
            $('#edit_bservice_form_href').trigger('click');
            //$('#bservice_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function updateBServiceData(details) {
    $('#save_bdservice').attr('disabled', 'disabled');
    var bsId = details.bsId;
    var service = details.service;
    var charge = details.charge;
    var amount_requested = details.amount_requested;
    var comment = details.comment;
    var woId = details.woId;
    var submit_flag = true;

    if (service == '') {
        $('#cwerr_service').html('Please select the service.');
        submit_flag = false;
    } else {
        $('#cwerr_service').html('');
    }

    if (charge == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (amount_requested == '') {
        $('#cwerr_amount').html('Please enter the requested amount.');
        submit_flag = false;
    } else {
        $('#cwerr_amount').html('');
    }


    if (submit_flag == false) {
        $('#save_bdservice').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savebuildingservice",
            type: "post",
            datatype: 'json',
            data: {
                service: service, charge: charge, amount_requested: amount_requested,
                comment: comment, bsId: bsId, woId: woId
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //reloadPage('#bs_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_bdservice').attr('disabled', false);
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}

var bServiceArray = {};
function updateBServiceDataTemp(bsId) {

    $('#save_bdservice').attr('disabled', 'disabled');
    var service = $('#edit_service').val();
    var charge = $('#edit_charge').val();
    var amount_requested = $('#edit_amount_requested').val();
    var comment = $('#edit_comment').val();
    var woId = $('#edit_woId').val();
    var building_id = $('#building_id').val();
    var submit_flag = true;

    if (service == '') {
        $('#cwerr_service').html('Please select the service.');
        submit_flag = false;
    } else {
        $('#cwerr_service').html('');
    }

    if (charge == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (amount_requested == '') {
        $('#cwerr_amount').html('Please enter the requested amount.');
        submit_flag = false;
    } else {
        $('#cwerr_amount').html('');
    }


    if (submit_flag == false) {
        $('#save_bdservice').attr('disabled', false);
        return false;
    } else {

        bServiceArray[bsId] = {service: service, charge: charge, amount_requested: amount_requested, comment: comment, bsId: bsId, woId: woId};
        //console.log(lidArray);

        var service_set = $("#edit_service option:selected").text();
        var unit_measure = $("#edit_service option:selected").attr('flag_id');
        $('#service_tab_table_' + bsId).html('<td>' + service_set + '</td><td>$' + charge + '</td><td>' + unit_measure + '</td><td>' + amount_requested + '</td><td>' + comment + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditBService(' + bsId + ', ' + building_id + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteBservice(' + bsId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $('#edit_bservice_form').html();
        $("div.fancybox-close").trigger("click");
        $('#edit_bservice_form').html('');
        $('.showmodel').hide();
        $('.hidemodel').show();

    }
}

function updateBServiceDataTemp2(bsId) {
    $('#save_bdservice').attr('disabled', 'disabled');
    var service = $('#edit_service').val();
    var charge = $('#edit_charge').val();
    var amount_requested = $('#edit_amount_requested').val();
    var comment = $('#edit_comment').val();
    var woId = $('#edit_woId').val();
    var building_id = $('#building_id').val();
    var submit_flag = true;

    if (service == '') {
        $('#cwerr_service').html('Please select the service.');
        submit_flag = false;
    } else {
        $('#cwerr_service').html('');
    }

    if (charge == '') {
        $('#cwerr_charge').html('Charge can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_charge').html('');
    }

    if (amount_requested == '') {
        $('#cwerr_amount').html('Please enter the requested amount.');
        submit_flag = false;
    } else {
        $('#cwerr_amount').html('');
    }


    if (submit_flag == false) {
        $('#save_bdservice').attr('disabled', false);
        return false;
    } else {

        saveBServiceDataArray[bsId] = {service: service, charge: charge, amount_requested: amount_requested, comment: comment, woId: woId};
        //console.log(lidArray);

        var service_set = $("#edit_service option:selected").text();
        var unit_measure = $("#edit_service option:selected").attr('flag_id');
        $('#service_tab_table_' + bsId).html('<td>' + service_set + '</td><td>$' + charge + '</td><td>' + unit_measure + '</td><td>' + amount_requested + '</td><td>' + comment + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditBServiceTemp(' + bsId + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempBservice(' + bsId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        console.log(saveBServiceDataArray);
        $("div.fancybox-close").trigger("click");
        $("#bservice_form").html('');

    }

}




function deleteBservice(bsId) {
    var workOrder_id = $("#workOrder_id").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deletebuildingservice",
        dataType: 'json',
        data: {
            bsId: bsId,
            woId: workOrder_id
        },
        success: function (msg) {
            $('.loader').hide();
            if (msg == true) {
                //$('#cw_success').html('Building Service Charge has been deleted successfully.');
                //reloadPage();
            } else {
                //$('#cw_error').html('Error Occurred during deletion of Building Service Charge.');
            }
        }

    });
}

var deleteBserviceArray = {};
function deleteBserviceTemp(bsId) {
    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting Building Service Charge, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                $('.loader').show();

                deleteBserviceArray[bsId] = bsId;
                $('#service_tab_table_' + bsId).empty();
                console.log(deleteBserviceArray);
                $('.loader').hide();
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });
}

/**************** Material Charge Js Code ******************/
function showMaterialForm(bId, woId) {

    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/addmaterial",
        type: "post",
        datatype: 'json',
        data: {bId: bId, woId: woId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#material_form').html(data);
            $('#material_form_href').trigger('click');
            //$('#material_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });

}

function cancelMaterial() {
    $("div.fancybox-close").trigger("click");
    $('#material_form').html('');
    $('#material_form').hide();
    $('.fade_default_opt').hide();
    deleteTempMaterial();
}

function cancelMaterialEdit() {
    $("div.fancybox-close").trigger("click");

    var material_id = $('#material_id').val();
    var cost = $('#cost').val();
    var markup = $('#markup').val();
    var quantity = $('#quantity').val();
    var tax = $('#tax').val();

    var material_form = $('#material_form').html();
    $("div.fancybox-close").trigger("click");
    $('#material_form').html(material_form);
    $('#addtempmaterial').val('addtempmaterial');
    $('#material_id').val(material_id);
    $('#cost').val(cost);
    $('#markup').val(markup);
    $('#quantity').val(quantity);
    $('#tax').val(tax);

    //$('#material_form').html('');
    $('#material_form').hide();
    $('.fade_default_opt').hide();
}

function setMaterial(mid) {
    var cost = material_cost[mid];
    var markup = material_markup[mid];
    $('#cost').val(cost);
    $('#markup').val(markup);
}

function editsetMaterial(mid) {
    var cost = material_cost[mid];
    var markup = material_markup[mid];
    $('#edit_cost').val(cost);
    $('#edit_markup').val(markup);
}

function saveMaterialData(details) {
    var material_id = details.material_id;
    var cost = details.cost;
    var markup = details.markup;
    var quantity = details.quantity;
    var tax = details.tax;
    var woId = details.woId;
    var submit_flag = true;

    if (material_id == '') {
        $('#cwerr_desc').html('Please select the description.');
        submit_flag = false;
    } else {
        $('#cwerr_desc').html('');
    }

    if (cost == '' || cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }

    if (quantity == '' || quantity == '0') {
        $('#cwerr_qty').html('Please enter quantity.');
        submit_flag = false;
    } else {
        $('#cwerr_qty').html('');
    }


    if (submit_flag == false) {
        $('#save_material').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savematerial",
            type: "post",
            datatype: 'json',
            data: {
                material_id: material_id, cost: cost, markup: markup,
                quantity: quantity, woId: woId, tax: tax
            },
            success: function (data) {
                //  $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#mat_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_material').attr('disabled', false);
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}

var savematerialArray = {};
var savematerial = 0;
function saveMaterialDataTemp(woId) {

    $('#save_material').attr('disabled', 'disabled');
    var material_id = $('#material_id').val();
    var cost = $('#cost').val();
    var markup = $('#markup').val();
    var quantity = $('#quantity').val();
    var tax = $('#show_tax').val();
    var bId = $('#building_id').val();
    var submit_flag = true;

    if (material_id == '') {
        $('#cwerr_desc').html('Please select the description.');
        submit_flag = false;
    } else {
        $('#cwerr_desc').html('');
    }

    if (cost == '' || cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }

    if (quantity == '' || quantity == '0') {
        $('#cwerr_qty').html('Please enter quantity.');
        submit_flag = false;
    } else {
        $('#cwerr_qty').html('');
    }
    if (submit_flag == false) {
        $('#save_material').attr('disabled', false);
        return false;
    } else {


        savematerialArray[savematerial] = {material_id: material_id, cost: cost, markup: markup, quantity: quantity, woId: woId, tax: tax, bId: bId};
        console.log(savematerialArray);
        var material_id_set = $("#material_id option:selected").text();
        var tax_set = $("#show_tax option:selected").text();
        $('#material_tab_table').append('<tr id="material_tab_table_' + savematerial + '"><td>' + material_id_set + '</td><td>$' + cost + '</td><td>' + quantity + '</td><td>' + markup + '</td><td>' + tax_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditMaterialTemp(' + savematerial + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempMaterial(' + savematerial + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td><tr>');
        savematerial++;
        $("#material_form").html('');
        $("div.fancybox-close").trigger("click");
        $('.showmodel').hide();
        $('.hidemodel').show();
    }
}

function selectTax(showtax) {
    $("#show_tax").val(showtax);
}

function editselectTax(showtax) {
    $("#edit_show_tax").val(showtax);
}

function deleteTempMaterial(index) {
    $('#material_tab_table_' + index).empty();
    delete savematerialArray[index];
}

function showEditMaterial(mcId, bId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editmaterial",
        type: "post",
        datatype: 'json',
        data: {bId: bId, mcId: mcId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_material_form').html(data);
            $('#edit_material_form_href').trigger('click');
            //$('#material_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function showEditMaterialTemp(index) {
    var bId = $('#building_id').val();
    $.ajax({
        url: baseUrl + "complete/editmaterialtemp",
        type: "post",
        datatype: 'json',
        data: {index: index, savematerialArray: savematerialArray, bId: bId},
        success: function (data) {

            //$('#edit_wo_form').show();
            $('#edit_material_form').html(data);
            $('#edit_material_form_href').trigger('click');
            //$('#material_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}

function updateMaterialData(details) {
    $('#save_material').attr('disabled', 'disabled');
    var material_id = details.material_id;
    var cost = details.cost;
    var markup = details.markup;
    var quantity = details.quantity;
    var woId = details.woId;
    var tax = details.tax;
    var mcId = details.mcId;
    var submit_flag = true;

    if (material_id == '') {
        $('#cwerr_desc').html('Please select the description.');
        submit_flag = false;
    } else {
        $('#cwerr_desc').html('');
    }

    if (cost == '' || cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }

    if (quantity == '' || quantity == '0') {
        $('#cwerr_qty').html('Please enter quantity.');
        submit_flag = false;
    } else {
        $('#cwerr_qty').html('');
    }


    if (submit_flag == false) {
        $('#save_material').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savematerial",
            type: "post",
            datatype: 'json',
            data: {
                material_id: material_id, cost: cost, markup: markup,
                quantity: quantity, mcId: mcId, tax: tax, woId: woId
            },
            success: function (data) {
                //  $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#mat_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_material').attr('disabled', false);
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}

var materialArray = {};
function updateMaterialDataTemp(mcId) {


    $('#save_material').attr('disabled', 'disabled');
    var material_id = $('#edit_material_id').val();
    var cost = $('#edit_cost').val();
    var markup = $('#edit_markup').val();
    var quantity = $('#edit_quantity').val();
    var woId = $('#edit_woId').val();
    var tax = $('#edit_show_tax').val();
    var building_id = $('#building_id').val();
    var submit_flag = true;

    if (material_id == '') {
        $('#cwerr_desc').html('Please select the description.');
        submit_flag = false;
    } else {
        $('#cwerr_desc').html('');
    }

    if (cost == '' || cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }

    if (quantity == '' || quantity == '0') {
        $('#cwerr_qty').html('Please enter quantity.');
        submit_flag = false;
    } else {
        $('#cwerr_qty').html('');
    }


    if (submit_flag == false) {
        $('#save_material').attr('disabled', false);
        return false;
    } else {
        materialArray[mcId] = {material_id: material_id, cost: cost, markup: markup, quantity: quantity, mcId: mcId, tax: tax, woId: woId};
        console.log(materialArray);

        var material_id_set = $("#edit_material_id option:selected").text();
        var tax_set = $("#edit_show_tax option:selected").text();
        $('#material_tab_table_' + mcId).html('<td>' + material_id_set + '</td><td>$' + cost + '</td><td>' + quantity + '</td><td>' + markup + '</td><td>' + tax_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditMaterial(' + mcId + ', ' + building_id + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteMaterial(' + mcId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $("div.fancybox-close").trigger("click");
        $("#edit_material_form").html('');
        $('.showmodel').hide();
        $('.hidemodel').show();


    }
}


function updateMaterialDataTemp2(mcId) {

    $('#save_material').attr('disabled', 'disabled');
    var material_id = $('#edit_material_id').val();
    var cost = $('#edit_cost').val();
    var markup = $('#edit_markup').val();
    var quantity = $('#edit_quantity').val();
    var woId = $('#edit_woId').val();
    var tax = $('#edit_show_tax').val();
    var bId = $('#building_id').val();
    var submit_flag = true;

    if (material_id == '') {
        $('#cwerr_desc').html('Please select the description.');
        submit_flag = false;
    } else {
        $('#cwerr_desc').html('');
    }

    if (cost == '' || cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }

    if (quantity == '' || quantity == '0') {
        $('#cwerr_qty').html('Please enter quantity.');
        submit_flag = false;
    } else {
        $('#cwerr_qty').html('');
    }


    if (submit_flag == false) {
        $('#save_material').attr('disabled', false);
        return false;
    } else {

        savematerialArray[mcId] = {material_id: material_id, cost: cost, markup: markup, quantity: quantity, tax: tax, woId: woId, bId: bId};
        console.log(savematerialArray);
        $("div.fancybox-close").trigger("click");
        var material_id_set = $("#edit_material_id option:selected").text();
        var tax_set = $("#edit_show_tax option:selected").text();
        $('#material_tab_table_' + mcId).html('<td>' + material_id_set + '</td><td>$' + cost + '</td><td>' + quantity + '</td><td>' + markup + '</td><td>' + tax_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditMaterialTemp(' + mcId + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempMaterial(' + mcId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $("div.fancybox-close").trigger("click");
        $("#edit_material_form").html('');

    }
}




function deleteMaterial(mcId) {
    var workOrder_id = $("#workOrder_id").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deletematerial",
        dataType: 'json',
        data: {
            mcId: mcId,
            woId: workOrder_id
        },
        success: function (msg) {
            $('.loader').hide();
            if (msg == true) {
                // $('#cw_success').html('Material Charge has been deleted successfully.');
                //location.reload();
                //reloadPage();
            } else {
                // $('#cw_error').html('Error Occurred during deletion of Material Charge.');
            }
        }

    });

}

var deleteMaterialArray = {};
function deleteMaterialTemp(mcId) {
    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting Material Charge, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                deleteMaterialArray[mcId] = mcId;
                console.log(deleteMaterialArray);
                $('#material_tab_table_' + mcId).empty();
                $('#cw_success').html('Material Charge has been deleted successfully.');
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });
}



/**************** Outside service Charge Js Code ******************/
function showOutsideForm(bId, woId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/addoutside",
        type: "post",
        datatype: 'json',
        data: {bId: bId, woId: woId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#outside_form').html(data);
            $('#outside_form_href').trigger('click');
            //$('#outside_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}

function cancelOutside() {
    $("div.fancybox-close").trigger("click");
    $('#outside_form').html('');
    $('#outside_form').hide();
    $('.fade_default_opt').hide();
    deleteTempOutside();
}

function cancelOutsideEdit() {
    var vendor = $('#vendor').val();
    var job_cost = $('#job_cost').val();
    var markup = $('#markup').val();
    var job_description = $('#job_description').val();
    var tax = $('#tax').val();


    $('#addtempoutside').val('addtempoutside');
    var outside_form = $('#outside_form').html();
    $("div.fancybox-close").trigger("click");
    $('#outside_form').html(outside_form);
    $('#vendor').val(vendor);
    $('#job_cost').val(job_cost);
    $('#markup').val(markup);
    $('#job_description').val(job_description);
    $('#tax').val(tax);


    //$('#outside_form').html('');
    $('#outside_form').hide();
    $('.fade_default_opt').hide();
}

function saveOutSideData(details) {
    $('#save_outside').attr('disabled', 'disabled');
    var vendor = details.vendor;
    var job_cost = details.job_cost;
    var markup = details.markup;
    var job_description = details.job_description;
    var tax = details.tax;
    var woId = details.woId;
    var submit_flag = true;

    if (vendor == '') {
        $('#cwerr_vendor').html('Please select the vendor.');
        submit_flag = false;
    } else {
        $('#cwerr_vendor').html('');
    }

    if (job_cost == '' || job_cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }


    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/saveoutside",
            type: "post",
            datatype: 'json',
            data: {
                vendor: vendor, job_cost: job_cost, markup: markup,
                job_description: job_description, woId: woId, tax: tax
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    // reloadPage('#os_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_outside').attr('disabled', false);
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}

var saveoutsideArray = {};
var saveoutside = 0;
function saveOutSideDataTemp(woId) {
    $('#save_outside').attr('disabled', 'disabled');
    var vendor = $('#vendor').val();
    var job_cost = $('#job_cost').val();
    var markup = $('#markup').val();
    var job_description = $('#job_description').val();
    var tax = $('#show_tax').val();
    var bId = $('#building_id').val();
    var submit_flag = true;

    if (vendor == '') {
        $('#cwerr_vendor').html('Please select the vendor.');
        submit_flag = false;
    } else {
        $('#cwerr_vendor').html('');
    }

    if (job_cost == '' || job_cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }


    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {
        //console.log(lidArray);

        saveoutsideArray[saveoutside] = {vendor: vendor, job_cost: job_cost, markup: markup, job_description: job_description, woId: woId, tax: tax, bId: bId};
        console.log(saveoutsideArray);
        var vendor_set = $("#vendor option:selected").text();
        var show_tax = $("#show_tax option:selected").text();
        $('#outside_tab_table').append('<tr id="outside_tab_table_' + saveoutside + '"><td>' + vendor_set + '</td><td>' + job_description + '</td><td>$' + job_cost + '</td><td>' + markup + '</td><td>' + show_tax + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditOutsideTemp(' + saveoutside + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempOutside(' + saveoutside + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td></tr>');
        saveoutside++;

        $("div.fancybox-close").trigger("click");
        $("#outside_form").html('');
        $('.showmodel').hide();
        $('.hidemodel').show();
    }
}


function deleteTempOutside(index) {
    $('#outside_tab_table_' + index).empty();
    delete saveoutsideArray[index];

}

function showEditOutside(osId, bId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editoutside",
        type: "post",
        datatype: 'json',
        data: {bId: bId, osId: osId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_outside_form').html(data);
            $('#edit_outside_form_href').trigger('click');
            //$('#outside_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function showEditOutsideTemp(index) {
    var bId = $('#building_id').val();
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editoutsidetemp",
        type: "post",
        datatype: 'json',
        data: {index: index, saveoutsideArray: saveoutsideArray, bId: bId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_outside_form').html(data);
            $('#edit_outside_form_href').trigger('click');
            //$('#outside_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function updateOutSideData(details) {
    $('#save_outside').attr('disabled', 'disabled');
    var vendor = details.vendor;
    var job_cost = details.job_cost;
    var markup = details.markup;
    var job_description = details.job_description;
    var tax = details.tax;
    var submit_flag = true;
    var woId = details.woId;
    var osId = details.osId;
    if (vendor == '') {
        $('#cwerr_vendor').html('Please select the vendor.');
        submit_flag = false;
    } else {
        $('#cwerr_vendor').html('');
    }

    if (job_cost == '' || job_cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }


    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/saveoutside",
            type: "post",
            datatype: 'json',
            data: {
                vendor: vendor, job_cost: job_cost, markup: markup,
                job_description: job_description, osId: osId, tax: tax, woId: woId
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#os_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_outside').attr('disabled', false);
                }
            },
            error: function () {
                //  $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}
var outsideArray = {};
function updateOutSideDataTemp(osId) {
    $('#save_outside').attr('disabled', 'disabled');
    var vendor = $('#edit_vendor').val();
    var job_cost = $('#edit_job_cost').val();
    var markup = $('#edit_markup').val();
    var job_description = $('#edit_job_description').val();
    var tax = $('#edit_show_tax').val();
    var submit_flag = true;
    var woId = $('#edit_woId').val();
    if (vendor == '') {
        $('#cwerr_vendor').html('Please select the vendor.');
        submit_flag = false;
    } else {
        $('#cwerr_vendor').html('');
    }

    if (job_cost == '' || job_cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }


    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {

        outsideArray[osId] = {vendor: vendor, job_cost: job_cost, markup: markup, job_description: job_description, osId: osId, tax: tax, woId: woId};
        //console.log(lidArray);

        var building_id = $('#building_id').val();
        var vendor_set = $("#edit_vendor option:selected").text();
        var show_tax = $("#edit_show_tax option:selected").text();
        $('#outside_tab_table_' + osId).html('<td>' + vendor_set + '</td><td>' + job_description + '</td><td>$' + job_cost + '</td><td>' + markup + '</td><td>' + show_tax + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditOutside(' + osId + ', ' + building_id + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteOutside(' + osId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $("div.fancybox-close").trigger("click");
        $('#edit_outside_form').html('');
        $('.showmodel').hide();
        $('.hidemodel').show();

    }
}


function updateOutSideDataTemp2(osId) {
    $('#save_outside').attr('disabled', 'disabled');
    var vendor = $('#edit_vendor').val();
    var job_cost = $('#edit_job_cost').val();
    var markup = $('#edit_markup').val();
    var job_description = $('#edit_job_description').val();
    var tax = $('#edit_show_tax').val();
    var submit_flag = true;
    var woId = $('#edit_woId').val();
    var bId = $('#building_id').val();
    if (vendor == '') {
        $('#cwerr_vendor').html('Please select the vendor.');
        submit_flag = false;
    } else {
        $('#cwerr_vendor').html('');
    }

    if (job_cost == '' || job_cost == '0') {
        $('#cwerr_cost').html('Cost can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_cost').html('');
    }

    if (markup == '') {
        $('#cwerr_markup').html('Mark-Up can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_markup').html('');
    }


    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {

        saveoutsideArray[osId] = {vendor: vendor, job_cost: job_cost, markup: markup, job_description: job_description, osId: osId, tax: tax, woId: woId, bId: bId};
        console.log(saveoutsideArray);

        var building_id = $('#building_id').val();
        var vendor_set = $("#edit_vendor option:selected").text();
        var show_tax = $("#edit_show_tax option:selected").text();
        $('#outside_tab_table_' + osId).html('<td>' + vendor_set + '</td><td>' + job_description + '</td><td>$' + job_cost + '</td><td>' + markup + '</td><td>' + show_tax + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditOutsideTemp(' + osId + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempOutside(' + osId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');

        $("div.fancybox-close").trigger("click");
        $("#edit_outside_form").html('');

    }
}

function deleteOutside(osId) {
    var workOrder_id = $("#workOrder_id").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deleteoutside",
        dataType: 'json',
        data: {
            osId: osId,
            woId: workOrder_id
        },
        success: function (msg) {
            $('.loader').hide();
            if (msg == true) {
                //$('#cw_success').html('Outside Service has been deleted successfully.');
                //location.reload();
                //reloadPage();
            } else {
                //$('#cw_error').html('Error Occurred during deletion of Outside Service.');
            }
        }

    });

}

var deleteOutsideArray = {};
function deleteOutsideTemp(osId) {
    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting Outside Services, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                $('.loader').show();
                deleteOutsideArray[osId] = osId;
                console.log(deleteOutsideArray);
                $('#outside_tab_table_' + osId).empty();
                $('.loader').hide();
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });
}

/**************** Note Js Code ******************/
function showNoteForm(woId) {

    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/addnote",
        type: "post",
        datatype: 'json',
        data: {woId: woId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#note_form').html(data);
            $('#note_form_href').trigger('click');
            //$('#note_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });

}

function cancelNote() {
    $("div.fancybox-close").trigger("click");
    $('#note_form').html('');
    $('#note_form').hide();
    $('.fade_default_opt').hide();

}

function cancelNoteEdit() {
    var note_date = $('#note_date').val();
    var internal = $('#internal').val();
    var note = $('#note').val();
    var note_form = $('#note_form').html();
    $("div.fancybox-close").trigger("click");
    $('#note_form').html(note_form);
    $('#addtempnotes').val('addtempnotes');
    $('#note_date').val(note_date);
    $('#internal').val(internal);
    $('#note').val(note);

    //$('#note_form').html('');
    $('#note_form').hide();
    $('.fade_default_opt').hide();
}

function saveNote(details) {
    var note_date = details.note_date;
    var internal = details.internal;
    var note = details.note;
    var woId = details.woId;

    var submit_flag = true;

    if (note_date == '') {
        $('#cwerr_date').html('Date can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_date').html('');
    }

    if (note == '') {
        $('#cwerr_note').html('Note can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_note').html('');
    }



    if (submit_flag == false) {
        $('#save_note').attr('disabled', false);
        return false;
    } else {
        // $('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savenote",
            type: "post",
            datatype: 'json',
            data: {
                note_date: note_date, internal: internal, note: note,
                woId: woId
            },
            success: function (data) {
                //$('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#note_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_note').attr('disabled', false);
                }
            },
            error: function () {
                //$('.loader').hide();
                alert('There was an error');
            }

        });
    }

}

var savenoteArray = {};
var savenote = 0;
function saveNoteTemp(woId) {

    var note_date = $('#note_date').val();
    var internal = $('#internal').val();
    var note = $('#note').val();
    var submit_flag = true;
    if (note_date == '') {
        $('#cwerr_date').html('Date can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_date').html('');
    }
    if (note == '') {
        $('#cwerr_note').html('Note can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_note').html('');
    }
    if (submit_flag == false) {
        $('#save_outside').attr('disabled', false);
        return false;
    } else {
        $('#save_note').attr('disabled', 'disabled');
        savenoteArray[savenote] = {note_date: note_date, internal: internal, note: note, woId: woId};
        console.log(savenoteArray);
        var internal_set = $("#internal option:selected").text();
        $('#notes_tab_table').append('<tr id="notes_tab_table_' + savenote + '"><td >' + note_date + '</td><td>' + note + '</td><td>' + internal_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditNoteTemp(' + savenote + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempNotes(' + savenote + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td></tr>');
        savenote++;

        $("div.fancybox-close").trigger("click");
        $("#note_form").html('');
        $('.showmodel').hide();
        $('.hidemodel').show();
    }
}


function deleteTempNotes(index) {
    $('#notes_tab_table_' + index).empty();
    delete savenoteArray[index];
    console.log(savenoteArray);
}
function showEditNote(wnId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editnote",
        type: "post",
        datatype: 'json',
        data: {wnId: wnId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_note_form').html(data);
            $('#edit_note_form_href').trigger('click');
            //$('#note_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function showEditNoteTemp(index) {

    var bId = $('#building_id').val();
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/editnotetemp",
        type: "post",
        datatype: 'json',
        data: {index: index, savenoteArray: savenoteArray, bId: bId},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#edit_note_form').html(data);
            $('#edit_note_form_href').trigger('click');
            //$('#note_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}


function updateNote(details) {
    $('#save_note').attr('disabled', 'disabled');
    var note_date = details.note_date;
    var internal = details.internal;
    var note = details.note;
    var woId = details.woId;
    var wnId = details.wnId;

    var submit_flag = true;

    if (note_date == '') {
        $('#cwerr_date').html('Date can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_date').html('');
    }

    if (note == '') {
        $('#cwerr_note').html('Note can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_note').html('');
    }



    if (submit_flag == false) {
        $('#save_note').attr('disabled', false);
        return false;
    } else {
        //$('.loader').show();
        $.ajax({
            url: baseUrl + "complete/savenote",
            type: "post",
            datatype: 'json',
            data: {
                note_date: note_date, internal: internal, note: note,
                wnId: wnId, woId: woId
            },
            success: function (data) {
                // $('.loader').hide();
                var content = $.parseJSON(data);
                if (content.status == 'success') {
                    $('#success_msg').html(content.msg);
                    //location.reload();
                    //reloadPage('#note_tab');
                } else {
                    //alert('Error occurred');
                    $('#error_msg').html(content.msg);
                    $('#save_note').attr('disabled', false);
                }
            },
            error: function () {
                // $('.loader').hide();
                alert('There was an error');
            }

        });
    }

}
var notesArray = {};
function updateNoteTemp(wnId) {

    $('#save_note').attr('disabled', 'disabled');
    var note_date = $('#edit_note_date').val();
    var internal = $('#edit_internal').val();
    var note = $('#edit_note').val();
    var woId = $('#edit_woId').val();

    var submit_flag = true;

    if (note_date == '') {
        $('#edit_cwerr_date').html('Date can not be blank.');
        submit_flag = false;
    } else {
        $('#edit_cwerr_date').html('');
    }

    if (note == '') {
        $('#edit_cwerr_note').html('Note can not be blank.');
        submit_flag = false;
    } else {
        $('#edit_cwerr_note').html('');
    }



    if (submit_flag == false) {
        $('#save_note').attr('disabled', false);
        return false;
    } else {
        notesArray[wnId] = {note_date: note_date, internal: internal, note: note, wnId: wnId, woId: woId};

        var internal_set = $("#edit_internal option:selected").text();
        $('#notes_tab_table_' + wnId).html('<td>' + note_date + '</td><td>' + note + '</td><td>' + internal_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditNote(' + wnId + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteNote(' + wnId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');
        $('#edit_note_form').html('');
        $("div.fancybox-close").trigger("click");
        $('.showmodel').hide();
        $('.hidemodel').show();
    }
}


function updateNoteTemp2(wnId) {
    $('#save_note').attr('disabled', 'disabled');
    var note_date = $('#edit_note_date').val();
    var internal = $('#edit_internal').val();
    var note = $('#edit_note').val();
    var woId = $('#edit_woId').val();
    var bId = $('#bId').val();

    var submit_flag = true;

    if (note_date == '') {
        $('#cwerr_date').html('Date can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_date').html('');
    }

    if (note == '') {
        $('#cwerr_note').html('Note can not be blank.');
        submit_flag = false;
    } else {
        $('#cwerr_note').html('');
    }



    if (submit_flag == false) {
        $('#save_note').attr('disabled', false);
        return false;
    } else {
        savenoteArray[wnId] = {note_date: note_date, internal: internal, note: note, wnId: wnId, woId: woId, bId: bId};
        console.log(savenoteArray);

        var internal_set = $("#edit_internal option:selected").text();
        $('#notes_tab_table_' + wnId).html('<td>' + note_date + '</td><td>' + note + '</td><td>' + internal_set + '</td><td><a title="Edit" href="javascript:void(0)" onclick="showEditNoteTemp(' + wnId + ')" class="close_bt_hide_cls"><img src="' + baseUrl + 'public/images/edit.png"  /></a><a href="javascript:void(0);"  title="Delete" onclick="deleteTempNotes(' + wnId + ')"><img src="' + baseUrl + 'public/images/delete.png"  /></a></td>');

        $("div.fancybox-close").trigger("click");
        $("#edit_note_form").html('');
    }
}

function deleteNote(wnId) {
    var workOrder_id = $("#workOrder_id").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deletenote",
        dataType: 'json',
        data: {
            wnId: wnId,
            woId: workOrder_id
        },
        success: function (msg) {
            $('.loader').hide();
            if (msg == true) {
                $('#cw_success').html('Note has been deleted successfully.');
                //location.reload();
                // reloadPage();
            } else {
                $('#cw_error').html('Error Occurred during deletion of Note.');
            }
        }

    });

}

var deleteNoteArray = {};
function deleteNoteTemp(wnId) {
    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting Note, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                $('.loader').show();
                deleteNoteArray[wnId] = wnId;
                $('#notes_tab_table_' + wnId).empty();
                console.log(deleteNoteArray);
                $('.loader').hide();
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });
}

/************** upload file js code ********************/
function showUploadForm(bId, woId, wnum) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + "complete/addfile",
        type: "post",
        datatype: 'json',
        data: {bId: bId, woId: woId, wnum: wnum},
        success: function (data) {
            $('.loader').hide();
            //$('#edit_wo_form').show();
            $('#file_form').html(data);
            $('#file_form_href').trigger('click');
            //$('#file_form').show();
            //$('.fade_default_opt').show();
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }

    });
}

function cancelFile() {
    $("div.fancybox-close").trigger("click");
    $('#file_form').html('');
    $('#file_form').hide();
    $('.fade_default_opt').hide();
}

var tempfile = 0;
function uploadFile() {

    $('#upload').attr('disabled', 'disabled');
    var file_title = $('#file_title').val();
    var file_val = $('#wo_file').val();
    var file_val_type = $('#wo_file').val().toLowerCase();
    var regex = new RegExp("(.*?)\.(pdf|png|jpg|jpeg|gif)$");

    var submit_flag = true;
    if (file_title == '') {
        $('#cwerr_title').html('Please enter the file title.');
        submit_flag = false;
    } else {
        $('#cwerr_title').html('');
    }

    if (file_val == '') {
        $('#cwerr_file').html('Please select the file.');
        submit_flag = false;
    } else {
        $('#cwerr_file').html('');
    }

    if (file_val != '') {
        var logo_file = document.querySelector("input[type='file']");
        var file_size = logo_file.files[0].size;
        if (file_size > (1024 * 1024 * 5)) {
            $('#cwerr_file').html('File size must be less than 5MB.');
            submit_flag = false;
        } else if (!(regex.exec(file_val_type))) {
            $('#cwerr_file').html('Please select correct file format.');
            submit_flag = false;
        } else {
            $('#cwerr_file').html('');
        }
    }

    if (submit_flag == false) {
        $('#upload').attr('disabled', false);
        $('.showmodel').hide();
        $('.hidemodel').show();
    } else {
        $('#showTempAttachment').append('<li id="tempfile_' + tempfile + '"></li>');

        $("#upload_file").ajaxForm({
            target: '#tempfile_' + tempfile
        }).submit();
        tempfile++;
        cancelFile();
    }
}

function uploadFileDatabase(filename, title, workorder) {

    $.ajax({
        type: "POST",
        url: baseUrl + "complete/uploadfiledatabase",
        data: {
            file_name: filename,
            file_title: title,
            woId: workorder
        }
    });


}

function deleteFiles(wfId) {
    var workOrder_id = $("#workOrder_id").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "complete/deletefile",
        data: {
            wfId: wfId,
            woId: workOrder_id

        },
    });

}


var deleteFilesArray = {};
function deleteFilesHide(wfId) {
    var workOrder_id = $("#workOrder_id").val();
    var check_delete = 'YES';
    var return_value = jPrompt("For Deleting File, Enter Yes in Capital letters.", '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                $('.loader').show();
                deleteFilesArray[wfId] = wfId;
                $('#tempfile_' + wfId).empty();
                console.log(deleteFilesArray);
                $('.loader').hide();
                $('.showmodel').hide();
                $('.hidemodel').show();
            } else {
                $('#cw_error').html('You have entered wrong word.');
            }
        }
    });

}

function deleteFilesTemp(index) {
    $('#' + index).empty();
}

function saveCompleteChanges(woId) {
    //$('.overlay').show();
    //$('#save_changes').attr('disabled', 'disabled');
    var date_cp_in = $('#date_cp_in').val();
    var date_cp_out = $('#date_cp_out').val();
    var time_in = $('#time_in').val();
    var time_out = $('#time_out').val();
    var wo_status = $('#wo_status').val();
    var wcId = $('#wcId').val();
    var billable_opt = "0";
    if ($('#billable_opt').is(":checked"))
    {
      billable_opt = $('#billable_opt').val();
    } 
    var submit_flag = true;
 
    if (wo_status == '1') {
        $('#cw_error').html('Work order status can not be new.');
        submit_flag = false;
    } else {
        $('#cw_error').html('');
    }

    if (date_cp_in > date_cp_out) {
        $('#cw_error').html('Date complete time out must be equal or greater than date complete time in.');
        submit_flag = false;
    } else if (date_cp_in == date_cp_out) {
        var tstatus = checkTimeStatus(time_in, time_out);
        //alert(tstatus);
        if (tstatus == 0) {
            $('#cw_error').html('Time out must be greater than time in.');
            submit_flag = false;
        } else if (tstatus == 2) {
            $('#cw_error').html('Time out date must be greater than time in date.');
            submit_flag = false;
        } else {
            $('#cw_error').html('');
        }
    } else {
        $('#cw_error').html('');
    }

    if (submit_flag == false) {
        $('#save_changes').attr('disabled', false);
        return false;
    } else {
        $('.loader').show();

        // save description
        var addtempdecs = $('#addtempdecs').val();
        if (addtempdecs == 'addtempdecs') {
            saveDescription(woId);
        }

        // save labor
        var savelaborArrayCount = Object.keys(savelaborArray).length;
        if (savelaborArrayCount > 0) {
            for (var key in savelaborArray) {
                saveLaborData(savelaborArray[key])
            }
        }

        // update labor
        var lidArrayCount = Object.keys(lidArray).length;
        if (lidArrayCount > 0) {
            for (var key in lidArray) {
                updateLaborData(lidArray[key])
            }
        }

        // delete labor
        var deleteLaborArrayCount = Object.keys(deleteLaborArray).length;
        if (deleteLaborArrayCount > 0) {
            for (var key in deleteLaborArray) {
                deleteLaborCharge(deleteLaborArray[key])
            }
        }

        // save bservice
        var saveBServiceDataArrayCount = Object.keys(saveBServiceDataArray).length;
        if (saveBServiceDataArrayCount > 0) {
            for (var key in saveBServiceDataArray) {
                saveBServiceData(saveBServiceDataArray[key])
            }
        }

        // update bservice
        var bServiceArrayCount = Object.keys(bServiceArray).length;
        if (bServiceArrayCount > 0) {
            for (var key in bServiceArray) {
                updateBServiceData(bServiceArray[key])
            }
        }

        // delete bservice
        var deleteBserviceArrayCount = Object.keys(deleteBserviceArray).length;
        if (deleteBserviceArrayCount > 0) {
            for (var key in deleteBserviceArray) {
                deleteBservice(deleteBserviceArray[key])
            }
        }

        // save material
        var savematerialArrayCount = Object.keys(savematerialArray).length;
        if (savematerialArrayCount > 0) {
            for (var key in savematerialArray) {
                saveMaterialData(savematerialArray[key])
            }
        }

        // update material
        var materialArrayCount = Object.keys(materialArray).length;
        if (materialArrayCount > 0) {
            for (var key in materialArray) {
                updateMaterialData(materialArray[key])
            }
        }

        // delete material
        var deleteMaterialArrayCount = Object.keys(deleteMaterialArray).length;
        if (deleteMaterialArrayCount > 0) {
            for (var key in deleteMaterialArray) {
                deleteMaterial(deleteMaterialArray[key])
            }
        }

        // save outside
        var saveoutsideArrayCount = Object.keys(saveoutsideArray).length;
        if (saveoutsideArrayCount > 0) {
            for (var key in saveoutsideArray) {
                saveOutSideData(saveoutsideArray[key])
            }
        }

        // update outside
        var outsideArrayCount = Object.keys(outsideArray).length;
        if (outsideArrayCount > 0) {
            for (var key in outsideArray) {
                updateOutSideData(outsideArray[key])
            }
        }

        // delete outside
        var deleteOutsideArrayCount = Object.keys(deleteOutsideArray).length;
        if (deleteOutsideArrayCount > 0) {
            for (var key in deleteOutsideArray) {
                deleteOutside(deleteOutsideArray[key])
            }
        }

        // save note
        var savenoteArrayCount = Object.keys(savenoteArray).length;
        if (savenoteArrayCount > 0) {
            for (var key in savenoteArray) {
                saveNote(savenoteArray[key])
            }
        }

        //update note
        var notesArrayCount = Object.keys(notesArray).length;
        if (notesArrayCount > 0) {
            for (var key in notesArray) {
                updateNote(notesArray[key])
            }
        }

        // delete note
        var deleteNoteArrayCount = Object.keys(deleteNoteArray).length;
        if (deleteNoteArrayCount > 0) {
            for (var key in deleteNoteArray) {
                deleteNote(deleteNoteArray[key])
            }
        }

        //upload file					
        $(".pfileupload").each(function () {
            var filename = $(this).val( );
            var title = $(this).attr("flag_id");
            var workorder = $(this).attr("woId_id");
            uploadFileDatabase(filename, title, workorder);
        });

        // delete file
        var deleteFilesArrayCount = Object.keys(deleteFilesArray).length;
        if (deleteFilesArrayCount > 0) {
            for (var key in deleteFilesArray) {
                deleteFiles(deleteFilesArray[key])
            }
        }

        // update work order
        var tempForm = $('#tempForm').val();
        if (tempForm != undefined) {
            for (var i = 0; i < 1; i++) {
                updateWO(woId);
            }
        }
        //alert(baseUrl);
        // update status
        $.ajax({
            url: baseUrl + "complete/wocomplete/billable_opt/" + billable_opt,
            type: "post",
            datatype: 'json',
            data: {
                date_cp_in: date_cp_in, date_cp_out: date_cp_out, time_in: time_in,
                time_out: time_out, wo_status: wo_status, woId: woId, wcId: wcId
            },
            success: function (data) {
                console.log(data);
                //$('.loader').hide();
                $('.overlay').show();
                var content = $.parseJSON(data);
                if(content !== null){
                    if (content.status == 'success') {
                        
                       str = window.location.href;
                        var res = str.replace("/workorder/", "/reloadworkorder/");
                        //setInterval(function () {
                            
                            //location.reload();
                            //window.location.assign(location.href);
                            $.ajax({    
                                    type: "POST",
                                    url: res,                               
                                    success: function (response) {
                                        //alert(response);
                                        $('.loader').hide();                
                                        $("#reloadworkorder").html(response);
                                        //$('.success_message').slideUp(500);
                                        //$( "#addcss" ).html( '<style>'+html+'</style>' );
                                    }
                             });
                        //}, 1100);
                        //location.reload(); 
    //                    $('.loader').hide();
    //                    
    //                    
    //                    $('.close_bt_hide_cls').hide();
    //                    $('.close_fd_dsbl').attr('disabled', true);
    //                    $('#edit_wwork_order').show();
                         $(".overlay").hide();
    //                    $(".print_invoice").hide();
    //                    $("#validateprint").hide();
    //                    $("#validprint").show();
                        
    //                    $("#edit_wwork_order").css("display","inline-block");
    //                    $("#save_changes").css("display","none");
    //                    $(".close_bt_hide_cls").css("display","none");
    //                    $(".close_bt_hide_cls").css("display","none");
    //                    $("#date_cp_in").attr("disabled","disabled");
    //                    $("#date_cp_out").attr("disabled","disabled");
    
                    } else {
                        $('.overlay').hide();
                        $('.loader').hide();
                        //alert('Error occurred');
                        $('#cw_error').html(content.msg);
                        $('#save_changes').attr('disabled', false);
                    }
                }else{
                    $('.overlay').hide();
                    $('.loader').hide();
                    $('#cw_error').html("No data found");
                    $('#save_changes').attr('disabled', false);
                }
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }

        });
    }
}

function checkTimeStatus(stime, etime) {
    var time_status = 0;
    var ti_res = stime.split(" ");
    var to_res = etime.split(" ");

    var ti_md = ti_res[1];
    var to_md = to_res[1];

    var ti_rt = ti_res[0].split(":");
    var ti_st = ti_rt[0] + '' + ti_rt[1];

    var to_rt = to_res[0].split(":");
    var to_et = to_rt[0] + '' + to_rt[1];

    ti_st = parseInt(ti_st);
    //alert(ti_st);
    if(ti_st>='1200'){
        ti_st= parseInt(ti_st) - 1200;
    }
    //alert(ti_st);
    to_et = parseInt(to_et);
    if(to_et >= '1200'){
        to_et= parseInt(to_et) - 1200;
    }

    if ((ti_md == to_md) && (ti_st >= to_et)) {
        time_status = 0;
    } else if ((ti_md == to_md) && (ti_st < to_et)) {
        time_status = 1;
    } else if ((ti_md != to_md) && (ti_md == 'AM')) {
        time_status = 1;
    } else if ((ti_md != to_md) && (ti_md == 'PM')) {
        time_status = 2;
    }

    return time_status;
}

function showAlertBox() {
    $('#alert_wo_edit_href').trigger('click');
    $('.showmodel').hide();
    $('.hidemodel').show();
    //$('#fd_dft_div').show();
    //$("#alert_wo_edit").show();
}

function cancelWoEdit() {
    $("div.fancybox-close").trigger("click");
    $('.showmodel').show();
    $('.hidemodel').hide();
    $('#fd_dft_div').hide();
    $("#alert_wo_edit").hide();
}

function showWoEdit() {
    $('.close_bt_hide_cls').show();
    $('.showmodel').hide();
    $('.hidemodel').show();
    $('.close_fd_dsbl').attr('disabled', false);
    $('#edit_wwork_order').hide();
    $("div.fancybox-close").trigger("click");
    $("#alert_wo_edit").hide();
    $('#fd_dft_div').hide();
    //cancelWoEdit();
}

$(function () {
    $("#work_order").autocomplete({
        source: function (request, response) {

            var building_id = $("#building_id").val();
            $.ajax({
                url: baseUrl + 'complete/searchworkorderbyid',
                dataType: "jsonp",
                data: {
                    workorder: request.term,
                    building_id: building_id
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 0,
        select: function (event, ui) {
            if (ui.item.cust_id != -1) {
                $("#work_order").val(ui.item.value);
                return false;
            }
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    }).focus(function () {
        $("#work_order").autocomplete("search");
    })
});

$[ "ui" ][ "autocomplete" ].prototype["_renderItem"] = function (ul, item) {
    return $("<li></li>")
            .data("item.autocomplete", item)
            .append($("<a></a>").html(item.label))
            .appendTo(ul);

};


function minChargeSub(newtime, starttime, timediff) {
    var newtime = moment(newtime, ["h:mm A"]).format("h:mm A");
    var starttime = moment(starttime, ["h:mm A"]).format("h:mm A");
//var ty=a.subtract(b).format("HH:mm");
    var dt = moment(newtime, ["h:mm A"]).add(timediff, 'm').format("h:mm A");
    if ($("#time_out option[value='" + dt + "']").length <= 0) {
        $("#time_out").append('<option value="' + dt + '">' + dt + '</option>')
    }
    $("#time_out").val(dt);
}

function minChargeAdd12(newtime, starttime, timediff) {
    var newtime = moment(newtime, ["h:mm A"]).format("h:mm A");
    var starttime = moment(starttime, ["h:mm A"]).format("h:mm A");
//var ty=a.subtract(b).format("HH:mm");
    var dt = moment(newtime, ["h:mm A"]).subtract(timediff, 'm').format("h:mm A");
    if ($("#time_in option[value='" + dt + "']").length <= 0) {
        $("#time_in").append('<option value="' + dt + '">' + dt + '</option>')
    }
    $("#time_in").val(dt);
}

function addNewBatch(url) {
    CheckForSessionpop(baseUrl);

    //$('form#first_form input#tenantName').trigger('click');
    $('a[href="#addNewBatch"]').fancybox({
        type: 'iframe',
        href: url,
        width: 870,
        height: 600,
        'beforeClose': function () {
            $('.loader').hide();
        },
        'afterLoad': function () {
            $.fancybox.hideLoading();
            $('.loader').show();
            $('form#first_form input#tenantName').focus();
            $(this.content).attr("tabindex", 1).focus();
            setInterval(function () {
                $('.loader').hide();
            }, 5000);
        },
        afterShow: function () {
            $('iframe.fancybox-iframe').contents().find("#tenantName").attr("tabindex", 1).focus();
        }
    });

}


function showWorkOrderInfo() {
    parent.CheckForSessionpop(baseUrl);
    var tuid = $("#tenantId").val();
    var bId = $("#bId").val();
    var page = $("#page").val();
    var batch_id = $("#batch_id").val();
    var fromdate = $("#fromdate").val();
    var todate = $("#todate").val();
    var monthyear = $("#monthyear").val();
    if (todate != '' && fromdate != '') {
        var todatearr = todate.split("/");
        todate = todatearr[2] + '-' + todatearr[0] + '-' + todatearr[1];
        var fromdatearr = fromdate.split("/");
        fromdate = fromdatearr[2] + '-' + fromdatearr[0] + '-' + fromdatearr[1];
        window.location.href = baseUrl + 'complete/index/bid/' + bId + '/page/' + page + '/tuid/' + tuid + '/to/' + todate + '/from/' + fromdate + '/batch/' + batch_id;
    } else if (monthyear != '') {
        var monthyear = monthyear.split("/");
        window.location.href = baseUrl + 'complete/index/bid/' + bId + '/page/' + page + '/tuid/' + tuid + '/month/' + monthyear[0] + '/year/' + monthyear[1] + '/batch/' + batch_id;
    } else {
        window.location.href = baseUrl + 'complete/index/bid/' + bId + '/page/' + page + '/tuid/' + tuid + '/batch/' + batch_id;
    }
}

function selectInvoice() {
    $(".checkBoxClass").prop('checked', true);

    var woiddel = "false";
    var workIdarr = {};
    $('.checkBoxClass:checked').each(function () {
        var workId = $(this).val();
        workIdarr[workId] = workId;
    });
    console.log(workIdarr);
    $.ajax({
        url: baseUrl + 'complete/selectedbatch',
        type: 'post',
        data: {
            woid: workIdarr,
            woiddel: woiddel
        },
        success: function (data) {
            $("#selectedworkorders").val(data);
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });






}

function unselectInvoice() {
    $(".checkBoxClass").prop('checked', false);


    var workIdarr = {};
    // var workId=$(this).val();
    $('.checkBoxClass:not(:checked').each(function () {
        var workId = $(this).val();
        workIdarr[workId] = workId;
    });
    woiddel = "true";
    console.log(workIdarr);
    $.ajax({
        url: baseUrl + 'complete/selectedbatch',
        type: 'post',
        data: {
            woid: workIdarr,
            woiddel: woiddel
        },
        success: function (data) {
            $("#selectedworkorders").val(data);
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

function cancelBatch() {
    parent.jQuery.fancybox.close();
}

function generateBatch() {
    parent.CheckForSessionpop(baseUrl);
    var tuid = $("#tenantId").val();
    var bid = $("#bId").val();
    var page = $("#page").val();
    var selectedworkorders = $("#selectedworkorders").val();
    var workorderjson = JSON.parse(selectedworkorders);
    var i = 0;
    var woid = new Array();
    for (x in workorderjson) {
        woid[i] = workorderjson[x];
        i++;
    }
    if (woid == '') {
        $("#batch_error").html("Please select Invoice Number");
    } else {
        $('.loader').show();
        $.ajax({
            url: baseUrl + 'complete/generatebatch',
            type: 'post',
            data: {
                tuid: tuid,
                bid: bid,
                woid: woid
            },
            success: function (data) {
                window.location.href = baseUrl + 'complete/index/bid/' + bid + '/page/' + page + '/tuid/' + tuid + '/batch/1';
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }
        });
    }

}

function deleteBatch(woId, batchid, bid) {
    var check_delete = 'YES';
    jPrompt('For Deleting work order from batch, Enter Yes in Capital letters.', '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                var tuid = $("#tenantId").val();
                var bid = $("#bId").val();
                var page = $("#page").val();
                $('.loader').show();
                $.ajax({
                    url: baseUrl + 'complete/deletebatch',
                    type: 'post',
                    data: {
                        woid: woId,
                        batchid: batchid,
                        bid: bid
                    },
                    success: function (data) {
                        window.location.href = baseUrl + 'complete/index/bid/' + bid + '/page/' + page + '/tuid/' + tuid + '/batch/1';
                    },
                    error: function () {
                        $('.loader').hide();
                        alert('There was an error');
                    }
                });

            } else {
                jAlert('You have entered wrong word.', 'Vision Work Orders');
            }
        }
    });
}

function searchByMonth(month, year) {
    parent.CheckForSessionpop(baseUrl);
    var tuid = $("#tenantId").val();
    var bId = $("#bId").val();
    var page = $("#page").val();
    var batch_id = $("#batch_id").val();
    month = parseInt(month) + 1;
    $('.loader').show();
    window.location.href = baseUrl + 'complete/index/bid/' + bId + '/page/' + page + '/tuid/' + tuid + '/month/' + month + '/year/' + year + '/batch/' + batch_id;
}

function searchBydate() {
    parent.CheckForSessionpop(baseUrl);
    var fromdate = $("#fromdate").val();
    var todate = $("#todate").val();
    var tuid = $("#tenantId").val();
    var bId = $("#bId").val();
    var page = $("#page").val();
    var batch_id = $("#batch_id").val();
    if (fromdate != '' && todate != '') {
        $('.loader').show();
        var todatearr = todate.split("/");
        todate = todatearr[2] + '-' + todatearr[0] + '-' + todatearr[1];
        var fromdatearr = fromdate.split("/");
        fromdate = fromdatearr[2] + '-' + fromdatearr[0] + '-' + fromdatearr[1];
        window.location.href = baseUrl + 'complete/index/bid/' + bId + '/page/' + page + '/tuid/' + tuid + '/to/' + todate + '/from/' + fromdate + '/batch/' + batch_id;
    }
}

$(function () {
    $('.monthYearPicker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm/yy'
    }).focus(function () {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function () {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            thisCalendar.datepicker('setDate', new Date(year, month, 1));
            searchByMonth(month, year);
        });
    });
});


$(function () {
    $(".checkBoxClass").click(function () {
        var woiddel = "false";
        var workIdarr = {};
        var workId = $(this).val();
        if ($(this).is(':checked')) {
            workIdarr[workId] = workId;
        } else {
            woiddel = "true";
            workIdarr[workId] = workId;
        }
        console.log(workIdarr);
        $.ajax({
            url: baseUrl + 'complete/selectedbatch',
            type: 'post',
            data: {
                woid: workIdarr,
                woiddel: woiddel
            },
            success: function (data) {
                $("#selectedworkorders").val(data);
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }
        });
    });
});

/* function showBatch(bId){
 $('.loader').show();
 $.ajax({
 url         : baseUrl+"complete/woparameter",
 type        : "post",
 datatype    : 'json',
 data        : {bId:bId},
 success     : function( data ) {
 $('.loader').hide();
 //$('#edit_wo_form').show();
 $('#batch_dft_fm').html(data);
 $('#batch_dft_fm_href').trigger('click');
 //$('#bd_dft_fm').show();
 //$('.fade_default_opt').show();
 },
 error       : function(){
 $('.loader').hide();
 alert('There was an error');
 }
 
 });
 }
 */

function showBatch(url) {
    //$('form#first_form input#tenantName').trigger('click');
    CheckForSessionpop(baseUrl);
    $('a[href="#showBatch"]').fancybox({
        type: 'iframe',
        href: url,
        width: 870,
        height: 600,
        'beforeClose': function () {
            $('.loader').hide();
        },
        'afterLoad': function () {
            $.fancybox.hideLoading();
            $('.loader').show();
            $('form#first_form input#tenantName').focus();
            $(this.content).attr("tabindex", 1).focus();
            setInterval(function () {
                $('.loader').hide();
            }, 5000);
        },
        afterShow: function () {
            $('iframe.fancybox-iframe').contents().find("#tenantName").attr("tabindex", 1).focus();
        }
    });
}

function loadBatches(batchId, buildingid) {
    parent.CheckForSessionpop(baseUrl);
    hideBatches();
    $('#open_div_' + batchId).hide();
    $('#close_div_' + batchId).show();
    $("#tenantuser_popup_" + batchId).hide();
    if (batchId != '') {
        $('.loader').show();
        $.ajax({
            url: baseUrl + "Complete/loadbatches",
            type: "post",
            data: {batchId: batchId, buildingid: buildingid},
            success: function (data) {
                $('.loader').hide();
                if (data) {
                    $('#trId_' + batchId).show();
                    $('#loadtenant_' + batchId).html(data);

                } else {
                    jAlert('There was an error');
                }
            },
            error: function () {
                $('.loader').hide();
                jAlert('There was an error');
            }

        });
    } else {
        jAlert('Some error occurred.');
    }
}

function hideBatches() {
    $('.open_plus').show();
    $('.open_close').hide();
    $('.trtenant-class').hide();
    $('.tdtenant-class').html('');
}

function showBatchInfo() {
    parent.CheckForSessionpop(baseUrl);
    var tuid = $("#tenantId").val();
    var bId = $("#bId").val();
    window.location.href = baseUrl + 'complete/showbatch/bid/' + bId + '/tuid/' + tuid;
}

function deleteBatchList(woId, batchid, bid) {
    var check_delete = 'YES';
    jPrompt('For Deleting work order from batch, Enter Yes in Capital letters.', '', 'Vision Work Orders', function (return_value) {
        if (return_value != null) {
            if (check_delete === return_value) {
                var tuid = $("#tenantId").val();
                var bid = $("#bId").val();
                var page = $("#page").val();
                $('.loader').show();
                $.ajax({
                    url: baseUrl + 'complete/deletebatch',
                    type: 'post',
                    data: {
                        woid: woId,
                        batchid: batchid,
                        bid: bid
                    },
                    success: function (data) {
                        $('.loader').hide();
                        location.reload();
                        //   window.location.href = baseUrl+'complete/showbatch/bid/'+bid+'/page/'+page+'/tuid/'+tuid+'/batch/1';
                    },
                    error: function () {
                        //$('.loader').hide();
                        alert('There was an error');
                    }
                });
            } else {
                jAlert('You have entered wrong word.', 'Vision Work Orders');
            }
        }
    });
}
function showBatchList(url) {
    $('.loader').show();
    $.ajax({
        url: url,
        type: "get",
        datatype: 'json',
        success: function (data) {
            $('#show_batch_list_div').html(data);
            $('#show_batch_list_div_href').trigger('click');
            $('.loader').hide();
        },
        error: function () {
            $('.loader').hide();
            jAlert('There was an error', 'Vision Work Orders');
        }
    });


}

function addWorkBatch(batchId) {
    var woId = $("#batchdropdown").val();

    if (woId == '') {
        $("#batch_error").html("Please select work order");
    } else {
        $('.loader').show();
        $.ajax({
            url: baseUrl + 'complete/upldatebatchworkorder',
            type: 'post',
            data: {
                batchId: batchId,
                woId: woId
            },
            success: function (data) {
                $("#batch_error").html("Work order added successfully");
                setInterval(10000);
                // $('.loader').hide();
                //cancelWorkBatch();
                location.reload();
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }
        });
    }
}

function cancelWorkBatch() {
    $("#fancybox-overlay").remove();
    $("div.fancybox-close").trigger("click");
    $('#show_batch_list_div').hide();
}

function cancelBatchList()
{
    parent.jQuery.fancybox.close();
}

function historyoflabor(bId, whId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyoflabor',
        type: 'post',
        data: {
            bId: bId,
            whId: whId
        },
        success: function (data) {
            $("#batch_error").html("Work order added successfully");
            $('.loader').hide();
            $("#add_new_labor_div").html(data);
            $('#add_new_labor_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

function historyofBuilding(bId, whId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyofbuilding',
        type: 'post',
        data: {
            bId: bId,
            whId: whId
        },
        success: function (data) {
            $("#batch_error").html("Work order added successfully");
            $('.loader').hide();
            $("#add_history_building_div").html(data);
            $('#add_history_building_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

function historyofMaterial(bId, whId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyofmaterial',
        type: 'post',
        data: {
            bId: bId,
            whId: whId,
        },
        success: function (data) {
            $("#batch_error").html("Work order added successfully");
            $('.loader').hide();
            $("#add_history_material_div").html(data);
            $('#add_history_material_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

function historyofoutside(bId, whId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyofoutside',
        type: 'post',
        data: {
            bId: bId,
            whId: whId,
        },
        success: function (data) {
            $("#batch_error").html("Work order added successfully");
            $('.loader').hide();
            $("#add_history_outside_div").html(data);
            $('#add_history_outside_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

function historyofnotes(bId, whId) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyofnotes',
        type: 'post',
        data: {
            bId: bId,
            whId: whId
        },
        success: function (data) {
            $("#batch_error").html("Work order added successfully");
            $('.loader').hide();
            $("#add_history_notes_div").html(data);
            $('#add_history_notes_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}


function hostoryofworkorder(bId, woId, current_value, change_value) {
    $('.loader').show();
    $.ajax({
        url: baseUrl + 'complete/historyofworkorder',
        type: 'post',
        data: {
            bId: bId,
            woId: woId,
            current_value: current_value,
            change_value: change_value
        },
        success: function (data) {
            $('.loader').hide();
            $('#add_histroy_workorder_div').html(data);
            $('#add_histroy_workorder_div_href').trigger('click');
        },
        error: function () {
            $('.loader').hide();
            alert('There was an error');
        }
    });
}

var set_change_priority = 'NotChanged';
function changePriority(categoryId) {
    if (categoryId != '') {
        $.ajax({
            url: baseUrl + 'complete/changepriority',
            type: 'post',
            data: {
                categoryId: categoryId
            },
            success: function (data) {
                set_change_priority = data;
            },
            error: function () {
                $('.loader').hide();
                alert('There was an error');
            }
        });
    }

}



function validateEditModeCheck() {
    jAlert('Save your changes before performing this function.', 'Vision Work Orders');
    return false;
}
$(function () {
    $("#date_cp_in, #date_cp_out, #wo_status, #time_in, #time_out ").change(function () {
        $('.showmodel').hide();
        $('.hidemodel').show();
    });
});
