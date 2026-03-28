<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class GeminiClient
{
    protected ?string $apiKey;
    protected ?string $model;
    protected Client $httpClient;

    public function __construct(?string $apiKey = null, ?string $model = null)
    {
        $this->apiKey = $apiKey ?: env('GEMINI_API_KEY') ?: config('services.gemini_ai.project_id');
        $this->model = $model ?: env('GEMINI_MODEL', 'gemini-1.5-flash');
        $this->httpClient = new Client(['timeout' => 30]);
    }

    /**
     * Generate text using Google's Generative Language API (Gemini).
     * Returns the raw text output (candidate) from the API.
     *
     * @throws Exception on HTTP or parse errors
     */
    public function generateText(string $prompt): string
    {
        if (empty($this->apiKey)) {
            throw new Exception('GEMINI_API_KEY / project id is not configured.');
        }

        $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/' . $this->model . ':generateContent?key=' . urlencode($this->apiKey);
        // Build body per documentation
        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
        ];

        try {
            // Log request attempt (preview only)
            try {
                Log::info('GeminiClient request', ['endpoint' => $endpoint, 'model' => $this->model, 'body_preview' => substr(json_encode($data), 0, 1000)]);
            } catch (\Throwable $e) {
                // ignore logging errors
            }

            $response = $this->httpClient->post($endpoint, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $result = json_decode((string) $response->getBody(), true);

            if (isset($result['candidates']) && is_array($result['candidates']) && ! empty($result['candidates'])) {
                foreach ($result['candidates'] as $candidate) {
                    if (isset($candidate['content']['parts']) && is_array($candidate['content']['parts']) && ! empty($candidate['content']['parts'])) {
                        foreach ($candidate['content']['parts'] as $part) {
                            if (isset($part['text'])) {
                                return $part['text'];
                            }
                        }
                    }
                }
            }

            Log::warning('GeminiClient: no response text found', ['response' => $result]);
            throw new Exception('No response text found in Gemini response');

        } catch (Exception $e) {
            Log::error('GeminiClient error', ['error' => $e->getMessage()]);
            throw new Exception('Error communicating with Gemini API: ' . $e->getMessage());
        }
    }
}
