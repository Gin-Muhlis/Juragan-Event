<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle('Berita');
        SEOTools::setDescription('Temukan berbagai berita atau artikel mengenai juragan event ataupun berita dari event-event yang disediakan oleh Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::twitter()->setSite('@juraganevent1');

        $allArticles = Post::limit(2)->latest()->get();
        $popularArticles = Post::join('visitors', 'posts.id', '=', 'visitors.post_id')
            ->select('posts.*', DB::raw('COUNT(visitors.id) as visitor_count'))
            ->groupBy('posts.id', 'posts.image', 'posts.title', 'posts.slug', 'posts.content', 'posts.created_at', 'posts.user_id', 'posts.topic_mix_id', 'posts.updated_at')
            ->orderByDesc('visitor_count')
            ->limit(3)
            ->get();

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];


        return view('user.blog', [
            'tittle' => 'Blog',
            'allArticles' => $allArticles,
            'popularArticles' => $popularArticles,
            'bulan' => $bulan
        ]);
    }

    public function show($slug)
    {

        // $post = Post::with('user')->where('slug', $slug)->first();
        $post = Cache::rememberForever('posts.' . $slug, function () use ($slug) {
            return Post::with('user')->where('slug', $slug)->first();
        });
        $content = explode(' ', strip_tags($post->content));
        $keyword = explode(', ', $post->topicMix->topic);

        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription(implode(' ', array_slice($content, 0, 25)));
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $post->topicMix->topic, 'property');
        SEOMeta::addKeyword($keyword);

        OpenGraph::setDescription(implode(' ', array_slice($content, 0, 25)));
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl(URL::current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'id-id');
        OpenGraph::addProperty('locale:alternate', ['id-id']);

        JsonLd::setTitle($post->title);
        JsonLd::setDescription(implode(' ', array_slice($content, 0, 25)));
        JsonLd::setType('Article');

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $anotherPosts = Post::where('slug', '!=', $slug)->get();

        return view('user.details.detailBerita', [
            'tittle' => 'Detail Berita',
            'post' => $post,
            'bulan' => $bulan,
            'anotherPosts' => $anotherPosts
        ]);
    }

    public function addBlog(Request $request)
    {
        $page = $request->input('currentPage');

        $articles = Post::limit($page)->latest()->get();
        $result = [];
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];


        foreach ($articles as $article) {
            $words_title = explode(' ', $article->title);
            $result[] = [
                'id' => $article->id,
                'path' => Storage::url($article->image),
                'title' => implode(' ', array_slice($words_title, 0, 3)) . (count($words_title) > 3 ? '...' : ''),
                'slug' => $article->slug,
                'description' => strip_tags(substr($article->content, 0, 100)),
                'created_at' => substr($article->created_at, 8, 2) . ' ' . $bulan[substr($article->created_at, 5, 2)] . ' ' . substr($article->created_at, 0, 4),
            ];
        }
        return response()->json(['articles' => $result]);
    }
}
