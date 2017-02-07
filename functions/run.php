<?php

$scriptdebug = $_POST["debugmode"];
REQUIRE("inc.php");

if (ISSET($_POST["submitted"]) && !empty($_POST["submitted"]) && $_POST["submitted"] == "true") {
    $db_info["host"] = filter_input(INPUT_POST, "host", FILTER_SANITIZE_STRING);
    $db_info["name"] = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $db_info["user"] = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
    $db_info["pass"] = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
    $db_info["prefix"] = filter_input(INPUT_POST, "prefix", FILTER_SANITIZE_STRING);
    $db_info["title"] = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $meta_keys = filter_input(INPUT_POST, "meta", FILTER_SANITIZE_STRING);
    $post_type = filter_input(INPUT_POST, "post_type", FILTER_SANITIZE_STRING);

    $view = new db_view;
    $params = "ID";
    $where = "(post_type LIKE '" . $post_type . "' AND post_status LIKE 'publish')";
    $ids = $view->wp_post_select($db_info, $params, $where, $meta_keys);
    $post_meta = $view->wp_post_meta($db_info, $meta_keys, $ids);
    $post_titles = $view->wp_new_titles($post_meta, $db_info["title"]);
    $post_updated = $view->wp_update_titles($db_info, $post_titles);

    echo("<h3>Post Title Change Status</h3>");
    echo("<table style='width:100%;' class='table table-condensed'> <tr><td>Post ID</td><td>Post Updated</td></tr>");
    foreach($post_updated as $id => $status){
        echo("<tr><td>" . $id . "</td>");
        if($status === true){
            echo("<td style='color:green;'>Completed</td>");
        }else{
            echo("<td style='color:red;'>There was an error.</td>");
        }
        echo("</tr>");
    }
    echo("</table>");
}