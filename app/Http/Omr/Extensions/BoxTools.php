<?php

namespace Encore\Admin\Widgets;

use Illuminate\Support\Collection;

class BoxTools
{

  /**
   * Collection of tools.
   *
   * @var Collection
   */
  protected $tools;

  /**
   * Create a new Tools instance.
   *
   * @param \Encore\Admin\Widgets\Box $box
   */
  public function __construct()
  {
    $this->tools = new Collection();

  }

  /**
   * @return Collection
   */
  public function getTools(): Collection
  {
    return $this->tools;
  }

  /**
   * Append tools.
   *
   * @param string $tool
   *
   * @return $this
   */
  public function append($tool)
  {
    $this->tools->push($tool);

    return $this;
  }

  /**
   * Prepend a tool.
   *
   * @param string $tool
   *
   * @return $this
   */
  public function prepend($tool)
  {
    $this->tools->prepend($tool);

    return $this;
  }

}
