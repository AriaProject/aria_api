<?php

use Faker\Factory as Faker;
use App\Models\Command;
use App\Repositories\CommandRepository;

trait MakeCommandTrait
{
    /**
     * Create fake instance of Command and save it in database
     *
     * @param array $commandFields
     * @return Command
     */
    public function makeCommand($commandFields = [])
    {
        /** @var CommandRepository $commandRepo */
        $commandRepo = App::make(CommandRepository::class);
        $theme = $this->fakeCommandData($commandFields);
        return $commandRepo->create($theme);
    }

    /**
     * Get fake instance of Command
     *
     * @param array $commandFields
     * @return Command
     */
    public function fakeCommand($commandFields = [])
    {
        return new Command($this->fakeCommandData($commandFields));
    }

    /**
     * Get fake data of Command
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCommandData($commandFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'commands' => $fake->word,
            'description' => $fake->word,
            'return' => $fake->word,
            'argc' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $commandFields);
    }
}
