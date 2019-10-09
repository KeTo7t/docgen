<?php

namespace  KeTo7t\docgen\Writer;
use KeTo7t\docgen\Contract\WriterInterface;

class dummyWriter implements WriterInterface
{

    function  run()
    {
      var_dump("this is dummy");
    }
}