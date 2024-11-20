<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Maket;
use App\Models\MaketShrift;
use App\Models\Shrift;
use App\Models\Type;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;

class MaketController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $type_id = $request->type_id;
        $with_avatar = $request->with_avatar;
        $maket = Maket::with(['type', 'shrifts:id,name'])
            ->when($title, fn ($q) => $q->where('title', 'like', "%$title%"))
            ->when($type_id, fn ($q) => $q->where('type_id', $type_id))
            ->when($with_avatar, fn ($q) => $q->where('with_avatar', ($with_avatar - 1)))
            ->select('id', 'type_id', 'shablon_image', 'with_avatar', 'colors', 'title', 'price')
            ->orderBy('id', 'desc')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        $types = Type::all();
        $shrifts = Shrift::all();
        return Inertia::render('Admin/Maket/Index', [
            'maket' => $maket,
            'types' => $types,
            'shrifts' => $shrifts,
        ]);
    }

    public function create()
    {
        $types = Type::all();
        $shrifts = Shrift::all();
        return Inertia::render('Admin/Maket/Create', [
            'types' => $types,
            'shrifts' => $shrifts,
        ]);
    }

    public function store(Request $request)
    {
        $withAvatar = filter_var($request['with_avatar'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $data = [
            'type_id' => $request['type_id'],
            'title' => $request['title'],
            'price' => $request['price'],
            'with_avatar' => $withAvatar,
            'avatar_sizes' => $request['avatar_sizes'],
            'texts' => $request['texts'],
            'colors' => $request['standartColors'],
        ];

        if ($request->hasFile('shablon_image')) {
            $shablon_image = $request->file('shablon_image');
            $shablonName = FileService::saveFile($shablon_image, "/shablon_images");
            $data['shablon_image'] = 'shablon_images/' . $shablonName;
        }
        if ($request->hasFile('maket_image')) {
            $maket_image = $request->file('maket_image');
            $maketName = FileService::saveFile($maket_image, "/maket_images");
            $data['maket_image'] = 'maket_images/' . $maketName;
        }
        if ($request->has('ava_image')) {
            $ava_image_base64 = $request->input('ava_image');
            $avaName = FileService::saveBase64Image($ava_image_base64, "ava_images");
            $data['ava_image'] = 'ava_images/' . $avaName;
        }

        $maket = Maket::create($data);
        $standartShrifts = json_decode($request['standartShrifts']);

        foreach ($standartShrifts as $shrift) {
            MaketShrift::create([
                'maket_id' => $maket->id,
                'shrift_id' => $shrift->id,
            ]);
        }

        return redirect()->route('admin.maket.index')->withSuccess("Макет қосылды!");
    }

    public function edit(Maket $maket)
    {
        $types = Type::all();
        $shrifts = Shrift::all();
        $maketShrifts = MaketShrift::where('maket_id', $maket->id)
            ->with(['shrift' => function ($query) {
                $query->select('id', 'name', 'shrift_css');
            }])
            ->get()
            ->each(function ($item) {
                $item->makeHidden(['id', 'maket_id', 'shrift_id']);
            });

        return Inertia::render('Admin/Maket/Edit', [
            'maket' => $maket,
            'types' => $types,
            'shrifts' => $shrifts,
            'maketShrifts' => $maketShrifts,
        ]);
    }

    public function update(Request $request, Maket $maket)
    {
        $withAvatar = filter_var($request['with_avatar'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $data = [
            'type_id' => $request['type_id'],
            'title' => $request['title'],
            'price' => $request['price'],
            'with_avatar' => $withAvatar,
            'avatar_sizes' => $request['avatar_sizes'],
            'texts' => $request['texts'],
            'colors' => $request['standartColors'],
        ];

        $oldShablonImage = basename($maket->shablon_image);
        if ($request->hasFile('shablon_image')) {
            $shablon_image = $request->file('shablon_image');
            $shablonName = FileService::saveFile($shablon_image, "/shablon_images", $oldShablonImage);
            $data['shablon_image'] = 'shablon_images/' . $shablonName;
        }

        $oldMaketImage = basename($maket->maket_image);
        if ($request->hasFile('maket_image')) {
            $maket_image = $request->file('maket_image');
            $maketName = FileService::saveFile($maket_image, "/maket_images", $oldMaketImage);
            $data['maket_image'] = 'maket_images/' . $maketName;
        }

        $oldAvaImage = basename($maket->ava_image);
        if ($request->has('ava_image')) {
            $ava_image_base64 = $request->input('ava_image');
            $avaName = FileService::saveBase64Image($ava_image_base64, "ava_images", $oldAvaImage);
            $data['ava_image'] = 'ava_images/' . $avaName;
        }

        $maket->shrifts()->detach();
        $standartShrifts = json_decode($request['standartShrifts']);

        foreach ($standartShrifts as $shrift) {
            MaketShrift::create([
                'maket_id' => $maket->id,
                'shrift_id' => $shrift->id,
            ]);
        }
        // $maket->shrifts()->sync($request['standartShrifts']);
        $maket->update($data);
        return redirect()->route('admin.maket.index')->withSuccess("Мәліметтер сәтті ауыстырылды!");
    }

    public function destroy(Maket $maket)
    {
        $maket_image = basename($maket->maket_image);
        FileService::deleteFile($maket_image, "/maket_images");
        $shablon_image = basename($maket->shablon_image);
        FileService::deleteFile($shablon_image, "/shablon_images");
        $ava_image = basename($maket->ava_image);
        FileService::deleteFile($ava_image, "/ava_images");
        $maket->delete();
        return redirect()->back()->withSuccess('Макет сәтті жойылды!');
    }
}
