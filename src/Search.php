<?php
namespace MusicNerd;

use MusicNerd\Exceptions\MissingCredentials;
use MusicNerd\Spotify;

class Search
{
    /**
     * Contains our spotify class
     * @var MusicNerd\Spotify
     */
    public $spotify = null;

    /**
     * Sets the search class to be able to use the Spotify API
     * @param  string $client_id     A Spotify Client ID
     * @param  string $client_secret A Spotify Client Secret
     * @param  string $market        Market to search into. Needs to be "ISO 3166-1 alpha-2"
     * @return $this
     */
    public function useSpotify($client_id = null, $client_secret = null, $market = null)
    {
        if (is_null($client_id) || is_null($client_secret)) {
            throw MissingCredentials::spotify();
        }
        
        $this->spotify = new Spotify($client_id, $client_secret, $market);

        return $this;
    }
}
