<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function index(): View
    {
        return view('image-upload');
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'image' => ['required'],
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $img = Image::read($request->image->path());

        $logo = public_path('images/logo.png');
        // dd($logo);
        $img->place($logo, 'bottom-right', 10, 10);
        // dd($request->all());
        $img->save(public_path('images/') . $imageName);

        return back()->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }
}
