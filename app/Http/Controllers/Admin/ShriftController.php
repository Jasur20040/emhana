<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shrift;
use App\Services\FileService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShriftController extends Controller
{
    public function index(Request $request)
    {
        $shrift = Shrift::orderBy('id', 'desc')->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return Inertia::render('Admin/Shrift/Index', [
            'shrift' => $shrift,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Shrift/Create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request['name'],
        ];

        if ($request->hasFile('shrift_file')) {
            $shrift_file = $request->file('shrift_file');
            $fileName = FileService::saveShriftFile($shrift_file, "/fonts");
            $data['shrift_file'] = 'fonts/' . $fileName;
        }
        if ($request->hasFile('shrift_css')) {
            $shrift_css = $request->file('shrift_css');
            $fileName = FileService::saveShriftFile($shrift_css, "/fonts");
            $data['shrift_css'] = 'fonts/' . $fileName;
        }
        Shrift::create($data);
        return redirect()->route('admin.shrift.index')->withSuccess("Шрифт қосылды!");
    }
    public function edit(Shrift $shrift)
    {
        return Inertia::render('Admin/Shrift/Edit', [
            'shrift' => $shrift
        ]);
    }

    public function update(Request $request, Shrift $shrift)
    {
        $data = [
            'name' => $request->name,
        ];

        $currentShriftFileName = basename($request->shrift_file);
        if ($request->hasFile('shrift_file')) {
            $shrift_file = $request->file('shrift_file');
            $fileName = FileService::saveShriftFile($shrift_file, "/fonts", $currentShriftFileName);
            $data['shrift_file'] = 'fonts/' . $fileName;
        }
        $currentShriftCssName = basename($request->shrift_css);
        if ($request->hasFile('shrift_css')) {
            $shrift_css = $request->file('shrift_css');
            $fileName = FileService::saveShriftFile($shrift_css, "/fonts", $currentShriftCssName);
            $data['shrift_css'] = 'fonts/' . $fileName;
        }
        $shrift->update($data);
        return redirect()->route('admin.shrift.index')->withSuccess("Сәтті сақталды!");
    }

    public function destroy(Shrift $shrift)
    {
        $shrift_file = basename($shrift->shrift_file);
        FileService::deleteFile($shrift_file, "/fonts");
        $shrift_css = basename($shrift->shrift_css);
        FileService::deleteFile($shrift_css, "/fonts");
        $shrift->delete();
        return redirect()->back()->withSuccess('Сәтті жойылды!');
    }
}
