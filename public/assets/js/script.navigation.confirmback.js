history.pushState(null,null,window.top.location.pathname + window.top.location.search);
window.addEventListener('popstate',(e)=>{
    e.preventDefault();
    var r = confirm('Yakin anda ingin pergi ?');
    if(r) history.back();
    history.pushState(null, null, window.location.pathname);
},false);
