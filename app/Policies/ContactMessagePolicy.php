<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContactMessage;

class ContactMessagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin, editor, and staff can view inquiries
        return in_array($user->role, ['admin', 'editor', 'staff']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactMessage $contactMessage): bool
    {
        return in_array($user->role, ['admin', 'editor', 'staff']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Public forms create these, they shouldn't be created inside the admin panel
        return false;
    }

    /**
     * Determine whether the user can update the model (e.g. mark as read).
     */
    public function update(User $user, ContactMessage $contactMessage): bool
    {
        return in_array($user->role, ['admin', 'editor', 'staff']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can bulk delete models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }
}
