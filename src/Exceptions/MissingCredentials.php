<?php

namespace MusicNerd\Exceptions;

use Exception;

class MissingCredentials extends Exception
{
    public static function spotify()
    {
        return new static("You did not provide either your Spotify client ID, client secret, or both. They are required.");
    }
}
