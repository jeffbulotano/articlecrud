<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items_per_page = $request->items ? $request->items : 10;
        $order_by = $request->orderBy ? $request->orderBy : 'id';
        $order_direction = $request->orderDirection ? $request->orderDirection : 'asc';

        $articles = Article::orderBy($order_by, $order_direction)->paginate($items_per_page);

        return new ArticleCollection($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required',
            'client_email' => 'required|email',
            'required_wordcount' => 'required|integer',
            'article' => 'required'
        ]);

        $validator->after(function($validator) use ($request) {
            if (!$this->validateWordCount($request->article, $request->required_wordcount)) {
                $validator->errors()->add(
                    'article', 'Article field must have atleast ' . $request->required_wordcount . ' words.'
                );
            }
        });

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => 'Article not saved.',
                'errors' => $validator->errors()
            ]);
        }

        $article = Article::create($request->all());

        return response([
            'status' => 'success',
            'message' => 'Article successfully saved.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'required_wordcount' => 'required|integer',
            'article' => 'required'
        ]);

        $validator->after(function($validator) use ($request) {
            if (!$this->validateWordCount($request->article, $request->required_wordcount)) {
            $validator->errors()->add(
                    'article', 'Article field must have atleast ' . $request->required_wordcount . ' words.'
                );
            }
        });

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => 'Article not saved.',
                'errors' => $validator->errors()
            ]);
        }

        $article->required_wordcount = $request->required_wordcount;
        $article->article = $request->article;
        $article->save();

        return response([
            'status' => 'success',
            'message' => 'Article successfully saved.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response([
            'status' => 'success',
            'message' => 'Article successfully deleted.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param String  $article
     * @param Integer  $required_wordcount
     * @return Boolean
     */
    public function validateWordCount($article = '', $required_wordcount = 0)
    {
        return count(explode(' ', strip_tags($article))) >= $required_wordcount;
    }
}
