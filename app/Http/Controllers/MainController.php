<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Content;
use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function dashboard()
    {
        $categories = Category::select()->get();
        return view('dashboard')->with('categories', $categories);
    }

    public function category()
    {
        $categories = Category::select()->get();
        return view('category')->with('categories', $categories);
    }

    public function addCategory(Request $request)
    {
        if ($request->id) {
            if ($request->hasFile('icon')) {
                $file      = $request->file('icon');
                $extension = $file->extension();
                $icon      = uniqid() . "." . $extension;
                $file->storeAs('/public/image', $icon);
                $affected = Category::where('id', $request->id)->update([
                    'name' => $request->name,
                    'icon' => $icon
                ]);
            } else {
                $affected = Category::where('id', $request->id)->update([
                    'name' => $request->name,
                ]);
            }
        } else {
            $file      = $request->file('icon');
            $extension = $file->extension();
            $icon      = uniqid() . "." . $extension;
            $file->storeAs('/public/image', $icon);

            $affected = Category::insert([
                'name' => $request->name,
                'icon' => $icon
            ]);
        }
        if ($affected) return true;
        else return false;
    }

    public function deleteCategory(Request $request)
    {
        $affected = Category::where('id', $request->id)->delete();

        if ($affected) return true;
        else return false;
    }

    public function question()
    {
        $categories = Category::select()->get();
        $questions  = Question::select()->get();
        return view('question')
            ->with('categories', $categories)
            ->with('questions', $questions);
    }

    public function questionManage(Request $request)
    {
        $id       = $request->question_id;
        $question = $request->question;
        $type     = $request->type;
        $category = $request->category;
        $ans_a    = $request->answer_a;
        $ans_b    = $request->answer_b;
        $ans_c    = $request->answer_c;
        $ans_d    = $request->answer_d;
        $ex_opt   = $request->correct_answer_option;
        $ex_tf    = $request->correct_answer_tf;

        if ($id) { // update question
            if ($type == "option") { // question type is options
                $affected = Question::where('id', $id)->update([
                    'content'  => $question,
                    'type'     => $type,
                    'category' => $category,
                    'answer_a' => $ans_a,
                    'answer_b' => $ans_b,
                    'answer_c' => $ans_c,
                    'answer_d' => $ans_d,
                    'correct'  => $ex_opt
                ]);
            } else { // question type is true or false
                $affected = Question::where('id', $id)->update([
                    'content'  => $question,
                    'type'     => $type,
                    'category' => $category,
                    'correct'  => $ex_tf
                ]);
            }
        } else { // add question
            if ($type == "option") { // question type is options
                $affected = Question::insert([
                    'content'  => $question,
                    'type'     => $type,
                    'category' => $category,
                    'answer_a' => $ans_a,
                    'answer_b' => $ans_b,
                    'answer_c' => $ans_c,
                    'answer_d' => $ans_d,
                    'correct'  => $ex_opt
                ]);
            } else { // question type is true or false
                $affected = Question::insert([
                    'content'  => $question,
                    'type'     => $type,
                    'category' => $category,
                    'correct'  => $ex_tf
                ]);
            }
        }

        if ($affected) return true;
        else return false;
    }

    public function deleteQuestion(Request $request)
    {
        $id = $request->id;
        $affected = Question::where('id', $request->id)->delete();

        if ($affected) return true;
        else return false;
    }

    public function user()
    {
        // User::where("role", )
        return view("user");
    }

    public function content()
    {
        $categories = Category::get();
        $contents   = Content::get();
        return view("content")
            ->with('categories', $categories)
            ->with('contents', $contents);
    }

    public function addContent(Request $request)
    {
        $title    = $request->title;
        $method   = $request->method;
        $category = $request->category;
        $url      = $request->import_url;

        if ($method == "upload") {
            $file      = $request->file('content_file');
            $extension = $file->extension();
            $icon      = uniqid() . "." . $extension;
            $path       = $file->storeAs('/public/contents', $icon);

            $affected = Content::insert([
                'title'    => $title,
                'url'      => $path,
                'category' => $category
            ]);
        } else {
            $affected = Content::insert([
                'title'    => $title,
                'url'      => $url,
                'category' => $category
            ]);
        }

        if ($affected) return true;
        else return false;
    }

    public function quiz()
    {
        $categories = Category::get();
        $questions  = Question::get();

        return view('quiz')
            ->with('categories', $categories)
            ->with('questions', $questions);
    }

    public function addQuiz(Request $request)
    {
        $affected = Quiz::insert([
            'title'  => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'date' => $request->date,
            'categories' => $request->categories
        ]);

        if ($affected) return true;
        else return false;
    }
}
