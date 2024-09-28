<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $profiles = CustomerProfile::with('customer')->get();

        return view('profiles.index', [
            'profiles' => $profiles
        ]);
    }

    public function show($id)
    {
        $profile = CustomerProfile::with('customer')->findOrFail($id);

        return view('profiles.show', [
            'profile' => $profile
        ]);
    }
}
