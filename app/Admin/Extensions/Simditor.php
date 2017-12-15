<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Simditor extends Field
{
    protected $view = 'admin.simditor';

    protected static $css = [
        '/vendor/simditor-2.3.6/styles/simditor.css',
        //'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css',
    ];

    protected static $js = [
        '/vendor/simditor-2.3.6/scripts/module.js',
        '/vendor/simditor-2.3.6/scripts/hotkeys.js',
        '/vendor/simditor-2.3.6/scripts/simditor.js',
        '/vendor/simditor-2.3.6/scripts/uploader.js',
        //'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js',
    ];

    public function render()
    {
//        $this->script = <<<EOT
//
//var editor = new Simditor({
//    textarea: document.getElementById("editor"),
//});
//
//EOT;
//        $this->script = <<<EOT
//
//var simplemde = new SimpleMDE({ element: document.getElementById("editor") });
//
//EOT;
        return parent::render();
    }
}