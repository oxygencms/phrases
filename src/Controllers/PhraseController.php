<?php

namespace Oxygencms\Phrases\Controllers;

use JavaScript;
use Oxygencms\Phrases\Models\Phrase;
use Illuminate\Support\Facades\Cache;
use Oxygencms\Core\Controllers\Controller;
use Oxygencms\Phrases\Requests\AdminPhraseRequest as PhraseRequest;

class PhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Phrase::class);

        JavaScript::put(['models' => Phrase::allWithAccessors('edit_url')]);

        return view('oxygencms::admin.phrases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Phrase::class);

        return view('oxygencms::admin.phrases.create', ['phrase' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PhraseRequest $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PhraseRequest $request)
    {
        $this->authorize('create', Phrase::class);

        $phrase = Phrase::create($request->validated());

        Cache::tags('phrases')->flush();

        notification("$phrase->model_name successfully created.");

        return redirect()->route('phrase.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Phrase $phrase
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Phrase $phrase)
    {
        $this->authorize('update', Phrase::class);

        return view('oxygencms::admin.phrases.edit', compact('phrase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PhraseRequest $request
     * @param Phrase $phrase
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PhraseRequest $request, Phrase $phrase)
    {
        $this->authorize('update', Phrase::class);

        $phrase->update($request->validated());

        Cache::tags('phrases')->flush();

        notification("$phrase->model_name successfully updated.");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Phrase $phrase
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Phrase $phrase)
    {
        $this->authorize('delete', Phrase::class);

        $phrase->delete();

        Cache::tags('phrases')->flush();

        return jsonNotification($phrase->model_name . ' successfully deleted.');
    }
}
