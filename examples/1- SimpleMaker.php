<?php

require __DIR__ . '/../vendor/autoload.php';

use AhjDev\PhpTagMaker\TagMaker;
use AhjDev\PhpTagMaker\HtmlClass;
use AhjDev\PhpTagMaker\Node\HtmlTag;

$output = TagMaker::build(
    HtmlTag::div(
        'my-class-name',
        HtmlTag::pre('A Pre Tag'),
        HtmlTag::div(
            new HtmlClass(['class-1', 'class-2'])
        )
    )
);
print($output);
