<?php

use Faker\Factory as Faker;
use App\Models\Viewer;
use App\Repositories\ViewerRepository;

trait MakeViewerTrait
{
    /**
     * Create fake instance of Viewer and save it in database
     *
     * @param array $viewerFields
     * @return Viewer
     */
    public function makeViewer($viewerFields = [])
    {
        /** @var ViewerRepository $viewerRepo */
        $viewerRepo = App::make(ViewerRepository::class);
        $theme = $this->fakeViewerData($viewerFields);
        return $viewerRepo->create($theme);
    }

    /**
     * Get fake instance of Viewer
     *
     * @param array $viewerFields
     * @return Viewer
     */
    public function fakeViewer($viewerFields = [])
    {
        return new Viewer($this->fakeViewerData($viewerFields));
    }

    /**
     * Get fake data of Viewer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeViewerData($viewerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'username' => $fake->word,
            'email' => $fake->word,
            'points' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $viewerFields);
    }
}
