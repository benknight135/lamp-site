<?php

use LampSite\ViewTemplate;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Env
 */
class ViewTemplateTest extends TestCase
{
    public function setUp(): void {}

    public function testVars(): void {
        $this->expectNotToPerformAssertions();
        $view = new LampSite\ViewTemplate(
            "Page not found", __DIR__ . '/../templates/views/404.php');
        $view->addDefaultStylesheets();
        $view->render();
    }
}
