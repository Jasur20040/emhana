<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\FileService;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $type = Type::paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return Inertia::render('Admin/Type/Index', [
            'type' => $type,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Type/Create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'latin_name' => $request->latin_name,
        ];

        if ($request->hasFile('image')) {
            $type_image = $request->file('image');
            $image_name = FileService::saveFile($type_image, "/types");
            $data['image'] = 'types/' . $image_name;
        }
        Type::create($data);
        return redirect()->route('admin.type.index')->withSuccess("Тип қосылды!");
    }
    public function edit(Type $type)
    {
        return Inertia::render('Admin/Type/Edit', [
            'type' => $type
        ]);
    }

    public function update(Request $request, Type $type)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'latin_name' => $request->latin_name,
        ];

        $oldTypeImage = basename($type->image);
        if ($request->hasFile('image')) {
            $type_image = $request->file('image');
            $image_name = FileService::saveFile($type_image, "/types", $oldTypeImage);
            $data['image'] = 'types/' . $image_name;
        }
        $type->update($data);
        return redirect()->route('admin.type.index')->withSuccess("Сәтті сақталды!");
    }

    public function destroy(Type $type)
    {
        $image = basename($type->image);
        FileService::deleteFile($image, "/types");
        $type->delete();
        return redirect()->back()->withSuccess('Сәтті жойылды!');
    }
}
