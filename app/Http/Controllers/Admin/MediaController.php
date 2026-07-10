<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CloudinaryService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function __construct(
        private readonly CloudinaryService $cloudinaryService
    ) {}

    /**
     * Upload un fichier vers Cloudinary
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:5120', // 5MB max
            'folder' => 'nullable|string|max:100',
            'type' => 'nullable|in:image,raw',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        try {
            $file = $request->file('file');
            $folder = $request->input('folder', 'general');
            $type = $request->input('type', 'image');

            if ($type === 'raw') {
                $result = $this->cloudinaryService->uploadPdf($file);
            } else {
                $result = $this->cloudinaryService->uploadImage($file, $folder);
            }

            return ApiResponse::success($result, 'Fichier uploadé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de l\'upload du fichier',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un fichier de Cloudinary
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'public_id' => 'required|string',
            'resource_type' => 'nullable|in:image,raw',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        try {
            $publicId = $request->input('public_id');
            $resourceType = $request->input('resource_type', 'image');

            $result = $this->cloudinaryService->delete($publicId, $resourceType);

            if ($result) {
                return ApiResponse::message('Fichier supprimé avec succès');
            }

            return ApiResponse::error('Erreur lors de la suppression du fichier', null, 400);
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du fichier',
                $e->getMessage()
            );
        }
    }
}