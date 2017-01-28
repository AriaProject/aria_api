<?php

namespace App\Repositories;

use App\Models\Broadcast;
use InfyOm\Generator\Common\BaseRepository;

class BroadcastRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'message'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Broadcast::class;
    }
}
