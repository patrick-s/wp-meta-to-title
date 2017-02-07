function view_posts(debugmode){
    var host = document.getElementById("db_host").value;
    var name = document.getElementById("db_name").value;
    var user = document.getElementById("db_user").value;
    var pass = document.getElementById("db_password").value;
    var prefix = document.getElementById("db_prefix").value;
    var meta = document.getElementById("meta_keys").value;
    var post_type = document.getElementById("post_type").value;
    var submitted = true;
    document.getElementById("outputresults").innerHTML = "Loading Posts... Please Wait... Please Wait... Please Wait...";
    $("#outputresults").load("./functions/view_posts.php", {debugmode: debugmode, submitted: submitted, host: host, name: name, user: user, pass: pass, prefix: prefix, meta: meta, post_type: post_type});
}

function test_run(debugmode){
    var host = document.getElementById("db_host").value;
    var name = document.getElementById("db_name").value;
    var user = document.getElementById("db_user").value;
    var pass = document.getElementById("db_password").value;
    var prefix = document.getElementById("db_prefix").value;
    var meta = document.getElementById("meta_keys").value;
    var post_type = document.getElementById("post_type").value;
    var title = document.getElementById("title").value;
    var submitted = true;
    document.getElementById("outputresults").innerHTML = "Loading Test Run... Please Wait... Please Wait... Please Wait...";
    $("#outputresults").load("./functions/test_run.php", {debugmode: debugmode, submitted: submitted, host: host, name: name, user: user, pass: pass, prefix: prefix, meta: meta, post_type: post_type, title: title});
}

function full_run(debugmode){
    var host = document.getElementById("db_host").value;
    var name = document.getElementById("db_name").value;
    var user = document.getElementById("db_user").value;
    var pass = document.getElementById("db_password").value;
    var prefix = document.getElementById("db_prefix").value;
    var meta = document.getElementById("meta_keys").value;
    var post_type = document.getElementById("post_type").value;
    var title = document.getElementById("title").value;
    var submitted = true;
    document.getElementById("outputresults").innerHTML = "Loading Run... Please Wait... Please Wait... Please Wait...";
    $("#outputresults").load("./functions/run.php", {debugmode: debugmode, submitted: submitted, host: host, name: name, user: user, pass: pass, prefix: prefix, meta: meta, post_type: post_type, title: title});
}