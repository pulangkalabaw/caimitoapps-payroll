<?php
namespace App\Traits;

// models
use App\UserDetails;

/*
*
* This trait handles the UserDetails of employee
*
*/

trait UserDetailsTrait
{
    // shows the Employees Details
    public function userDetails($user_id) {
        // Instance
        $user_details = new UserDetails();

        $data = $user_details->where('user_id', $user_id)->first(['date_hired']);

        return $data;
    }
}
