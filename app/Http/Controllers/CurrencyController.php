<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $currencies = Currency::all();
            return view('currencies.index', compact('currencies'));
        } else {
            // Handle unauthorized access
        }
    }

    public function create()
    {
        if (Auth::user()->role == 1) {
            return view('currencies.create');
        } else {
            // Handle unauthorized access
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $currency = new Currency();
            $currency->name = $request->input('name');
            $currency->code = strtoupper($request->input('code'));;
            $currency->convertion_rate = $request->input('convertion_rate');
            // Set other properties as needed
            $currency->save();

            return redirect()->route('currencies.index')->with('success', 'Currency created successfully.');
        } else {
            // Handle unauthorized access
        }
    }

    public function edit($id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $currency = Currency::findOrFail($id);
            return view('currencies.edit', compact('currency'));
        } else {
            // Handle unauthorized access
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $currency = Currency::findOrFail($id);
            $currency->name = $request->input('name');
            $currency->code = strtoupper($request->input('code'));
            $currency->convertion_rate = $request->input('convertion_rate');
            // Update other properties as needed
            $currency->save();

            return redirect()->route('currencies.index')->with('success', 'Currency updated successfully.');
        } else {
            // Handle unauthorized access
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $currency = Currency::findOrFail($id);
            $currency->delete();

            return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully.');
        } else {
            // Handle unauthorized access
        }
    }
}
