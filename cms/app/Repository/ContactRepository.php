<?php

namespace App\Repository;

use App\Models\CollectionsModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\DB;

class ContactRepository extends BaseRepository
{

    public const MODEL_CLASS = ContactModel::class;

    public function datatable()
    {
        return $this->model
            ->get(['id', 'name',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }

    public function create(array $data,$type)
    {
        return DB::transaction(function () use ($data,$type) {
            return "";
        });

    }

    public function update(array $data, $id)
    {
        $collection = $this->model->findOrFail($id);
        return DB::transaction(function () use ($data, $collection) {
            return "";
        });
    }
}
