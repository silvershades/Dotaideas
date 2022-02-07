<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = null;
        $filter = null;

        if ($request->has('sort')) {
            $sort = $request->input('sort');
        }
        if ($request->has('filter')) {
            $filter = $request->input('filter');
        }

        $posts = Post::select('posts.*', DB::raw('SUM(votes.vote) as votos'))
            ->where("posts.is_active", '=', 1)
            ->leftJoin('votes', 'posts.id', '=', 'votes.post_id')
            ->when($sort, function ($query, $sort) {
                switch ($sort) {
                    case 'date':
                    {
                        return $query->orderBy('created_at', 'desc');
                        break;
                    }
                    case 'score':
                    {
                        return $query->orderBy('votos', 'desc');
                        break;
                    }
                    default:
                    {
                        return $query->orderBy('created_at', 'desc');
                        break;
                    }
                }
            })
            ->when($filter, function ($query, $filter) {
                switch ($filter) {
                    case 'all':
                    {
                        break;
                    }
                    case 'heroes':
                    {
                        return $query->where('post_type_id', 1);
                        break;
                    }
                    case 'items':
                    {
                        return $query->where('post_type_id', 2);
                        break;
                    }
                    case 'others':
                    {
                        return $query->where('post_type_id', 3);
                        break;
                    }
                    default:
                    {
                        return;
                        break;
                    }
                }

            })
            ->groupBy('posts.id')
            ->paginate(12);


        return view('home.index', compact('posts'));
    }

}
