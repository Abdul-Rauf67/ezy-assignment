<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function getThemeMode()
    {
        $user = Auth::user();
        return response()->json(['themeMode' => $user->theme_mode]);
    }

    public function updateThemeMode(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'themeMode' => 'required|string|in:light,dark',
        ]);

        $user->theme_mode = $request->input('themeMode');
        $user->save();

        return response()->json(['message' => 'Theme mode updated']);
    }
}
