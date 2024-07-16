<?php

include 'vendor/autoload.php';

use AhjDev\PhpTagMaker\TagMaker;
use AhjDev\PhpTagMaker\Node\Tag;
use AhjDev\PhpTagMaker\Node\Text;
use AhjDev\PhpTagMaker\Node\EscapedText;

$maker = new TagMaker();
$maker->formatOutput(true);
$output = $maker->run(
    Tag::a(
        'Can also use a string or Stringable Class',
        Tag::foo(),
        Tag::ul(
            Tag::li('li', 'one'),
            Tag::li('li', 'two'),
            Tag::li('three')->setAttribute('class', 'aha'),
        ),
        new Text('<a> without escape'),
        new EscapedText('<a> with escape'),
    ),
);
