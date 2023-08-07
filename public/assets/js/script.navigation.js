
// Confirm Back Button
function updateHistory(curr){
    window.location.lastHash.push(window.location.hash);
    window.location.hash = curr;
}

function goBack(){
    window.location.hash = window.location.lasthash[window.location.lasthash.length-1];
    window.location.lasthash.pop();
}



