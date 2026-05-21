<?php

namespace App\Services;

use Google\Auth\ApplicationDefaultCredentials;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmService
{
    private const FCM_SCOPE = 'https://www.googleapis.com/auth/firebase.messaging';
    private const FCM_URL   = 'https://fcm.googleapis.com/v1/projects/{project_id}/messages:send';

    // ── Envio para tópico ────────────────────────────────────────

    public function sendToTopic(
        string $topic,
        string $title,
        string $body,
        array  $data = [],
    ): bool {
        return $this->send([
            'message' => [
                'topic'        => $topic,
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                ],
                // data só aceita string → string
                'data'    => array_map('strval', $data),
                'android' => ['priority' => 'high'],
                'apns'    => [
                    'headers' => ['apns-priority' => '10'],
                    'payload' => ['aps' => ['sound' => 'default']],
                ],
            ],
        ]);
    }

    // ── Internos ─────────────────────────────────────────────────

    private function send(array $body): bool
    {
        try {
            $projectId = config('services.fcm.project_id');
            $url       = str_replace('{project_id}', $projectId, self::FCM_URL);
            $token     = $this->accessToken();

            $response = Http::withToken($token)
                ->timeout(10)
                ->post($url, $body);

            if ($response->failed()) {
                Log::channel('broadcast')->error('[FCM] Falha no envio', [
                    'status' => $response->status(),
                    'body'   => $response->json(),
                ]);
                return false;
            }

            return true;

        } catch (\Throwable $e) {
            Log::channel('broadcast')->error('[FCM] Exceção', [
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }

    private function accessToken(): string
    {
        $credentialsPath = config('services.fcm.credentials_path');

        $credentials = new ServiceAccountCredentials(
            self::FCM_SCOPE,
            json_decode(file_get_contents($credentialsPath), true),
        );

        return $credentials->fetchAuthToken()['access_token'];
    }
}