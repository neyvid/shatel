<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newRepository;

    public function __construct()
    {
        $this->newRepository = new  NewsRepository();
    }

    public function all()
    {
        $news = $this->newRepository->all()->where('status', 1);
        return $news;
    }
    public function create(Request $request)
    {
        return $request->all();
    }

}
