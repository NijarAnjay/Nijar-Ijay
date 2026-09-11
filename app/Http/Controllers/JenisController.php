<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Jenis\StoreRequest;
use App\Http\Requests\Jenis\UpdateRequest;
use App\Models\Jenis;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $jenis = Jenis::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->withCount('produk')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $jenis = Jenis::withCount('produk')->latest()->paginate(10)->withQueryString();
        }

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        $this->authorize('create', Jenis::class);

        return view('jenis.create');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Jenis::class);

        $data = $request->validated();

        Jenis::create($data);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function show(Jenis $jenis)
    {
        $this->authorize('view', $jenis);

        return view('jenis.show', compact('jenis'));
    }

    public function edit(Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        return view('jenis.edit', compact('jenis'));
    }

    public function update(UpdateRequest $request, Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        $jenis->update($request->validated());

        return redirect()->route('jenis.edit', $jenis->id)->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus.');
    }
}
