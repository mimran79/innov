<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $client = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->get();
        return view('admin.clients.view', compact('client', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteClient(string $id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
    //View All Deleted Clients
    public function deletedClients()
    {
        $deletedClients = User::onlyTrashed()->where('role', 'client')->get();
        return view('admin.clients.deleted', compact('deletedClients'));
    }
    public function restoreClient($id)
    {
        $client = User::onlyTrashed()->findOrFail($id);
        $client->restore();
        return redirect()->route('admin.clients.deleted')->with('success', 'Client restored successfully.');
    }
}
