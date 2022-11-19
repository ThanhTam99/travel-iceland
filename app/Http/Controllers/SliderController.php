<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy("id", "DESC")->paginate(5);
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            "title" => "required|unique:slider|max:255",
            "description" => "required|max:255",
            "image" => "required|image|mimes:jpg,png,jpeg,gif,sgv|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max-height=2000",
            "status" => "required",
        ],
        [
            "title.unique" => "Ten danh muc game da co, xin nhap ten khac",
            "title.required" => "Ten danh muc la bat buoc",
            "description.required" => "Mo ta danh muc la bat buoc",
            "image.required" => "Hinh anh la bat buoc",
        ]
        );
        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->description = $data['description'];


        // Add image into folder
        $get_image = $request->image;
        $path = "uploads/slider/";

        $get_name_image = $get_image->getClientOriginalName(); //hinhanh.jpg

        $name_image = current(explode('.', $get_name_image)); // hinhanh . jpg "current(explode('.',$get_name_image))" -> get .jpg
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $slider->image = $new_image;

        $slider->status  = $data['status'];
        $slider->save();
        return redirect()->route("slider.index")->with("status", "Them slider game thanh cong");
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
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
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
            "description" => "required|max:255",
            "image" => "image|mimes:jpg,png,jpeg,gif,sgv|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max-height=2000",
            "status" => "required",
        ],
        [
            "title.required" => "Ten danh muc la bat buoc",
            "description.required" => "Mo ta danh muc la bat buoc",
            "image.required" => "Hinh anh la bat buoc",
        ]
        );
        $slider = Slider::find($id);
        $slider->title = $data['title'];
        $slider->description = $data['description'];


        // Add image into folder
        $get_image = $request->image;
        if ($get_image) {
            // Remove image
            $path_unlink = "uploads/slider/" . $slider->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            // Add new image
            $path = "uploads/slider/";
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh.jpg
            $name_image = current(explode('.', $get_name_image)); // hinhanh . jpg "current(explode('.',$get_name_image))" -> get .jpg
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $slider->image = $new_image;
        }
        $slider->status  = $data['status'];
        $slider->save();
        return redirect()->back()->with("status", "Sua slider thanh cong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $path_unlink = "uploads/slider/" . $slider->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $slider->delete();
        return redirect()->back();
    }
}
