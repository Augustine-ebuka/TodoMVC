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
        $root_url = env('ROOT_URL');
        $response = $client->get($root_url, [
            'headers' => [
                'Authorization' => $api_key,
                'Accept' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return response()->json($data);

    } catch (RequestException $e) {
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
        try {
            $todo = $request->input('todo');
            $client = new Client();
            $api_key = env('API_KEY');
            $root_url = env('ROOT_URL');
            $response = $client->post($root_url, [
                'headers' => [
                    'Authorization' => $api_key,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'todo' => $todo,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            
            return response()->json(['message' => 'Successful creation of todo!', 'data' => $data]);
    
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Unknown error';
    
            return response()->json(['error' => $errorMessage], $statusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $client = new Client();
            $api_key = env('API_KEY');
            $root_url = env('ROOT_URL');
            $endpointUrl = $root_url . '/' . $id;
            $response = $client->get($endpointUrl, [
                'headers' => [
                    'Authorization' => $api_key,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return response()->json(['message' => 'Successful get of single todo!', 'data' => $data]);
    
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Unknown error';
    
            return response()->json(['error' => $errorMessage], $statusCode);
        }
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
        try {
            $todo = $request->input('todo');
            $completed = $request->input('completed');
            $client = new Client();
            $api_key = env('API_KEY');
            $root_url = env('ROOT_URL');
            $endpointUrl = $root_url . '/' . $id;
            $response = $client->patch($endpointUrl, [
                'headers' => [
                    'Authorization' => $api_key,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'todo' => $todo,
                    'completed' => $completed,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return response()->json(['message' => 'Successful update of todo!', 'data' => $data]);
    
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Unknown error';
    
            return response()->json(['error' => $errorMessage], $statusCode);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = new Client();
            $api_key = env('API_KEY');
            $root_url = env('ROOT_URL');
            $endpointUrl = $root_url . '/' . $id;
            $response = $client->delete($endpointUrl, [
                'headers' => [
                    'Authorization' => $api_key,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return response()->json(['message' => 'Successful delete of single todo!', 'data' => $data]);
    
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Unknown error';
    
            return response()->json(['error' => $errorMessage], $statusCode);
        }
    }
}
