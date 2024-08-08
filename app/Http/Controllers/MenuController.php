<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(){
        $menu = Menu::all();

        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        $menu = Menu::all();
        return view('menu.add', compact('menu'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $path = 'photo-menu/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($photo));

            $data['photo'] = $filename;
        } else {
            $data['photo'] = null;
        }

        $existingmenu = Menu::where('name', $request->name)->exists();
        if ($existingmenu) {
            return redirect()->back()->withInput()->withErrors(['menu sudah terdata.']);
        }

        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Data menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = menu::find($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,svg', // Validate image
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $menu = menu::find($id);

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('photo') && ($photo = $request->file('photo'))) {
            if ($menu->photo) {
                Storage::disk('public')->delete('photo-menu/' . $menu->photo);
            }

            $filename = time() . '_' . $photo->getClientOriginalName();
            $path = 'photo-menu/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($photo));

            $menu->photo = $filename;
        }

        $existingmenu = menu::where('name', $request->name)->whereNotIn('merchant_id', [$id])
        ->exists();
        if ($existingmenu) {
            return redirect()->back()->withInput()->withErrors(['Menu sudah ada.']);
        }

        $menu->save();

        return redirect()->route('menu/index')->with('success', 'Data menu berhasil diubah');
    }


    public function delete($id)
    {
        $menu = menu::find($id);
        $menu->deleteImage();
        $menu->delete();

        return redirect()->route('menu/index')->with('success', 'Data menu berhasil dihapus');
    }
}
