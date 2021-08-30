<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\DataCollector\RequestDataCollector;
use Symfony\Component\VarDumper\Cloner\Data;
use Zenstruck\Browser\Response;
use Zenstruck\Browser\Test\HasBrowser;

class SeveralButtonClickTest extends WebTestCase
{
    use HasBrowser;

    public function testFirstButtonClick(): void
    {
        $this
            ->browser()
            ->interceptRedirects()
            ->get('/')
            ->fillField('default[fieldOne]', '1')
            ->fillField('default[fieldTwo]', '2')
            ->click('First button')
            ->assertContains('clicked firstButton')
        ;
    }

    public function testSecondButtonClick(): void
    {
        $this
            ->browser()
            ->interceptRedirects()
            ->get('/')
            ->fillField('default[fieldOne]', '1')
            ->fillField('default[fieldTwo]', '2')
            ->click('Second button')
            ->assertContains('clicked secondButton')
        ;
    }

    public function testFirstPlainButtonClick(): void
    {
        /** @var RequestDataCollector $request */
        $request = $this
            ->browser()
            ->interceptRedirects()
            ->get('/')
            ->fillField('default[fieldOne]', '1')
            ->fillField('default[fieldTwo]', '2')
            ->withProfiling()
            ->click('firstPlainButton')
            ->assertNotContains('clicked firstPlainButton')
            ->profile()->getCollector('request');

        /** @var Data $submittedData */
        $submittedData = $request->getRequestRequest()->get('submit');
        self::assertSame('firstPlainButton', $submittedData->getValue());
    }

    public function testSecondPlainButtonClick(): void
    {
        /** @var RequestDataCollector $request */
        $request = $this
            ->browser()
            ->interceptRedirects()
            ->get('/')
            ->fillField('default[fieldOne]', '1')
            ->fillField('default[fieldTwo]', '2')
            ->withProfiling()
            ->click('secondPlainButton')
            ->assertNotContains('clicked secondPlainButton')
            ->profile()->getCollector('request');

        /** @var Data $submittedData */
        $submittedData = $request->getRequestRequest()->get('submit');
        self::assertSame('secondPlainButton', $submittedData->getValue());
    }
}
