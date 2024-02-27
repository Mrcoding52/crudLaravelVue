<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    protected $etudiant;
    public function __construct()
    {
        $this->etudiant = new Etudiant();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->etudiant->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->etudiant->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = $this->etudiant->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etudiant = $this->etudiant->find($id);
        $etudiant->update($request->all());
        return $etudiant;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = $this->etudiant->find($id);
        return $etudiant->delete();
    }
}
