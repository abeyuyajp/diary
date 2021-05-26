<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Translate\V2\TranslateClient;

class TranslateController extends Controller
{
    public function __construct()
    {
        $this->api_key = env("GOOGLE_TRANSLATION_API_KEY");
    }

    public function create(Request $request)
    {
        return view('translate.create');
    }


    public function translate(Request $request)
    {
        if(!empty($request->translate)) {
            $translate = new TranslateClient();
            $lang = "en";
            $result = $translate->translate($request->translate, [
            'target' => $lang,
            ]);
            $translation = $result['text'];
            #$json = json_encode($translation);
            return response()->json(['translation'=>$translation]);
        } else {
            return redirect()->back();
        }
    }
}
