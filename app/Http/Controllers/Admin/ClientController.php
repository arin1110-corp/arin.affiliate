<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $data = ModelUser::where('user_role', 'client')
            ->latest('user_id')
            ->get();

        return view('admin.client.index', compact('data'));
    }

    public function show($id)
    {
        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        return view('admin.client.show', compact('item'));
    }

    public function edit($id)
    {
        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        $packages = ModelPackage::where('package_is_active', true)
            ->orderBy('package_sort_order')
            ->get();

        return view('admin.client.edit', compact('item', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        $request->validate([
            'user_nama' => 'required|string|max:150',
            'user_email' => 'required|email|max:150|unique:arin_users,user_email,' . $item->user_id . ',user_id',
            'user_slug' => 'required|string|max:100|alpha_dash|unique:arin_users,user_slug,' . $item->user_id . ',user_id',
            'user_package' => 'required|string|max:100',
            'user_expired_at' => 'nullable|date',
            'user_password' => 'nullable|string|min:6',
        ]);

        $data = [
            'user_nama' => $request->user_nama,
            'user_email' => $request->user_email,
            'user_slug' => Str::slug($request->user_slug),
            'user_subdomain' => Str::slug($request->user_slug),
            'user_package' => $request->user_package,
            'user_expired_at' => $request->user_expired_at,
            'user_is_active' => $request->has('user_is_active'),
            'user_is_trial' => $request->has('user_is_trial'),
            'user_is_promo' => $request->has('user_is_promo'),
        ];

        if ($request->filled('user_password')) {
            $data['user_password'] = Hash::make($request->user_password);
        }

        $item->update($data);

        return redirect()
            ->route('admin.client.index')
            ->with('success', 'Client berhasil diupdate.');
    }

    public function toggle($id)
    {
        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        $item->update([
            'user_is_active' => !$item->user_is_active,
        ]);

        return back()->with('success', 'Status client berhasil diubah.');
    }

    public function extend(Request $request, $id)
    {
        $request->validate([
            'extend_days' => 'required|integer|min:1',
        ]);

        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        $startDate = now();

        if ($item->user_expired_at && $item->user_expired_at->greaterThan(now())) {
            $startDate = $item->user_expired_at;
        }

        $item->update([
            'user_is_active' => true,
            'user_is_trial' => false,
            'user_expired_at' => $startDate->copy()->addDays((int) $request->extend_days),
        ]);

        return back()->with('success', 'Masa aktif client berhasil diperpanjang.');
    }

    public function destroy($id)
    {
        $item = ModelUser::where('user_role', 'client')
            ->where('user_id', $id)
            ->firstOrFail();

        $item->delete();

        return redirect()
            ->route('admin.client.index')
            ->with('success', 'Client berhasil dihapus.');
    }
}