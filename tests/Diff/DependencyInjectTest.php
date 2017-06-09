<?php

namespace FineDiffTests\Diff;

use PHPUnit\Framework\TestCase;
use Mockery as m;
use iphis\FineDiff\Diff;

class DependencyInjectTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetGranularity()
    {
        $character = m::mock('iphis\FineDiff\Granularity\Character');
        $character->shouldReceive('justTesting')->once();

        $diff = new Diff($character);
        $granularity = $diff->getGranularity();

        $granularity->justTesting();
    }

    public function testGetRenderer()
    {
        $html = m::mock('iphis\FineDiff\Render\Html');
        $html->shouldReceive('justTesting')->once();

        $diff = new Diff(null, $html);
        $renderer = $diff->getRenderer();

        $renderer->justTesting();
    }

    public function testRender()
    {
        $opcodes = m::mock('iphis\FineDiff\Parser\Opcodes');
        $opcodes->shouldReceive('generate')->andReturn('c12');

        $parser = m::mock('iphis\FineDiff\Parser\Parser');
        $parser->shouldReceive('parse')->andReturn($opcodes);

        $html = m::mock('iphis\FineDiff\Render\Html');
        $html->shouldReceive('process')->with('hello', $opcodes)->once();


        $diff = new Diff(null, $html, $parser);
        $diff->render('hello', 'hello2');
    }

    public function testGetParser()
    {
        $parser = m::mock('iphis\FineDiff\Parser\Parser');
        $parser->shouldReceive('justTesting')->once();

        $diff = new Diff(null, null, $parser);
        $parser = $diff->getParser();

        $parser->justTesting();
    }

    public function testGetOpcodes()
    {
        $parser = m::mock('iphis\FineDiff\Parser\Parser');
        $parser->shouldReceive('parse')->with('foobar', 'eggfooba')->once();

        $diff = new Diff(null, null, $parser);
        $diff->getOpcodes('foobar', 'eggfooba');
    }
}
