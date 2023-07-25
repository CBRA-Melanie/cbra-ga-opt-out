const gaProperty = data.property;
const disableStr = 'ga-disable-' + gaProperty;

if (document.cookie.indexOf(disableStr + '=true') > -1) {
    window[disableStr] = true;
}
    
function gaOptout() {
    document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
    window[disableStr] = true;
}

const link = document.getElementById('cb-ga-opt-out');

link.addEventListener("click", (e) => {
    e.preventDefault();
    alert(data.alert);
    gaOptout();
});