<?php

namespace AudioDharma\Base;

/**
 * Class Request
 * This is somewhat modeled after the Symfony request object, insofar as it has a "createFromGlobals" method.
 * It's a pretty simple DTO used to help avoid references to superglobals throughout the app.
 * @package AudioDharma\Base
 */
class Request {

    private
        $get,
        $post,
        $cookie,
        $files,
        $server
    ;

    public function __construct(array $cookie, array $files, array $get, array $post, array $server)
    {
        $this->cookie = $cookie;
        $this->files = $files;
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    public static function createFromGlobals()
    {
        return new static($_COOKIE, $_FILES, $_GET, $_POST, $_SERVER);
    }

    /**
     * This will let you access properties like through a function.
     * E.g., for URL example.com?name=Gautama
     * this lets you get the name like so:
     * $name = $this->request->get('name');
     * It also tries not to be case-sensitive.
     * Pass no arguments to get the entire superglobal:
     * $post = $this->request->post();
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments) {
        if (isset($this->$method)) {
            $super_global = $this->$method;
            $property = isset($arguments[0]) ? $arguments[0] : false;
            if (isset($super_global[$property])) {
                return $property ? $super_global[$property] : $super_global;
            }
            if (isset($super_global[strtoupper($property)])) {
                return $property ? $super_global[strtoupper($property)] : $super_global;
            }
            if (isset($super_global[strtolower($property)])) {
                return $property ? $super_global[strtolower($property)] : $super_global;
            }
            return false;
        }
    }

    /**
     * Get the request method
     * @param null $method
     * @return bool
     */
    public function method($method = null)
    {
        if ($method) {
            $real_method = $this->server('request_method');
            return strtolower($method) === strtolower($real_method);
        }
        return $this->server('request_method');
    }

}