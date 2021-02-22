<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptionController extends Controller
{
    public function encrypt($key)
    {
        return Crypt::encryptString($key);
    }

    public function decrypt($key)
    {
        return Crypt::decryptString($key);
    }
}
