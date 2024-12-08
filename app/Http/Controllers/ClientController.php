<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        activity("Read", "Clients read.");

        return response()->json(Client::all()->load("orders", "orders.product", "orders.client"));
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());

        activity("Create", "Client :name created.", [
            ":name" => $client->name
        ]);

        return response()->json($client->load("orders", "orders.product"));
    }

    public function show(Client $client)
    {
        activity("Read", "Client :name read.", [
            ":name" => $client->name
        ]);

        return response()->json($client->load("orders", "orders.product"));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        activity("Update", "Client :name updated.", [
            ":name" => $client->name
        ]);

        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        activity("Delete", "Client :name deleted.", [
            ":name" => $client->name
        ]);

        return response()->json($client->delete());
    }
}
