<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLang($lang){
        if($lang == 'ru'){
            session()->put('locale', $lang);
            App::setLocale('ru');
        }
        else{
            session()->put('locale', $lang);
            App::setLocale('en');
        }
        return redirect()->back();
    }
}
