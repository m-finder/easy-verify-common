<?php

namespace Wu\EasyVerifyCommon;

interface HttpResult
{
    public function isSuccess();

    public function isFail();

    public function isProcessing();

    public function getData();

    public function getReason();
}