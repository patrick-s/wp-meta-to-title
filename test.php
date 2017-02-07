<?php

function find_wpconfig() {
    $dir = "../";
    $found = false;
    $count = 0;

    while ($found === false && $count < 5) {
        $dir_arr = scandir($dir);
        foreach ($dir_arr as $files) {
            if ($files == "wp_config.php") {
                return $dir;
            }
        }

        $dir .= "../";
        $count++;
    }

    return false;
}

$dir = find_wpconfig();

if($dir !== false){
    echo $dir;
}else{
    echo "Couldn't find the directory within 5 sub folders.";
}
