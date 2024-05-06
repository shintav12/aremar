<?php

namespace App\Repository;

use App\Models\OrderModel;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{

    public const MODEL_CLASS = OrderModel::class;

    public function datatable()
    {
        return $this->model->where("status", "!=", 2)
            ->get(['id', 'name', 'status',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }


    public function update(array $data, $id)
    {
        $offers = $this->model->findOrFail($id);

        return DB::transaction(function () use ($data, $offers) {
            $offers->update([
                "delivered_status"=>$data['delivered_status'],
            ]);
            return "";
        });
    }
}
