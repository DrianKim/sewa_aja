<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'customer')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $totalUsers = User::where('role', 'customer')->count();
        $userAktif = User::where('role', 'customer')->count();

        return view('admin.user.index', compact('users', 'totalUsers', 'userAktif'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:15|unique:users,no_hp',
            'alamat'   => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nama.required'          => 'Nama harus diisi',
            'nama.string'            => 'Nama harus berupa teks',
            'nama.max'               => 'Nama maksimal 255 karakter',
            'email.required'         => 'Email harus diisi',
            'email.email'            => 'Format email tidak valid',
            'email.unique'           => 'Email sudah terdaftar',
            'no_hp.required'         => 'Nomor HP harus diisi',
            'no_hp.unique'           => 'Nomor HP sudah terdaftar',
            'alamat.required'        => 'Alamat harus diisi',
            'alamat.max'             => 'Alamat maksimal 500 karakter',
            'password.required'      => 'Password harus diisi',
            'password.min'           => 'Password minimal 6 karakter',
            'password.confirmed'     => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            User::create([
                'nama'     => $request->nama,
                'email'    => $request->email,
                'no_hp'    => $request->no_hp,
                'alamat'   => $request->alamat,
                'password' => Hash::make($request->password),
                'role'     => 'customer',
            ]);

            return redirect()->route('user.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'customer') {
            abort(403, 'Anda tidak bisa mengedit admin');
        }

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'customer') {
            abort(403, 'Anda tidak bisa mengubah admin');
        }

        $validator = Validator::make($request->all(), [
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $id,
            'no_hp'  => 'required|string|max:15|unique:users,no_hp,' . $id,
            'alamat' => 'required|string|max:500',
        ], [
            'nama.required'   => 'Nama harus diisi',
            'email.required'  => 'Email harus diisi',
            'email.email'     => 'Format email tidak valid',
            'email.unique'    => 'Email sudah terdaftar',
            'no_hp.required'  => 'Nomor HP harus diisi',
            'no_hp.unique'    => 'Nomor HP sudah terdaftar',
            'alamat.required' => 'Alamat harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user->update([
                'nama'   => $request->nama,
                'email'  => $request->email,
                'no_hp'  => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            // Update password jika ada
            if ($request->filled('password')) {
                $passwordValidator = Validator::make($request->all(), [
                    'password' => 'string|min:6|confirmed',
                ]);

                if ($passwordValidator->fails()) {
                    return redirect()->back()
                        ->withErrors($passwordValidator)
                        ->withInput();
                }

                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return redirect()->route('user.index')
                ->with('success', 'Data user berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'customer') {
            abort(403, 'Anda tidak bisa menghapus admin');
        }

        try {
            $user->delete();

            return redirect()->route('user.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}
