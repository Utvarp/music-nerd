<?php
namespace MusicNerd;

use MusicNerd\Exceptions\MissingParameters;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

/**
 * Interacts with the Spotify API
 */
class Spotify
{
    /**
     * Stores the session to connect to Spotify
     * @var SpotifyWebAPI\Session
     */
    protected $session;

    /**
     * Stores the Spotify API
     * @var SpotifyWebAPI\SpotifyWebAPI
     */
    protected $api;

    /**
     * Store the target market to search into. Needs to be "ISO 3166-1 alpha-2" country code
     * @var string
     */
    protected $market;

    /**
     * Access token used to interact with the Spotify API
     * @var string
     */
    private $accessToken;

    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $market
     */
    public function __construct($client_id, $client_secret, $market)
    {
        $this->session = new Session(
            $client_id,
            $client_secret
        );

        $this->session->requestCredentialsToken();
        $this->accessToken = $this->session->getAccessToken();

        $this->api = new SpotifyWebAPI();
        $this->api->setAccessToken($this->accessToken);

        $this->market = $market;
    }

    /**
     * Search for a track with a string.
     * @param  string $string String to search for
     * @param  int $limit  Number of item to limit the results
     * @param  int $offset Number of items to skip
     * @return object
     */
    public function searchTrack($string, $limit = null, $offset = null)
    {
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'market' => $this->market,
        ];
        return $this->api->search($string, 'track', $options);
    }
}
