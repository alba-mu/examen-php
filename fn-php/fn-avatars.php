<?php
/**
 * Returns a list of available avatar images stored inside the /avatars directory.
 *
 * This function scans the avatars/ folder, filters only valid image files
 * (currently JPEG and PNG), and returns an associative array where:
 *   - The key is the filename (e.g., "avatar1.png")
 *   - The value is the relative filepath (e.g., "avatars/avatar1.png")
 *
 * Files that are not images or are unreadable are ignored.
 *
 * @return array<string, string> Associative array in the format ['filename' => 'filepath']
 */
function listAvatars(){

    $filedir='avatars/';
    $avatars = [];
    $allowed = ['image/jpeg', 'image/png'];

    if(file_exists($filedir) && is_dir($filedir)){
        if($handle=opendir($filedir)){
            while(($entry=readdir($handle))!==false){
                if($entry!="." && $entry !=".."){
                    $filepath = $filedir . $entry;
                    
                    if(in_array(mime_content_type($filepath), $allowed)){
                        $avatars[$entry] = $filepath;
                    }
                }
            }
            closedir($handle);
        }
    }
    return $avatars;
}