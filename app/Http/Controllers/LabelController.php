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
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Label::class);
        $label = Label::make();
        return view('label.create', compact('label'));
    }

    public function edit(Label $label)
    {
        $this->authorize('update', $label);
        return view('label.edit', compact('label'));
    }

    public function store(LabelRequest $request)
    {
        $this->authorize('create', Label::class);
        Label::create($request->validated());
        return to_route('labels.index')->with('status', 'Метка успешно создана');
    }


    public function update(LabelRequest $request, Label $label)
    {
        $this->authorize('update', $label);
        $label->update($request->validated());
        return to_route('labels.index')->with('status', 'Метка успешно обновлена');
    }

    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        try {
            $label->delete();
        } catch (QueryException) {
            return to_route('labels.index')->with('status', 'Не удалось удалить метку');
        }
        return to_route('labels.index')->with('status', 'Метка успешно удалена');
    }
}
