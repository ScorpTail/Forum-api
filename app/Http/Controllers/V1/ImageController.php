<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ClinetSideService\ClientSideService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function __construct(private ClientSideService $service)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke($fileName)
    {
        [$file, $type] = $this->service->getImage($fileName);

        return response($file, Response::HTTP_OK)
            ->header('Content-Type', $type);
    }
}
