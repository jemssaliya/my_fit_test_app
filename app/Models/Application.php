<?php

namespace App;

class Application extends \Illuminate\Foundation\Application
{

    public function publicPath(): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'public_html';
    }

}
