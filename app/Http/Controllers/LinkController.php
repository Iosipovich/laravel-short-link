<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Services\LinkService;

class LinkController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'original_url' => 'required|url' 
        ]);

        do {
            $short_code = Str::random(6);
        } while (Link::where('short_code', $short_code)->exists());


        $link = Link::create([
            'original_url' => $request->original_url,
            'short_code' => $short_code,
        ]);

        $shortened_link = url($link->short_code);

        return redirect()->route('home')->with('shortened_link', $shortened_link);
    }

    // перенаправляем на оригинальную ссылку
    public function redirect($short_code)
    {
        $link = Link::where('short_code', $short_code)->firstOrFail();

        $link->increment('clicks');

        return redirect($link->original_url);
    }
}
