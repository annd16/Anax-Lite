<?php

namespace anna\Session;

class Session
{
    private $name;

    /**
     * Constructor
     * @param string $name (optional) The name of the session
     * @return void
     */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
        // echo("\$this->name inside Session constructor = " . $this->name);
    }

    // /**
    //  * Starts the session if not exists
    //  * @return void
    //  */
    // public function start($name = null)
    // {
    //     // Kollar om $name är satt annars sätts det till $this->name
    //     session_name($name ? $name : $this->name);
    //
    //     if (!empty(session_id())) {
    //         session_destroy();
    //     }
    //     session_start();
    // }

    /**
     * Starts the session if not exists
     * @return void
     */
    public function start($name)                // Måste skicka med namnet
    {
        session_name($name);

        if (!empty(session_id())) {
            session_destroy();
        }
        session_start();
    }

    /**
     * Gets the name of the session
     * @return string $this->name the session name
     */
    public function getSessionName()
    {
        return $this->name;
    }

    /**
     * Check if key exists in session
     * @param $key string The key to check for in session
     * @return bool true if $key exists, otherwise false
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }


    /**
     * Sets a variable in session
     * @param $key string The key in session
     * @param $val string The value to set to $key
     * @return void
     */
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    /**
     * Retrieve value if exists in session
     * @param $key string The key to get from session
     * @param $default optional The return value if not found  // KAN SÄTTA VALFRITT VÄRDE PÅ DET SOM REURNERAS OM NÅGOT VÄRDE INTE HITTAS
     * @return string The session variable if present, else $default
     */
    public function get($key, $default = false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default;
    }


    /**
     * Destroys the session and sets cookie
     * @return void
     */
    public function destroy()
    {
        // // Unset all of the session variables.
        // $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

    // Finally, destroy the session.
        session_destroy();
    }

    /**
     * Deletes variable from session if exists
     * @param $key string The key variable to unset from session
     * @return void
     */
    public function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }


    /**
     * Dumps the session
     * Good for debugging
     * @return void
     */
    public function dump()
    {
        var_dump($_SESSION);
    }
}
