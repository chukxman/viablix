<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WatsonController extends Controller
{
    public function productAssessment(Request $request)
    {
        $product = $request->input('productType');
        $price = $request->input('price');
        $region = $request->input('region');

        $time = date("H:i:s d M Y");

        $apiKey = env('IBM_CLOUD_API_KEY');
        $tokenUrl = 'https://iam.cloud.ibm.com/identity/token';
        
        // Step 1: Get the access token from IBM Cloud
        $tokenResponse = Http::asForm()->post($tokenUrl, [
            'grant_type' => 'urn:ibm:params:oauth:grant-type:apikey',
            'apikey' => $apiKey,
        ]);

        if ($tokenResponse->failed()) {
            return response()->json(['error' => 'Failed to get access token'], 500);
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // Step 2: Call IBM Watson Text Generation API
        $ibmUrl = 'https://us-south.ml.cloud.ibm.com/ml/v1/text/generation?version=2023-05-29';

        // Define the payload for product viability assessment
        $payload = [
            'input' => "\nConduct a comprehensive product viability assessment for the following product:\n\n" .
                 "Product Type: {$product}\n" .
                 "Price: {$price}\n" .
                 "Location/Region: {$region}\n\n" .
                 "Consider the following factors in your analysis:  \n" .
                 "1. Market demand: Analyze the target market's demand for this product in the specified location/region.  \n" .
                 "2. Competitor analysis: Identify key competitors, their pricing strategies, and market share in the region.  \n" .
                 "3. Consumer purchasing power: Assess the purchasing power of the target market relative to the product's price.  \n" .
                 "4. Regulatory environment: Check for any regulatory or logistical barriers that could impact product distribution in the region.  \n" .
                 "5. Supply chain feasibility: Evaluate the supply chain infrastructure and the ease of getting the product to market.  \n" .
                 "6. Cultural and regional preferences: Consider whether local tastes, preferences, or cultural aspects could affect the product's viability.  \n" .
                 "7. Pricing strategy: Determine if the product's price is competitive or needs adjustments based on local market conditions.  \n" .
                 "8. Climate factors: Assess how the local climate and weather patterns might affect the product's performance, demand, or distribution.  \n" .
                 "9. Risk factors: Highlight any potential risks or challenges that could affect product success.  \n" .
                 "10. Recommendations: Provide strategic recommendations on how to improve product viability in this location/region.\n\n" .
                 "After generating the report, rewrite or rephrase and structure the output so that it can serve as a formal working document.",
            'parameters' => [
                'decoding_method' => 'greedy',
                'max_new_tokens' => 1000,
                'min_new_tokens' => 0,
                'stop_sequences' => [],
                'repetition_penalty' => 1,
            ],
            'model_id' => 'ibm/granite-13b-chat-v2',
            'project_id' => '696752c1-7d55-48ca-9227-6796f6533c79',
            'moderations' => [
                'hap' => [
                    'input' => [
                        'enabled' => true,
                        'threshold' => 1,
                        'mask' => [
                            'remove_entity_value' => true,
                        ],
                    ],
                    'output' => [
                        'enabled' => true,
                        'threshold' => 1,
                        'mask' => [
                            'remove_entity_value' => true,
                        ],
                    ],
                ],
            ],
        ];

        // cURL request to IBM Watson
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->timeout(60)
        ->post($ibmUrl, $payload);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to generate product viability analysis'], 500);
        }
        $data = array('product' => $product,'price' => $price,'region' => $region, 'time' => $time);

        // Return the AI-generated forecast to the user
        return view('result', ['result' => $response->json()],['data' => $data]);
    }
}
