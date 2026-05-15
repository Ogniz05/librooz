<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function chiSiamo() {
        return view('info.chi-siamo');
    }

    public function spedizioni() {
        return view('info.spedizioni');
    }

    public function resiRimborsi() {
        return view('info.resi');
    }

    public function faq() {
        return view('info.faq');
    }
}