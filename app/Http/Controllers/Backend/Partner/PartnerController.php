<?php

namespace App\Http\Controllers\Backend\Partner;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PartnerController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:partner'])->only('index');
    }

    # partner list
    public function index(Request $request)
    {
        $searchKey = null;
        $is_published = null;

        $pages = Partner::orderBy('id','ASC');
        if ($request->search != null) {
            $pages = $pages->where('title', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }


        $pages = $pages->paginate(paginationNumber());
        return view('backend.pages.partner.pages.index', compact('pages', 'searchKey'));
    }


    # return view of create form
    public function create()
    {
        return view('backend.pages.partner.pages.create');
    }

    # partner store
    public function store(Request $request)
    {
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->thumbnail_image = $request->image;
        $blog->banner = $request->banner;
        $blog->meta_img = $request->meta_image;

        if ($request->slug != null) {
            $blog->slug = Str::slug($request->slug);
        } else {
            $blog->slug = Str::slug($request->title) . '-' . Str::random(5);
        }

        $blog->blog_category_id = $request->category_id;
        $blog->short_description = $request->short_description;

        $blog->video_link = $request->video_link;
        $blog->description = $request->description;

        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;

        $blog->save();
        $blog->tags()->sync($request->tag_ids);

        $blogLocalization = BlogLocalization::firstOrNew(['lang_key' => env('DEFAULT_LANGUAGE'), 'blog_id' => $blog->id]);
        $blogLocalization->title = $blog->title;
        $blogLocalization->short_description = $blog->short_description;
        $blogLocalization->description = $blog->description;
        $blogLocalization->save();

        $blog->save();
        flash(localize('Blog has been inserted successfully'))->success();
        return redirect()->route('admin.blogs.index');
    }

    # edit partner
    public function edit(Request $request, $id)
    {
        $lang_key = $request->lang_key;
        $language = Language::isActive()->where('code', $lang_key)->first();
        if (!$language) {
            flash(localize('Language you are trying to translate is not available or not active'))->error();
            return redirect()->route('admin.partner.index');
        }

        $partner = Partner::findOrFail($id);

        return view('backend.pages.partner.pages.edit', compact('partner', 'lang_key'));
    }

    # update partner
    public function update(Request $request)
    {
        $partner = Partner::findOrFail($request->id);

        if ($request->lang_key == env("DEFAULT_LANGUAGE")) {
            $partner->title = $request->title;
            $partner->slug = (!is_null($request->slug)) ? Str::slug($request->slug, '-') : Str::slug($request->name, '-') . '-' . strtolower(Str::random(5));

            $partner->content = $request->content;

            $partner->meta_title = $request->meta_title;
            $partner->meta_description = $request->meta_description;

            $partner->save();
        }


        $partner->save();

        flash(localize('Has been updated successfully'))->success();
        return back();
    }

    # delete partner
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        BlogTag::where('blog_id', $blog->id)->delete();
        $blog->delete();
        flash(localize('Blog has been deleted successfully'))->success();
        return back();
    }
}
