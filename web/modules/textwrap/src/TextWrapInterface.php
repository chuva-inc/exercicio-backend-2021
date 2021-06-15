<?php
namespace Drupal\textwrap;
interface TextWrapInterface {
  public function wrap(string $text, int $length): array;
}
