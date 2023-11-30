<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /* protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'age',
        'email',
    ]; *///kung specific lang ang gusto mong ipaedit pwede mo piliin lang yung ipapaedit mo na data

    protected $guarded = [];//kung lahat naman pwede mo ipaedit pwede mo gamitin yung guarded tapos walang laman yung array niya
}
