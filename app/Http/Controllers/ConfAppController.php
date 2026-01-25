<?php

namespace App\Http\Controllers;

use App\Models\Config\App;
use Illuminate\Http\Request;

class ConfAppController extends Controller
{
    public function update(Request $request)
    {
        App::where('app_id', 1)->update(
            $request->only([
                'app_nama',
                'app_desc',
                'app_alamat',
                'app_email',
                'app_tlp',
                'app_author'
            ])
        );
        return redirect()
            ->back()
            ->with('success', 'Perubahan tersimpan');
    }

    public function updateLogoIcon(Request $request)
    {
        $app = App::find(1);

        $lokasi = 'komponen/assets/images/';
        $file = $request->file('gbr');
        $ext = $file->extension();
        $newName = 'logo_' . time() . '.' . $ext;
        $file->move($lokasi, $newName);

        if ($request->tipe == 'logo') {
            if (file_exists($app->app_logo)) {
                @unlink($app->app_logo);
            }
            $app->app_logo = $lokasi . $newName;
            $app->save();
        } elseif ($request->tipe == 'logow') {
            if (file_exists($app->app_logo_w)) {
                @unlink($app->app_logo_w);
            }
            $app->app_logo_w = $lokasi . $newName;
            $app->save();
        } else {
            if (file_exists($app->app_icon)) {
                @unlink($app->app_icon);
            }
            $app->app_icon = $lokasi . $newName;
            $app->save();
        }
        return redirect()
            ->back()
            ->with(['success' => 'Perubahan tersimpan', 'isLogo' => true]);
    }
}
