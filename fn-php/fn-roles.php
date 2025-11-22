<?php
/** 
 * File: fn-roles.php
 * Author: Alba Muñoz
 *
 * Description:
 * This file contains functions to manage permissions to access application pages.
 */

/**
 * Checks permission to access a page based on user role
 * @param string $role the role of the user ('basic', 'advanced', etc.)
 * @param string $page the page being accessed (e.g., 'home', 'profile', 'avatarManagement', etc.)
 * @return bool true if access is granted, false otherwise
 */
function isGranted(string $role, string $page): bool
{
    $permissions = [
        'home' => ['basic', 'advanced', 'guest'],
        'profile' => ['basic', 'advanced'],
        'avatarManagement' => ['advanced'],
    ];

    if ($role === '') {
        $role = 'guest';
    }

    return isset($permissions[$page]) && in_array($role, $permissions[$page]);
}

