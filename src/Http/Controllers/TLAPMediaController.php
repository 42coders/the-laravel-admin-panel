<?php

namespace the42coders\TLAP\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use the42coders\TLAP\TLAPModel;

class TLAPMediaController extends Controller
{
    public function index()
    {
        $images = Media::orderBy('updated_at')->limit(20)->get();

        return view('tlap::pages.medialibrary.index', [
            'images' => $images,
        ]);
    }
}
