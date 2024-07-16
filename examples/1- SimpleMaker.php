<?php

include 'vendor/autoload.php';

use AhjDev\PhpTagMaker\TagMaker;
use AhjDev\PhpTagMaker\Node\Tag;
use AhjDev\PhpTagMaker\Node\Text;
use AhjDev\PhpTagMaker\Node\EscapedText;

$output = TagMaker::build(
    Tag::a(
        new Tag('foo', 'bar'),
        Tag::ul(
            Tag::li('li', 'one'),
            Tag::li('li', 'two'),
            Tag::li('three'),
        ),
        Text::make('<a> without escape </a>'),
        EscapedText::make('<a> with escape'),
    ),
);
print($output);