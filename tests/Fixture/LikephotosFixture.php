<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LikephotosFixture
 */
class LikephotosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'created' => '2024-04-24',
                'user_id' => 1,
                'photo_id' => 1,
            ],
        ];
        parent::init();
    }
}
