<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());

        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return response()->json($client, 200);
    }

    public function destroy(Client $client)
    {
        return response()->json($client->delete(), 204);
    }
}
