<?php

namespace App\Repositories\Eloquent;
use App\Models\Feedback;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class FeedbackRepository extends  BaseRepository {

    public function __construct(Feedback $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

}
?>
