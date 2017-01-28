<?php

namespace App\Repositories;

use App\Models\Viewer;
use InfyOm\Generator\Common\BaseRepository;

class ViewerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'email',
        'points'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Viewer::class;
    }
}
