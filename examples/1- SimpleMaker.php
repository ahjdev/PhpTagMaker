<?php

include 'vendor/autoload.php';

use AhjDev\PhpTagMaker\TagMaker;
use AhjDev\PhpTagMaker\HtmlClass;
use AhjDev\PhpTagMaker\Node\HtmlTag;

$output = TagMaker::build(
    HtmlTag::div(
        'My Class Name',
        HtmlTag::pre('A Pre Tag'),
        HtmlTag::div(
            new HtmlClass(['Class 1', 'Class 2'])
        )
    )
);
print($output);