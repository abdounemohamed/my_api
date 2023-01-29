<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Products;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    public function __invoke(): array
    {
        return [
            'success' => true,
            'message' => "Welcome to my Api",
            'data' => [
                'version' => '1.0',
                'language' => app()->getLocale(),
            ]
        ];
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        $request->validate(["key" => "required", "value" => "required", "timestamp" => "required"]);

        $object = new Products();
        $object->key = $request->get('key');
        $object->value = $request->get('value');
        $object->created_at = $request->get('timestamp');
        $object->save();

        return new JsonResponse(['message' => 'key created with success'], 201);
    }

    /**
     * @param string $key
     * @param $timestamp
     * @return JsonResponse
     */
    public function get(string $key, $timestamp = null): JsonResponse
    {
        if ($timestamp !== null){
            $lastValue = Products::where('key', $key)->where('created_at', (new \DateTime)->setTimestamp($timestamp))->get();
        }else{
            $lastValue = Products::where('key', $key)->orderBy('created_at', 'DESC')->first();
        }

       if ($lastValue){
           return new JsonResponse($lastValue, 200);
       }

       return new JsonResponse(['message' => 'Unable to find this item'], 404);
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $data = Products::all();

        return new JsonResponse($data, 200);
    }
}
