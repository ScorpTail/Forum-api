<?php

namespace App\Services\V1\ClinetSideService;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClientSideService
{
    public function validationData($request)
    {
        $validatedData = $request->validated();

        $images = $this->getImageFromRequest($request);

        $storeImage = array_map(fn ($image) => [$image => $this->storeImage($request->file($image))], $images);

        $validatedData = array_merge($validatedData, ...$storeImage);

        return $validatedData;
    }

    public function getImage($fileName): array
    {
        if (!Storage::exists("images/$fileName")) {
            return response()->json(['error' => 'Image not found'], Response::HTTP_NOT_FOUND);
        }

        $file = Storage::get("images/$fileName");

        $type = Storage::mimeType("images/$fileName");

        return [$file, $type];
    }

    private function getImageFromRequest($request): array
    {
        $keys = array_keys($request->allFiles());

        return array_filter($keys, fn ($val) => $request->has($val));
    }

    private function storeImage($image)
    {
        return explode('/', $image->store('images'))[1];
    }
}
