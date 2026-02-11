<?php

namespace App\Repositories;

use App\Models\Watch;

class WatchRepository
{
    public function getAll()
    {
        return Watch::all();
    }

    public function create(Watch $watch)
    {
        return $watch->save();
    }

    public function delete(Watch $watch)
    {
        return $watch->delete();
    }

    public function update(Watch $watch)
    {
        return $watch->save();
    }

    public function find($id)
    {
        return Watch::with(['feature', 'strap', 'type'])->find($id);
    }


    public function exists(Watch $watch)
    {
        return Watch::where('model', $watch->model)
            ->where('brand', $watch->brand)
            ->exists();
    }

    public function existsById($id)
    {
        return Watch::where('id', $id)->exists();
    }

    public function getAllByPrice($price)
    {
        return Watch::where('price', '>', $price)
            ->orderBy('brand', 'ASC')
            ->get();
    }
}