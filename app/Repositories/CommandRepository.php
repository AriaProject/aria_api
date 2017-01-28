<?php

namespace App\Repositories;

use App\Models\Command;
use InfyOm\Generator\Common\BaseRepository;

class CommandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'commands',
        'description',
        'return',
        'argc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Command::class;
    }
}
