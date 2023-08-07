function confirmSwitchPage(url, message='Yakin anda ingin pergi?'){
    var r = confirm(message);
    if(r) window.location.href=url;
}

function toggleAjaxStatus(){
    if(ajax_status) ajax_status = false;
    else            ajax_status = true;
}

function displayError(){

}




