<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;


class NewsController extends Controller
{
    //Add methods for creating, updating, and deleting FAQs use isadmin for protec
    public function index()
{
    $news = News::latest('publicationDate')->get();
    $faqs = \App\Models\FAQ::all();
    return view('dashboard', [
        'news' => $news,
        'faqs' => $faqs
    ]);
}
}
