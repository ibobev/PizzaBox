<?php

function preparedFileUpload()
{
    $allowed_types = array('jpg', 'jpeg', 'png');
    
    $file_name = $_FILES['img']['name'];
    $temp_file = $_FILES['img']['tmp_name'];

    $upload_dir = '\\images\\menu\\';
    $curr_dir = getcwd();
    
    $dir_path = $curr_dir . $upload_dir . $file_name;
    
    if(file_exists($dir_path)){
        $flag = '-1';
        return $flag;
    }
    

    $file_type = strtolower(pathinfo($dir_path, PATHINFO_EXTENSION));

    if(in_array($file_type, $allowed_types)){
        if(move_uploaded_file($temp_file, $dir_path)){
            return $file_name;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function deleteFile($file_name)
{
    $dir = getcwd();
    $path = '\\images\\menu\\';
    $file = $dir . $path .$file_name;
    //echo $file_name;
    if(!unlink($file)){
        return false;
    }else{
        return true;
    }
}
