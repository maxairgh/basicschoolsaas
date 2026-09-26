<?php

namespace App\Models;

use App\enums\Panel;
use Spatie\Permission\Models\Role as spatieRole;

class Role extends spatieRole
{
   protected $fillable = [
    'name',
    'panel',
    'guard_name',
   ];

   protected $cast = [
    'panel' => Panel::class
   ];
}
