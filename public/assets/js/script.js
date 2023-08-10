// ==================================================================
// ------------------------- LOADING SCRIPT -----------------------------
// ==================================================================
const NOTIFICATION = {
  WRAPPER   : $('#notification-wrapper'), 
  CONTAINER : $('#notification-container'),
}

// ==================================================================
// ------------------------- CSRF TOKEN -----------------------------
// ==================================================================
let csrf = $('meta[name="csrf-token"]');
let ajax_status = false;

function getTokenCSRF(){
    $.ajax({
        url:'/refresh-csrf',
        method:'post',
        headers:{
            'X-CSRF-TOKEN':csrf.attr('content'),
        },
    }).then((d)=>{
            csrf.attr('content',d);
        });
}
function testTokenCSRF(){
    $.ajax({
        url:'/refresh-csrf',
        method:'post',
        headers:{
            'X-CSRF-TOKEN':csrf.attr('content'),
        },
    }).then((d)=>{
            console.log('Token Is Valid');
        });
}

window.setInterval(()=>{
    getTokenCSRF();
    testTokenCSRF();
}, 1000*60*60*120);


$('.prevent-multiple-submit').on('submit',(e)=>{
    var target = e.target;
    var submit = target.querySelector('input[type="submit"]');
    submit.disabled = true;
})

