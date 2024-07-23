<?php

declare(strict_types=1);

require_once 'src/Entities/Song.php';

use PHPUnit\Framework\TestCase;

class SongTest extends TestCase {
    public function testGetLength(): void
    {
        $song = new Song('song 2', 3.00, NULL);
        $result = $song->getLength();

        $expected = '3:00';

        $this->assertEquals($expected, $result);
    }
}