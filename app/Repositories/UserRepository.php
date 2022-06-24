<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @return Collection<User>|User[]
     */
    public function findAll(): Collection
    {
        return User::query()
            ->get();
    }
}
