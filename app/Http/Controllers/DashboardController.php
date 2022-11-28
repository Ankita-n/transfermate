<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Repositories\SaveDataInterface;

class DashboardController extends Controller
{
    protected $saveData;
    public function __construct(SaveDataInterface $saveData){
        $this->saveData = $saveData;
    }

    public function home()
    {
        return view('dashboard');
    }

    //store xml data in database
    public function featchStoreData()
    {
        $data = $this->saveData->featchAndStoreData();
        session()->flash('message', $data['message']);
        return redirect('/');
    }

    //search by author name and find the author all information
    public function searchAuthorData(Request $request)
    {
        $author_infos = [];
        $search_data = '';
        if ($request->has('search_data') && !empty($request->search_data)) {
            $search_data = $request->search_data;
            $author_infos =  Author::where('author_name', 'like', '%' . $request->search_data . '%')->with('books')->get();
        }
        return view('dashboard', ['author_infos' => $author_infos,'search_data'=>$search_data]);
    }
}
