<?php
/**
 * update user info
 * @param string $username
 * @param string $password
 * @param string $role
 * @param string $name
 * @param string $surname
 * @return bool true if successfully inserted, false otherwise
 */
function updateUser(
        string $username, 
        string $password,
        string $role,
        string $visits): bool {
    $filename = "files/users.txt";
    $delimiter = ";";
    $result = false;
    //ckeck if username exists
    $usrdata = searchUser($username);
    if (\count($usrdata) != 0) {
        //update user
       if (\file_exists($filename) && \is_writable($filename)) {
           $handle_write = \fopen($filename, 'w');  //returns false on error.
           if ($handle_write) {
            $rows = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $newRows = [];
            foreach ($rows as $row) {
                //Separar les línes en camps
                list($username, $password, $role, $visits) = explode($delimiter, $row);
                
                if($usrdata == $row) {
                    $newPassword = $password;
                    $visits++;
                }
                
                $newRows[] = implode($deliminet, [$userdata, $newPassword ?? $password, $role, $visits]);
                
            }
               //Escriure de nou el fitxer
                file_put_contents($filename, implode(PHP_EOL, $newRows));
                $result = true;
           }
        }
        fclose($handle_write);     
    } 

    return $result;
}