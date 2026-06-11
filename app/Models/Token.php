<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id','token_type', 'access_token', 'expires_at'])]
class Token extends Model
{
    //
}
