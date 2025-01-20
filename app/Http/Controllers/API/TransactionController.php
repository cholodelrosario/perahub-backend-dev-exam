<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PendingTransaction;
use App\Models\SuccessfulTransaction;
use App\Models\ApiLog;

class TransactionController extends Controller
{
    // Base URL for the external API
    private $apiUrl = 'https://privatedrp.dev.perahub.com.ph/v1/remit/dmt/';

    // Authentication token for API requests
    private $gatewayToken = 'MWhkYWoydW5kZGFubl4ldWRhczs0NDQ=';

    /**
     * Reusable method to send a POST request to the API.
     *
     * @param string $endpoint
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function postToApi(string $endpoint, array $data)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Perahub-Gateway-Token' => $this->gatewayToken,
        ])->post($this->apiUrl . $endpoint, $data);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json($response->json(), $response->status());
    }

    /**
     * Handle the "inquire" functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inquire(Request $request)
    {
        return $this->postToApi('inquire', $request->all());
    }

    /**
     * Handle the "payout/validate" functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function payoutValidate(Request $request)
    {
        return $this->postToApi('receive/validate', $request->all());
    }

    /**
     * Handle the "payout/confirm" functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function payoutConfirm(Request $request)
    {
        return $this->postToApi('receive/confirm', $request->all());
    }

    /**
     * Handle the "send/validate" functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendValidate(Request $request)
    {
        return $this->postToApi('send/validate', $request->all());
    }    

    /**
     * Handle the "send/confirm" functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendConfirm(Request $request)
    {
        return $this->postToApi('send/confirm', $request->all());
    }

    /**
     * Handle the "transactions" functionality.
     */
    public function getTransactions(Request $request)
    {
        //
    }
}