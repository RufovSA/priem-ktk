var document_data = new FormData();

function ep_back(href, act, sid) {
    ep_loader(true);
    $.ajax({
        url: href,
        method: 'post',
        data: {
            act: act,
            sid: sid,
            no_check: 1
        },
        headers: {
            "Reagordi-Ajax": 'XMLHttpRequest'
        },
        success: function (data) {
            ep_loader(false);
            $('#page_context').html(data);
            ep_updatephone();
        }
    });
}

function ep_change_input_file(e) {
    $.each( e.files, function( key, value ){
        document_data.append( $(e).attr('name'), value );
    });
    //console.log(document_data);
}

function ep_form(e) {
    ep_loader(true);

    var d = {
        url: e.action,
        method: 'post',
        dataType: 'html',
        cache: false,
        headers: {
            "Reagordi-Ajax": 'XMLHttpRequest'
        },
        success: function (data) {
            ep_loader(false);
            $('#page_context').html(data);
            ep_updatephone();
        }
    };

    if ($('#rg_ep_act').attr('value') == '10') {
        var data = document_data;
        alert();
        //data.append('uploaded_application', $("#file-0b").file);
        //data.append('uploaded_passport', $("#file-1b").file);
        //data.append('uploaded_certificate', $("#file-2b").file);
        //data.append('act', $('#rg_ep_act').attr('value'));
        data.append('sid', $('#rg_ep_sid').attr('value'));
        d.data = data;
        d.processData = false;
        d.contentType = false;
    } else {
        var data = $(e).serialize();
        d.data = data;
    }
    //console.log(data);

    $.ajax(d);
}

function ep_loader(st) {
    if (st === false) {
        document.body.style.overflow = 'auto';
        document.getElementById('rde_load').style.display = 'none';
    } else {
        document.body.style.overflow = 'hidden';
        document.getElementById('rde_load').style.display = 'block';
    }
}

function ep_updatephone() {
    $('form input[type="text"].bfh-phone, form input[type="tel"].bfh-phone, span.bfh-phone').each(function () {
        var $phone;

        $phone = $(this);

        $phone.bfhphone($phone.data());
    });
    $('.ep_addres').select2({
        maximumSelectionLength: 2,
        language: reagordi.lang
    });
    $("#file-0b").fileinput({
        language: 'ru',
        maxFileSize: 2048,
        showClose: false,
        allowedFileExtensions: ['pdf']
    });
    $("#file-1b").fileinput({
        language: 'ru',
        maxFileSize: 2048,
        showClose: false,
        allowedFileExtensions: ['pdf']
    });
    $("#file-2b").fileinput({
        language: 'ru',
        maxFileSize: 2048,
        showClose: false,
        allowedFileExtensions: ['pdf']
    });
}

function update_date() {
    ep_loader(true);
    var e = $('#ed_statement_form');
    var dat = e.serialize();

    $.ajax({
        url: e.action,
        method: 'post',
        dataType: 'html',
        headers: {
            "Reagordi-Ajax": 'XMLHttpRequest'
        },
        data: dat + '&update=1',
        success: function (data) {
            ep_loader(false);
            $('#page_context').html(data);
            ep_updatephone();
        }
    });
}

function ep_block_addres_fact(status) {
    if (status === false) {
        $('#addres_fact_street').removeAttr('required');
        $('#addres_fact_house').removeAttr('required');
        document.getElementById('ep_block_addres_fact').style.display = 'none';
    } else {
        $('#addres_fact_street').attr('required', true);
        $('#addres_fact_house').attr('required', true);
        document.getElementById('ep_block_addres_fact').style.display = 'block';
    }
}
