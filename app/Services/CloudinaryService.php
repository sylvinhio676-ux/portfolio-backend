<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

class CloudinaryService
{
    private string $folder = 'portfolio';
    private string $cloudName;
    private string $apiKey;
    private string $apiSecret;

    public function __construct()
    {
        $cloudinaryUrl = env('CLOUDINARY_URL');

        if (!$cloudinaryUrl) {
            throw new RuntimeException('CLOUDINARY_URL environment variable is not set');
        }

        // Parse cloudinary://key:secret@cloud_name
        $parsed = parse_url($cloudinaryUrl);
        
        if (!$parsed || !isset($parsed['host'], $parsed['user'], $parsed['pass'])) {
            throw new RuntimeException('Invalid CLOUDINARY_URL format. Expected: cloudinary://api_key:api_secret@cloud_name');
        }

        $this->cloudName = $parsed['host'];
        $this->apiKey = $parsed['user'];
        $this->apiSecret = $parsed['pass'];
    }

    /**
     * Upload une image vers Cloudinary.
     *
     * @return array{url: string, public_id: string, width: int, height: int}
     */
    public function uploadImage(UploadedFile $file, string $subfolder = 'general'): array
    {
        $publicId = "{$this->folder}/{$subfolder}/" . Str::uuid();

        $result = $this->upload($file->getRealPath(), [
            'public_id'     => $publicId,
            'resource_type' => 'image',
        ]);

        return [
            'url'       => (string) $result['secure_url'],
            'public_id' => (string) $result['public_id'],
            'width'     => (int) $result['width'],
            'height'    => (int) $result['height'],
        ];
    }

    /**
     * Upload un fichier PDF (CV) vers Cloudinary.
     *
     * @return array{url: string, public_id: string}
     */
    public function uploadPdf(UploadedFile $file): array
    {
        $publicId = "{$this->folder}/documents/" . Str::uuid();

        $result = $this->upload($file->getRealPath(), [
            'public_id'     => $publicId,
            'resource_type' => 'raw',
        ]);

        return [
            'url'       => (string) $result['secure_url'],
            'public_id' => (string) $result['public_id'],
        ];
    }

    /**
     * Supprime un fichier sur Cloudinary via son public_id.
     */
    public function delete(string $publicId, string $resourceType = 'image'): bool
    {
        try {
            $timestamp = time();
            $signature = $this->generateSignature($publicId, $resourceType, $timestamp);

            $response = Http::asForm()->post(
                "https://api.cloudinary.com/v1_1/{$this->cloudName}/{$resourceType}/destroy",
                [
                    'public_id'  => $publicId,
                    'api_key'    => $this->apiKey,
                    'timestamp'  => $timestamp,
                    'signature'  => $signature,
                ]
            );

            if ($response->failed()) {
                Log::warning('Cloudinary delete failed', [
                    'public_id' => $publicId,
                    'response' => $response->body(),
                ]);
                return false;
            }

            return $response->json('result') === 'ok';
        } catch (\Exception $e) {
            Log::error('Cloudinary delete error', [
                'public_id' => $publicId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Upload multiple images en une seule opération.
     *
     * @param  UploadedFile[]  $files
     * @return array<int, array{url: string, public_id: string, width: int, height: int}>
     */
    public function uploadImages(array $files, string $subfolder = 'projects'): array
    {
        $results = [];

        foreach ($files as $file) {
            $results[] = $this->uploadImage($file, $subfolder);
        }

        return $results;
    }

    /**
     * Génère la signature Cloudinary
     */
    private function generateSignature(string $publicId, string $resourceType, int $timestamp): string
    {
        // resource_type est dans l'URL (pas un paramètre signé par Cloudinary).
        return sha1("public_id={$publicId}&timestamp={$timestamp}{$this->apiSecret}");
    }

    /**
     * Méthode interne — appel HTTP direct à l'API Cloudinary.
     * Evite toute dépendance au SDK pour contourner les problèmes de namespace.
     *
     * @param  array<string, mixed>  $options
     * @return array<string, mixed>
     * @throws RuntimeException
     */
    private function upload(string $filePath, array $options): array
    {
        $resourceType = $options['resource_type'] ?? 'image';
        $timestamp = time();

        // Construction de la signature
        $paramsToSign = collect($options)
            ->except(['resource_type', 'file'])
            ->put('timestamp', $timestamp)
            ->sortKeys()
            ->map(fn($v, $k) => "{$k}={$v}")
            ->implode('&');

        $signature = sha1($paramsToSign . $this->apiSecret);

        $response = Http::attach(
            'file',
            file_get_contents($filePath),
            basename($filePath)
        )->post(
            "https://api.cloudinary.com/v1_1/{$this->cloudName}/{$resourceType}/upload",
            array_merge($options, [
                'api_key'   => $this->apiKey,
                'timestamp' => $timestamp,
                'signature' => $signature,
            ])
        );

        if ($response->failed()) {
            Log::error('Cloudinary upload failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'options' => $options,
            ]);

            throw new RuntimeException(
                'Cloudinary upload failed: ' . $response->body()
            );
        }

        $result = $response->json();

        if (!isset($result['secure_url'], $result['public_id'])) {
            throw new RuntimeException('Cloudinary upload returned invalid response');
        }

        return $result;
    }
}