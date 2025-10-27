<?php

use App\Models\Category;
use App\Models\Metapage;
use App\Models\Post;
// use App\Models\category;

function getchildren($parent_id)
{
    $children = Category::where('parent_id', $parent_id)->get();
    return $children;
}
function getMetas($segment1, $segment2)
{

    if (!Request::segment(1)) {

        $links = MetaPage::where("page_name", "home")->first();
        if ($links) {
            $meta = (object) [
                'title' => ucfirst($links->meta_title),
                'description' => $links->meta_description,
                'image' => 'uploads/' . $links->ogimage,
                'keywords' => $links->keywords,
            ];
            return $meta;
        } else {
            $meta = (object) [
                'title' => 'NepByte',
                'description' => '"Discover top IT solutions including IT services, Display Marketing, and SEO services at Home/NepByte. Boost your business efficiency today!',
                'image' => 'images/defaultimage.png',
                'keywords' => 'NepByte, software development, custom software solutions, IT services, SaaS development, mobile app development, cloud software, enterprise applications, software consulting, tech company',
            ];
            return $meta;
        }
    }
    $links = MetaPage::where("page_name", "!=", "home")->where('page_name', $segment1)->first();
    if ($links) {
        $meta = (object) [
            'title' => ucfirst($links->meta_title),
            'description' => $links->meta_description,
            'image' => 'uploads/' . $links->ogimage,
            'keywords' => $links->keywords,
        ];
        return $meta;
    } else if (Request::segment(1) == 'category') {
        $category = Category::where('slug', $segment2)->first();

        $meta = (object) [
            'title' => $category->meta_title,
            'description' => $category->meta_description,
            'image' => 'uploads/' . $category->image,
            'keywords' => $category->meta_keywords,
        ];
        return $meta;
    }
    else if (Request::segment(1) == 'post') {
        $blog = Post::where('url_slug', $segment2)->first();
        if (!$blog) {
            $blog = Post::where('slug', $segment2)->first();
        }

        $meta = (object) [
            'title' => $blog->meta_title,
            'description' => $blog->meta_description,
            'image' => 'uploads/' . $blog->featured_image,
            'keywords' => $blog->meta_keywords,
        ];
        return $meta;
    }
    else if (Request::segment(1) == 'search') {
        $search = Request::query('q');

        $blog = "Search for $search";

        $meta = (object) [
            'title' => $blog,
            'description' => $blog,
            'image' => 'uploads/' . $blog,
            'keywords' => "search",
        ];
        return $meta;
    }
     else {
        $links = MetaPage::where("page_name", "home")->first();
        if ($links) {
            $meta = (object) [
                'title' => ucfirst($links->meta_title),
                'description' => $links->meta_description,
                'image' => 'uploads/' . $links->ogimage,
                'keywords' => $links->keywords,
            ];
            return $meta;
        } else {
            $meta = (object) [
                'title' => 'NepByte',
                'description' => '"Discover top IT solutions including IT services, Display Marketing, and SEO services at Home/NepByte. Boost your business efficiency today!',
                'image' => 'images/defaultimage.png',
                'keywords' => 'NepByte, software development, custom software solutions, IT services, SaaS development, mobile app development, cloud software, enterprise applications, software consulting, tech company',
            ];

            return $meta;
        }

    }



}
