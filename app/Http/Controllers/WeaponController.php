<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weapon;

class WeaponController extends Controller
{
    public function index(){
        $weapons = Weapon::obtainWeapons('ar');
        return view('weapon.index', compact('weapons'));
    }
}
