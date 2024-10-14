<?php

namespace App\Models\Traits;

trait SelectBox
{

    public function getSelectBox($bc = "", $name = "name"): array
    {
        $data = $this;

        if (!empty($bc)) {
            $data = $data->where("bc", $bc);
        }

        $data = $data->get()
            ->pluck($name, "id")
            ->toArray();

        return ['' => '-- Select --'] + $data;
    }
}
