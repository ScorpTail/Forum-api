<?php

namespace App\Services\V1\ClinetSideService;

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

    private function getImageFromRequest($request): array
    {
        $keys = array_keys($request->allFiles());

        return array_filter($keys, fn ($val) => $request->has($val));
    }

    private function storeImage($image)
    {
        return asset($image->store('post'));
    }
}
