<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\DB;

class Banned implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userlevel = DB::table('users')
        ->select('userlevel')
        ->where('name', $value)
        ->get();
        if(isset($userlevel[0]->userlevel) && $userlevel[0]->userlevel == 0){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are banned!';
    }
}
