<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\User;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = auth()->user()->items; 
        $itemsArray = $items->toArray(); 

        foreach ($itemsArray as &$item) { 
            $user = User::find($item['user_id']);
            $item['user_name'] = $user->name;
        }

        return view('items.index', compact('itemsArray'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
    
        $validatedData['user_id'] = auth()->id(); 
    
        $item = new Item($validatedData);
    
        if (is_object($item)) { // Verifica si $item es un objeto
            $item->save();
        } else {
            // Maneja el error si $item no es un objeto
            return redirect()->back()->with('error', 'Error al crear el artículo.');
        }
    
        return redirect()->route('items.index')->with('success', 'Artículo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // Verificar si el usuario autenticado es el propietario del artículo
        if ($item->user_id !== auth()->id()) {
            return redirect()->route('items.index')->with('error', 'No tienes los permisos para realizar esta acción.');
        }

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
         // Verificar si el usuario autenticado es el propietario del artículo
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Actualizar el artículo
        $item->update($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('items.index')->with('success', 'Artículo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Autorización para eliminar el item
        if ($item->user_id !== auth()->id()) {
            return redirect()->route('items.index')->with('error', 'No tienes los permisos para realizar esta acción.');
        }
        $item->delete();

    return redirect()->route('items.index')->with('success', 'Item eliminado exitosamente!');
    }

    public function allItems()
    {
        $items = Item::with('user')->get(); // Obtiene todos los items con su usuario asociado
        $itemsArray = $items->toArray(); 

        foreach ($itemsArray as &$item) { 
            $item['user_name'] = $item['user']['name'];
        }
        return view('items.all', compact('itemsArray')); 
    }
}
