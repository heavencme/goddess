function loadScript(url, callback) {
    var script = document.createElement("script");
    script.type = "text/javascript";
    
    //IE
    if (script.readyState) {
        script.onreadystatechange = function () {
            if (script.readyState == "loaded" || script.readyState == "complete") {
                script.onreadystatechange = null;
                callback();
            }
        }
    }
    else {
        //not IE
        script.onload = function () {
            callback();
        }
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}
    
loadScript("js/jquery.js", function () {
    loadScript("js/obj.js", function () {
        loadScript("js/zi.js", function () {
        });
    });
});