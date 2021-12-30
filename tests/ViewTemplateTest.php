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
        ob_start(); // buffer output
        $view = new LampSite\ViewTemplate(
            "Page not found", __DIR__ . '/../templates/views/404.php');
        $view->addDefaultStylesheets();
        $view->render();
        $output = ob_get_contents(); // get output from buffer
        ob_end_clean(); // clean output bufffer
        // TODO check contents for issues
    }
}
