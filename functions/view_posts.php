<?php
$scriptdebug = $_POST["debugmode"];
REQUIRE("inc.php");

if(ISSET($_POST["submitted"]) && !empty($_POST["submitted"]) && $_POST["submitted"] == "true"){
    $db_info["host"] = filter_input(INPUT_POST, "host", FILTER_SANITIZE_STRING);
    $db_info["name"] = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $db_info["user"] = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
    $db_info["pass"] = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
    $db_info["prefix"] = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_STRING);
    $meta_keys = filter_input(INPUT_POST, "meta", FILTER_SANITIZE_STRING);
    $post_type = filter_input(INPUT_POST, "post_type", FILTER_SANITIZE_STRING);
    
    $view = new db_view;
    $params = "ID, post_title";
    $where = "(post_type LIKE '" . $post_type . "' AND post_status LIKE 'publish')";
    $ids = $view->wp_post_select($db_info, $params, $where, $meta_keys, true);
    
    echo("<h3>Post that should be changed</h3>");
    echo("<table style='width:100%;' class='table table-condensed'> <tr><td>Post ID</td><td>Post Updated</td></tr>");
    foreach($ids AS $id => $name){
        echo("<tr><td>" . $id . "</td><td>" . $ids[$id]["wptc_old_title"] . "</td></tr>");
    }
    echo("</table>");
}