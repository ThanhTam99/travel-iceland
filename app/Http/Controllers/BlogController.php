<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::orderBy("id", "DESC")->paginate(5);
        return view('admin.blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|unique:categories|max:255",
            "description" => "required|max:255",
            "image" => "required|image|mimes:jpg,png,jpeg,gif,sgv|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max-height=2000",
            "status" => "required",
        ],
        [
            "title.unique" => "Ten danh muc game da co, xin nhap ten khac",
            "title.required" => "Ten danh muc la bat buoc",
            "slug.unique" => "Slug da co, xin nhap ten khac",
            "slug.required" => "Slug la bat buoc",
            "description.required" => "Mo ta danh muc la bat buoc",
            "image.required" => "Hinh anh la bat buoc",
        ]
        );
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->description = $data['description'];


        // Add image into folder
        $get_image = $request->image;
        $path = "uploads/blog/";

        $get_name_image = $get_image->getClientOriginalName(); //hinhanh.jpg

        $name_image = current(explode('.', $get_name_image)); // hinhanh . jpg "current(explode('.',$get_name_image))" -> get .jpg
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $blog->image = $new_image;

        $blog->status  = $data['status'];
        $blog->save();
        return redirect()->route("blog.index")->with("status", "Them danh muc thanh cong");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "title" => "required|max:255",
            "slug" => "required|max:255",
            "description" => "required|max:255",
            "image" => "image|mimes:jpg,png,jpeg,gif,sgv|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max-height=2000",
            "status" => "required",
        ],
        [
            "title.required" => "Ten danh muc la bat buoc",
            "slug.required" => "Slug la bat buoc",
            "description.required" => "Mo ta danh muc la bat buoc",
            "image.required" => "Hinh anh la bat buoc",
        ]
        );
        $blog = Blog::find($id);
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];
        $blog->description = $data['description'];


        // Add image into folder
        $get_image = $request->image;
        if ($get_image) {
            // Remove image
            $path_unlink = "uploads/blog/" . $blog->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            // Add new image
            $path = "uploads/blog/";
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh.jpg
            $name_image = current(explode('.', $get_name_image)); // hinhanh . jpg "current(explode('.',$get_name_image))" -> get .jpg
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $blog->image = $new_image;
        }
        $blog->status  = $data['status'];
        $blog->save();
        return redirect()->back()->with("status", "Sua danh muc thanh cong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $path_unlink = "uploads/blog/" . $blog->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $blog->delete();
        return redirect()->back();
    }
}