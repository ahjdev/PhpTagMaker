<?php

require __DIR__ . '/../vendor/autoload.php';

use AhjDev\PhpTagMaker\TagMaker;
use AhjDev\PhpTagMaker\Node\HtmlTag;
use AhjDev\PhpTagMaker\Node\HtmlText;
use AhjDev\PhpTagMaker\Node\EscapedText;
use AhjDev\PhpTagMaker\Node\HtmlTagMulti;

$maker = new TagMaker();
$output = $maker
    ->formatOutput()
    ->run(
        HtmlTag::span(
            HtmlTag::a(
                'github.com/ahjdev',
                'My Github',
            ),
            'Can also use a string',
            HtmlTag::ul(
                HtmlTag::li('one'),
                HtmlTag::li('two'),
                HtmlTag::li('three')->setClass('Class 1', 'Class 2'),
            ),
            HtmlText::make('<a> without escape'),
            HtmlTag::br(),
            EscapedText::make('<a> with escape'),
            HtmlTag::br(),
            HtmlTagMulti::make(['a', 'b', 'code'], 'Multi tag'),
            HtmlTag::br(),
            HtmlTagMulti::make(
                ['c', 'r', 'y'],
                HtmlTag::b('inside tag'),
                ' ',
                'Just text'
            )
        )
    );
print($output);

$myTag = HtmlTag::make('myTag', 'myValue');
// Set attribute
$myTag->setAttribute('foo1', 'bar');
$myTag->setAttribute('foo2', 'baz');

// Get value of attribute
var_dump($myTag->getAttribute('foo1')); // bar

// Remove attribute
$myTag->removeAttribute('foo1');

// Whether attribute exists
var_dump($myTag->hasAttribute('foo1')); // false
var_dump($myTag->hasAttribute('foo2')); // true

// Set attribute directly
$myTag->setId('myid');
// Set class directly
$myTag->setClass('blah');
// Change tag name (Can check with getName method)
$myTag->setName('h1');

// Iterate attributes
foreach ($myTag->iterAttributes() as $attr) {
    // $attr is instanceof DOMAttr
    // var_dump($attr);
}
print($maker->run($myTag));
