<?php

namespace App\Http\Controllers;

use App\Entities\Article;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Redirect;
use Storage;
use EMedia\Formation\Builder\Formation;

class ArticleController extends Controller
{

    protected $indexRoute;

    public function __construct()
    {
        $this->indexRoute = route('manage.articles.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        $articlesQuery = Article::where('status', 1)->latest();

        if ($request->has('q')) {
            $search = $request->query('q');
            $articlesQuery->Where('title', 'LIKE', '%' . $search . '%');
        }

        $articles = $articlesQuery->paginate(15);

        return view('article.index', [
            'pageTitle' => 'Manage Articles',
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        $article = new Article();

        return view('article.create', [
            'pageTitle' => "Add New Article",
            'entity' => $article,
            'form' => new Formation($article),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pdf' => 'required|mimes:pdf',
            'title' => 'required|unique:articles|max:120',
        ]);

        $data = $request->all();

        // save the file
        if ($request->hasFile('pdf')) {
            $disk = Storage::disk('public');
            // return $request->file('pdf');
            $filename = $request->title . '.pdf';
            $path = $request->file('pdf')->store('articles/' . $request->title, 'public');
            // $path = $request->file('pdf')->storeAs('articles/'. $request->title, $filename);
            $url = $disk->url($path);
            $data['file_url'] = $url;
            Article::create($data);
            return redirect($this->indexRoute)->with('success', 'Article created.');

        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Factory|Response|View
     */
    public function edit(Article $article)
    {
        return view('article.edit', [
            'pageTitle' => "Edit Article - `{$article->title}`",
            'entity' => $article,
            'form' => new Formation($article),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse|Response
     * @throws ValidationException
     */
    public function update(Request $request, Article $article)
    {
        if ($article->title !== $request->title) {
            $this->validate($request, [
                'pdf' => 'mimes:pdf',
                'title' => 'required|unique:articles|max:120',
            ]);
        } else {
            $this->validate($request, [
                'pdf' => 'mimes:pdf',
                'title' => 'required|max:120',
            ]);
        }

        $data = $request->all();

        if ($request->hasFile('pdf')) {
            $disk = Storage::disk('public');
            // return $request->file('pdf');
            $path = $request->file('pdf')->store('articles/' . $request->title, 'public');
            $url = $disk->url($path);
            $data['file_url'] = $url;
            $article->update(['title' => $request->title, 'file_url' => $url]);
            return redirect($this->indexRoute)->with('success', 'Article updated.');

        }

        $article->update($data);

        return redirect($this->indexRoute)->with('success', 'Article updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect($this->indexRoute)->with('success', 'Article deleted.');
    }
}
