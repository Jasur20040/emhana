<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\ClientMaket;
use App\Models\Maket;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function types(Request $request)
    {
        $types = Type::all();
        Config::set('app.meta.title', 'To‘y uchun surat taklifnoma yaratish | e-taklif.uz');
        Config::set('app.meta.description', 'To‘y uchun 500 dan ortiq surat taklifnoma turlariі.  Faqatgina 20000 so‘mdan boshlab. Qiz uzatish, nikoh to‘yi, sunnat to‘yi va boshqa barcha to‘ylar uchun taklifnomalar yaratamiz. Bepul taklifnomalar namunalari mavjud.');
        Config::set('app.meta.keywords', 'e-taklif, taklif, taklifnoma, onlayn taklifnoma, qiz uzatish, bepul taklifnoma, taklif matni, sunnat to‘yi, qiz uzatish, sunnat to‘yi, nikoh to‘yi, beshik to‘yi, meros to‘yi, yubiley, taklifnomalar, to‘yga taklifnoma, suratli taklifnoma, videoli taklifnoma, sayt taklifnoma');
        Config::set('app.meta.canonical', 'https://constructor.e-taklif.uz');
        return Inertia::render('Suret/Types', [
            'types' => $types,
        ]);
    }

    public function index(Request $request, $slug = null)
    {
        $maket = Maket::with(['type', 'shrifts:id,name'])
            ->select('id', 'type_id', 'shablon_image', 'with_avatar', 'colors', 'title', 'price')
            ->when($slug, fn ($q) => $q->whereHas('type', fn ($qu) => $qu->where('latin_name', $slug)))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        $filter = $slug ? Type::where('latin_name', $slug)->first() : null;
        $types = Type::all();

        $title = $slug ? $filter->description : 'Barcha to\'ylar';
        Config::set('app.meta.title', $title . ' uchun surat taklifnomalarining namunalari | e-taklif.uz');
        Config::set('app.meta.description', 'To‘y uchun 500 dan ortiq surat taklifnoma turlariі.  Faqatgina 20000 so‘mdan boshlab. Qiz uzatish, nikoh to‘yi, sunnat to‘yi va boshqa barcha to‘ylar uchun taklifnomalar yaratamiz. Bepul taklifnomalar namunalari mavjud.');
        Config::set('app.meta.keywords', 'e-taklif, taklif, taklifnoma, onlayn taklifnoma, qiz uzatish, bepul taklifnoma, taklif matni, sunnat to‘yi, qiz uzatish, sunnat to‘yi, nikoh to‘yi, beshik to‘yi, meros to‘yi, yubiley, taklifnomalar, to‘yga taklifnoma, suratli taklifnoma, videoli taklifnoma, sayt taklifnoma');
        $canonical = $slug ? 'suret/' . $slug : 'suret';
        Config::set('app.meta.canonical', 'https://constructor.e-taklif.uz/' . $canonical);
        return Inertia::render('Suret/Index', [
            'maket' => $maket,
            'types' => $types,
            'filter' => $filter,
        ]);
    }

    public function edit($type, $id)
    {
        $maket = Maket::with(['shrifts:id,name,shrift_css'])->find($id);

        $title = Maket::find($id)->title;
        $description = Maket::find($id)->type->description;
        Config::set('app.meta.title', $description . ' uchun ' . $title . ' taklifnoma | e-taklif.uz');
        Config::set('app.meta.description', 'To‘y uchun 500 dan ortiq surat taklifnoma turlariі.  Faqatgina 20000 so‘mdan boshlab. Qiz uzatish, nikoh to‘yi, sunnat to‘yi va boshqa barcha to‘ylar uchun taklifnomalar yaratamiz. Bepul taklifnomalar namunalari mavjud.');
        Config::set('app.meta.keywords', 'e-taklif, taklif, taklifnoma, onlayn taklifnoma, qiz uzatish, bepul taklifnoma, taklif matni, sunnat to‘yi, qiz uzatish, sunnat to‘yi, nikoh to‘yi, beshik to‘yi, meros to‘yi, yubiley, taklifnomalar, to‘yga taklifnoma, suratli taklifnoma, videoli taklifnoma, sayt taklifnoma');

        $latin_name = Maket::find($id)->type->latin_name . '/';
        Config::set('app.meta.canonical', 'https://constructor.e-taklif.uz//' . $latin_name . $id);
        return Inertia::render('Suret/Edit', [
            'maket' => $maket,
        ]);
    }

    public function update(Request $request)
    {
        $dataUrl = $request->input('image');
        $base64_str = substr($dataUrl, strpos($dataUrl, ',') + 1);
        $image = base64_decode($base64_str);
        $file_name = uniqid() . '.png';
        $upload_dir = public_path('storage/user_uploads');

        if (!File::exists($upload_dir)) {
            File::makeDirectory($upload_dir, 0777, true, true);
        }

        $path = $upload_dir . '/' . $file_name;
        File::put($path, $image);

        $client_maket = ClientMaket::create([
            'client_maket' => 'user_uploads/' . $file_name,
            'upload_date' => Carbon::now(),
        ]);

        return response()->json([
            'client_maket' => $client_maket,
        ]);
    }
}
