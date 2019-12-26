<?php
$hash = password_hash('AlexTsm12345', PASSWORD_DEFAULT);
echo $hash;
echo "\n";

if (password_verify('AlexTsm12345', $hash)) {
    echo "true\n";
} else {
    echo "false\n";
}
echo 'ok';

$hash = password_hash('1234', PASSWORD_DEFAULT);
echo $hash;
//echo 'user1@example.com';
if (password_verify('1234', $hash)) {
    echo "\ntrue\n";
} else {
    echo "\nfalse\n";
}
// http://localhost:9091/change_user?user_id=2

 function remove_dirs()
{
    $dir_log = 'parser/logdir_anb_' . 6;
    $temp_log = 'parser/logdir_anb_' . 6;
    if (file_exists($dir_log)) {
        recursive_remove_dir($dir_log);
    }
    if (file_exists($temp_log)) {
        recursive_remove_dir($temp_log);
    }
}

 function recursive_remove_dir($dir)
{
    $includes = glob($dir . '/*');
    foreach ($includes as $include) {
        if (is_dir($include)) {
            recursive_remove_dir($include);
        } else {
            unlink($include);
        }
    }
    rmdir($dir);
}

remove_dirs();
echo getcwd();

