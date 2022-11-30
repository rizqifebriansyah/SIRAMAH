<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login.index',[
            'menu' => 1,
            'title' => 'Semerusmart Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            $hak = auth()->user()->hak_akses;
            if($hak == 2){
                return redirect()->intended('perawat');
            }
            if($hak == 3){
                return redirect()->intended('dokter');
            }
        } 
        return back()->with('loginError', 'Login gagal !');
    }
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username1' => 'required|min:5|max:20|unique:users_semerusmart,username',
            'kodeunit' => 'required',
            'password1' => 'required|min:5'
        ]);
        $pass = bcrypt($validateData['password1']);
        $data = [
            'name' => $request->name,
            'username' => $request->username1,
            'unit' => $request->kodeunit,
            'password' => $pass
        ];
        User::create($data);
        $request->session()->flash('success', 'Registrasi berhasil, Silahkan hubungi tim it untuk aktivasi ...');
        return redirect('/');
    }
    public function cariunit(Request $request)
    {
        $result = DB::table('mt_unit')->where('nama_unit', 'LIKE', '%' . $request['term'] . '%')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_unit,
                    'kode' => $row->kode_unit,
                );
            echo json_encode($arr_result);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();     
        return redirect('/');
    }
}