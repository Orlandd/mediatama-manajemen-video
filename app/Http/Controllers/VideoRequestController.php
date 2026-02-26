<?php

namespace App\Http\Controllers;

use App\Models\VideoRequest;
use App\Http\Requests\StoreVideoRequestRequest;
use App\Http\Requests\UpdateVideoRequestRequest;
use Illuminate\Support\Facades\Auth;

class VideoRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }
        $data = VideoRequest::with(['video', 'user'])->get();

        return view('Admin.VideoRequest.index', compact('data'));
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
    public function store(StoreVideoRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoRequest $videoRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoRequest $videoRequest)
    {
        $videoRequest->load(['video', 'user']);

        return view('Admin.VideoRequest.update', [
            'videoRequest' => $videoRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequestRequest $request, VideoRequest $videoRequest)
    {
        if (!Auth::check() || Auth::user()->role_id != 1 || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'start'  => 'required_if:status,approved|nullable|date',
            'end'    => 'required_if:status,approved|nullable|date|after:start',
        ]);


        $videoRequest->update([
            'status' => $request->status,
            'access_start' => $request->start,
            'access_end' => $request->end,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect('/admin/video-request')->with('success', 'Status video request berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoRequest $videoRequest)
    {
        //
    }

    public function history()
    {
        $data = VideoRequest::with('video')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($item) {

                return [
                    'id'          => $item->id,
                    'video_id'    => $item->video_id,
                    'title'       => $item->video->title,
                    'status'      => $item->status,
                    "description" => $item->video->description,
                    "start" => $item->access_start,
                    "end" => $item->access_end,

                    // INI SATU-SATUNYA YANG DIPAKAI VIEW
                    'access_url'  => $item->status === 'approved'
                        ? $item->video->url
                        : 'expired',
                ];
            });

        return view('User.History.index', compact('data'));
    }
}
