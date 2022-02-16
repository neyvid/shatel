<?php

namespace App\Repositories\Contract;

abstract class BaseRepository
{

    protected $model;

    public function search(string $serachValue,$searchFiled)
    {
        return $this->model::where($searchFiled,'like','%'.$serachValue.'%')->get();

    }

    public function all(string $with=null)
    {
        if($with!=null){
            return $this->model::with($with)->get();
        }
        return $this->model::all();
    }
    public function find(int $id)
    {
        return $this->model::find($id);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function delete(int $id)
    {
        $item = $this->model::find($id);
        return $item->delete();
    }

    public function update(int $id, array $data)
    {
        $item = $this->find($id);
        return $item->update($data);
    }

    public function deleteAll(array $items)
    {
        foreach ($items as $item) {
            $this->model::delete($item);
        }


    }

    public function findBy(array $criteria, $single = true, string $condition = '=')
    {
        $query = $this->model::query();
        foreach ($query as $key => $item) {
            $query->where($key, $condition, $item);
        }
        if ($single) {
            return $query->first();
        }
        return $query->get();

    }

}
