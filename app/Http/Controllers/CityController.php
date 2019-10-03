<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $city;

    public function __construct(City $city)
    {
        $this->city = $city;

    }

    public function index()
    {
        $cities = $this->city->all();
        return view('cities.list', compact('cities'));

    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->name;
        $city->save();

        return redirect()->route('cities.index');
    }

    public function edit($id)
    {
        $city = $this->city->find($id);

        return view('cities.edit', compact('city'));
    }

    public function update($id, Request $request)
    {
        $city = $this->city->find($id);
        $city->name = $request->input('name');
        $city->save();
        return redirect()->route('cities.index');
    }

    public function destroy($id){
        $city = $this->city->find($id);
        $city->delete();

        return redirect()->route('cities.index');
    }

}
