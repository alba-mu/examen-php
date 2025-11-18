<?php
/** 

 * File: fn-users.php
 *
 * Description:
 * This file contains functions to manage user persistence in the system.
 * It provides functions to search for a user by username and to insert a new user,
 * ensuring that usernames are unique.
 */

/**
 * searches username in file
 * @param string $username the username to search
 * @return array with all data of that user or empty array if not found
 */
function searchUser(string $username): array {
    $filename = "files/users.txt";
    $delimiter = ";";
    $result = [];
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            while (!\feof($handle)) {
                fscanf($handle, "%s\n", $line);
                if ($line) {
                    $fields = \explode($delimiter, $line);
                    if (($fields[0]===$username)) {
                        $result = $fields;
                        break;
                    }
                }
            }
            \fclose($handle);            
        }
    }  
    return $result;
}

/**
 * inserts a new user in file, preventing duplicates
 * (username must be unique)
 * @param string $username
 * @param string $password
 * @param string $role
 * @param string $name
 * @param string $surname
 * @return bool true if successfully inserted, false otherwise
 */
function insertUser(
        string $username, 
        string $password,
        string $role,
        string $visits): bool {
    $filename = "files/users.txt";
    $delimiter = ";";
    $result = false;
    //ckeck if username already exists
    $usrdata = searchUser($username);
    if (\count($usrdata) == 0) {
        //write new user to file
       if (\file_exists($filename) && \is_writable($filename)) {
           $handle = \fopen($filename, 'a');  //returns false on error.
           if ($handle) {
               fprintf($handle, 
                       "%s%s%s%s%s%s%s%s%s\n", 
                       $username,$delimiter, 
                       $password, $delimiter,
                       $role, $delimiter,
                       $visits);
               $result = true;
               \fclose($handle);   
           }
       }       
    } 

    return $result;
}