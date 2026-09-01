<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Backup;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackupPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return true;
    }

    public function view(AuthUser $authUser, Backup $backup): bool
    {
        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return true;
    }

    public function update(AuthUser $authUser, Backup $backup): bool
    {
        return true;
    }

    public function delete(AuthUser $authUser, Backup $backup): bool
    {
        return true;
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return true;
    }

    public function restore(AuthUser $authUser, Backup $backup): bool
    {
        return true;
    }

    public function forceDelete(AuthUser $authUser, Backup $backup): bool
    {
        return true;
    }
}
