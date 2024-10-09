<?php

namespace FGCQuickWeb\Widgets;

/**
 * Description of Widget
 *
 * @author Hoang Bien<hoangbien264@gmail.com>
 * @copyright (c) 2024, Fgc Techlution, JSC
 */
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\Translator;
use FGCQuickWeb\Widgets\ActivatorInterface;

abstract class Widget {

    use Macroable;

    protected $app;
    protected $name;
    protected $path;

    /**
     * 
     * @var Filesystem
     */
    private $files;
    private $translator;
    private $activetor;

    public function __construct(Container $app, string $name, $path) {
        $this->name = $name;
        $this->path = $path;
        $this->files = $app['files'];
        $this->translator = $app['translator'];
        $this->activetor = $app[ActivatorInterface::class];
        $this->app = $app;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Get name in lower case.
     *
     * @return string
     */
    public function getLowerName(): string {
        return strtolower($this->name);
    }

    /**
     * Get name in studly case.
     *
     * @return string
     */
    public function getStudlyName(): string {
        return Str::studly($this->name);
    }

    /**
     * Get name in snake case.
     *
     * @return string
     */
    public function getSnakeName(): string {
        return Str::snake($this->name);
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string {
        return $this->get('description');
    }

    /**
     * Get priority.
     *
     * @return string
     */
    public function getPriority(): string {
        return $this->get('priority');
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path): Module {
        $this->path = $path;

        return $this;
    }

}
