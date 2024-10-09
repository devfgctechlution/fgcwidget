<?php
namespace FGCQuickWeb\Widgets;

/**
 * Description of ActivatorInterface
 *
 * @author Hoang Bien<hoangbien264@gmail.com>
 * @copyright (c) 2024, Fgc Techlution, JSC
 */
use FGCQuickWeb\Widgets\Widget;
interface ActivatorInterface {
    /**
     * Enables a widget
     * @param Widget $widget
     * @return void
     */
    public function enable(Widget $widget): void;
    /**
     * Disables a widget
     * @param Widget $widget
     * @return void
     */
    public function disable(Widget $widget): void;
    /**
     * Determine whether the given status same with a widget status
     * @param Widget $widget
     * @param bool $active
     * @return bool
     */
    public function hasStatus(Widget $widget, bool $active): bool;
    /**
     * Set active state for a widget
     * @param Widget $widget
     * @param bool $active
     * @return void
     */
    public function setActive(Widget $widget, bool $active): void;
    /**
     * Sets a module status by its name
     * @param string $name
     * @param bool $active
     * @return void
     */
    public function setActiveByName(string $name, bool $active): void;
    /**
     * Deletes a widget activation status
     * @param Widget $widget
     * @return void
     */
    public function delete(Widget $widget): void;
    /**
     * Deletes any Widget activation statuses created by this class
     * @return void
     */
    public function reset(): void;
}
