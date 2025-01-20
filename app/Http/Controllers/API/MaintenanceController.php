<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MaintenanceController extends Controller
{
    // Base URL for the external API
    private $apiUrl = 'https://privatedrp.dev.perahub.com.ph/v1/remit/dmt/';

    // Authentication token for API requests
    private $gatewayToken = 'MWhkYWoydW5kZGFubl4ldWRhczs0NDQ=';

    /**
     * Reusable method to send a GET request to the API.
     *
     * @param string $endpoint
     * @return \Illuminate\Http\JsonResponse
     */
    private function fetchFromApi(string $endpoint)
    {
        // Make a GET request to the specified API endpoint with headers
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Perahub-Gateway-Token' => $this->gatewayToken,
        ])->get($this->apiUrl . $endpoint);

        // If the response is successful, return the JSON data
        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        // If the response fails, return an error message with the HTTP status code
        return response()->json(['error' => 'Failed to fetch data from ' . $endpoint], $response->status());
    }

    /**
     * Get a list of available partners.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPartners(Request $request)
    {
        return $this->fetchFromApi('partner');
    }

    /**
     * Get a list of purposes for transactions.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPurpose(Request $request)
    {
        return $this->fetchFromApi('purpose');
    }

    /**
     * Get a list of occupations.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOccupations(Request $request)
    {
        return $this->fetchFromApi('occupation');
    }

    /**
     * Get a list of employment types.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployment(Request $request)
    {
        return $this->fetchFromApi('employment');
    }

    /**
     * Get a list of sources of funds.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSourceOfFund(Request $request)
    {
        return $this->fetchFromApi('sourcefund');
    }

    /**
     * Get a list of relationships for transaction purposes.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRelationship(Request $request)
    {
        return $this->fetchFromApi('relationship');
    }
}