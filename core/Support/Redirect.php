<?php

namespace Core\Support;

class Redirect
{
    protected $url;

    public function __construct($url = null)
    {
        $this->url = $url ?? $_SERVER['HTTP_REFERER'] ?? '/';
    }

    public function withInput()
    {
        General::setOldData();
        return $this;
    }

    /**
     * @param null $with
     * @return Redirect|void
     */
    public function back()
    {
        $this->url = $_SERVER['HTTP_REFERER'] ?? '/';
        return $this;
    }

    /**
     * Redirect to a specific URL
     * @param string $url
     * @return $this
     */
    public function to($url)
    {
        $this->url = url($url);
        return $this;
    }

    /**
     * Redirect using named route (e.g., route('home.index'))
     * Requires global `route()` helper to resolve route names
     */
    public function route(string $name, array $params = []): static
    {
        $this->url = route($name, $params);
        return $this;
    }


    /**
     * Perform the redirect
     * @return void
     */
    public function go()
    {
        header('Location: ' . $this->url);
        exit;
    }

    /**
     * @param $data
     */
    public function backWithErrors($data){
        Session::push('errors',$data);
        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function backWith($key,$message){
        Session::flash($key, $message);
        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * Attach a flash message and redirect
     * @param string $type
     * @param string $message
     * @return void
     */
    public function with($type, $message)
    {
        Session::flash($type, $message);
        $this->go();
    }

}