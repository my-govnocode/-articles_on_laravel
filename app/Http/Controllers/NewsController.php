<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use Illuminate\Http\Request;
use App\Models\News;
use App\Services\TagsSynchronizer;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(News $news)
    {
        $news = $news->where('approved', true)->with('tags')->latest()->paginate(10);
        return view('news.index', compact(['news']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = new News(); 
        return view('news.create', compact(['news']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();
        $news = News::create($data);

        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $news);
        }

        return redirect()->route('admin.news')->with('success', 'Новость успешно создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $comments = $news->comments->sortByDesc('created_at');
        return view('news.show', compact(['news', 'comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact(['news']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateNewsRequest $request, News $news, TagsSynchronizer $tagsSynchronizer)
    {
        $data = $request->validated();
        $news->update($data);

        if (isset($data['tags']) && !empty($data['tags'])) {
            $tagsSynchronizer->sync($data['tags'], $news);
        }

        return redirect()->route('admin.news')->with('success', 'Новость успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news')->with('success', 'Новость успешно удалена!');
    }
}
