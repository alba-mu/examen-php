<?php
/**
 * update user info
 * @param string $username
 * @param string $password
 * @param string $role
 * @param string $visits
 * @return bool true if successfully updated, false otherwise
 */
function updateUser(
    string $username, 
    string $password,
    string $role,
    int $visits
): bool {
    $filename = "files/users.txt";
    $delimiter = ";";
    $result = false;

    if (!file_exists($filename) || !is_writable($filename)) return false;

    $rows = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $newRows = [];

    foreach ($rows as $row) {
        $fields = explode($delimiter, $row);

        if ($fields[0] === $username) {
            $fields[1] = $password;
            $fields[2] = $role;
            $fields[3] = $visits;
        }

        $newRows[] = implode($delimiter, $fields);
    }

    if (file_put_contents($filename, implode(PHP_EOL, $newRows) . PHP_EOL) !== false) {
        $result = true;
    }

    return $result;
}
