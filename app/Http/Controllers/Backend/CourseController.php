<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseSection;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
    public function AllCourse()
    {

        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();
        return view('instructor.courses.all_course', compact('courses'));
    } //End Method

    public function AddCourse()
    {
        $categories = Category::latest()->get();
        return view('instructor.courses.add_course', compact('categories'));
    }//End Method

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }//End Method

    public function StoreCourse(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4|max:10000',
        ]);

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('uploads/course/thambnail/' . $name_gen);
        $save_url = 'uploads/course/thambnail/' . $name_gen;

        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('uploads/course/video/'), $videoName);
        $save_video = 'uploads/course/video/' . $videoName;

        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ','-',$request->course_name)),
            'description' => $request->description,
            'video' => $save_video,

            'level' => $request->level,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certeficate' => $request->certeficate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        ///Course Goal Started
        $goals = Count($request->course_goals);
        if ($goals != NULL) {
            for ($i = 0; $i < $goals; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }
        ///Course Goal ended
        $notification = array(
            'message' =>'Course created successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.course')->with($notification);
    }//End Method

    public function EditCourse($id){
        $course=Course::find($id);
        $goals=Course_goal::where('course_id',$id)->get();
        $categories=Category::latest()->get();
        $subcategories=SubCategory::latest()->get();
        return view('instructor.courses.edit_course',compact('course','categories','subcategories','goals'));
    }//End Method

    public function UpdateCourseImage(Request $request){
        $course_id=$request->id;
        $oldImage=$request->old_img;

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('uploads/course/thambnail/' . $name_gen);
        $save_url = 'uploads/course/thambnail/' . $name_gen;

        if(file_exists($oldImage)){
            unlink($oldImage);
        }

        Course::find($course_id)->update([
            'course_image'=> $save_url,
            'updated_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message' =>'Course Image Updated successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }//End Method

    public function UpdateCourseVideo(Request $request){
        $course_id=$request->id;
        $oldVideo=$request->old_vid;

        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('uploads/course/video/'), $videoName);
        $save_video = 'uploads/course/video/' . $videoName;

        if(file_exists($oldVideo)){
            unlink($oldVideo);
        }

        Course::find($course_id)->update([
            'video'=> $save_video,
            'updated_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message' =>'Course Video Updated successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }//End Method

    public function UpdateCourseGoal(Request $request){
        $cid=$request->id;
        if($request->course_goals == NULL){
            return redirect()->back();
        }else{
            Course_goal::where('course_id',$cid)->delete();
              ///Course Goal Started
        $goals = Count($request->course_goals);
        if ($goals != NULL) {
            for ($i = 0; $i < $goals; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $cid;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }// end loop
        }
        ///Course Goal ended

        }
        $notification = array(
            'message' =>'Course Goal Updated successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }// End Method

    public function DeleteCourse($id){
        $course=Course::find($id);
        if($course->course_image){
        unlink($course->course_image);}
        if($course->video){
            unlink($course->video);
        }

        Course::find($id)->delete();

        $goalsData=Course_goal::where('course_id',$id)->get();
        foreach($goalsData as $item){
            $item->goal_name;
            Course_goal::where('course_id',$id)->delete();
        }
        $notification = array(
            'message' =>'Course Delete successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }//End Method

    public function AddCourseLecture($id){
        $course = Course::find($id);
        $section=CourseSection::where('course_id',$id)->latest()->get();
        return view('instructor.courses.section.add_course_lecture', compact('course','section'));
    }//End Method

    public function AddCourseSection(Request $request){
        $cid=$request->id;
        CourseSection::insert([
            'course_id'=>$cid,
            'section_title'=>$request->section_title,
        ]);
        $notification = array(
            'message' =>'Course Section Added successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }//End Method
}
