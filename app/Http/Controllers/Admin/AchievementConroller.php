<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAchRequest;
use App\Models\Admin\Achievement;
use App\Models\Admin\Lang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AchievementConroller extends Controller
{

    protected $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
        
    }
    //
    public function index()
    {
        $achieves = Achievement::withTrashed()->get();
        return view('admin.achieve.index' , ['achieves'=>$achieves]);

    }

    public function add(){
        return view('admin.achieve.add' , ['langs'=>$this->langs]);
    }

    public function edit($id){
        return view('admin.achieve.edit' , ['langs'=>$this->langs , 'ach'=> Achievement::findOrFail($id)]);
    }

    public function store(StoreAchRequest $request) {
         // dd($request->all());
        try{

            $image_name = null;
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/achs'), $image_name);  
            }


            DB::beginTransaction();
           $ach =  Achievement::create([
                'value'=>$request->value,
                'max_value'=>$request->max_value,
                'image'=>$image_name
            ]);
            foreach ($this->langs as $lang) {
                $ach->{'name:'.$lang->code}               = $request->name[$lang->code];
                $ach->{'small_des:'.$lang->code}          = $request->small_des[$lang->code];
            }
            $ach->save();
            DB::commit();
            Alert::success('success', 'Achievement Stored Successfully !');
            return redirect()->route('admin.ach.index');
           

        }catch(\Exception $e){
          DB::rollBack();
          dd($e->getMessage() , $e->getLine());
        }
        
    }

    public function update(StoreAchRequest $request ,$id)
    {
        try{


            $achievement = Achievement::findOrFail($id);
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/achs'), $image_name);
                if (isset($achievement->image) && file_exists(public_path('uploads/images/achs/' .$achievement->image))) {
                    unlink(public_path('uploads/images/achs/' .$achievement->image));
                }
                $achievement->image = $image_name;
                
            }
            $achievement->update([
                'value'=>$request->value,
                'max_value'=>$request->max_value
            ]);

            foreach ($this->langs as $lang) {
                $achievement->{'name:'.$lang->code}               = $request->name[$lang->code];
                $achievement->{'small_des:'.$lang->code}          = $request->small_des[$lang->code];
            }
            $achievement->save();
            Alert::success('success', 'Achievement Updated Successfully !');
            return redirect()->route('admin.ach.index');

        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage() , $e->getCode());
        }

    }




    public function destroy($id)
    {
        $ach = Achievement::findOrFail($id);
        $ach->forceDelete();
        Alert::success('success', 'Achievement Deleted Successfully !');
        return redirect()->route('admin.ach.index');
    }

    public function soft_delete($id)
    {
        $ach = Achievement::findOrFail($id);
        $ach->delete();
        Alert::success('success', 'Achievement Soft Deleted Successfully !');
        return redirect()->route('admin.ach.index');

    }

    public function restore($id)
    {
        $ach = Achievement::withTrashed()->findOrFail($id);
        $ach->restore();
        Alert::success('success', 'Achievement Restored Successfully !');
        return redirect()->route('admin.ach.index');

    }





}
