<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * @package   CodeIgniter WebSocket Library: Config file
 * @category  Libraries
 * @author    Taki Elias <taki.elias@gmail.com>
 * @license   http://opensource.org/licenses/MIT > MIT License
 * @link      https://github.com/takielias
 *
 * CodeIgniter WebSocket library. It allows you to make powerful realtime applications by using Ratchet Websocket
 */
class CodeigniterWebsocket extends \Takielias\CodeigniterWebsocket\Config\CodeigniterWebsocket
{
    public $host = "127.0.0.1";
    public $port = 5000;
    public $timer = false;
    public $interval = 1;
    public $auth = false;
    public $debug = false;
    public $jwt_key = "GGFSRTSYTSOPLGCCXS";
    public $token_timeout = 1;

    public $callbacks = ['auth', 'event', 'close', 'citimer', 'roomjoin', 'roomleave', 'roomchat'];
}
