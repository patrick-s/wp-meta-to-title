<?php

class db_view extends class_db_con {

    public function wp_post_select($db_info, $params = "*", $where = null, $meta_keys = false, $post_name = false) {
        $conn = $this->connect_db($db_info["host"], $db_info["name"], $db_info["user"], $db_info["pass"]);

        $select_statement = "SELECT " . $params . " FROM " . $db_info['prefix'] . "posts";

        if (ISSET($where) && !empty($where)) {
            $select_statement .= " WHERE " . $where;
        }

        if ($prep_sql_pone = $conn->query($select_statement)) {
            $id_list = array();

            while ($row = $prep_sql_pone->fetch()) {
                $id = $row["ID"];
                if ($meta_keys !== false) {
                    $arr_meta = explode(",", $meta_keys);

                    $id_list[$id] = array();
                    foreach ($arr_meta AS $meta_key) {
                        $meta_key = trim($meta_key);
                        $id_list[$id][$meta_key] = NULL;
                    }

                    if ($post_name === true) {
                        $id_list[$id]["wptc_old_title"] = $row["post_title"];
                    }
                } else {
                    $id_list[] = $id;
                }
            }

            return $id_list;
        } else {
            echo "Couldn't find any results.";
            return false;
        }
    }

    public function wp_post_meta($db_info, $meta_keys, $ids, $conn = false) {
        if ($conn === false) {
            $conn = $this->connect_db($db_info["host"], $db_info["name"], $db_info["user"], $db_info["pass"]);
        }


        foreach ($ids AS $id => $key) {
            $meta_setup = "";

            $arr_meta = explode(",", $meta_keys);
            foreach ($arr_meta AS $meta_key) {
                $meta_key = trim($meta_key);
                $meta_setup .= " OR meta_key = '" . $meta_key . "'";
            }

            $meta_setup = substr($meta_setup, 4);

            $select_statement = "SELECT meta_key, meta_value FROM " . $db_info["prefix"] . "postmeta WHERE (" . $meta_setup . ") AND post_id = " . $id . ";";

            $prep_sql = $conn->query($select_statement);
            if ($prep_sql) {
                while ($row = $prep_sql->fetch()) {
                    $meta_key = $row["meta_key"];

                    $ids[$id][$meta_key] = $row["meta_value"];
                }
            }
        }

        return $ids;
    }

    public function wp_new_titles($posts, $title_pattern) {
        foreach ($posts AS $key => $value) {
            $title = $title_pattern;
            foreach ($value AS $key_value => $value_value) {
                $title = str_replace("[" . $key_value . "]", $value_value, $title);
            }

            $post_new[$key] = $title;
        }
        
        return $post_new;
    }

    public function wp_update_titles($db_info, $posts, $conn = false) {
        if ($conn === false) {
            $conn = $this->connect_db($db_info["host"], $db_info["name"], $db_info["user"], $db_info["pass"]);
        }

        foreach ($posts AS $id => $key) {
            $key = addslashes($key);
            $update_query = "UPDATE " . $db_info["prefix"] . "posts SET post_title = '" . $key . "' WHERE ID = '" . $id . "'";

            $prep_sql = $conn->prepare($update_query);
            
            if ($prep_sql->execute()) {
                $setreturn[$id] = true;
            } else {
                $setreturn[$id] = false;
            }
        }

        return $setreturn;
    }

}
