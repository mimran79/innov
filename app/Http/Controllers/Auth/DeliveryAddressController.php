<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryAddressController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->postal_code = $request->input('postal_code');
        $user->save();

        return redirect()->back()->with('status', 'Delivery address updated successfully.');
    }
}
