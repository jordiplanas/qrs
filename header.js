document.addEventListener('DOMContentLoaded', function(){ 
    //Get data for header, points and username from cookies
    var userPoints = getCookieValue("points");
    var userName = getCookieValue("name");
    document.getElementById("user-name").innerHTML = userName;
    document.getElementById("user-points").innerHTML = userPoints + " pts";

    function getCookieValue(a) {
        var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
        return b ? b.pop() : '';
    }
}, false);