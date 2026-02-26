<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\VideoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }
        $data = Video::all();

        return view('Admin.Video.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }

        return view('Admin.Video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }

        // Validasi
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'video_file' => 'required|file|mimetypes:video/mp4,video/mpeg,video/quicktime',
        ]);

        // Buat record sementara tanpa URL
        $video = Video::create([
            'title' => $request->judul,
            'description' => $request->deskripsi,
            'url' => '',
            'created_by' => Auth::id(),
        ]);

        $file = $request->file('video_file');
        $extension = $file->getClientOriginalExtension();

        $fileName = $video->id . '-' . preg_replace('/[^a-zA-Z0-9-_]/', '-', strtolower($request->judul)) . '.' . $extension;

        $filePath = $file->storeAs('videos', $fileName, 'public');

        $video->update([
            'url' => $filePath,
        ]);

        return redirect('/admin/video')->with('success', 'Video berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {

        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }
        return view('Admin.Video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, $id)
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }

        $video = Video::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime',
        ]);

        $dataUpdate = [
            'title' => $request->judul,
            'description' => $request->deskripsi,
        ];

        if ($request->hasFile('video_file')) {
            if ($video->url && Storage::disk('public')->exists($video->url)) {
                Storage::disk('public')->delete($video->url);
            }

            $file = $request->file('video_file');
            $extension = $file->getClientOriginalExtension();

            $fileName = $video->id . '-' . preg_replace('/[^a-zA-Z0-9-_]/', '-', strtolower($request->judul)) . '.' . $extension;

            $filePath = $file->storeAs('videos', $fileName, 'public');

            $dataUpdate['url'] = $filePath;
        }

        $video->update($dataUpdate);

        return redirect('/admin/video')->with('success', 'Video berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        if (Auth::user()->role_id != 1 || !Auth::check()) {
            abort(403, 'Unauthorized');
        }

        if ($video->url && Storage::disk('public')->exists($video->url)) {
            Storage::disk('public')->delete($video->url);
        }

        $video->delete();

        return redirect('/admin/video')->with('success', 'Video berhasil dihapus');
    }


    public function userIndex()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $videos = Video::with(['requests' => function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->latest()
                    ->limit(1);
            }])->get();
        } else {
            $videos = Video::all();
            $data = $videos->map(function ($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'description' => $video->description,
                    'request_status' =>  null,
                ];
            });

            return view('User.Video.index', compact('data'));
        }

        $data = $videos->map(function ($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
                'request_status' => $video->requests->first()?->status ?? null,
            ];
        });

        return view('User.Video.index', compact('data'));
    }

    public function userRequest($id)
    {
        $video = Video::findOrFail($id);
        $video->makeHidden(['url', 'created_by']);

        $dataRequest = [
            'video_id' => $id,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'requested_at' => now(),
        ];

        VideoRequest::create($dataRequest);

        $videos = Video::all();

        $data = $videos->map(function ($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'description' => $video->description,
            ];
        });

        return view('User.Video.index', compact('data'))->with('success', 'Permintaan video berhasil dikirim');
    }

    public function watch($id)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $video = Video::findOrFail($id);


        if (Auth::user()->role_id != 1) {
            $latestRequest = $video->requests()
                ->where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->first();

            if (!$latestRequest || $latestRequest->status !== 'approved' || $latestRequest->access_end < now()) {
                abort(403, 'Anda tidak memiliki akses ke video ini.');
            }

            return view('User.history.watch', compact('video'));
        }

        return view('Admin.Video.watch', compact('video'));
    }

    public function stream($filename)
    {
        $path = storage_path('app/public/videos/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $mime = mime_content_type($path);
        return response()->file($path, ['Content-Type' => $mime]);
    }
}
