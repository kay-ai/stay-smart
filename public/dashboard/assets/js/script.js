
$(document).ready(function(){
    $(".message-alert").delay(7000).fadeOut("slow");
});

function getGISInfo(index) {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Convert latitude to N or S
            var latitudeSymbol = latitude >= 0 ? "N" : "S";
            latitude = Math.abs(latitude);

            // Convert longitude to E or W
            var longitudeSymbol = longitude >= 0 ? "E" : "W";
            longitude = Math.abs(longitude);

            $("#meter-latitude"+index).val(latitude.toFixed(6) + " " + latitudeSymbol);
            $("#meter-longitude"+index).val(longitude.toFixed(6) + " " + longitudeSymbol);

            console.log("Latitude: " + latitude + ", Longitude: " + longitude);
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function searchMeter(){
    var meter_number = $('#search_meter_number').val();

    let error;
    if(meter_number.length > 1 && meter_number.length < 11){
        error = 'Meter Number must be at least 11 characters';
    }
    if(meter_number.length < 1){
        error = 'Meter Number is required';
    }

    if(error){
        $('#customer_div').show();
        $('#customer_div').html('<p class="text-danger">'+error+'</p>');
        $('#kct_div').show();
        $('#kct_information').hide();
        $('#search_btn').removeAttr('disabled');
        $('#search_btn').html('Search');
    }else{
        $.ajax({
            url: "/search-meter/"+meter_number,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // data: { username: selectedData },
            beforeSend: function(){
                $('#customer_div').show();
                $('#customer_found').hide();
                $('#meter_treated').hide();
                $('#kct_div').show();
                $('#kct_information').hide();
                $('#search_btn').attr('disabled', 'disabled');
                $('#search_btn').html('loading...');
            },
            success: function(data) {
                $('#search_btn').removeAttr('disabled');
                $('#search_btn').html('Search');

                console.log(data);
                if(data.status == 'error'){
                    $('#customer_div').show();
                    $('#customer_found').hide();
                    $('#meter_treated').hide();
                    if(data.msg == 'Customer not found'){
                        getGISInfo(1);
                        $('#customer_div').html('<p class="text-danger mb-0 me-2">'+data.msg+'<button onClick="showDiv();" class="btn btn-primary btn-sm mt-1 m-auto d-block"><i class="bi bi-plus m-0"></i> Capture Customer</button></p>');
                    }else{
                        $('#customer_div').html('<p class="text-danger">'+data.msg+'</p>');
                    }
                    $('#kct_div').show();
                    $('#kct_information').hide();
                }else if(data.status == 'treated'){
                    // console.log(data.kct);
                    $('#customer_div').hide();
                    $('#kct_div').show();
                    $('#kct_information').hide();

                    var username = data.user.first_name + ' ' + data.user.last_name;
                    $('#user_name').html(data.user ? username : '...');
                    $('#Kmeter_number').html(data.kct.meter_number ?? '...');
                    $('#Kcustomer_name').html(data.kct.customer_name ?? '...');
                    $('#Kcustomer_address').html(data.kct.customer_address ?? '...');


                    $('#Kaccess_power_kct1').html(data.kct.access_power_kct1 ?? '...');
                    $('#Kaccess_power_kct2').html(data.kct.access_power_kct2 ?? '...');
                    $('#Kaedc_kct1').html(data.kct.aedc_kct1 ?? '...');
                    $('#Kaedc_kct2').html(data.kct.aedc_kct2 ?? '...');
                    $('#Kbase_date').html(data.kct.base_date ?? '...');
                    $('#Kdate').html(data.kct.date ?? '...');
                    $('#Kcustomer_longitude').html(data.task.meter_longitude ?? '...');
                    $('#Kcustomer_latitude').html(data.task.meter_latitude ?? '...');
                    $('#meter_no_before').html(data.task.aedc_meter_account_no_before_power ?? '...');
                    $('#previous_meter_no').html(data.task.previous_meter_account_no ?? '...');
                    $('#kct_failed').html(data.task.which_dkct_failed ?? '...');
                    $('#phone_number').html(data.task.phone_number ?? '...');
                    $('#rollover_status').html(data.task.rollover_status ?? '...');
                    $('#needs_relocation').html(data.task.meter_needs_relocation ?? '...');

                    $('#meter_treated').show();
                    // console.log('data:',data.kct);
                }else if(data.status == 'success'){
                    getGISInfo(2);
                    console.log(data.msg);
                    $('#meter_number').html(data.msg.meter_number ?? '...');
                    $('#customer_name').html(data.msg.customer_name ?? '...');
                    $('#customer_address').html(data.msg.customer_address ?? '...');
                    $('#access_power_kct1').html(data.msg.access_power_kct1 ?? '...');
                    $('#access_power_kct2').html(data.msg.access_power_kct2 ?? '...');

                    $('#aedc_kct1').html(data.msg.aedc_kct1 ?? '...');
                    $('#aedc_kct2').html(data.msg.aedc_kct2 ?? '...');
                    $('#base_date').html(data.msg.base_date ?? '...');
                    $('#date').html(data.msg.date ?? '...');
                    $('#access_aedc_kct_id').val(data.msg.id);

                    $('#customer_div').hide();
                    $('#customer_found').show();
                    $('#kct_div').hide();
                    $('#kct_information').show();
                }
            },
            error: function(error){
                $('#customer_div').show();
                $('#customer_div').html('<p class="text-danger">'+error+'</p>');
                $('#kct_div').show();
                $('#kct_information').hide();
                $('#search_btn').removeAttr('disabled');
                $('#search_btn').html('Search');
            }
        });
    }
}

function showDiv() {
    meter_number = $('#search_meter_number').val();

    $('#new_meter_number').val(meter_number);
    $('#customer_not_found').toggleClass('d-none');
    $('#customer_div').hide();
}

function hideDiv() {
    $('#customer_not_found').toggleClass('d-none');
    $('#customer_div').show();
}

function deleteCustomer(customer) {
    console.log('delete customer');
    $('#delete_customer').modal('show');
    $('#customer_delete_form').attr('action', '/customer/' + customer + '/delete');
}

$(document).ready(function() {
    var table = $('#tasks_datatable').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print']
    });

    table.buttons().container()
        .appendTo( '#tasks_datatable_wrapper .col-md-6:eq(0)' );

    var table = $('#kct_datatable').DataTable( {
        lengthChange: false,
        pageLength: 30,
        buttons: [ 'copy', 'excel', 'pdf', 'print']
    });

    table.buttons().container()
        .appendTo( '#kct_datatable_wrapper .col-md-6:eq(0)' );

    var table = $('#tasks_list_datatable').DataTable( {
        lengthChange: false,
        pageLength: 30,
        buttons: [ 'copy', 'excel', 'pdf', 'print']
    });

    table.buttons().container()
        .appendTo( '#tasks_list_datatable_wrapper .col-md-6:eq(0)' );


    $('input[name="aedc_meter_account_no_before_power"]').on('change', function() {
        var aedc_power = $(this).val();
        if (aedc_power === "yes") {
            $('#previous_meter_number').show();
        } else {
            $('#previous_meter_number').hide();
        }
    });

    $('select[name="rollover_status"]').on('change', function() {
        var rollover_status = $(this).val();
        if (rollover_status === "failed") {
            $('#failed_kct').show();
        } else {
            $('#failed_kct').hide();
        }
    });

});
