<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        // валидация api
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // такая же логика создание ссылки как и вебконтроллере
        do {
            $short_code = Str::random(6);
        } while (Link::where('short_code', $short_code)->exists());

        $link = Link::create([
            'original_url' => $request->original_url,
            'short_code' => $short_code,
        ]);

        // возвращаем JSON
        return response()->json([
            'success' => true,
            'data' => [
                'original_url' => $link->original_url,
                'short_code'   => $link->short_code,
                'short_url'    => url($link->short_code),
            ]
        ], 201);
    }
}
