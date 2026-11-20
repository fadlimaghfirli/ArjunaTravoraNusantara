<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    // === AREA ADMIN ===

    public function index()
    {
        $members = TeamMember::orderBy('sort_order', 'asc')->get();
        return view('admin.team-members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'role' => 'required|string|max:100',
            'level' => 'required|in:Pimpinan,Manajemen,Karyawan',
            'division' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = TeamMember::max('sort_order') ?? 0;
        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('team-members', 'public')
            : null;

        TeamMember::create([
            'name' => $request->name,
            'role' => $request->role,
            'level' => $request->level,
            'division' => $request->division,
            'photo' => $photoPath,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Anggota struktur organisasi berhasil ditambahkan!');
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'role' => 'required|string|max:100',
            'level' => 'required|in:Pimpinan,Manajemen,Karyawan',
            'division' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'role', 'level', 'division']);

        if ($request->hasFile('photo')) {
            if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
                Storage::disk('public')->delete($teamMember->photo);
            }
            $data['photo'] = $request->file('photo')->store('team-members', 'public');
        }

        $teamMember->update($data);

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:team_members,id',
        ]);

        foreach ($request->order as $index => $id) {
            TeamMember::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        return back()->with('success', 'Anggota berhasil dihapus dari struktur organisasi!');
    }

    // === AREA PUBLIK ===

    public function publicIndex()
    {
        $members = TeamMember::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $leaders = $members->where('level', 'Pimpinan')->values();
        $managers = $members->where('level', 'Manajemen')->values();
        $staff = $members->where('level', 'Karyawan')->values();
        $staffRoles = $staff->pluck('role')->unique()->values();

        $setting = Setting::first() ?? new Setting();

        return view('organization.index', compact(
            'members',
            'leaders',
            'managers',
            'staff',
            'staffRoles',
            'setting'
        ));
    }
}
