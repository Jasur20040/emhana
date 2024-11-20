<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientMaket;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClientMaketController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $clientMaket = ClientMaket::when($id, fn ($q) => $q->where('id', $id))
            ->orderBy('id', 'desc')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return Inertia::render('Admin/ClientMaket/Index', [
            'clientMaket' => $clientMaket,
        ]);
    }

    public function destroy(ClientMaket $clientMaket)
    {
        $name = basename($clientMaket->client_maket);
        FileService::deleteFile($name, "/user_uploads");
        $clientMaket->delete();
        return redirect()->back()->withSuccess('Сәтті жойылды!');
    }

    public function downloadFile(Request $request)
    {
        $filePath = $request->input('url');
        $pathToPublicFolder = public_path();
        $fileFullPath = $pathToPublicFolder . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $filePath;
        return response()->download($fileFullPath);
    }

    public function destroyClientImages()
    {
        $dayAgo = Carbon::now()->subDays(1);
        $filesToDelete = ClientMaket::where('upload_date', '<', $dayAgo)->get();

        // $twoSecondsAgo = Carbon::now()->subSeconds(2);
        // $filesToDelete = ClientMaket::where('upload_date', '<', $twoSecondsAgo)->get();
        foreach ($filesToDelete as $file) {
            $name = basename($file->client_maket);
            FileService::deleteFile($name, "/user_uploads");

            $file->delete();
        }
        return 200;
    }
}
