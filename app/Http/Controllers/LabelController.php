<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LabelController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Label::class);
        $labels = Label::all();
        return view('sections.label.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Label::class);
        $label = Label::make();
        return view('sections.label.create', compact('label'));
    }

    public function edit(Label $label)
    {
        $this->authorize('update', $label);
        return view('sections.label.edit', compact('label'));
    }

    public function store(LabelRequest $request)
    {
        $this->authorize('create', Label::class);
        $label = Label::make($request->validated());
        $label->description = $label->description ?? '';
        $label->save();
        return to_route('labels.index')->with('message', 'Метка успешно создана');
    }


    public function update(LabelRequest $request, Label $label)
    {
        $this->authorize('update', $label);
        $label->update($request->validated());
        return to_route('labels.index')->with('message', 'Метка успешно изменена');
    }

    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        try {
            $label->delete();
        } catch (QueryException) {
            return to_route('labels.index')->with('message', 'Не удалось удалить метку');
        }
        return to_route('labels.index')->with('message', 'Метка успешно удалена');
    }
}
