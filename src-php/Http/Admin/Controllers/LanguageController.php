<?php

namespace Maxfactor\CMS\Http\Admin\Controllers;

use Maxfactor\CMS\Models\Language;
use Maxfactor\CMS\Http\Controllers\Controller;
use Maxfactor\CMS\Http\Admin\Requests\LanguageRequest;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Language::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Maxfactor\CMS\Http\Admin\Requests\LanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        Language::create(
            $request->all()
        );

        return response([
            'message' => __('Successfully created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $locale = null, int $id)
    {
        return Language::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Maxfactor\CMS\Http\Admin\Requests\LanguageRequest  $request
     * @param  string  $locale
     * @param  Maxfactor\CMS\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, string $locale = null, Language $language)
    {
        $language->update(
            $request->all()
        );

        return response([
            'message' => __('Successfully updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $locale
     * @param  Maxfactor\CMS\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale = null, Language $language)
    {
        $language->delete();

        return response([
            'message' => __('Successfully deleted'),
        ]);
    }
}
