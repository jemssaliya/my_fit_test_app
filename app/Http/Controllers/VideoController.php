<?php

namespace App\Http\Controllers;

use App\Entities\Video;
use EMedia\Formation\Builder\Formation;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VideoController extends Controller
{
    protected $indexRoute;

    public function __construct()
    {
        $this->indexRoute = route('manage.videos.index');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $articlesQuery = Video::where('status', 1)->latest();

        if ($request->has('q')) {
            $search = $request->query('q');
            $articlesQuery->Where('title', 'LIKE', '%' . $search . '%');
        }

        $articles = $articlesQuery->paginate(15);

        return view('video.index', [
            'pageTitle' => 'Manage Videos',
            'videos' => $articles,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $video = new Video();

        return view('video.create', [
            'pageTitle' => "Add New Video",
            'entity' => $video,
            'form' => new Formation($video),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required|url',
        ]);

        Video::create($request->all());

        return redirect($this->indexRoute)->with('success', 'Video has been created.');
    }

    /**
     * @param Video $video
     * @return Factory|View
     */
    public function edit(Video $video)
    {
        return view('video.edit', [
            'pageTitle' => "Edit Article - `{$video->title}`",
            'entity' => $video,
            'form' => new Formation($video),
        ]);
    }

    /**
     * @param Request $request
     * @param Video $video
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required|url',
        ]);

        $video->update($request->all());
        return redirect($this->indexRoute)->with('success', 'Video has been updated.');
    }

    /**
     * @param Video $video
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect($this->indexRoute)->with('success', 'Video has been deleted.');
    }
}
