<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    //アップロード画面
    public function create()
    {
        return view('photos.create');
    }

    //アップロード処理
    public function store(Request $request)
    {
        // 1. 画像を public ディスクの photos フォルダに保存
        $savedFilePath = $request->file('image')->store('photos', 'public');
        Log::debug('保存されたフルパス: ' . $savedFilePath);

        // 2. パスからファイル名だけを抽出（例: photos/abc.jpg -> abc.jpg）
        $fileName = pathinfo($savedFilePath, PATHINFO_BASENAME);
        Log::debug('抽出されたファイル名: ' . $fileName);
        
        // 3. 重要：photos.show（表示画面）に、抽出したファイル名を渡してリダイレクト
        return to_route('photos.show', ['photo' => $fileName])->with('success', 'アップロードしました');
    }

    // アップロード画像の表示
    public function show(string $fileName)
    {
        // ファイル名を受け取って photos.show ビューを表示
        return view('photos.show', ['fileName' => $fileName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    //アップロード画像の削除処理
    public function destroy(string $fileName)
    {
        Storage::disk('public')->delete('photos/'. $fileName);
        return to_route('photos.create')->with('success','削除しました');
    }

    //アップロード画像のダウンロード処理
    public function download($fileName)
    {
        return Storage::disk('public')->download('photos/'.$fileName,'アップロード画像.jpg');
    }
}