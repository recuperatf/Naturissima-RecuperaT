<?php

namespace App\Http\Controllers;

use App\Cie9Mc;
use App\DiagnosisPlan;
use App\Order;
use App\CatCIE10;
use App\User;
use App\UserRol;
use App\Valoration;
use App\Parametrization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductCategory;
use App\Product;
use App\Clinic;
use Carbon\Carbon;
use DB;
use Hash;
use Storage;
use App\ClinicalHistory;
use App\Patient;
use App\Session;
use App\SessionObjective;
use App\Keyword;
use App\AnatoPhysiologyGlosaryItem;
use App\ClinicalPhysiotherapyNote;
use App\CollectionType;
use App\Offer;

class TestController extends Controller
{
    public function index($uuid = false)
    {
        dd(Offer::find(56));
        return response()->json(['error' => 'not found'], 404);
        // $hi = CollectionType::find(24);
        // dd($hi);
        // dd(ClinicalPhysiotherapyNote::all());
        $trashedUsers = User::onlyTrashed()->get();
        // dd($trashedUsers->first());
        foreach ($trashedUsers as $user) {
            $user->name = $user->name . $user->id;
            $user->save();
        }
        dd('users name updated');
        return;
        set_time_limit(0);
        AnatoPhysiologyGlosaryItem::all()->each(function ($item) {
            // all lowercase except first letter
            $item->update([
                'name' => ucfirst(strtolower($item->name))
            ]);
        });

        Keyword::all()->each(function ($item) {
            // all lowercase except first letter
            $item->update([
                'name' => ucfirst(strtolower($item->name))
            ]);
        });
    }
}
