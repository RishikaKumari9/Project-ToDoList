<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index()
    {
        return view('create');
    }

    public function list()
    {
        $todos= Todo::all();
        return view('list')->with(['todos' =>$todos]);
    }

    public function update(Todo $model)
    {
        //return view('update');
        $model->delete();
        redirect()->route('model.index')->with('success','Record Deleted');

    }

    public function upload(Request $request)
    {
         $request ->validate([
            'title'=>'required|max:255'
        ]);
        $todo = $request->title;
        Todo::create(['title'=>$todo]);
        //   $todo=new Todo();
        //    $todo->title=$request->title;

        //    $todo->save();
           return redirect()->back();
    }

     public function completed($id)
     {
        $todo=Todo::find($id);
         if($todo-> completed){
             $todo-> update(['completed'=> false]);
            return redirect()->back()->with('success',"incomplete");
        }else{
            $todo->update(['completed'=>true]);
            return redirect()->back()->with('success',"complete");
        }
    }
    // public function complete($id)
    // {
    //     $todo = Todo::findOrFail($id);
    //     $todo->is_completed = 1;
    //     $todo->save();
    //     return response()->json(['success' => true]);
    // }

    // public function destroy($id)
    // {
    //     $todo = Todo::findOrFail($id);
    //     $todo->delete();
    //     return response()->json(['success' => true]);
    // }

    public function destroy($id)
{
    $todo = Todo::findOrFail($id); // Find the item
    $todo->delete(); // Delete the item
    return redirect()->back()->with('success', 'Todo deleted successfully.');
}

}
