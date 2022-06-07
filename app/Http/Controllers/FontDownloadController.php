<?php

namespace App\Http\Controllers;

use App\Http\FontDownloadRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZanySoft\Zip\Zip;

class FontDownloadController extends Controller
{
    public function download(FontDownloadRequest $request)
    {
        $files = $request->file('files');

        $storedFiles = [];
        $downloaded = [];
        $fontFiles = [];

        foreach ($files as $file) {
            $custom_name = Str::random(16).'.'.$file->getClientOriginalExtension();
            $storedFiles[] = $file->storeAs('styles', $custom_name);
        }

        foreach ($storedFiles as $storedFile) {
            $storedFilePath = storage_path('app/'.$storedFile);
            $styleFile = File::get($storedFilePath);
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $styleFile, $fontFiles);
        }

        return back()
            ->with('success','File has uploaded to the database.')
            ->with('file', 'ad')
            ->with('fontFiles', $fontFiles[0]);
    }
}
