<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function create(Request $request)
    {

    }

    public function update(Request $request)
    {
        User::where('user_id', Auth::id())->update($request->only(['user_nama','user_email','user_tlp']));
        session()->put('nama', $request->user_nama);
        return redirect()
            ->back()
            ->with('success', 'Perubahan tersimpan');
    }

    public function updatePass(Request $request)
    {
        if ($request->pass_b != $request->pass_b2) {
            return response()->json([
                'status' => false,
                'msg' => "Password baru tidak cocok"
            ]);
        }
        $user = User::find(Auth::id());
        if (Hash::check($request->pass_l, $user->password)) {
            $user->password = Hash::make($request->pass_b);
            $user->save();
            return response()->json([
                'status' => true,
                'msg' => "Password berhasil diubah"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => "Password lama anda salah"
            ]);
        }
    }
}
