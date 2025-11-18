<?php
/**
 * Checks permission to access a page based on user role
 * @param string $role the role of the user ('basic', 'advanced', etc.)
 * @param string $page the page being accessed (e.g., 'home', 'profile', 'avatarManagement', etc.)
 * @return bool true if access is granted, false otherwise
 */
function isGranted(string $role, string $page): bool {
    // Define permissions per page
    $permissions = [
        'home' => ['basic, advanced, guest'],   // Everyone can access
        'profile' => ['basci, advanced'],       // Registered users can access
        'avatarManagement'    => ['advanced'],  // Advanced users can access
    ];

    // Determine effective role for not logged-in users
    if ($role === '') {
        $role = 'guest';
    }

    // Grant access if page exists in permissions and role is allowed
    if (isset($permissions[$page]) && in_array($role, $permissions[$page])) {
        return true;
    }

    return false;
}
?>
