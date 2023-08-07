<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostRepositoryInterface
{
    public function index()
    {
        DB::beginTransaction();

        try {
            $posts = Post::orderBy('created_at', 'desc')->paginate(5);

            /**
             * nested queries
             */

            DB::commit();

            return $posts;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong. to line 21 developed by james');

            abort(500);
        }
    }
}
