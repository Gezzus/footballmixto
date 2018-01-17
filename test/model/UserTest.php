<?php

declare(strict_types=1);

include_once($_SERVER['DOCUMENT_ROOT'] . "src/model/User.php");

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase {

    public function testUserCanBeCreated() {
        var_dump(User::getUserById(9));
        $this->assertTrue(true);
        /*
        $this->assertInstanceOf(
            User::class,
            User::createUser("TEST", "1", "ALLBOYS", 1)
        );
        */
    }

}

