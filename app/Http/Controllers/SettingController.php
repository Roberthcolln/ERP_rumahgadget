<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Setting';
        $setting = Setting::first();
        return view('setting.index', compact('setting', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $logo = $setting->logo_setting;
        $favicon = $setting->favicon_setting;

        // Jika ada file logo baru
        if ($request->hasFile('logo_setting')) {
            // Hapus logo lama jika ada
            if ($logo && file_exists(public_path('logo/' . $logo))) {
                unlink(public_path('logo/' . $logo));
            }

            // Upload logo baru dengan nama unik
            $logo = time() . '_' . $request->file('logo_setting')->getClientOriginalName();
            $request->file('logo_setting')->move('logo/', $logo);
        }

        // Jika ada file favicon baru
        if ($request->hasFile('favicon_setting')) {
            // Hapus favicon lama jika ada
            if ($favicon && file_exists(public_path('favicon/' . $favicon))) {
                unlink(public_path('favicon/' . $favicon));
            }

            // Upload favicon baru dengan nama unik
            $favicon = time() . '_' . $request->file('favicon_setting')->getClientOriginalName();
            $request->file('favicon_setting')->move('favicon/', $favicon);
        }

        // Update data setting
        $update = [
            'instansi_setting' => $request->instansi_setting,
            'pimpinan_setting' => $request->pimpinan_setting,
            'logo_setting' => $logo,
            'favicon_setting' => $favicon,
            'tentang_setting' => $request->tentang_setting,
            'keyword_setting' => $request->keyword_setting,
            'alamat_setting' => $request->alamat_setting,
            'instagram_setting' => $request->instagram_setting,
            'youtube_setting' => $request->youtube_setting,
            'email_setting' => $request->email_setting,
            'no_hp_setting' => $request->no_hp_setting,
            'maps_setting' => $request->maps_setting,

            // TAMBAHAN BARU
            'alamat_setting_2' => $request->alamat_setting_2,
            'email_setting_2' => $request->email_setting_2,
            'no_hp_setting_2' => $request->no_hp_setting_2,
            'maps_setting_2' => $request->maps_setting_2,
        ];

        $setting->update($update);

        return redirect()->back()->with('Sukses', 'Berhasil Konfigurasi Website');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
