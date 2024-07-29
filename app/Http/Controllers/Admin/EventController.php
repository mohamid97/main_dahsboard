<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Models\Admin\Event;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    protected $langs;
    //

    public function __construct()
    {
        $this->langs = Lang::all();
    }
    //
    public function get()  {
        $events = Event::withTrashed()->get();
        return view('admin.events.index' , ['events'=>$events , 'langs'=>$this->langs]);
    }




    public function create()
    {
        $media_groups = MediaGroup::all();
        return view('admin.events.add' , ['langs' => $this->langs , 'media_groups'=>$media_groups]);

    }

    public function store(StoreEventRequest $request)
    {
        
  
        try{
        
            $event = Event::create([
                'media_id' => $request->group_media,
            ]);
            
      
            foreach ($this->langs as $lang) {
                $event->{'title:'.$lang->code}  = $request->title[$lang->code];
                $event->{'des:'.$lang->code}  = $request->des[$lang->code];

            }
            $event->save();
            DB::commit();
            Alert::success('Success', 'Event  saved !');
            return redirect()->route('admin.ourteam.index');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.ourteam.index');
        }

    }

    public function edit($id){
        try{
            return view('admin.events.update' , ['event'=> Event::findOrFail($id) , 'langs'=> $this->langs]);

        }catch(\Exception $e){
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.ourteam.index'); 
        }
    }

    public function update(UpdateTeamRequest $request , $id)
    {

        try{
            DB::beginTransaction();
            $team = Ourteam::findOrFail($id);
            if ($request->has('image')) {
                $image_name = time() . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/teams'), $image_name);
                if ($team->image && file_exists(public_path('uploads/images/teams/' . $team->image))) {
                    unlink(public_path('uploads/images/teams/' . $team->image));
                }
                $team->image = $image_name;
            }
            $team->facebook = $request->facebook;
            $team->twitter = $request->twitter;
            $team->instagram = $request->instagram;
            $team->youtube = $request->youtube;
            $team->tiktok = $request->tiktok;
            $team->linkedin = $request->linkedin;

            foreach ($this->langs as $lang) {
                $team->{'title:' . $lang->code} = $request->title[$lang->code];
                $team->{'name:' . $lang->code} = $request->name[$lang->code];
                $team->{'des:' . $lang->code} = $request->des[$lang->code];

            }

            $team->save();
            DB::commit();
            Alert::success('Success', 'Your Member updated successfully!');
            return redirect()->route('admin.ourteam.index');


        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage() , $e->getLine());

        }

    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->forceDelete();
        Alert::success('success', 'Event Deleted Successfully !');
        return redirect()->route('admin.events.index');
    }

    public function soft_delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        Alert::success('success', 'Event Soft Deleted Successfully !');
        return redirect()->route('admin.events.index');
    }

    public function restore($id)
    {
        $event = Event::withTrashed()->findOrFail($id);
        $event->restore();
        Alert::success('success', 'Event Restored Successfully !');
        return redirect()->route('admin.events.index');

    }

}
