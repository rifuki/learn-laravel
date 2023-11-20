<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption(): void
    {
        $content = 'RifuKi';
        $encrypt = Crypt::encrypt($content);
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals($content, $decrypt);
    }
}
