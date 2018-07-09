<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/descriptor.proto

namespace Google\Protobuf\Internal;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBWire;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\InputStream;

use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Describes a service.
 * </pre>
 *
 * Protobuf type <code>google.protobuf.ServiceDescriptorProto</code>
 */
class ServiceDescriptorProto extends \Google\Protobuf\Internal\Message
{
    /**
     * <code>optional string name = 1;</code>
     */
    private $name = '';
    private $has_name = false;
    /**
     * <code>repeated .google.protobuf.MethodDescriptorProto method = 2;</code>
     */
    private $method;
    private $has_method = false;
    /**
     * <code>optional .google.protobuf.ServiceOptions options = 3;</code>
     */
    private $options = null;
    private $has_options = false;

    public function __construct() {
        \GPBMetadata\Google\Protobuf\Internal\Descriptor::initOnce();
        parent::__construct();
    }

    /**
     * <code>optional string name = 1;</code>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * <code>optional string name = 1;</code>
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;
        $this->has_name = true;
    }

    public function hasName()
    {
        return $this->has_name;
    }

    /**
     * <code>repeated .google.protobuf.MethodDescriptorProto method = 2;</code>
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * <code>repeated .google.protobuf.MethodDescriptorProto method = 2;</code>
     */
    public function setMethod(&$var)
    {
        GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Internal\MethodDescriptorProto::class);
        $this->method = $var;
        $this->has_method = true;
    }

    public function hasMethod()
    {
        return $this->has_method;
    }

    /**
     * <code>optional .google.protobuf.ServiceOptions options = 3;</code>
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * <code>optional .google.protobuf.ServiceOptions options = 3;</code>
     */
    public function setOptions(&$var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Internal\ServiceOptions::class);
        $this->options = $var;
        $this->has_options = true;
    }

    public function hasOptions()
    {
        return $this->has_options;
    }

}

