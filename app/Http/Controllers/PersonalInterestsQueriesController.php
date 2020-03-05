<?php

namespace App\Http\Controllers;

use App\PersonalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PersonalInterestsQueriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            return view('personsInterest.generic')->render();
        }
        else{
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function personalInterests(Request $request){
        if(Auth::check()){
            $data =$request->query();
            if(isset($data['type'])) {

                switch ($data['type']) {
                    case 'animal_lovers':
                        $dataLoad = PersonalDetails::where('interests_id','like', '%' . "Animals" . '%')->paginate(10);
                        return view('personsInterest.animalLovers', compact('dataLoad'))->render();
                        break;
                    case 'sport_and_children_lovers':
                        $dataLoad = PersonalDetails::where('interests_id','like', '%' . "Children" . '%')->where('interests_id','like', '%' . "Sports" . '%')->paginate(10);
                        return view('personsInterest.ChildrenSportLovers', compact('dataLoad'))->render();
                        break;
                    case 'people_with_six_interest':
                        $dataLoad = PersonalDetails::query('SELECT COUNT(*) where DISTINCT documents_id')->paginate(10);

                        return view('personsInterest.PeopleWithInterests', compact('dataLoad'))->render();
                        break;
                    case 'unique_interests':
                        $dataLoad = PersonalDetails::query('SELECT * where DISTINCT interests_id and documents_id is null')->paginate(10);
                        return view('personsInterest.UniqueueInterestNoDocuments', compact('dataLoad'))->render();
                        break;
                    default:
                        return view('personsInterest.generic')->render();

                }
            }

        }
        else{
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');
        }
    }

}
