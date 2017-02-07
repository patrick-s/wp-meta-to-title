<?php


class general {
    public function find_wpconfig($sub_search = 5) {
        $dir = "../";
        $found = false;
        $count = 0;

        while ($found === false && $count < $sub_search) {
            $dir_arr = scandir($dir);
            foreach ($dir_arr as $files) {
                if ($files == "wp-config.php") {
                    return $dir;
                }
            }

            $dir .= "../";
            $count++;
        }

        return false;
    }

}
