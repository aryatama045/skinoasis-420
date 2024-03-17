<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Theme;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    # set theme
    public function theme($name = "")
    {
        $settingActiveThemes = getSetting("active_themes");


        $active_themes = $settingActiveThemes != null ? json_decode($settingActiveThemes) : [1];
        $theme = Theme::whereIn('id', $active_themes)->where('code', $name)->first();

        if(session('theme') != $name){
            if (Auth::check()) {
                Cart::where('user_id', Auth::user()->id)->delete();
            } else {
                Cart::where('guest_user_id', (int) $_COOKIE['guest_user_id'])->delete();
            }
        }

        if(!is_null($theme)){
            session(['theme' => $name]);
        }else{
            flash(localize('The page you are looking for is not available at this moment'))->error();
        }

        return redirect()->route('home');
    }

    # homepage
    public function index()
    {
        $blogs = Blog::isActive()->latest()->take(3)->get();

        $sliders = [];
        if (getSetting('hero_sliders') != null) {
            $sliders = json_decode(getSetting('hero_sliders'));
        }

        $brands = Brand::get();
        // dd($brands);

        $banner_section_one_banners = [];
        if (getSetting('banner_section_one_banners') != null) {
            $banner_section_one_banners = json_decode(getSetting('banner_section_one_banners'));
        }

        $client_feedback = [];
        if (getSetting('client_feedback') != null) {
            $client_feedback = json_decode(getSetting('client_feedback'));
        }

        $trending1 = Blog::where('placement','1')->isActive()->latest()->take(1)->get();
        $trending2 = Blog::where('placement','2')->isActive()->latest()->take(1)->get();
        $trending3 = Blog::where('placement','3')->isActive()->latest()->take(1)->get();


        return getView('pages.home', ['blogs' => $blogs, 'trending1' => $trending1, 'trending2' => $trending2, 'trending3' => $trending3, 'sliders' => $sliders, 'brands' => $brands, 'banner_section_one_banners' => $banner_section_one_banners, 'client_feedback' => $client_feedback]);
    }

    # all brands
    public function allBrands()
    {
        return getView('pages.brands');
    }

    # all categories
    public function allCategories()
    {
        return getView('pages.categories');
    }

    # all coupons
    public function allCoupons()
    {
        return getView('pages.coupons.index');
    }

    # all offers
    public function allOffers()
    {
        return getView('pages.offers');
    }

    # all blogs
    public function allBlogs(Request $request)
    {
        $searchKey  = null;
        $blogs = Blog::isActive()->latest();

        if ($request->search != null) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->category_id != null) {
            $blogs = $blogs->where('blog_category_id', $request->category_id);
        }

        $blogs = $blogs->paginate(paginationNumber(5));
        return getView('pages.blogs.index', ['blogs' => $blogs, 'searchKey' => $searchKey]);
    }

    # blog details
    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return getView('pages.blogs.blogDetails', ['blog' => $blog]);
    }

    # get all campaigns
    public function campaignIndex()
    {
        return getView('pages.campaigns.index');
    }

    # campaign details
    public function showCampaign($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        return getView('pages.campaigns.show', ['campaign' => $campaign]);
    }

    # about us page
    public function aboutUs()
    {
        $features = [];

        if (getSetting('about_us_features') != null) {
            $features = json_decode(getSetting('about_us_features'));
        }

        $why_choose_us = [];

        if (getSetting('about_us_why_choose_us') != null) {
            $why_choose_us = json_decode(getSetting('about_us_why_choose_us'));
        }

        return getView('pages.quickLinks.aboutUs', ['features' => $features, 'why_choose_us' => $why_choose_us]);
    }

    # contact us page
    public function contactUs()
    {
        return getView('pages.quickLinks.contactUs');
    }

    # quick link / dynamic pages
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return getView('pages.quickLinks.index', ['page' => $page]);
    }

    function filterTemplates(){

        $searchKey = null;
        $per_page = 9;
        $max_range = Product::max('max_price');
        $min_value = 0;
        $max_value = formatPrice($max_range, false, false, false, false);
        $tags = Tag::all();

        return getView('pages.products.inc.productSidebar',compact('min_value', 'max_value','max_range','tags'));
    }
}
