<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    try {
        $client = new Client();
        $api_key = env('API_KEY');
        $response = $client->get('http://localhost:5000/api/v1/todo', [
            'headers' => [
                'Authorization' => $api_key,
                'Accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Process the $data array as needed
        // For example, you might return it or use it in your application logic
        return response()->json($data);

    } catch (RequestException $e) {
        // Handle exceptions, log errors, or return appropriate responses
        // For example:
        $statusCode = $e->getResponse()->getStatusCode();
        $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Unknown error';

        return response()->json(['error' => $errorMessage], $statusCode);
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = 'i am cretae';
        return response()->json(['messagte'=>$message]);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
