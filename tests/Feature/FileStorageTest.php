<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage(): void
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'put your content here');

        $content = $filesystem->get('file.txt');

        self::assertEquals('put your content here', $content);
    }

    public function testPublic(): void
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', 'mahoma rifuki');

        $content = $filesystem->get('file.txt');

        self::assertEquals('mahoma rifuki', $content);
    }

    public function testUpload()
    {
        $image = UploadedFile::fake()->image('kuroi.jpg');

        $this->post('/file/upload', [
            'picture' => $image
        ])
            ->assertSeeText('kuroi.jpg')
            ->assertStatus(200);
    }
}
