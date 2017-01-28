<?php

use Faker\Factory as Faker;
use App\Models\Broadcast;
use App\Repositories\BroadcastRepository;

trait MakeBroadcastTrait
{
    /**
     * Create fake instance of Broadcast and save it in database
     *
     * @param array $broadcastFields
     * @return Broadcast
     */
    public function makeBroadcast($broadcastFields = [])
    {
        /** @var BroadcastRepository $broadcastRepo */
        $broadcastRepo = App::make(BroadcastRepository::class);
        $theme = $this->fakeBroadcastData($broadcastFields);
        return $broadcastRepo->create($theme);
    }

    /**
     * Get fake instance of Broadcast
     *
     * @param array $broadcastFields
     * @return Broadcast
     */
    public function fakeBroadcast($broadcastFields = [])
    {
        return new Broadcast($this->fakeBroadcastData($broadcastFields));
    }

    /**
     * Get fake data of Broadcast
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBroadcastData($broadcastFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'message' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $broadcastFields);
    }
}
