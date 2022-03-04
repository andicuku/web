

$("#year").text(new Date().getFullYear());

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}