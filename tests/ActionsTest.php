<?php

namespace R4nkt\PhpSdk\Tests;

use R4nkt\PhpSdk\Exceptions\NotFoundException;

class ActionsTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        // clear existing actions
        $this->clearResources($this->r4nkt->actions());
    }

    /** @test */
    public function it_can_get_actions_when_there_are_none()
    {
        $this->assertCount(0, $this->r4nkt->actions());
    }

    /** @test */
    public function it_can_create_an_action()
    {
        $customId = 'test.customId';
        $name = 'test.name';
        $description = 'test.description';

        $action = $this->createAction($customId, $name, $description);

        $this->assertSame($customId, $action->custom_id);
        $this->assertSame($name, $action->name);
        $this->assertSame($description, $action->description);
    }

    /** @test */
    public function it_can_get_actions()
    {
        $expectedCustomIds = [
            'action.a',
            'action.b',
            'action.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createAction($customId);
        }

        $actions = $this->r4nkt->actions();

        $this->assertCount(count($expectedCustomIds), $actions);
        foreach ($actions as $action) {
            $this->assertContains($action->custom_id, $expectedCustomIds);
        }
    }

    /** @test */
    public function it_can_get_an_action()
    {
        $expectedCustomIds = [
            'action.a',
            'action.b',
            'action.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createAction($customId);
        }

        $action = $this->r4nkt->action('action.b');

        $this->assertSame('action.b', $action->custom_id);
    }

    /** @test */
    public function it_cannot_get_a_nonexistent_action()
    {
        $this->expectException(NotFoundException::class);

        $this->r4nkt->action('nonexistent.action');
    }

    /** @test */
    public function it_can_get_delete_an_action_via_r4nkt()
    {
        $customId = 'action.a';
        $action = $this->createAction($customId);

        $this->r4nkt->deleteAction($action->custom_id);

        $this->assertCount(0, $this->r4nkt->actions());
    }

    /** @test */
    public function an_action_can_delete_itself()
    {
        $customId = 'action.a';
        $action = $this->createAction($customId);

        $action->delete();

        $this->assertCount(0, $this->r4nkt->actions());
    }
}
