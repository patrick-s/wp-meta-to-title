<?php
require("functions/inc.php");
$general = new general;
$wp_config = $general->find_wpconfig();

if($wp_config !== false){
    require($wp_config . "wp-config.php");
    $noconfig = false;
}else{
    $noconfig = true;
}


// When gone, decomment this piece of code.
//$noconfig = true;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico?v=1.1" type="image/x-icon">

        <title>Fix Yo Data - WP Meta to Post Title Bot</title>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
        <script src="bootstrap/bootstrap.min.js"></script>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="assets/style.css?v=1">
        <script src="assets/script.js?v=stopcacheingthiswebsitethanks"></script>

    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 header">
                    Fix Yo Data
                </div>

                <div class="col-sm-9 tagline">
                    Wordpress Post Meta to Post Title Converter. <a href='?debugmode=1' style='color:#c3312d;'>DEBUG MODE</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Database Information</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline">
                        <div class="form-group form-group-custom">
                            <label for="db_host">Host</label><br/>
                            <input type="text" class="form-control" id="db_host" name="db_host" placeholder="localhost" value="<?php if(!$noconfig){ echo DB_HOST; } ?>">
                        </div>
                        <div class="form-group form-group-custom">
                            <label for="db_name">Name</label><br/>
                            <input type="text" class="form-control" id="db_name" name="db_name" placeholder="wp_database" value="<?php if(!$noconfig){ echo DB_NAME; } ?>">
                        </div>
                        <div class="form-group form-group-custom">
                            <label for="db_user">User</label><br/>
                            <input type="text" class="form-control" id="db_user" name="db_user" placeholder="wp_user" value="<?php if(!$noconfig){ echo DB_USER; } ?>">
                        </div>
                        <div class="form-group form-group-custom">
                            <label for="db_password">Password</label><Br/>
                            <input type="text" class="form-control" id="db_password" name="db_password" placeholder="wp_userpass" value="<?php if(!$noconfig){ echo DB_PASSWORD; } ?>">
                        </div>
                        
                        <div class="form-group form-group-custom">
                            <label for="db_password">Table Prefix</label><Br/>
                            <input type="text" class="form-control" id="db_prefix" name="db_prefix" placeholder="wp_" value="<?php if(!$noconfig){ echo $table_prefix; } ?>">
                        </div>
                    </form>
                </div>
            </div>

            <div class="row alt-row">
                <div class="col-sm-12">
                    <h2>Meta Key Titles</h2>
                    <p>Separate with comma.</p>
                </div>
            </div>

            <div class="row alt-row">
                <div class="col-sm-12">
                    <div class="row" id="meta-1-row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control verticle-margin" id="meta_keys" name="meta_keys" placeholder="meta_key">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Post Type</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control verticle-margin" id="post_type" name="post_type" placeholder="Post Type">
                </div>
            </div>
            
            <div class="row alt-row">
                <div class="col-sm-12">
                    <h2>Title Pattern</h2>
                </div>
            </div>

            <div class="row alt-row">
                <div class="col-sm-12">
                    <input type="text" class="form-control verticle-margin" id="title" name="title" placeholder="First: [meta_key] - Last: [meta_key]">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <h2>Actions</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button id="remove_metakey" class="btn btn-primary verticle-margin" onclick="view_posts(<?php echo $debugmode ?>);">View Posts</button>
                    <button id="remove_metakey" class="btn btn-warning verticle-margin" onclick="test_run(<?php echo $debugmode ?>);">Test Run</button>
                    <button id="remove_metakey" class="btn btn-danger verticle-margin" onclick="full_run(<?php echo $debugmode ?>);">Run</button>
                </div>
            </div>
            
            <div class="row alt-row">
                <div class="col-sm-12">
                    <h2>Output</h2>
                </div>
            </div>

            <div class="row alt-row">
                <div class="col-sm-12" id="outputresults">
                    
                </div>
            </div>
        </div>
    </body>
</html>