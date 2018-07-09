<?php

# phpunit has memory leak by itself. Thus, it cannot be used to test memory leak.

require_once('generated/Bar/TestInclude.php');
require_once('generated/Foo/TestEnum.php');
require_once('generated/Foo/TestMessage.php');
require_once('generated/Foo/TestMessage_Sub.php');
require_once('generated/Foo/TestPackedMessage.php');
require_once('generated/Foo/TestPhpDoc.php');
require_once('generated/Foo/TestUnpackedMessage.php');
require_once('generated/GPBMetadata/Proto/Test.php');
require_once('generated/GPBMetadata/Proto/TestInclude.php');
require_once('test_util.php');

use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBType;
use Foo\TestMessage;
use Foo\TestMessage_Sub;

$from = new TestMessage();
TestUtil::setTestMessage($from);
TestUtil::assertTestMessage($from);

$data = $from->encode();

$to = new TestMessage();
$to->decode($data);

TestUtil::assertTestMessage($to);

$from->setRecursive($from);

$arr = new RepeatedField(GPBType::MESSAGE, TestMessage::class);
$arr []= new TestMessage;
$arr[0]->SetRepeatedRecursive($arr);

// Test oneof fields.
$m = new TestMessage();

$m->setOneofInt32(1);
assert(1 === $m->getOneofInt32());
assert(0.0 === $m->getOneofFloat());
assert('' === $m->getOneofString());
assert(NULL === $m->getOneofMessage());
$data = $m->encode();
$n = new TestMessage();
$n->decode($data);
assert(1 === $n->getOneofInt32());

$m->setOneofFloat(2.0);
assert(0 === $m->getOneofInt32());
assert(2.0 === $m->getOneofFloat());
assert('' === $m->getOneofString());
assert(NULL === $m->getOneofMessage());
$data = $m->encode();
$n = new TestMessage();
$n->decode($data);
assert(2.0 === $n->getOneofFloat());

$m->setOneofString('abc');
assert(0 === $m->getOneofInt32());
assert(0.0 === $m->getOneofFloat());
assert('abc' === $m->getOneofString());
assert(NULL === $m->getOneofMessage());
$data = $m->encode();
$n = new TestMessage();
$n->decode($data);
assert('abc' === $n->getOneofString());

$sub_m = new TestMessage_Sub();
$sub_m->setA(1);
$m->setOneofMessage($sub_m);
assert(0 === $m->getOneofInt32());
assert(0.0 === $m->getOneofFloat());
assert('' === $m->getOneofString());
assert(1 === $m->getOneofMessage()->getA());
$data = $m->encode();
$n = new TestMessage();
$n->decode($data);
assert(1 === $n->getOneofMessage()->getA());
