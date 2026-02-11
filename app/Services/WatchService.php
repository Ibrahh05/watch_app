<?php

namespace App\Services;

use App\Models\Watch;
use App\Models\Feature;
use App\Repositories\WatchRepository;

class WatchService
{
    protected $watchRepository;

    public function __construct(WatchRepository $watchRepository)
    {
        $this->watchRepository = $watchRepository;
    }

    public function getAll()
    {
        return $this->watchRepository->getAll();
    }

    public function get($id)
    {
        return $this->findWatch($id);
    }

    public function create($data)
    {
        $watch = new Watch();
        
        $watch->fill($data);

        $watch->ean = $data['ean'] ?? rand(10000000, 99999999); 
        $watch->year_edition = $data['year_edition'] ?? date('Y'); 

        if ($this->watchRepository->exists($watch)) {
            throw new \Exception("El reloj ya existe.", 409);
        }

        $this->watchRepository->create($watch);

        Feature::create([
            'watch_id' => $watch->id,
            'name' => $data['description'] ?? 'Sin descripción' 
        ]);

        return $watch;
    }

    public function delete($id)
    {
        $watch = $this->findWatch($id);
        
        Feature::where('watch_id', $watch->id)->delete();

        return $this->watchRepository->delete($watch);
    }

    public function update($data, $id)
    {
        $watch = $this->findWatch($id);
        $watch->fill($data);

        if (isset($data['description'])) {
            Feature::where('watch_id', $id)->update([
                'name' => $data['description']
            ]);
        }

        $this->watchRepository->update($watch);
        return $watch;
    }

    private function findWatch($id)
    {
        $watch = $this->watchRepository->find($id);
        if (!$watch) {
            throw new \Exception("Reloj no encontrado", 404);
        }
        return $watch;
    }
    
    public function getAllByPrice($price)
    {
        return $this->watchRepository->getAllByPrice($price);
    }
}