var Appliaction = function() {
    this.init = function() {
        alert("test");
    };
    this.startService = function(serviceName) {
        alert("test2");
        var ajaxRequest = new XMLHttpRequest();

        ajaxRequest.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                alert(ajaxRequest.responseText);
            }
        };
        ajaxRequest.open("GET", window.location + "?action_name=starService&service_name=" + serviceName, true);
        ajaxRequest.send();
    };
};