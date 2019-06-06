<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthComponent;

class Auth implements AuthComponent
{  
    public function generateToken()
	{
        $first = sha1(str_random(64));
        $second = sha1(str_random(64));
		return "{$first}.{$second}";
	}
}